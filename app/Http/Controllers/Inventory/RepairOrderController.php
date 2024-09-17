<?php

namespace App\Http\Controllers\Inventory;

use PDF;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Models\Employee;

use App\Models\Settlement;

use App\Models\Client\Client;

use App\Http\Controllers\Controller;

use App\Models\Product\Product;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductGroup;
use App\Models\Product\ProductClientOrder;
use App\Models\Product\ProductRepairOrder;

use App\Models\Service\Service;
use App\Models\Service\RepairOrder;
use App\Models\Service\ServiceRepairOrder;

use App\Models\Inventory\ReturnFromTheClient;
use App\Models\Inventory\Currency;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\Transaction;
use App\Models\Inventory\PaymentMethod;

use Picqer\Barcode\BarcodeGeneratorHTML;

use App\Http\Controllers\Inventory\AddProductController;
use App\Http\Controllers\FunctionsController as Functions;

class RepairOrderController extends Controller
{
    public function index()
    {
        $repair_orders = RepairOrder::paginate(25);

        return view('inventory.repair_orders.index', compact('repair_orders'));
    }

    public function create()
    {
        $clients		= Client::all();
        $warehouses		= Warehouse::all();
        $currencies		= Currency::where('active','=','1')->get();
		
        return view('inventory.repair_orders.create', compact('clients','warehouses','currencies'));
    }
    
    public function store(Request $request, RepairOrder $repair_order, Client $client)
    {
		$requestData = $request->all();
        
        $existent = RepairOrder::where('client_id', $request->get('client_id'))->where('finalized_at', null)->get();

        if($existent->count())
        {
			return back()->withError('Существует не проведеный документ "Заказ-Наряд" для данного клиента. <a href="'.route('repair_orders.show', $existent->first()).'">Нажмите для перехода</a>');
        }

		$created_at						= Carbon::now();
		$dateprefix						= $created_at->format('Y m d');
		$code_6							= sprintf("%06s",(string)$request->client_id);
		$timeStamp						= Functions::GenerateTimestamp();
		$requestData['discount']		= Client::find($request->client_id)->product_discount;
		$requestData['barcode']			= "" . $dateprefix . " " . $timeStamp . " " . $code_6 ."";
		
		$repair_order = $repair_order->create($requestData);

        return redirect()->route('repair_orders.show', ['repair_order' => $repair_order->id])->withStatus('Документ "Заказ-Наряд" зарегистрирован');
    }
    
    public function show(RepairOrder $repair_order)
    {
		$docHeaderValues = $this->docHeaderValues($repair_order);

		$repair_order->docCount						= $docHeaderValues['docCount'];
		$repair_order->docServicesCount						= $docHeaderValues['docServicesCount'];
		$repair_order->docDiscountSum				= $docHeaderValues['docDiscountSum'];
		$repair_order->docServicesDiscountSum				= $docHeaderValues['docServicesDiscountSum'];
		$repair_order->docDiscountedTotal			= $docHeaderValues['docDiscountedTotal'];
		$repair_order->docServicesDiscountedTotal			= $docHeaderValues['docServicesDiscountedTotal'];		
		$repair_order->docQuantity					= $docHeaderValues['docQuantity'];
		$repair_order->docServicesQuantity					= $docHeaderValues['docServicesQuantity'];
		$repair_order->docTotal						= $docHeaderValues['docTotal'];

        return view('inventory.repair_orders.show', compact('repair_order'));
    }
    
	public function destroy(RepairOrder $repair_order)
    {
		ServiceRepairOrder::where('repair_order_id','=',$repair_order->id)->delete();
		ProductRepairOrder::where('repair_order_id','=',$repair_order->id)->delete();
        $repair_order->delete();

        return redirect()->route('repair_orders.index')->withStatus('Документ "Заказ-Наряд" удален');
    }

