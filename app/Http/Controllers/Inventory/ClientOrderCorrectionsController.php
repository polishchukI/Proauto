<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use PDF;

use App\Models\Client\Client;

use App\Models\Inventory\Currency;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\Provider;
use App\Models\Inventory\ClientOrderCorrection;
use App\Models\Inventory\PaymentMethod;
use App\Models\Inventory\Transaction;

use App\Models\Product\Product;
use App\Models\Product\ProductClientOrder;
use App\Models\Product\ProductPrice;
use App\Models\Product\ProductGroup;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductClientOrderCorrection;

use Picqer\Barcode\BarcodeGeneratorHTML;

use App\Models\OrderControl\ProductClientOrderControl;

use App\Http\Controllers\Inventory\AddProductController;
use App\Http\Controllers\FunctionsController as Functions;

class ClientOrderCorrectionsController extends Controller
{
    public function index()
    {
        $client_order_corrections = ClientOrderCorrection::paginate(25);
        
        return view('inventory.client_order_corrections.index', compact('client_order_corrections'));
    }
    
    public function create()
    {
        $clients			= Client::all();
        $warehouses			= Warehouse::all();
        $currencies			= Currency::where('active','=',1)->get();

        return view('inventory.client_order_corrections.create', compact('warehouses','currencies','clients'));
    }
    
    public function store(Request $request, ClientOrderCorrection $client_order_correction)
    {
        $requesteddata = $request->all();

        $requesteddata['client_id'] = $request->clientLive ?? $request->client_id;

        if(array_key_exists('reference_type', $requesteddata) && array_key_exists('reference_id', $requesteddata))
		{
			if($requesteddata['reference_type'] == "client_order")
			{
				$reference_order_products = ProductClientOrder::where('client_order_id','=',$request->get('reference_id'))->get()->toArray();
			}
		}
		else
		{
            $existent = ClientOrderCorrection::where('client_id', $requesteddata['client_id'])->where('finalized_at', null)->get();
            if($existent->count())
            {
                return back()->withError('There is already an unfinished client order correction belonging to this client. <a href="'.route('client_order_corrections.show', $existent->first()).'">Click here to go to it</a>');
            }
        }

		$created_at				        	= Carbon::now();
		$dateprefix					        = $created_at->format('Y m d');
		$code_6						        = sprintf("%06s",(string)$request->clientLive);
		$timeStamp					        = Functions::GenerateTimestamp();
		$requesteddata['barcode']	    	= "" . $dateprefix . " " . $timeStamp . " " . $code_6 ."";

		$client_order_correction = $client_order_correction->create($requesteddata);
   
		if(isset($reference_order_products))
		{
			foreach($reference_order_products as $product)
			{
				ProductClientOrderCorrection::insert(['client_order_correction_id' => $client_order_correction->id,
                                        'product_id'                => $product['product_id'],
                                        'currency'                  => $client_order_correction->currency,
                                        'price'                     => $product['price'],
                                        'total_amount'              => $product['total_amount'],
                                        'warehouse_id'              => $client_order_correction->warehouse_id,
                                        'client_order_id'           => $client_order_correction->reference_id,
                                        'quantity'                  => $product['quantity']]);
			}
		}
        
        return redirect()->route('client_order_corrections.show', ['client_order_correction' => $client_order_correction->id])->withStatus('Документ "Корректировка заказа покупателя" успешно зарегистрирован');
    }
    
	public function show(ClientOrderCorrection $client_order_correction)
    {
		$docHeaderValues = $this->docHeaderValues($client_order_correction);

		$client_order_correction->docCount						= $docHeaderValues['docCount'];
		$client_order_correction->docTotal						= $docHeaderValues['docTotal'];
		$client_order_correction->docQuantity					= $docHeaderValues['docQuantity'];

        return view('inventory.client_order_corrections.show', compact('client_order_correction'));
    }
    
    public function client_order_correction_add_single_product_store(Request $request)
    {
        $requesteddata = $request->all();
        dd(compact('requesteddata'));
    }
    
    public function edit($id)
    {
        //
    }
    
    public function destroy($id)
    {
        //
    }
    
    
    public function client_order_correction_edit_product(Request $request, ClientOrderCorrection $client_order_correction)
    {
		$edit = "true";
		$client_order_correction_id = $request->client_order_correction_id;
		$product_id = $request->product_id;
		
		$product = ProductClientOrderCorrection::select('product_client_order_corrections.quantity','product_client_order_corrections.price',
        'product_client_order_corrections.client_order_correction_id','products.id as product_id','products.article','products.brand','products.name','products.full_name')
		->where('product_id','=',$product_id)
		->join('products', 'products.id', '=', 'product_client_order_corrections.product_id')
		->where('client_order_correction_id','=',$client_order_correction_id)
		->first();
		if($client_order_correction_id)
		{
			$product = $product->toarray();
		}
        
		return view('inventory.client_order_corrections.addproduct_modal', compact('product','edit'));
    }
    

    public static function docHeaderValues(ClientOrderCorrection $client_order_correction)
	{
		$docHeaderValues = [];

		$docCount				= 0;
		$docTotal				= 0;
		$docQuantity			= 0;

		$docTotalRequest = ProductClientOrderCorrection::where('client_order_correction_id','=',$client_order_correction->id)->get();
		
		$docHeaderValues['docCount']					= $docTotalRequest->count();
		$docHeaderValues['docQuantity']					= $docTotalRequest->sum('quantity');
		$docHeaderValues['docTotal']					= $docTotalRequest->sum('total_amount');
		
		return $docHeaderValues;
	}
}
