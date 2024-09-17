<?php

namespace App\Http\Controllers\Inventory;

use PDF;

use Carbon\Carbon;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

use Picqer\Barcode\BarcodeGeneratorHTML;

use App\Models\Brand\Brand;

use App\Models\Client\Client;

use App\Models\Inventory\Currency;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\ClientOrder;

use App\Models\OnlineOrder\OnlineOrder;
use App\Models\OnlineOrder\OnlineOrderProduct;

use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductGroup;
use App\Models\Product\ProductClientOrder;

use App\Http\Controllers\FunctionsController as Functions;

class OnlineClientOrdersController extends Controller
{
    public function index()
    {
        $online_client_orders = OnlineOrder::paginate(25);

        return view('inventory.online_client_orders.index', compact('online_client_orders'));
    }
    
    public function store(Request $request)
    {
        //
    }

	public function show(OnlineOrder $online_client_order)
	{
		$docHeaderValues = $this->docHeaderValues($online_client_order);

		$online_client_order->docCount						= $docHeaderValues['docCount'];
		$online_client_order->docDiscountSum				= $docHeaderValues['docDiscountSum'];
		$online_client_order->docDiscountedTotal			= $docHeaderValues['docDiscountedTotal'];
		$online_client_order->docTotal						= $docHeaderValues['docTotal'];
		$online_client_order->docQuantity					= $docHeaderValues['docQuantity'];

        return view('inventory.online_client_orders.show', compact('online_client_order','productstable'));
    }
	
	public function destroy(OnlineOrder $online_client_order)
    {
        $online_client_order->delete();

        return redirect()->route('online_client_orders.index')->withStatus('Документ "OnLine заказ покупателя" успешно удален');
    }

	public function clear_products_table(OnlineOrder $online_client_order)
    {
		OnlineOrderProduct::where('online_order_id','=',$online_client_order->id)->delete();
		return back()->withStatus('Products table cleared.');
    }
    
    public function update(Request $request, $id)
    {
        //
    }

	public function unfinalize(OnlineOrder $online_client_order)
	{
		$online_client_order->finalized_at = null;
        $online_client_order->save();

        return back()->withStatus('Отмена проведения документа "OnLine заказ покупателя" успешна');
	}
    
    //print_online_client_order
    public function print_online_client_order(OnlineOrder $online_client_order)
    {
        $online_client_order->barcode = "123456789";
		$products = OnlineOrderProduct::select('online_order_products.article',
							'online_order_products.brand',
							'online_order_products.name',
							'online_order_products.quantity',
							'online_order_products.price',
                            'online_order_products.total')
				->where('online_order_products.online_order_id','=',$online_client_order->id)->get();
				
				$online_client_order["quantity"] = $products->sum('quantity');
				$online_client_order["delivery"] = $online_client_order->shipping;
				$online_client_order["subtotal"] = $products->sum('total');
                $online_client_order["tax"] = $online_client_order->tax;
                $online_client_order["total_amount"] = $online_client_order["subtotal"]+$online_client_order["tax"];
		
		$client =  Client::where('id','=', $online_client_order->client_id)->first()->toArray();
		
		$generator = new BarcodeGeneratorHTML();
        $barcode = $generator->getBarcode((string)$online_client_order->barcode, $generator::TYPE_CODE_128, 1, 25);
        
        $pdf = PDF::loadView('inventory.pdf.online_client_order', compact('online_client_order', 'products', 'client', 'billingaddress', 'shippingaddress','barcode'));
        $file_name = "online_client_order - " . $online_client_order->id . ".pdf";
        return $pdf->stream($file_name)->header('Content-Type','application/pdf');
    }

    public static function online_client_orders_product_create(Request $request)
	{
        $online_client_order_id         = $request->online_client_order_id;
		$product_ordered_id             = $request->product_ordered_id;
        
        $product_to_create = OnlineOrderProduct::where('online_order_id','=',$online_client_order_id)->where('id','=',$product_ordered_id)->first();

		$categories			= ProductCategory::all()->toArray();
		$brands				= Brand::all()->toArray();
		$groups				= ProductGroup::all()->toArray();

		return view('inventory.online_client_orders.product_add_to_base', compact('categories','groups','product_to_create','brands'));
	}
    