    public function print_repair_order(RepairOrder $repair_order)
    {
		$products = ProductRepairOrder::select('products.article',
							'products.brand',
							'products.name',
							'product_repair_orders.quantity',
							'product_repair_orders.price',
							'product_repair_orders.total as total',
							'product_repair_orders.discount as discount',
							'product_repair_orders.total_amount as total_amount')
				->leftjoin('products','products.id','=','product_repair_orders.product_id')
				->where('product_repair_orders.repair_order_id','=',$repair_order->id)->get();
		
		$client =  Client::where('id','=', $repair_order->client_id)->first()->toArray();

        $repair_order["quantity"]				= $products->sum('quantity');
        $repair_order["subtotal"]				= $products->sum('total');
        $repair_order["discountValue"]			= $products->sum('discount');
		$repair_order["tax"]					= 0;
		$repair_order["total_amount"]			= $repair_order["subtotal"] - $repair_order["discountValue"] + $repair_order["tax"];
		
		$generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode((string)$repair_order->barcode, $generator::TYPE_CODE_128, 1, 25);
		
        $pdf = PDF::loadView('inventory.pdf.repair_orderinvoice', compact('repair_order', 'barcode', 'products', 'client', 'billingaddress', 'shippingaddress'));
        $file_name = 'repair_order-' . $repair_order->id . '.pdf';
        return $pdf->stream($file_name)->header('Content-Type','application/pdf');
    }

    //product selector
	public static function repair_order_add_single_product_store(Request $request)
	{
		
		//request data
		$product_id						= $request->productLive;
		$repair_order_id				= $request->repair_order_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		//additional data
		$repair_order					= RepairOrder::findOrFail($repair_order_id);
		
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $repair_order->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id, auth()->user()->default_warehouse_id);
		$currency						= $repair_order->currency;

		$price							= ($price !=0) ? $price : AddProductController::get_product_price($product_id, 'out', $currency);
		$total							= $price * $quantity;
		$discount						= $total * ($repair_order->discount/100);
		$total_amount					= $total - $discount;
		
		$created_at						= Carbon::now();

		//writing into recieved_products table
		$requesteddata['repair_order_id']			= $repair_order_id;
		$requesteddata['currency']					= $currency;
		$requesteddata['warehouse_id']				= $warehouse_id;
		$requesteddata['product_id']				= $product_id;
		$requesteddata['price']						= $price;
		$requesteddata['quantity']					= $quantity;
		$requesteddata['total']						= $total;
		$requesteddata['discount']					= $discount;
		$requesteddata['total_amount']				= $total_amount;
		$requesteddata['created_at']				= $created_at;
		
