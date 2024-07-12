<?php

namespace App\Http\Controllers\Inventory;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Models\Client\ClientAuto;
use App\Models\Client\Client;
use App\Models\Client\ClientAutoColor;
use App\Models\Client\ClientAutoServicePart;

use App\Models\Product\Product;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductPrice;
use App\Models\Product\ProductClientOrder;
use App\Models\Product\SoldProduct;

use App\Models\Inventory\Sale;
use App\Models\Inventory\Currency;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\ClientOrder;

use App\Http\Controllers\Controller;

use App\Http\Controllers\Inventory\AddProductController;

use App\Http\Controllers\FunctionsController as Functions;

class ClientAutosController extends Controller
{
	public function index()
    {
        $client_autos = ClientAuto::all();

        return view('inventory.client_autos.index', compact('client_autos'));
    }
	
    public function create()
    {
        // return view('inventory.client_autos.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(ClientAuto $client_auto)
    {
		$warehouses = Warehouse::all();
        $currencies = Currency::where('active','=','1')->get();

        return view('inventory.client_autos.show', compact('client_auto','warehouses','currencies'));
    }


    public function edit(Request $request,  ClientAuto $client_auto)
    {
		$colors							= ClientAutoColor::get();
		$cataloggroups					= ['passenger','commercial','motorbike','engine','axle'];
		$clients						= Client::all();
		if($clients)
		{
			$clients = $clients->toArray();
		}
		
        return view('inventory.client_autos.edit', compact('clients', 'client_auto', 'colors','cataloggroups'));
		
	}
	
	
    public function update(Request $request, $id)
    {
		$requesteddata['client_id']			= $request->client_id;
		$requesteddata['plate']				= $request->plate;
		$requesteddata['color']				= $request->color;

		$client_auto						= ClientAuto::where('vin', '=', $request->vin)->update($requesteddata);
	
		return back();

    }
	
    public function destroy($id)
    {
        //
    }
	
	//add_single_product
	public static function servicepart_add(Request $request)
	{
		$edit								= "false";
		$client_auto_id						= $request->client_auto_id;
		$products							= Product::select('products.id as product_id','products.article','products.brand','products.name','products.full_name')
											->orderby('products.article', 'asc')
											->get()->toArray();
		
		return view('inventory.client_autos.addservicepart', compact('client_auto_id','edit','products'));
	}


	public function servicepart_store (Request $request, ClientAutoServicePart $clientservicepart)
    {
		$document_currency = "RUB";
		$requestData['client_auto_id']		= $request->client_auto_id;
		$requestData['product_id']			= $request->product;
		$requestData['quantity']			= $request->quantity;
		$requestData['comment']				= $request->comment;
		
		$clientservicepart = $clientservicepart->create($requestData);

		$servicepart = Product::where('id','=', $clientservicepart->product_id)->get()->first();
		$stock = AddProductController::get_product_stocks($clientservicepart->product_id);
		$price = AddProductController::get_product_price($clientservicepart->product_id, "out", $document_currency);
		
		return response()->json([
			'status'  => 1 , 
			'message' => ['Телефон добавлен', 'success'],
			'info'    => [
				'client_auto_id'			=> $requestData['client_auto_id'],
				'servicepart_id'			=> $clientservicepart->id,
				'article'					=> $servicepart->article,
				'brand'						=> $servicepart->brand,
				'name'						=> $servicepart->name,
				'stock'						=> $stock ?? 0,
				'price'						=> $price ?? 0,
				'quantity'					=> $clientservicepart->quantity,
				'comment'					=> $clientservicepart->comment,
			],
		]);
    }
	
	public static function servicepart_edit (Request $request)
	{
		$edit								= "true";
		$client_auto_id						= $request->client_auto_id;
		$item_id							= $request->item_id;

		$servicepart						= ClientAutoServicePart::select('quantity','comment','product_id')->where('client_auto_id','=',$client_auto_id)->where('id','=',$item_id)->first()->toArray();
		
		$products							= Product::select('products.id as product_id','products.article','products.brand','products.name','products.full_name')
											->orderby('products.article', 'asc')
											->get()->toArray();

		return view('inventory.client_autos.addservicepart', compact('client_auto_id','item_id','servicepart','edit','products'));
	}
	
	public static function servicepart_update(Request $request, ClientAutoServicePart $clientservicepart)
    {
		if (!$request->ajax())
		{
			abort('404');
		};

		$client_auto_id						= $request->client_auto_id;
		$item_id							= $request->item_id;
		$product_id							= $request->product;
		$quantity							= $request->quantity;
		$comment							= $request->comment;
		
		$item = ClientAutoServicePart::where('client_auto_id','=',$client_auto_id)->where('id','=',$item_id)->get()->first();

		$document_currency = "RUB";

		if ($item)
		{
			// dd(compact('item'));
			$servicepart	= Product::where('id','=', $product_id)->get()->first();
			$stock			= AddProductController::get_product_stocks($product_id);
			$price			= AddProductController::get_product_price($product_id, "out", $document_currency);

			$item = $item->update([
				'product_id'		=> $product_id,
				'quantity'			=> $quantity,
				'comment'			=> $comment,
			]);

			if ($item)
			{
				return response()->json([
					'status'  => 1 , 
					'message' => ['Обновлен', 'success'],
					'info'    => [
						'client_auto_id'			=> $client_auto_id,
						'servicepart_id'			=> $item_id,
						'article'					=> $servicepart->article,
						'brand'						=> $servicepart->brand,
						'name'						=> $servicepart->name,
						'stock'						=> $stock ?? 0,
						'price'						=> $price ?? 0,
						'quantity'					=> $quantity,
						'comment'					=> $comment,
					],
				]);
			}
        }
    }
	
	public function servicepart_delete(Request $request)
    {
		if (!$request->ajax())
		{
			abort('404');
		};

		$client_auto_id						= $request->client_auto_id;
		$item_id							= $request->item_id;
		
		$item = ClientAutoServicePart::where('client_auto_id','=',$client_auto_id)->where('id','=',$item_id)->get()->first();
		if ($item)
		{
			$item = $item->delete();
			return response()->json([
				'status'  => 1 , 
				'message' => ['Удалено', 'success'],
				'info'    => [
					'servicepart_id'    => $item_id,
				],
			]);
			}
		}

	/////////////////////ordre from service parts list
	public function servicepart_client_order_create(Request $request, ClientOrder $client_order)
	{
		$requesteddata						= $request->all();
		$requesteddata['reference_type']	= "service_parts";
		$requesteddata['warehouse_id']		= $request->warehouse_id ?? auth()->user()->default_warehouse_id;
		$requesteddata['currency']			= $request->currency ?? auth()->user()->default_currency;
		
		$created_at							= Carbon::now();
		$dateprefix							= $created_at->format('Y m d');
		$code_6								= sprintf("%06s",(string)$request->client_id);
		$timeStamp							= Functions::GenerateTimestamp();
		$requesteddata['barcode']				= "" . $dateprefix . " " . $timeStamp . " " . $code_6 ."";

		$existent = ClientOrder::where('client_id', $request->get('client_id'))->where('reference_type', "service_parts")->where('finalized_at', null)->get();
		if($existent->count())
		{
			$href = route('client_orders.show', $existent->first());
			
			return $href;
		}
		else
		{
			$client_order = $client_order->create($requesteddata);
	
			if(isset($request->table_info))
			{
				foreach($request->table_info as $product)
				{
					$product_id = $product['product_id'];
					$quantity = $product['quantity'];
					$product_price = AddProductController::get_product_price($product['product_id'], 'out', $client_order->currency) ?? 0;
	
					ProductClientOrder::insert(['client_order_id'			=> $client_order->id,//
												'product_id'				=> $product['product_id'],//
												'currency'					=> $client_order->currency,//
												'price' 					=> $product_price,//
												'total_amount'				=> $quantity * $product_price,//
												'warehouse_id'				=> $client_order->warehouse_id,//
												'quantity'					=> $quantity,//
												'created_at'				=> Carbon::now(),//
											]);
				}
			}
			$href = route('client_orders.show', ['client_order' => $client_order->id]);
			
			return $href;
		}		
	}
	
	public function servicepart_sale_create(Request $request, Sale $sale)
    {
		$requesteddata						= $request->all();
		$requesteddata['reference_type']	= "service_parts";
		$requesteddata['warehouse_id']		= $request->warehouse_id ?? auth()->user()->default_warehouse_id;
		$requesteddata['currency']			= $request->currency ?? auth()->user()->default_currency;

		$created_at							= Carbon::now();
		$dateprefix							= $created_at->format('Y m d');
		$code_6								= sprintf("%06s",(string)$request->client_id);
		$timeStamp							= Functions::GenerateTimestamp();
		$requesteddata['barcode']				= "" . $dateprefix . " " . $timeStamp . " " . $code_6 ."";

		$existent = Sale::where('client_id', $request->get('client_id'))->where('reference_type', "service_parts")->where('finalized_at', null)->get();
		if($existent->count())
		{
			$href = route('sales.show', $existent->first());
			
			return $href;
		}
		else
		{
			$sale = $sale->create($requesteddata);
	
			if(isset($request->table_info))
			{
				foreach($request->table_info as $product)
				{
					$product_id = $product['product_id'];
					$quantity = $product['quantity'];
					$product_price = AddProductController::get_product_price($product['product_id'], 'out', $sale->currency) ?? 0;
	
					SoldProduct::insert(['sale_id'			=> $sale->id,//
										'product_id'		=> $product['product_id'],//
										'currency'			=> $sale->currency,//
										'price' 			=> $product_price,//
										'total_amount'		=> $quantity * $product_price,//
										'warehouse_id'		=> $sale->warehouse_id,//
										'quantity'			=> $quantity,//
										'created_at'		=> Carbon::now(),//
									]);
				}
			}
			$href = route('sales.show', ['sale' => $sale->id]);
			
			return $href;
		}		
    }
}
