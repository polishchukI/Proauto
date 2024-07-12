<?php

namespace App\Http\Controllers\Inventory;

use PDF;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Models\Client\Client;
use App\Models\Inventory\Sale;
use App\Models\Inventory\AdminCart;
use App\Models\Inventory\ClientOrder;
use App\Models\Inventory\Provider;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\Currency;

use App\Models\Product\Product;
use App\Models\Product\SoldProduct;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductStock;
use App\Models\Product\ProductClientOrder;

use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
	//отчет шел в изначальной версии
	public function sales_stats_report()
	{
		$warehouse_id = 1;
		$currency = "RUB";
		$categories = ProductCategory::all();
		$products = Product::all();
		$soldproductsbystock = SoldProduct::selectRaw('product_id, max(created_at), sum(quantity) as total_qty, sum(total_amount) as incomes, avg(price) as avg_price')
								->whereYear('created_at', Carbon::now()->year)
								->groupBy('product_id')
								->orderBy('total_qty', 'desc')
								->limit(15)
								->get();
								
		$soldproductsbyincomes = SoldProduct::selectRaw('product_id, max(created_at), sum(quantity) as total_qty, sum(total_amount) as incomes, avg(price) as avg_price')->whereYear('created_at', Carbon::now()->year)->groupBy('product_id')->orderBy('incomes', 'desc')->limit(15)->get();
		$soldproductsbyavgprice = SoldProduct::selectRaw('product_id, max(created_at), sum(quantity) as total_qty, sum(total_amount) as incomes, avg(price) as avg_price')->whereYear('created_at', Carbon::now()->year)->groupBy('product_id')->orderBy('avg_price', 'desc')->limit(15)->get();

		return view('inventory.reports.inventory', compact('categories','products','soldproductsbystock','soldproductsbyincomes','soldproductsbyavgprice'));
	}

	//KPI Report
    public function kpi_stats()
    {
		return view('inventory.reports.kpi_stats');
	}
	
	public function kpi_stats_show(Request $request)
    {
		$warehouse_id	= 1;
		$currency		= "RUB";
		$count			= 0;
		$data			= [];
		$date_from		= $request->date_from ?? Carbon::now()->startOfMonth();
		$date_to		= $request->date_to ?? Carbon::now()->endOfMonth();
		
		//1.Новые клиенты
		$newcustomers = Client::whereBetween('created_at', [$date_from, $date_to])->count();
		$count++;
		$data[] = ['count' => $count, 'kpi_name' => 'Новые клиенты', 'kpi_value' => $newcustomers];
		
		//2.Новые поставщики
		$newproviders = Provider::whereBetween('created_at', [$date_from, $date_to])->count();
		$count++;
		$data[] = ['count' => $count, 'kpi_name' => 'Новые поставщики', 'kpi_value' => $newproviders];
		
		//3.Новые продукты
		$newproducts = Product::whereBetween('created_at', [$date_from, $date_to])->count();
		$count++;
		$data[] = ['count' => $count, 'kpi_name' => 'Новые продукты', 'kpi_value' => $newproducts];
		
		//4.Заказы клиентов, количество товарных позиций
		$productClientOrder = ProductClientOrder::whereBetween('created_at', [$date_from, $date_to])->count();
		$count++;
		$data[] = ['count' => $count, 'kpi_name' => 'Заказы клиентов, количество товарных позиций', 'kpi_value' => $productClientOrder];
		
		//5.Продажи товаров, количество товарных позиций
		$SoldProduct = SoldProduct::whereBetween('created_at', [$date_from, $date_to])->count();
		$count++;
		$data[] = ['count' => $count, 'kpi_name' => 'Продажи товаров, количество товарных позиций', 'kpi_value' => $SoldProduct];
		
		//Стоимость склада в закупочных ценах
		$q = ProductStock::select('product_id')->distinct()->get();
		if($q)
		{
			$productStocksTotal = 0;
			foreach($q as $product)
			{
				$quanity = AddProductController::get_product_stocks($product['product_id']);
				$price = AddProductController::get_product_price($product['product_id'], 'in', $currency);
				if($quanity > 0)
				{
					$productStocksTotal = $productStocksTotal+($quanity*$price);
					$productStocksTotal = round($productStocksTotal,2);
				}															
			}
		}
		$count++;
		$data[] = ['count' => $count, 'kpi_name' => 'Стоимость склада в закупочных ценах (' . $currency .')', 'kpi_value' => $productStocksTotal];
		
		//Эффективность работы склада по заказам
		$count++;
		$SoldProductByOrder = SoldProduct::whereBetween('created_at', [$date_from, $date_to])->whereNotNull('client_order_id')->count();
		$warehouseEfficiency = ($productClientOrder != null) ? round((100*($productClientOrder-$SoldProductByOrder)/$productClientOrder),2) : 0;
		
		$data[] = ['count' => $count, 'kpi_name' => 'Эффективность работы склада (%)', 'kpi_value' => $warehouseEfficiency];		
		
		//Продаж за период
		$salesForPeriod = Sale::whereBetween('finalized_at', [$date_from, $date_to])->count();
		$count++;
		$data[] = ['count' => $count, 'kpi_name' => 'Продаж за период, количество документов', 'kpi_value' => $salesForPeriod];
		
		//Продажи за период в денежном эквиваленте
		$SoldProductTotal = SoldProduct::whereBetween('created_at', [$date_from, $date_to])->sum('total_amount');
		$count++;
		$data[] = ['count' => $count, 'kpi_name' => 'Продажи за период в денежном эквиваленте (' . $currency .')', 'kpi_value' => $SoldProductTotal];
		
		//Стоимость чека в денежном эквиваленте
		$count++;
		$averageSaleCost = round(($SoldProductTotal/$salesForPeriod),2);
		$data[] = ['count' => $count, 'kpi_name' => 'Средний чек (' . $currency .')', 'kpi_value' => $averageSaleCost];

		//Заказы клиента
		$clientorders = ClientOrder::whereBetween('finalized_at', [$date_from, $date_to])->count();
		$count++;
		$data[] = ['count' => $count, 'kpi_name' => 'Заказы клиента, количество документов', 'kpi_value' => $clientorders];
				
		//Коэффициент выполненных заказов
		$count++;
		$ordersEfficiency = round((100*($salesForPeriod/$clientorders)),2);
		$data[] = ['count' => $count, 'kpi_name' => 'Коэффициент выполненных заказов (%)', 'kpi_value' => $ordersEfficiency];
		
		//Коэффициент конверсии корзины администратора
		$admincartsTotalCost = AdminCart::whereBetween('finalized_at', [$date_from, $date_to])->sum('total_amount');
		$admincartConversion = ($SoldProductTotal/$admincartsTotalCost) * 100;
		$admincartConversion = round($admincartConversion,2);
		$count++;
		$data[] = ['count' => $count, 'kpi_name' => 'Коэффициент конверсии корзины администратора (%)', 'kpi_value' => $admincartConversion];
		
		return response()->json($data);       
    }

	
	public function sales_by_clients()
    {
		$warehouses = Warehouse::all();
        $currencies = Currency::where('active','=','1')->get();
		
		return view('inventory.reports.sales_by_clients', compact('warehouses','currencies'));

	}	

	public function sales_by_clients_show(Request $request)
    {
		$warehouse		= $request->warehouse ?? 1;
		$currency		= $request->currency ?? "RUB";
		
		$data = [];
	
		$date_from = $request->date_from ?? Carbon::now()->startOfMonth();
		$date_to = $request->date_to ?? Carbon::now()->endOfMonth();
	
		$Clients = Sale::select('clients.id','clients.name')
					->where('sales.warehouse_id','=',$warehouse)
					->whereBetween('sales.finalized_at', [$date_from, $date_to])
					->join('clients','clients.id','=','sales.client_id')
					->distinct()
					->orderBy('clients.name', 'asc')
					->get();
		
		if($Clients)
		{
			$Clients = $Clients->toArray();
			foreach($Clients as $client)
			{
				$data_temp[$client['id']] = ['id'							=>	$client['id'],
													'name'					=>	$client['name'],
													'total_amount'			=>	0,
													'discount_amount'		=>	0,
													'saleDocuments'			=>	[],
												];
			}
			
			foreach($data_temp as $item)
			{
				$saleDocuments = [];

				$sales = Sale::where('sales.client_id', '=', $item['id'])
						->whereBetween('sales.finalized_at', [$date_from, $date_to])
						->where('sales.warehouse_id', '=' ,$warehouse)->get();
					
				if($sales)
				{
					$salesCount = count($sales);
					$saleDocuments = $sales->toArray();
				}
					
				$total_amount						= $sales->sum('total_amount');
				$discount_amount					= $sales->sum('discount_amount');
				
			 	$data[] = ['client_id'				=> $item['id'],
							'name'					=> $item['name'],							
							'salesCount'			=> $salesCount,							
							'total_amount'			=> number_format($total_amount, 2),
							'discount_amount'		=> number_format($discount_amount, 2),
							'saleDocuments'			=> $saleDocuments,
						];
			}
		}
		
		return response()->json([
			'quantity_total'			=> $quantity_total ?? 0,
			'currency'					=> $currency,
			'warehouse'					=> $warehouse,
			'data'						=> $data,
			'bought_total'				=> $bought_total ?? 0,
			'sold_total'				=> $sold_total ?? 0,
			'profit_total'				=> $profit_total ?? 0,
		]);     
    }



	public function sales_by_clients_print(Request $request)
    {
		$warehouse		= $request->warehouse ?? 1;
		$currency		= $request->currency ?? "RUB";
		
		$data = [];
		$count				= 0;
		$bought_total		= 0;
		$sold_total			= 0;
		$quantity_total		= 0;
		$profit				= 0;

		$product_sales = [];
		$product_sales_header						= [];		
		$product_sales_header['date_to']			= $date_to = $request->date_to ?? Carbon::now()->endOfMonth();
		$product_sales_header['date_from']			= $date_from = $request->date_from ?? Carbon::now()->startOfMonth();
		$product_sales_header['warehouse']			= Warehouse::where('id','=',$warehouse)->first()->name;		
		$product_sales_header['currency']			= Currency::where('code','=',$currency)->first()->name;

		$SoldProducts = ProductStock::select('products.id','products.article','products.brand','products.name')
					->where('product_stocks.warehouse_id','=',$warehouse)
					->where('product_stocks.doc_type','=',"sale")
					->whereBetween('product_stocks.finalized_at', [$date_from, $date_to])
					->join('products','products.id','=','product_stocks.product_id')
					->distinct()->get();
		
		if($SoldProducts)
		{
			$SoldProducts = $SoldProducts->toArray();
			foreach($SoldProducts as $Product)
			{
				$data_temp[$Product['id']] = ['id'							=>	$Product['id'],
													'article'				=>	$Product['article'],
													'brand'					=>	$Product['brand'],
													'name'					=>	$Product['name'],
													'products_quantity'		=>	0,
													'products_total'		=>	0,
													'products_total_out'	=>	0,
													'profit'				=>	0,
												];
			}
			
			foreach($data_temp as $item)
			{
				$count++;
				$sales = ProductStock::where('product_stocks.product_id', '=', $item['id'])
						->whereBetween('product_stocks.finalized_at', [$date_from, $date_to])
						->where('product_stocks.doc_type','=',"sale")
						->where('product_stocks.warehouse_id','=',$warehouse)
						->join('products','products.id','=','product_stocks.product_id')->get();
				$quantity = abs($sales->sum('quantity'));
				$total = $sales->sum('total');
				$total_out = $sales->sum('total_out');
				// $total_amount = currency($sales->sum('total_amount'), $sales->currency, $currency, false);
			 	$product_sales[] = ['count'=> $count, 'id'=>$item['id'],
							'article'=>$item['article'],
							'brand'=>$item['brand'],
							'name'=>$item['name'],
							'products_quantity'=> $quantity,
							'products_total'=> $total,
							'products_total_out'=> $total_out,
							'profit'=> $total_out - $total,
						];
						$quantity_total = $quantity_total + $quantity;
						$bought_total	= $bought_total + $total;
						$sold_total		= $sold_total + $total_out;
						$profit			= $profit + ($total_out - $total);
			}
		}

		$product_sales_header['quantity_total']		= $quantity_total;
		$product_sales_header['bought_total']		= $bought_total;
		$product_sales_header['sold_total']			= $sold_total;
		$product_sales_header['profit']				= $profit;
		$product_sales_header['profit_percent']		= $profit/$sold_total*100;
		
		$pdf = PDF::loadView('inventory.pdf_reports.sales_by_clients_print', compact('product_sales_header', 'product_sales'));
		$path = public_path('reports/');
        $file_name = 'product-stocks-report.pdf';
		$pdf->save($path . '/' . $file_name);
		$pdf = public_path('reports/'.$file_name);
        return response()->download($pdf);
	}
	
	 function product_stocks_report()
    {
		$warehouses = Warehouse::all();
        $currencies = Currency::where('active','=','1')->get();
		
		return view('inventory.reports.product_stocks', compact('warehouses','currencies'));
	}

	public function product_stocks_report_print(Request $request)
    {
		$warehouse		= $request->warehouse ?? 1;
		$currency		= $request->currency ?? "RUB";
		
		$count				= 0;
		$stocks_total		= 0;
		$quantity_total		= 0;

		$product_stocks = [];
		$product_stocks_header						= [];		
		$product_stocks_header['report_date']		= $request->report_date ?? Carbon::now()->endOfMonth();
		$product_stocks_header['warehouse']			= Warehouse::where('id','=',$warehouse)->first()->name;		
		$product_stocks_header['currency']			= Currency::where('code','=',$currency)->first()->name;

		$q = ProductStock::select('product_id','products.name')
				->leftjoin('products','products.id','=','product_stocks.product_id')
				->distinct()
				->orderBy('products.name', 'asc')
				->get();

		if($q)
		{ 
			$q = $q->toArray();
			foreach($q as $product)
			{				
				$abn = Product::select('article','brand','name')->where('id','=',$product['product_id'])->first()->toArray();
				$quanity = AddProductController::get_product_stocks($product['product_id']);
				$price = AddProductController::get_product_price($product['product_id'], 'in', $currency);
				if($quanity > 0)
				{
					$count++;
					$product_stocks[] = ['count' => $count,
								'id' => $product['product_id'],
								'article' => $abn['article'],
								'brand' => $abn['brand'],
								'name' => $abn['name'],
								'quantity' => $quanity,
								'price' => $price,
								'total' => $quanity * $price];
					$stocks_total = $stocks_total + $quanity * $price;
					$quantity_total = $quantity_total + $quanity;
				}				
			}
		}

		$product_stocks_header['stocks_total']			= $stocks_total;
		$product_stocks_header['quantity_total']		= $quantity_total;
		
		$pdf = PDF::loadView('inventory.pdf_reports.product_stocks', compact('product_stocks_header', 'product_stocks'));
		$path = public_path('reports/');
        $file_name = 'product-stocks-report.pdf';
		$pdf->save($path . '/' . $file_name);
		$pdf = public_path('reports/'.$file_name);
        return response()->download($pdf);
	}

	// SELECT
	// product_stocks.product_id,
	// Sum(product_stocks.quantity),
	// products.article,
	// products.brand,
	// products.`name`
	// FROM
	// product_stocks
	// INNER JOIN products ON product_stocks.product_id = products.id
	// GROUP BY
	// product_stocks.product_id
	// ORDER BY
	// products.full_name ASC
	public function product_stocks_report_show(Request $request)
    {
		$warehouse			= $request->warehouse ?? 1;
		$currency			= $request->currency ?? "RUB";
		
		$count = 0;
		$product_stocks = [];
		$stocks_total = 0;
		$quantity_total = 0;

		$q = ProductStock::select('product_id','products.name')
			->leftjoin('products','products.id','=','product_stocks.product_id')
			->distinct()
			->orderBy('products.name', 'asc')
			->get();

		if($q)
		{
			foreach($q as $product)
			{				
				$abn = Product::select('article','brand','name')->where('id','=',$product['product_id'])->first()->toArray();
				$quanity = AddProductController::get_product_stocks($product['product_id']);
				$price = AddProductController::get_product_price($product['product_id'], 'in', $currency);
				if($quanity > 0)
				{
					$count++;
					$data[] = ['count' => $count,
								'id' => $product['product_id'],
								'article' => $abn['article'],
								'brand' => $abn['brand'],
								'name' => $abn['name'],
								'quantity' => $quanity,
								'price' => $price,
								'total' => $quanity * $price];
					$stocks_total = $stocks_total + $quanity * $price;
					$quantity_total = $quantity_total + $quanity;
				}
				
			}
		}

		return response()->json([
			'stocks_total'		=> $stocks_total,
			'quantity_total'	=> $quantity_total,
			'currency'			=> $currency,
			'warehouse'			=> $warehouse,
			'stocks_table'		=> $data,
		]);
	}

	public function settlements()
    {
		return view('inventory.reports.settlements');
	}

    public function settlements_show(Request $request)
    {
		$warehouse_id		= 1;
		$count				= 0;
		$product_stocks		= [];

		$q = ProductStock::select('product_id')->distinct()->get()->toArray();
		if($q)
		{
			foreach($q as $product)
			{
				$count++;
				$abn = Product::select('article','brand','name')->where('id','=',$product['product_id'])->first()->toArray();
				$data[] = ['count' => $count, 'id' => $product['product_id'],
															'article' => $abn['article'],
															'brand' => $abn['brand'],
															'name' => $abn['name'],
															'quantity' => AddProductController::get_product_stocks($product['product_id'])];
			}
		}
		return response()->json($data);
	}

	//sales by product categories
    public function sales_by_categories()
    {
		return view('inventory.reports.sales_by_categories');
	}
	
	public function sales_by_categories_show(Request $request)
    {
		$warehouse = $request->warehouse ?? 1;
		$currency = "RUB";
		$count = 0;
		$data = [];
		$date_from = $request->date_from ?? Carbon::now()->startOfMonth();
		$date_to = $request->date_to ?? Carbon::now()->endOfMonth();

		$SoldProductGroups = SoldProduct::select('product_groups.id','product_groups.name')
					->where('sold_products.warehouse_id','=',$warehouse)
					->whereBetween('sales.finalized_at', [$date_from, $date_to])
					->whereBetween('sold_products.created_at', [$date_from, $date_to])
					->join('sales','sales.id','=','sold_products.sale_id')
					->join('products','products.id','=','sold_products.product_id')
					->join('product_groups','product_groups.id','=','products.product_group_id')
					->distinct()->get()->toArray();
		if($SoldProductGroups)
		{
			foreach($SoldProductGroups as $productGroup)
			{
				$data_temp[$productGroup['id']] = ['id'						=>	$productGroup['id'],
													'name'					=>	$productGroup['name'],
													'products_quantity'		=>	0,
													'products_total_amount'	=>	0];
			}

			foreach($data_temp as $item)
			{
				$count++;

				$sales = SoldProduct::where('products.product_group_id', '=', $item['id'])
					->whereBetween('sold_products.created_at', [$date_from, $date_to])
					->join('products','products.id','=','sold_products.product_id')
					->join('product_groups','product_groups.id','=','products.product_group_id')->get();

				$quantity = $sales->sum('quantity');
				$total_amount = $sales->sum('total_amount');

			 	$data[] = ['count'=> $count, 'id'=>$item['id'], 'name'=>$item['name'],'products_quantity'=> $quantity ,'products_total_amount'=> $total_amount];
			}

		}
		
		return response()->json($data);       
    }
	
	//sales by product products
    public function sales_by_products()
    {
		$currencies = Currency::where('active','=', 1)->get()->toArray();
		$warehouses = Warehouse::where('active','=', 1)->get()->toArray();

		return view('inventory.reports.sales_by_products', compact('currencies','warehouses'));
	}
	
	public function sales_by_products_show(Request $request)
    {
		$warehouse = $request->warehouse ?? 1;
		$count = 0;
		$data = [];
		$date_from = $request->date_from ?? Carbon::now()->startOfMonth();
		$date_to = $request->date_to ?? Carbon::now()->endOfMonth();

		$SoldProducts = SoldProduct::select('products.id','products.article','products.brand','products.name')
					->where('sold_products.warehouse_id','=',$warehouse)
					->whereBetween('sold_products.created_at', [$date_from, $date_to])
					->whereBetween('sales.finalized_at', [$date_from, $date_to])
					->join('sales','sales.id','=','sold_products.sale_id')
					->join('products','products.id','=','sold_products.product_id')
					->distinct()
					->orderBy('products.name', 'asc')
					->get();
		if($SoldProducts)
		{
			// dd(compact('SoldProducts'));
			$SoldProducts = $SoldProducts->toArray();
			foreach($SoldProducts as $Product)
			{
				$data_temp[$Product['id']] = ['id'							=>	$Product['id'],
													'article'				=>	$Product['article'],
													'brand'					=>	$Product['brand'],
													'name'					=>	$Product['name'],
													'products_quantity'		=>	0,
													'products_total_amount'	=>	0];
			}
			
			foreach($data_temp as $item)
			{
				$count++;
				$sales = SoldProduct::where('sold_products.product_id', '=', $item['id'])
				->whereBetween('sold_products.created_at', [$date_from, $date_to])
				->where('sold_products.warehouse_id','=',$warehouse)
			 	->join('products','products.id','=','sold_products.product_id')->get();
				$quantity = $sales->sum('quantity');
				$total_amount = $sales->sum('total_amount');
				// $total_amount = currency($sales->sum('total_amount'), $sales->currency, $currency, false);
			 	$data[] = ['count'=> $count, 'id'=>$item['id'],
							'article'=>$item['article'],
							'brand'=>$item['brand'],
							'name'=>$item['name'],
							'products_quantity'=> $quantity,
							'products_total_amount'=> $total_amount];
			}
		}
		
		return response()->json($data);       
    }

	//profit by sales
    public function profit_by_sales()
    {
		$currencies = Currency::where('active','=', 1)->get()->toArray();
		$warehouses = Warehouse::where('active','=', 1)->get()->toArray();
		return view('inventory.reports.profit_by_sales', compact('currencies','warehouses'));
	}
	
	public function profit_by_sales_show(Request $request)
    {
		$warehouse		= $request->warehouse ?? 1;
		$currency		= $request->currency ?? "RUB";
		
		$data = [];
		$count					= 0;
		$bought_total			= 0;
		$sold_total				= 0;
		$quantity_total			= 0;
		$profit_total			= 0;

		$date_from = $request->date_from ?? Carbon::now()->startOfMonth();
		$date_to = $request->date_to ?? Carbon::now()->endOfMonth();

		$SoldProducts = ProductStock::select('products.id','products.article','products.brand','products.name')
					->where('product_stocks.warehouse_id','=',$warehouse)
					->where('product_stocks.doc_type','=',"sale")
					->whereBetween('product_stocks.finalized_at', [$date_from, $date_to])
					->join('products','products.id','=','product_stocks.product_id')
					->distinct()
					->orderBy('products.name', 'asc')
					->get();
		
		if($SoldProducts)
		{
			$SoldProducts = $SoldProducts->toArray();
			foreach($SoldProducts as $Product)
			{
				$data_temp[$Product['id']] = ['id'							=>	$Product['id'],
													'article'				=>	$Product['article'],
													'brand'					=>	$Product['brand'],
													'name'					=>	$Product['name'],
													'products_quantity'		=>	0,
													'products_total'		=>	0,
													'products_total_out'	=>	0,
													'profit'				=>	0,
													'markup'				=>	0,
												];
			}
			
			foreach($data_temp as $item)
			{
				$count++;
				$sales = ProductStock::where('product_stocks.product_id', '=', $item['id'])
					->whereBetween('product_stocks.finalized_at', [$date_from, $date_to])
					->where('product_stocks.doc_type','=',"sale")
					->where('product_stocks.warehouse_id','=',$warehouse)
					->join('products','products.id','=','product_stocks.product_id')->get();
					
				$quantity							= abs($sales->sum('quantity'));
				$total								= $sales->sum('total');
				$total_out							= $sales->sum('total_out');
				$profit								= $total_out - $total;
				
			 	$data[] = ['count'					=> $count,
							'id'					=> $item['id'],
							'article'				=> $item['article'],
							'brand'					=> $item['brand'],
							'name'					=> $item['name'],
							'products_quantity'		=> number_format($quantity),
							'products_total'		=> number_format($total),
							'products_total_out'	=> number_format($total_out),
							'profit'				=> number_format(($total_out - $total), 2),
							'markup'				=> number_format(($total_out>0 ? ($total_out - $total)/$total_out*100 : 0), 2),
						];
						$quantity_total				= $quantity_total + $quantity;
						$bought_total				= $bought_total + $total;
						$sold_total					= $sold_total + $total_out;
						$profit_total				= $profit_total + $profit;
						
			}
		}
		
		return response()->json([
			'quantity_total'	=> $quantity_total,
			'currency'			=> $currency,
			'warehouse'			=> $warehouse,
			'data'				=> $data,
			'bought_total'				=> $bought_total,
			'sold_total'				=> $sold_total,
			'profit_total'				=> $profit_total,
			'avgmarkup'					=> number_format($profit_total/$sold_total*100, 2),
		]);     
    }

	public function profit_by_sales_print(Request $request)
    {
		$warehouse		= $request->warehouse ?? 1;
		$currency		= $request->currency ?? "RUB";
		
		$data = [];
		$count				= 0;
		$bought_total		= 0;
		$sold_total			= 0;
		$quantity_total		= 0;
		$profit				= 0;

		$product_sales = [];
		$product_sales_header						= [];		
		$product_sales_header['date_to']			= $date_to = $request->date_to ?? Carbon::now()->endOfMonth();
		$product_sales_header['date_from']			= $date_from = $request->date_from ?? Carbon::now()->startOfMonth();
		$product_sales_header['warehouse']			= Warehouse::where('id','=',$warehouse)->first()->name;		
		$product_sales_header['currency']			= Currency::where('code','=',$currency)->first()->name;

		$SoldProducts = ProductStock::select('products.id','products.article','products.brand','products.name')
					->where('product_stocks.warehouse_id','=',$warehouse)
					->where('product_stocks.doc_type','=',"sale")
					->whereBetween('product_stocks.finalized_at', [$date_from, $date_to])
					->join('products','products.id','=','product_stocks.product_id')
					->distinct()->get();
		
		if($SoldProducts)
		{
			$SoldProducts = $SoldProducts->toArray();
			foreach($SoldProducts as $Product)
			{
				$data_temp[$Product['id']] = ['id'							=>	$Product['id'],
													'article'				=>	$Product['article'],
													'brand'					=>	$Product['brand'],
													'name'					=>	$Product['name'],
													'products_quantity'		=>	0,
													'products_total'		=>	0,
													'products_total_out'	=>	0,
													'profit'				=>	0,
												];
			}
			
			foreach($data_temp as $item)
			{
				$count++;
				$sales = ProductStock::where('product_stocks.product_id', '=', $item['id'])
				->whereBetween('product_stocks.finalized_at', [$date_from, $date_to])
				->where('product_stocks.doc_type','=',"sale")
				->where('product_stocks.warehouse_id','=',$warehouse)
			 	->join('products','products.id','=','product_stocks.product_id')->get();
				$quantity = abs($sales->sum('quantity'));
				$total = $sales->sum('total');
				$total_out = $sales->sum('total_out');
				// $total_amount = currency($sales->sum('total_amount'), $sales->currency, $currency, false);
			 	$product_sales[] = ['count'=> $count, 'id'=>$item['id'],
							'article'=>$item['article'],
							'brand'=>$item['brand'],
							'name'=>$item['name'],
							'products_quantity'=> $quantity,
							'products_total'=> $total,
							'products_total_out'=> $total_out,
							'profit'=> $total_out - $total,
						];
						$quantity_total = $quantity_total + $quantity;
						$bought_total	= $bought_total + $total;
						$sold_total		= $sold_total + $total_out;
						$profit			= $profit + ($total_out - $total);
			}
		}

		$product_sales_header['quantity_total']		= $quantity_total;
		$product_sales_header['bought_total']		= $bought_total;
		$product_sales_header['sold_total']			= $sold_total;
		$product_sales_header['profit']				= $profit;
		$product_sales_header['profit_percent']		= $profit/$sold_total*100;
		
		$pdf = PDF::loadView('inventory.pdf_reports.profit_by_sales_print', compact('product_sales_header', 'product_sales'));
		$path = public_path('reports/');
        $file_name = 'product-stocks-report.pdf';
		$pdf->save($path . '/' . $file_name);
		$pdf = public_path('reports/'.$file_name);
        return response()->download($pdf);
	}
}