		ProductRepairOrder::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($repair_order);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues' => $docHeaderValues,
			'info'    => [
				'product_id'		=> $product_id,
				'repair_order_id'			=> $repair_order_id,
				'article'			=> $product->article,
				'brand'				=> $product->brand,
				'name'				=> $product->name,
				'quantity'			=> $quantity,
				'discount'			=> $discount,//+-
				'total'				=> $total,
				'stock'				=> $stock,
				'price'				=> $price,
				'total_amount'		=> $total_amount,
				'created_at'		=> $created_at,

			],
		]);
    }

	public static function repair_order_add_product(Request $request)
	{
		$edit = "false";
		$product_id						= $request->product_id;
		$repair_order_id						= $request->repair_order_id;

		$repair_order							= RepairOrder::where('id', $repair_order_id)->first();		
		$product						= Product::select('products.id as product_id','products.article','products.brand','products.name','products.full_name')
												->orderby('products.article', 'asc')
												->where('products.id','=',$product_id)
												->first()->toarray();
				
		//last price
		$product['price']				= AddProductController::get_product_price($product_id, 'out', $repair_order->currency);
		$product['repair_order_id']			= $repair_order_id;

		return view('inventory.repair_orders.addproduct_modal', compact('product','edit'));
	}

	public static function repair_order_add_product_store(Request $request)
	{
		//request data
		$product_id						= $request->product_id;
		$repair_order_id						= $request->repair_order_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		//additional data
		$repair_order							= RepairOrder::findOrFail($repair_order_id);
		
		$product						= Product::findOrFail($product_id);
		$warehouse_id					= $repair_order->warehouse_id;
		$stock							= AddProductController::get_product_stocks($product_id, auth()->user()->default_warehouse_id);
		$currency						= $repair_order->currency;

		$price							= ($price !=0) ? $price : AddProductController::get_product_price($product_id, 'out', $currency);
		$total							= $price * $quantity;
		$discount						= $total * ($repair_order->discount/100);
		$total_amount					= $total - $discount;

		$created_at						= Carbon::now();

		//writing into recieved_products table
		$requesteddata['repair_order_id']			= $repair_order_id;
		$requesteddata['currency']			= $currency;
		$requesteddata['warehouse_id']		= $warehouse_id;
		$requesteddata['product_id']		= $product_id;
		$requesteddata['price']				= $price;
		$requesteddata['quantity']			= $quantity;
		$requesteddata['total']				= $total;
		$requesteddata['discount']			= $discount;
		$requesteddata['total_amount']		= $total_amount;
		$requesteddata['created_at']		= $created_at;
		
		ProductRepairOrder::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($repair_order);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'docHeaderValues' => $docHeaderValues,
			'info'    => [
				'product_id'		=> $product_id,
				'repair_order_id'			=> $repair_order_id,
				'article'			=> $product->article,
				'brand'				=> $product->brand,
				'name'				=> $product->name,
				'quantity'			=> $quantity,
				'stock'				=> $stock,
				'price'				=> $price,
				'total'				=> $total,
				'discount'			=> $discount,//+-
				'total_amount'		=> $total_amount,
				'created_at'		=> $created_at,

			],
		]);
    }

	public function repair_order_edit_product(Request $request)
    {
		$edit = "true";
		$repair_order_id = $request->repair_order_id;
		$product_id = $request->product_id;
		
		$product = ProductRepairOrder::select('product_repair_orders.quantity','product_repair_orders.price','product_repair_orders.repair_order_id','products.id as product_id','products.article','products.brand','products.name','products.full_name')
					->where('product_id','=',$product_id)
					->join('products', 'products.id', '=', 'product_repair_orders.product_id')
					->where('repair_order_id','=',$repair_order_id)
					->first();
		if($repair_order_id)
		{
			$product = $product->toarray();
		}
		
		return view('inventory.repair_orders.addproduct_modal', compact('product','edit'));
    }
	

	public function repair_order_update_product_store(Request $request)
	{
		$product_id								= $request->product_id;
		$repair_order_id						= $request->repair_order_id;
		$price									= floatval($request->price);//????
		$quantity								= $request->quantity;

		$repair_order							= RepairOrder::findOrFail($repair_order_id);
		$item									= ProductRepairOrder::where('repair_order_id','=',$repair_order_id)->where('product_id','=',$product_id)->get()->first();

		if ($item)
		{
            $old_price			= $item->price;
            $old_quantity		= $item->quantity;

            $new_price			= $request->price;
            $new_quantity		= $request->quantity;
            $new_total			= $new_price * $new_quantity;
            $new_discount		= $new_total * ($repair_order->discount/100);//
            $new_total_amount	= $new_total - $new_discount;

            if ($old_price != $new_price || $old_quantity != $new_quantity)
			{
                $repair_order = RepairOrder::find($repair_order_id);
                if ($repair_order) {
                    $item = $item->update([
                        'price'			=> $new_price,
                        'quantity'		=> $new_quantity,
                        'total'			=> $new_total,
                        'discount'		=> $new_discount,
                        'total_amount'	=> $new_total_amount,
                    ]);

					$docHeaderValues = self::docHeaderValues($repair_order);

					if ($item) {
                        return response()->json([
                            'status'  => 1 , 
                            'message' => ['Обновлен', 'success'],
                            'docHeaderValues' => $docHeaderValues,
                            'info'    => [
                                    'product_id'    => $product_id,
									'price'			=> $new_price,
									'quantity'		=> $new_quantity,
									'total'			=> $new_total,
									'discount'		=> $new_discount,
									'total_amount'	=> $new_total_amount,
                            ],
                        ]);
                    }
                    $error_message = 'Ошибка обновления услуги';
                }
                $error_message = 'Неверный номер заказа';
            }
            $error_message = 'Вы не изменили значения';
        }
	}
    
	public function clear_products_table(RepairOrder $repair_order)
    {
		ProductRepairOrder::where('repair_order_id','=',$repair_order->id)->delete();
		return back()->withStatus('Products table cleared.');
    }
	
	public function clear_services_table(RepairOrder $repair_order)
    {
		ServiceRepairOrder::where('repair_order_id','=',$repair_order->id)->delete();
		return back()->withStatus('Products table cleared.');
    }
	
	public function repair_order_delete_product(Request $request)
    {
		if (!$request->ajax())
		{
			abort('404');
		};

		$product_id						= (int)$request->product_id;
		$repair_order_id						= (int)$request->repair_order_id;

		$item = ProductRepairOrder::where('repair_order_id','=',$repair_order_id)->where('product_id','=',$product_id)->get()->first();		
		
		if ($item) {
			$old_price    = $item->price;
			$old_quantity = $item->quantity;

			$repair_order = RepairOrder::find($repair_order_id);
			if ($repair_order)
			{
				$item = $item->delete();

				$docHeaderValues = self::docHeaderValues($repair_order);

				return response()->json([
					'status' 				=> 1 , 
					'message'				=> ['Удалено', 'success'],
					'docHeaderValues'		=> $docHeaderValues,
					'info' => [
							'product_id'	=> $product_id,
						],
					]);
			}
		}
    }
    ///////////////////////////////services
    public static function repair_order_add_single_service_store(Request $request)
    {
        //request data
        $service_id						= $request->service_id;
        $repair_order_id				= $request->repair_order_id;
        $price							= floatval($request->price);//????
        $employee_id					= $request->employee_id;

        //additional data
        $repair_order					= RepairOrder::findOrFail($repair_order_id);		
        $service						= Service::findOrFail($service_id);
        $employee						= Employee::findOrFail($employee_id);
        $warehouse_id					= $repair_order->warehouse_id;
        $currency						= $repair_order->currency;

        $price							= $price ?? 0;
        $discount						= $price * ($repair_order->discount/100);
        $total_amount					= $price - $discount;
        
        $created_at						= Carbon::now();

        //writing into recieved_services table
        $requesteddata['repair_order_id']			= $repair_order_id;
        $requesteddata['currency']					= $currency;
        $requesteddata['warehouse_id']				= $warehouse_id;
        $requesteddata['service_id']				= $service_id;
        $requesteddata['price']						= $price;
        $requesteddata['employee_id']				= $employee_id;
        $requesteddata['discount']					= $discount;
        $requesteddata['total_amount']				= $total_amount;
        $requesteddata['created_at']				= $created_at;
        
        ServiceRepairOrder::create($requesteddata);

        $docHeaderValues = self::docHeaderValues($repair_order);

        return response()->json([
            'status'  => 1 , 
            'message' => ['Товар добавлен', 'success'],
            'docHeaderValues' => $docHeaderValues,
            'info'    => [
                'service_id'				=> $service_id,
                'repair_order_id'			=> $repair_order_id,
                'article'					=> $service->article,
                'name'						=> $service->name,
                'employee_id'				=> $employee_id,
                'employee'					=> $employee->lastname . " " . $employee->firstname . " " . $employee->secondname,
                'discount'					=> $discount,
                'price'						=> $price,
                'total_amount'				=> $total_amount,
                'created_at'				=> $created_at,

            ],
        ]);
    }

    public static function repair_order_edit_service(Request $request)
    {
		$edit               = "true";
		$repair_order_id    = $request->repair_order_id;
		$service_id         = $request->service_id;

        $employees = Employee::all()->toArray();
		
		$service = ServiceRepairOrder::select('service_repair_orders.employee_id',
                        'service_repair_orders.price',
                        'service_repair_orders.repair_order_id',
                        'services.id as service_id',
                        'services.article',
                        'services.name')
					->where('service_id','=',$service_id)
					->join('services', 'services.id', '=', 'service_repair_orders.service_id')
					->where('repair_order_id','=',$repair_order_id)
					->first();
		if($repair_order_id)
		{
			$service = $service->toarray();
		}
		
		return view('inventory.repair_orders.addservice_modal', compact('service','employees','edit'));
    }

    //*<>*//
    public static function repair_order_add_service_store(Request $request)
	{
		//request data
        $service_id						= $request->service_id;
        $repair_order_id				= $request->repair_order_id;
        $price							= floatval($request->price);//????
        $employee_id					= $request->employee_id;

        //additional data
        $repair_order					= RepairOrder::findOrFail($repair_order_id);		
        $service						= Service::findOrFail($service_id);
        $employee						= Employee::findOrFail($employee_id);
        $warehouse_id					= $repair_order->warehouse_id;
        $currency						= $repair_order->currency;

        $price							= $price ?? 0;
        $discount						= $price * ($repair_order->service_discount/100);
        $total_amount					= $price - $discount;
        
        $created_at						= Carbon::now();

        //writing into recieved_services table
        $requesteddata['repair_order_id']			= $repair_order_id;
        $requesteddata['currency']					= $currency;
        $requesteddata['warehouse_id']				= $warehouse_id;
        $requesteddata['service_id']				= $service_id;
        $requesteddata['price']						= $price;
        $requesteddata['employee_id']				= $employee_id;
        $requesteddata['discount']					= $discount;
        $requesteddata['total_amount']				= $total_amount;
        $requesteddata['created_at']				= $created_at;
        
        ServiceRepairOrder::create($requesteddata);

        $docHeaderValues = self::docHeaderValues($repair_order);

        return response()->json([
            'status'  => 1 , 
            'message' => ['Услуга добавлена', 'success'],
            'docHeaderValues' => $docHeaderValues,
            'info'    => [
                'service_id'				=> $service_id,
                'repair_order_id'			=> $repair_order_id,
                'article'					=> $service->article,
                'name'						=> $service->name,
                'employee_id'				=> $employee_id,
                'employee'					=> $employee->lastname . " " . $employee->firstname . " " . $employee->secondname,
                'discount'					=> $discount,
                'price'						=> $price,
                'total_amount'				=> $total_amount,
                'created_at'				=> $created_at,

            ],
        ]);
    }

	public function repair_order_update_service_store(Request $request)
	{
		$service_id						= $request->service_id;
		$repair_order_id				= $request->repair_order_id;
		$price							= floatval($request->price);//????
		$employee_id					= $request->employee;		

		$repair_order					= RepairOrder::findOrFail($repair_order_id);
		$employee						= Employee::findOrFail($employee_id);
		$item							= ServiceRepairOrder::where('repair_order_id','=',$repair_order_id)->where('service_id','=',$service_id)->get()->first();

		if ($item)
		{
            $old_price					= $item->price;
            $old_employee_id			= $item->employee_id;			
			$new_price					= $request->price;
            $new_employee_id			= $request->employee;

            $new_discount				= $new_price * ($repair_order->service_discount/100);//
            $new_total_amount			= $new_price - $new_discount;

            if ($old_price != $new_price || $old_employee_id != $new_employee_id)
			{
                $repair_order = RepairOrder::find($repair_order_id);
                if ($repair_order)
				{
                    $item = $item->update([
                        'price'			=> $new_price,
                        'employee_id'	=> $new_employee_id,
                        'discount'		=> $new_discount,
                        'total_amount'	=> $new_total_amount,
                    ]);

					$docHeaderValues = self::docHeaderValues($repair_order);

					if ($item) {
                        return response()->json([
                            'status'  => 1 , 
                            'message' => ['Обновлен', 'success'],
                            'docHeaderValues' => $docHeaderValues,
                            'info'    => [
                                    'service_id'    => $service_id,
									'price'			=> $new_price,
									'employee_id'	=> $new_employee_id,
									'employee'		=> $employee->lastname . " " . $employee->firstname . " " . $employee->secondname,
									'discount'		=> $new_discount,
									'total_amount'	=> $new_total_amount,
                            ],
                        ]);
                    }
                    $error_message = 'Ошибка обновления услуги';
                }
                $error_message = 'Неверный номер заказа';
            }
            $error_message = 'Вы не изменили значения';
        }
	}

	public function repair_order_delete_service(Request $request)
    {
		if (!$request->ajax())
		{
			abort('404');
		};

		$service_id						= (int)$request->service_id;
		$repair_order_id				= (int)$request->repair_order_id;

		$item = ServiceRepairOrder::where('repair_order_id','=',$repair_order_id)->where('service_id','=',$service_id)->get()->first();		
		
		if ($item)
		{
			$old_price    = $item->price;
			$old_quantity = $item->quantity;

			$repair_order = RepairOrder::find($repair_order_id);
			if ($repair_order)
			{
				$item = $item->delete();

				$docHeaderValues = self::docHeaderValues($repair_order);

				return response()->json([
					'status' 				=> 1 , 
					'message'				=> ['Удалено', 'success'],
					'docHeaderValues'		=> $docHeaderValues,
					'info' => [
							'service_id'	=> $service_id,
						],
					]);
			}
		}
    }

	public static function docHeaderValues(RepairOrder $repair_order)
	{
		$docHeaderValues = [];

		//products
		$docTotalRequest										= ProductRepairOrder::where('repair_order_id','=',$repair_order->id)->get();

		$docHeaderValues['docCount']							= $docTotalRequest->count() ?? 0;
		$docHeaderValues['docDiscountSum']						= $docTotalRequest->sum('discount') ?? 0;
		$docHeaderValues['docDiscountedTotal']					= $docTotalRequest->sum('total') - $docTotalRequest->sum('discount') ?? 0;
		$docHeaderValues['docQuantity']							= $docTotalRequest->sum('quantity') ?? 0;

		$docTotalRequestServices								= ServiceRepairOrder::where('repair_order_id','=',$repair_order->id)->get();
		
		$docHeaderValues['docServicesCount']					= $docTotalRequestServices->count() ?? 0;
		$docHeaderValues['docServicesDiscountSum']				= $docTotalRequestServices->sum('discount') ?? 0;
		$docHeaderValues['docServicesDiscountedTotal']			= $docTotalRequestServices->sum('price') - $docTotalRequestServices->sum('discount') ?? 0;
		$docHeaderValues['docServicesQuantity']					= $docTotalRequestServices->sum('quantity') ?? 0;

		$docHeaderValues['docTotal']							= $docHeaderValues['docDiscountedTotal'] + $docHeaderValues['docServicesDiscountedTotal'];
		
		return $docHeaderValues;
	}

	//discount % switch++
	public function change_discount(Request $request)
	{
		$discount = $request->discount;
		$repair_order = RepairOrder::findOrFail($request->get('repair_order'));
		$repair_order->update([
			'discount' => $discount,
		]);

		$products_to_sale			= $repair_order->products;//все продукты из документа, которые списываются		

		foreach($products_to_sale as $item)
		{
			$item->update([
				'discount'			=> $discount * ($item->price / 100) * $item->quantity,
				'total_amount'		=> $item->price * ((100 - $discount) / 100) * $item->quantity,
			]);
		}
		
		$docHeaderValues	= $this->docHeaderValues($repair_order);
		
		$repairOrderProductsTable = ProductRepairOrder::select('products.article',
									'products.brand',
									'products.name',
									'product_repair_orders.quantity',
									'product_repair_orders.price',
									'product_repair_orders.total',
									'product_repair_orders.discount',
									'product_repair_orders.total_amount',
									'product_repair_orders.repair_order_id',
									'products.id as product_id')
						->join('products', 'products.id', '=', 'product_repair_orders.product_id')
						->where('repair_order_id','=',$repair_order->id)->get();

		if($repairOrderProductsTable)
		{
			foreach($repairOrderProductsTable as $product)
			{
				$product->stock = AddProductController::get_product_stocks($product->product_id, $repair_order->warehouse_id);
			}
			$ProductsTable = $repairOrderProductsTable->toArray();
		}

		return response()->json([
					'status'			=> 1 ,
					'message'			=> ['Установлена новая скидка на зачасти', 'success'],
					'docHeaderValues'	=> $docHeaderValues,
					'info'				=> $ProductsTable,
			]);
	}
	//services discount % switch++
	public function change_service_discount(Request $request)
	{
		$service_discount = $request->service_discount;
		$repair_order = RepairOrder::findOrFail($request->get('repair_order'));
		$repair_order->update([
			'service_discount' => $service_discount,
		]);

		$repair_order_services			= $repair_order->services;//все продукты из документа, которые списываются		

		foreach($repair_order_services as $item)
		{
			$item->update([
				'discount'			=> $service_discount * ($item->price / 100),
				'total_amount'				=> $item->price * ((100 - $service_discount) / 100),
			]);
		}
		
		$docHeaderValues	= $this->docHeaderValues($repair_order);
		
		$repairOrderServicesTable = ServiceRepairOrder::select('services.article',
									'services.name',
									'employees.fullname as employee',
									'service_repair_orders.price',
									'service_repair_orders.discount',
									'service_repair_orders.total_amount',
									'service_repair_orders.repair_order_id',
									'services.id as service_id')
						->join('services', 'services.id', '=', 'service_repair_orders.service_id')
						->join('employees', 'employees.id', '=', 'service_repair_orders.employee_id')
						->where('repair_order_id','=',$repair_order->id)->get();

		
		if($repairOrderServicesTable)
		{
			$ServicesTable = $repairOrderServicesTable->toArray();
		}

		return response()->json([
					'status'			=> 1 ,
					'message'			=> ['Установлена новая скидка на работы', 'success'],
					'docHeaderValues'	=> $docHeaderValues,
					'info'				=> $ServicesTable,
			]);
	}
}
