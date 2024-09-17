<?php

namespace App\Http\Controllers\Inventory;

use Session;

use Carbon\Carbon;

use App\Models\Product\Product;
use App\Models\Product\ProductStock;
use App\Models\Product\SoldProduct;

use App\Models\Client\Client;

use App\Models\Inventory\Sale;
use App\Models\Inventory\Receipt;
use App\Models\Inventory\ClientOrder;
use App\Models\Inventory\ToProviderOrder;
use App\Models\Inventory\Transaction;
use App\Models\Inventory\PaymentMethod;
use App\Models\Inventory\AdminCart;

use App\Models\OrderControl\ProductClientOrderControl;
use App\Models\OrderControl\ProductToProviderOrderControl;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $monthlybalancebymethod                 = $this->getMethodBalance()->get('monthlyBalanceByMethod');
        $monthlybalance                         = $this->getMethodBalance()->get('monthlyBalance');

        $anualsales                             = $this->getAnnualSales();
        $anualclients                           = $this->getAnnualClients();
        $anualproducts                          = $this->getAnnualProducts();
        
        $lasttransactions = [];
        // $lasttransactions                       = Transaction::latest()->limit(20)->get();
        $date_from                              = $request->date_from ?? Carbon::now()->startOfDay();
		$date_to                                = $request->date_to ?? Carbon::now()->endOfDay();
        $lasttransactions                       = Transaction::whereBetween('created_at', [$date_from, $date_to])->get();

        $unfinishedsales                        = Sale::where('finalized_at', null)->get();
        $unfinishedreceipts                     = Receipt::where('finalized_at', null)->get();
        $MonthlyTransactions                    = $this->getMonthlyTransactions();
        
        $lastmonths                             = array_reverse($MonthlyTransactions->get('lastmonths'));
        $lastincomes                            = $MonthlyTransactions->get('lastincomes');
        $lastexpenses                           = $MonthlyTransactions->get('lastexpenses');
        $semesterexpenses                       = $MonthlyTransactions->get('semesterexpenses');
        $semesterincomes                        = $MonthlyTransactions->get('semesterincomes');
        
        $lastadmincarts                         = AdminCart::orderBy('id', 'desc')->limit(20)->get();
        $unfinishedclientorders                 = ClientOrder::whereNull('finalized_at')->get();
        $unfinishedtoproviderorders             = ToProviderOrder::whereNull('finalized_at')->get();
        
        $productStocksTotal                     = $this->productStocksTotal();
        $moneysTotal                            = Transaction::sum('amount');
        $totalCost                              = $productStocksTotal + $moneysTotal;

        //unfinished client orders
        $unfinished_client_orders               = [];
        
        $client_order_uids                      = ProductClientOrderControl::select('order_uid')->distinct()->get();
        
        foreach($client_order_uids as $item)
        {
            $item_order_sum                     = ProductClientOrderControl::where('order_uid','=', $item['order_uid'])->sum('quantity');
            if($item_order_sum !=0)
            {
                $unfinished_client_orders[]     = ProductClientOrderControl::where('order_uid','=', $item['order_uid'])->first()->doc_id;
            }
        }
        $unfinished_client_orders     = ClientOrder::whereIn('id',array_unique($unfinished_client_orders))->get();
        
        //unfinished to provider orders
        $unfinished_to_provider_orders              = [];
        
        $to_provider_order_uids                     = ProductToProviderOrderControl::select('order_uid')->distinct()->get();
        foreach($to_provider_order_uids as $item)
        {
            $item_order_sum                         = ProductToProviderOrderControl::where('order_uid','=', $item['order_uid'])->sum('quantity');
            if($item_order_sum !=0)
            {
                $unfinished_to_provider_orders[]    = ProductToProviderOrderControl::where('order_uid','=', $item['order_uid'])->first();
            }
        }

        $notifiedClients = Client::where('created_at', '!=' , null)->orWhere('notified_at','!=', null)->get()->count();

        return view('inventory.dashboard', compact('monthlybalance', 'monthlybalancebymethod','lasttransactions','lastincomes','lastexpenses','semesterexpenses',
        // dd(compact('monthlybalance', 'monthlybalancebymethod','lasttransactions','lastincomes','lastexpenses','semesterexpenses',
            'lastmonths','anualsales','anualclients','anualproducts','unfinishedsales','semesterincomes',
            'unfinishedclientorders','unfinishedtoproviderorders','totalCost','unfinished_client_orders','unfinished_to_provider_orders',
            'productStocksTotal','moneysTotal','notifiedClients','unfinishedreceipts','lastadmincarts'
        ));
    }

    public function productStocksTotal()
	{
        $currency = "RUB";
        $productStocksTotal = 0;
        $request = ProductStock::select('product_id')->distinct()->get()->toArray();
		if($request)
		{
            foreach($request as $product)
			{
				// $quanity        = AddProductController::get_product_stocks($product['product_id']);
				$quanity        = AddProductController::get_product_stocks($product['product_id'], auth()->user()->default_warehouse_id);
				$price          = AddProductController::get_product_price($product['product_id'], 'in', $currency);
				if($quanity > 0)
				{
                    $productStocksTotal = $productStocksTotal+($quanity*$price);
				}															
			}			
		}
		return $productStocksTotal;
	}

    public function getMethodBalance()
    {
        $methods = PaymentMethod::all();
        $monthlyBalanceByMethod = [];
        $monthlyBalance = 0;

        foreach ($methods as $method)
        {
            $balance = Transaction::findByPaymentMethodId($method->id)->thisMonth()->sum('amount');
            $monthlyBalance += (float) $balance;
            $monthlyBalanceByMethod[$method->name] = $balance;
        }
        return collect(compact('monthlyBalanceByMethod', 'monthlyBalance'));
    }

    public function getAnnualSales()
    {
        $sales = [];
        foreach(range(1, 12) as $i)
        {
            $monthlySalesCount = Sale::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $i)->count();

            array_push($sales, $monthlySalesCount);
        }
        return "[" . implode(',', $sales) . "]";
    }

    public function getAnnualClients()
    {
        $clients = [];
        foreach(range(1, 12) as $i)
        {
            $monthclients = Sale::selectRaw('count(distinct client_id) as total')->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $i)->first();

            array_push($clients, $monthclients->total);
        }
        return "[" . implode(',', $clients) . "]";
    }

    public function getAnnualProducts()
    {
        $products = [];
        foreach(range(1, 12) as $i)
        { 
            $monthproducts = SoldProduct::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $i)->sum('quantity');

            array_push($products, $monthproducts);
        }        
        return "[" . implode(',', $products) . "]";
    }

    public function getMonthlyTransactions()
    {
        $actualmonth = Carbon::now();

        $lastmonths = [];
        $lastincomes = '';
        $lastexpenses = '';
        $semesterincomes = 0;
        $semesterexpenses = 0;
        
        foreach (range(1, 6) as $i)
        {
            array_push($lastmonths, $actualmonth->shortMonthName);

            $incomes = Transaction::where('type', 'income')->whereYear('created_at', $actualmonth->year)
                ->WhereMonth('created_at', $actualmonth->month)->sum('amount');

            $semesterincomes += $incomes;
            $lastincomes = round($incomes).','.$lastincomes;

            $expenses = abs(Transaction::whereIn('type', ['expense', 'payment'])->whereYear('created_at', $actualmonth->year)
                ->WhereMonth('created_at', $actualmonth->month)->sum('amount'));

            $semesterexpenses += $expenses;
            $lastexpenses = round($expenses).','.$lastexpenses;

            $actualmonth->subMonthsNoOverflow(1);
        }

        $lastincomes = '['.$lastincomes.']';
        $lastexpenses = '['.$lastexpenses.']';
        
        return collect(compact('lastmonths', 'lastincomes', 'lastexpenses', 'semesterincomes', 'semesterexpenses'));
    }

    public function phpinfo()
    {
        return view('inventory.phpinfo');
    }

}
