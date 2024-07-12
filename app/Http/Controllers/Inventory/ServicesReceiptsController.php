<?php

namespace App\Http\Controllers\Inventory;

use PDF;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Settlement;

use App\Models\Inventory\Provider;
use App\Models\Inventory\Currency;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\Transaction;
use App\Models\Inventory\PaymentMethod;

use App\Models\Service\Service;
use App\Models\Service\ServicesReceipt;
use App\Models\Service\ServicesReceiptItem;

use App\Http\Controllers\FunctionsController as Functions;

class ServicesReceiptsController extends Controller
{
    public function index()
    {
        $services_receipts		= ServicesReceipt::paginate(25);

        return view('inventory.services_receipts.index', compact('services_receipts'));
    }

	public function create()
    {
        $providers			= Provider::where('active','=','1')->where('services_provider','=','1')->get();
        $warehouses			= Warehouse::all();
        $currencies			= Currency::where('active','=','1')->get();
		
		return view('inventory.services_receipts.create', compact('providers','warehouses','currencies'));
    }

    public function store(Request $request, ServicesReceipt $services_receipt)
    {
		$requestData = $request->all();		
		
		$created_at					= Carbon::now();
		$dateprefix					= $created_at->format('Y m d');
		$code_6						= sprintf("%06s",(string)$request->provider_id);
		$timeStamp					= Functions::GenerateTimestamp();
		$requestData['barcode']		= "" . $dateprefix . " " . $timeStamp . " " . $code_6 ."";
		
		$services_receipt = $services_receipt->create($requestData);
		
		return redirect()->route('services_receipts.show', $services_receipt)->withStatus('Services Receipt registered successfully, you can start adding the services belonging to it.');
    }

    public function show(ServicesReceipt $services_receipt)
    {
		$docHeaderValues = $this->docHeaderValues($services_receipt);

		$services_receipt->docCount						= $docHeaderValues['docCount'];
		$services_receipt->docTotal						= $docHeaderValues['docTotal'];
		$services_receipt->docQuantity					= $docHeaderValues['docQuantity'];

		return view('inventory.services_receipts.show', compact('services_receipt'));
    }

    public function destroy(ServicesReceipt $services_receipt)
    {
		ServicesReceiptItem::where('services_receipt_id','=',$services_receipt->id)->delete();
        $services_receipt->delete();
        return redirect()->route('services_receipts.index')->withStatus('ServicesReceipt successfully removed.');
    }


    public function services_receipt_add_service(Request $request, ServicesReceiptItem $services_item)
	{
        $edit = "false";
        $services = Service::all();
        
        $services_receipt_id = $request->services_receipt_id;
        $services_receipt = ServicesReceipt::findOrfail($services_receipt_id);
        
        return view('inventory.services_receipts.addservice_modal', compact('services_receipt','services','edit'));	
	}

