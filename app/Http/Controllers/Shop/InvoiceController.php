<?php

namespace App\Http\Controllers\Shop;

use PDF;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Client\ClientAddress;
use App\Models\Inventory\OrderStatus;
use App\Models\OnlineOrder\OnlineOrder;
use App\Models\OnlineOrder\OnlineOrderProduct;

use Picqer\Barcode\BarcodeGeneratorHTML;

class InvoiceController extends Controller
{
    public function download(Request $request)
    {
		$order_id = $request->order_id;
		$client_id = (int)$request->user('clients')->id;
		$order = OnlineOrder::where('client_id', $client_id)->where('id', $order_id)->first();
		$order_q = OnlineOrder::where('id', $orderid)->first();
		if($order_q)
		{
			$order = $order_q->toArray();
		}

		$products_q = OnlineOrderProduct::where('order_id', $orderid)->get()->toArray();

        $products = [];
		
		foreach($products_q as $product)
		{
			$products[] = ['title' => $product['name'], 'price' => $product['price'], 'quantity' => $product['quantity'], 'totals' => $product['price'] * $product['quantity']];
		}

		$pdf = PDF::loadView('pdf.invoice', compact('order','products'));
		$fileName = 'invoice_'.$orderid.'.pdf';
		
		$path = 'pdf/'.$fileName;
		$pdf->save($path);
		
		return $pdf->download($path);
    }
	
	public function download_order(Request $request)
    {
		$order_id = $request->order_id;
		
		$client_id = (int)$request->user('clients')->id;
		
		$order = OnlineOrder::where('client_id', $client_id)->where('id', $order_id)->first()->toArray();
		
		$products = OnlineOrderProduct::where('online_order_id', $order_id)->get()->toArray();
		
		$billingaddress = ClientAddress::where('id', '=', $order['billing_address_id'])->where('client_id', $client_id)->first()->toArray();
		
		$shippingaddress = ClientAddress::where('id', '=', $order['shipping_address_id'])->where('client_id', $client_id)->first()->toArray();

		$generator = new BarcodeGeneratorHTML();

        $barcode_string = $order['invoice'].'-'.$order['id'];
        $barcode = $generator->getBarcode((string)$barcode_string, $generator::TYPE_CODE_128, 1, 25);
		
        $pdf = PDF::loadView('shop.pdf.onlineorder', compact('order', 'products', 'billingaddress', 'shippingaddress','barcode'));
		
        $file_name = 'invoice - ' . $order['invoice'] . '-' . $order['id'] . '.pdf';
		
        return $pdf->stream($file_name)->header('Content-Type','application/pdf');
    }
}