    public static function online_client_orders_product_create_store(Request $request, Product $product_model)
	{
		$brand						= Str::upper($request->brand);
		$article					= Str::upper($request->article);
		$product_name				= $request->product_name;
		$category_id				= $request->category;
		$product_group_id			= $request->group;
		$group_name					= ProductGroup::where('id','=',$product_group_id)->first()->name;
		$akey						= Functions::SingleKey($article);
		$bkey						= Functions::SingleKey($brand,true);
		$pkey						= $bkey . $akey;

		$requestData['article']						= $article;
		$requestData['akey']						= $akey;
		$requestData['brand']						= $brand;		
		$requestData['bkey']						= $bkey;		
		$requestData['pkey']						= $pkey;		
		$requestData['name']						= $product_name ?? $group_name;		
		$requestData['product_category_id']			= $category_id;		
		$requestData['product_group_id']			= $product_group_id;		
		$requestData['full_name']					= ($product_name ?? $group_name). ", " . $brand . ", " . $article;
        
		$new_product = $product_model->create($requestData);
		
		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],

		]);
	}
	
	public static function client_order(Request $request, OnlineOrder $online_client_order, ClientOrder $client_order)
	{
		$requestData							= [];
        $finalized_at							= Carbon::now();
		$productsToTest							= [];
		$productsToOrder						= [];
		$online_client_order_products			= $online_client_order->products;//все продукты из документа, которые списываются

		foreach($online_client_order_products as $online_client_product)
		{
			$product_to_test = Product::where('pkey', '=', $online_client_product->pkey)->first();			
			if(!$product_to_test)
			{
				$product = "" . $online_client_product->name . ", " . $online_client_product->brand . ", " . $online_client_product->article;
				array_push($productsToTest, $product);						
			}
			else
			{
				$product = [];
				$product['product_id'] = $product_to_test->id;
				$product['warehouse_id'] = auth()->user()->default_warehouse_id;
				$product['quantity'] = $online_client_product->quantity;
				$product['price'] = $online_client_product->price;
				$product['currency'] = $online_client_order->currency;
				$product['total_amount'] = $online_client_product->price * $online_client_product->quantity;
				$product['created_at'] = $finalized_at;
				
				array_push($productsToOrder, $product);
			}
		}
		if (count($productsToTest) !== 0)
		{
			$productsList = implode("; ", $productsToTest);
			return redirect()->back()->with('error', 'Товар: << ' . $productsList .' >> отсутствует в номенклатуре! Обновите и продолжите заказ!');		
		}

		$requestData['user_id']					= auth()->user()->id;
		$requestData['client_id']				= $online_client_order->client_id;
		$requestData['warehouse_id']			= auth()->user()->default_warehouse_id;
		$requestData['currency']				= $online_client_order->currency;
		$requestData['reference_type']			= "online_client_order";
		$requestData['reference_id']			= $online_client_order->id;

		$dateprefix								= $finalized_at->format('Y m d');
		$code_6									= sprintf("%06s",(string)$online_client_order->client_id);
		$requestData['barcode']					= "" . $dateprefix . " " . $code_6 . "";

		$client_order = $client_order->create($requestData);
		
        $online_client_order->finalized_at = $finalized_at;
        $online_client_order->save();

		if(isset($productsToOrder))
		{
			foreach($productsToOrder as $product)
			{
				ProductClientOrder::insert(['client_order_id'		=> $client_order->id,
											'product_id'			=> $product['product_id'],
											'currency'				=> $client_order->currency,
											'price'					=> $product['price'],
											'total_amount'			=> $product['total_amount'],
											'warehouse_id'			=> $client_order->warehouse_id,
											'quantity'				=> $product['quantity']
										]);
			}
		}
        
        return redirect()->route('client_orders.show', ['client_order' => $client_order->id])->withStatus('Документ "OnLine Заказ покупателя" успешно зарегистрирован');
	}

	public static function docHeaderValues(OnlineOrder $online_client_order)
	{
		$docHeaderValues = [];

		$docCount				= 0;
		$docTotal				= 0;
		$docDiscountSum			= 0;
		$docDiscountedTotal		= 0;
		$docQuantity			= 0;

		$docTotalRequest = OnlineOrderProduct::where('online_order_id','=',$online_client_order->id)->get();

		$docHeaderValues['docCount']					= $docTotalRequest->count();
		$docHeaderValues['docDiscountSum']				= $docTotalRequest->sum('discount');
		$docHeaderValues['docDiscountedTotal']			= $docTotalRequest->sum('total') - $docTotalRequest->sum('discount');
		$docHeaderValues['docQuantity']					= $docTotalRequest->sum('quantity');
		$docHeaderValues['docTotal']					= $docTotalRequest->sum('total');
		
		return $docHeaderValues;
	}
}