    // services_receipt_add_service_store
    public static function services_receipt_add_service_store(Request $request)
	{
        //request data
		$service_id						= $request->service_id;
		$services_receipt_id			= $request->services_receipt_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		//additional data
		$services_receipt				= ServicesReceipt::findOrFail($services_receipt_id);
		$service						= Service::findOrFail($service_id);
		$currency						= $services_receipt->currency;
		$warehouse_id					= $services_receipt->warehouse_id;
		$total_amount					= $price * $quantity;
		$created_at						= Carbon::now();


		//writing into recieved_services table
		$requesteddata['services_receipt_id']		= $services_receipt_id;
		$requesteddata['currency']			= $currency;
		$requesteddata['warehouse_id']		= $warehouse_id;
		$requesteddata['service_id']		= $service_id;
		$requesteddata['price']				= $price;
		$requesteddata['quantity']				= $quantity;
		$requesteddata['total_amount']		= $total_amount;
		$requesteddata['created_at']		= $created_at;
		
		ServicesReceiptItem::create($requesteddata);

		$docHeaderValues = self::docHeaderValues($services_receipt);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Услуга добавлена', 'success'],
			'docHeaderValues'				=> $docHeaderValues,
			'info'    => [
				'service_id'				=> $service_id,
				'services_receipt_id'		=> $services_receipt_id,
				'name'						=> $service->name,
				'quantity'					=> $quantity,
				'price'						=> $price,
				'total_amount'				=> $total_amount,
				'created_at'				=> $created_at,

			],
		]);
    }

	public function services_receipt_edit_service(Request $request)
    {
		$edit = "true";
		$services								= Service::all()->toArray();

		$services_receipt_id					= $request->services_receipt_id;
		$service_id								= $request->service_id;
		$services_receipt						= ServicesReceipt::findOrFail($services_receipt_id);
		
		$receipt_service = ServicesReceiptItem::select('services_receipt_items.quantity','services_receipt_items.price','services_receipt_items.services_receipt_id','services.id as service_id','services.article','services.name')
		->where('service_id','=',$service_id)
		->join('services', 'services.id', '=', 'services_receipt_items.service_id')
		->where('services_receipt_id','=',$services_receipt_id)
		->first();
		if($services_receipt_id)
		{
			$receipt_service = $receipt_service->toarray();
		}
		
		return view('inventory.services_receipts.addservice_modal', compact('receipt_service','edit','services_receipt','services','service_id'));
    }

    public function services_receipt_update_service_store(Request $request)
	{
		$service_id						= $request->service_id;
		$services_receipt_id			= $request->services_receipt_id;
		$price							= floatval($request->price);//????
		$quantity						= $request->quantity;

		$item = ServicesReceiptItem::where('services_receipt_id','=',$services_receipt_id)->where('service_id','=',$service_id)->get()->first();

		if ($item)
		{
            $old_service_id		= $item->service_id;
            $old_price   		= $item->price;
            $old_quantity		= $item->quantity;

            $new_service_id		= $request->service_id;
            $new_price			= $request->price;
            $new_quantity		= $request->quantity;
            $new_total_amount	= $new_price * $new_quantity;

            if ($old_service_id != $new_service_id || $old_price != $new_price || $old_quantity != $new_quantity)
			{
                $services_receipt = ServicesReceipt::find($services_receipt_id);
                if ($services_receipt) {
                    $item = $item->update([
                        'service_id' => $new_service_id,
                        'price' => $new_price,
                        'quantity' => $new_quantity,
                        'total_amount' => $new_total_amount,
                    ]);

					if ($item) {
						$docHeaderValues = self::docHeaderValues($services_receipt);

						return response()->json([
							'status'  => 1 , 
							'message' => ['Услуга добавлена', 'success'],
							'docHeaderValues'				=> $docHeaderValues,
                            'info'    => [
                                    'service_id'    => $service_id,
                                    'price' => $new_price,
                                    'quantity' => $new_quantity,
                                    'total_amount' => $new_total_amount,
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

    public function edit($id)
    {
        //
    }

    public function clear_services_table(ServicesReceipt $services_receipt)
    {
		ServicesReceiptItem::where('services_receipt_id','=',$services_receipt->id)->delete();
		return back()->withStatus('Services table cleared.');
    }

    public function services_receipt_delete_service(Request $request)
    {
		if (!$request->ajax()) {
			abort('404');
		};

		$service_id						= (int)$request->service_id;
		$services_receipt_id			= (int)$request->services_receipt_id;

		$item = ServicesReceiptItem::where('services_receipt_id','=',$services_receipt_id)->where('service_id','=',$service_id)->get()->first();
		
		if ($item) {
			$old_price    = $item->price;
			$old_quantity = $item->quantity;

			$services_receipt = ServicesReceipt::find($services_receipt_id);
			if ($services_receipt)
			{
				$item = $item->delete();

				$docHeaderValues = self::docHeaderValues($services_receipt);

				return response()->json([
					'status'  => 1 , 
					'message' => ['Услуга добавлена', 'success'],
					'docHeaderValues'		=> $docHeaderValues,
					'info'    => [
							'service_id'    => $service_id,
						],
					]);
			}
		}
    }

	public function finalize(ServicesReceipt $services_receipt)
    {
		$finalized_at = Carbon::now()->toDateTimeString();
		
		$total_amount = ServicesReceiptItem::where('services_receipt_id','=', $services_receipt->id)->sum('total_amount');

		//перетераем начисление задолженности, чтоб не задублировался
		Settlement::where('doc_type','=', "services_receipt")->where('doc_id','=', $services_receipt->id)->delete();
		//проводим начисление задолженности
		Settlement::Insert(['doc_type' => "services_receipt",'doc_id' => $services_receipt->id,'provider_id' => $services_receipt->provider_id,'total_amount' => $total_amount,'currency' => $services_receipt->currency,'user_id' => $services_receipt->user_id]);
		
		$services_receipt->total_amount = $total_amount;
		$services_receipt->finalized_at = $finalized_at;
        $services_receipt->save();
		
        return back()->withStatus('Receipt successfully completed.');
    }

	//reciept payment
	public function addtransaction(ServicesReceipt $services_receipt)
    {
        $payment_methods = PaymentMethod::all();

        return view('inventory.services_receipts.addtransaction', compact('services_receipt', 'payment_methods'));
    }

    public function storetransaction(Request $request, ServicesReceipt $services_receipt, Transaction $transaction)
    {
        switch($request->all()['type'])
		{
			case 'income':
				$request->merge(['title' => 'Возврат оплаты по накладной поставки услуг №: ' . $request->get('services_receipt_id')]);
				break;

            case 'expense':
                $request->merge(['title' => 'Оплата по накладной поставки услуг №: ' . $request->get('services_receipt_id')]);

                if($request->get('amount') > 0)
				{
                    $request->merge(['amount' => (float) $request->get('amount') * (-1) ]);
                }
                break;
        }
		
        $transaction = $transaction->create($request->all());
	
		//перетераем платеж, чтоб не задублировался
		Settlement::where('doc_type','=', "expense")->where('doc_id','=', $transaction->id)->delete();
		//проводим начисление задолженности
		Settlement::Insert(['doc_type'			=> "expense",
								'doc_id'		=> $transaction->id,
								'provider_id'	=> $request->provider_id,
								'total_amount'	=> $request->amount,
								'currency'		=> $services_receipt->currency,
								'user_id'		=> $request->user_id]);
								

        return redirect()->route('services_receipts.show', compact('services_receipt'))->withStatus('Successfully registered transaction.');
    }

    public function update(Request $request, $id)
    {
        //
    }

	public static function docHeaderValues(ServicesReceipt $services_receipt)
	{
		$docHeaderValues = [];

		$docCount				= 0;
		$docTotal				= 0;
		$docQuantity			= 0;

		$docTotalRequest = ServicesReceiptItem::where('services_receipt_id','=', $services_receipt->id)->get();
		
		$docHeaderValues['docCount']					= $docTotalRequest->count();
		$docHeaderValues['docQuantity']					= $docTotalRequest->sum('quantity');
		$docHeaderValues['docTotal']					= $docTotalRequest->sum('total_amount');
		
		return $docHeaderValues;
	}

	public static function services_receipt_create_new_provider_store (Request $request, Provider $provider_model)
    {
		$requesteddata['name']						= $request->name;
		$requesteddata['hasprice']					= $request->hasprice ?? "None";
		$requesteddata['provider_code']				= $request->provider_code ?? $request->name;
		$requesteddata['spares_provider']			= $request->spares_provider;
		$requesteddata['services_provider']			= $request->services_provider;
		$requesteddata['description']				= $request->description;
		$requesteddata['active']					= (int)1;
		$requesteddata['created_at']				= Carbon::now();
				
        $provider = $provider_model->create($requesteddata);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Поставщик добавлен', 'success'],
			'info'    => [
				'id'		=> $provider->id,
				'name'		=> $provider->name,
			],
		]);
	}
}
