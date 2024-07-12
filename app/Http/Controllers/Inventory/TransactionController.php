<?php

namespace App\Http\Controllers\Inventory;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Client\Client;

use App\Models\Product\SoldProduct;

use App\Models\Inventory\Sale;
use App\Models\Inventory\Provider;
use App\Models\Inventory\Transaction;
use App\Models\Inventory\PaymentMethod;

class TransactionController extends Controller
{
    public function index()
    {
        $transactionname = [
            'income' => 'Income',
            'payment' => 'Payment',
            'expense' => 'Expense',
            'transfer' => 'Transfer'
        ];

        $transactions = Transaction::paginate(25);

        return view('inventory.transactions.index', compact('transactions', 'transactionname'));
    }

    public function transaction_statistics_report()
    {
        Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);
        
        $salesperiods = [];
        $transactionsperiods = [];

        $salesperiods['Day'] = Sale::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->get();
        $transactionsperiods['Day'] = Transaction::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->get();

        $salesperiods['Yesterday'] = Sale::whereBetween('created_at', [Carbon::now()->subDay(1)->startOfDay(), Carbon::now()->subDay(1)->endOfDay()])->get();
        $transactionsperiods['Yesterday'] = Transaction::whereBetween('created_at', [Carbon::now()->subDay(1)->startOfDay(), Carbon::now()->subDay(1)->endOfDay()])->get();

        $salesperiods['Week'] = Sale::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $transactionsperiods['Week'] = Transaction::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        $salesperiods['Month'] = Sale::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();
        $transactionsperiods['Month'] = Transaction::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get();

        $salesperiods['Trimester'] = Sale::whereBetween('created_at', [Carbon::now()->startOfQuarter(), Carbon::now()->endOfQuarter()])->get();
        $transactionsperiods['Trimester'] = Transaction::whereBetween('created_at', [Carbon::now()->startOfQuarter(), Carbon::now()->endOfQuarter()])->get();

        $salesperiods['Year'] = Sale::whereYear('created_at', Carbon::now()->year)->get();
        $transactionsperiods['Year'] = Transaction::whereYear('created_at', Carbon::now()->year)->get();
        
        $clients = [];

        return view('inventory.reports.transactions', [
            'clients'               => $clients,
            'salesperiods'          => $salesperiods,
            'transactionsperiods'   => $transactionsperiods,
            'date'                  => Carbon::now(),
            'methods'               => PaymentMethod::all()
        ]);
    }

    public function type($type)
    {
        switch ($type) {
            case 'expense':
                return view('inventory.transactions.expense.index', ['transactions' => Transaction::where('type', 'expense')->paginate(25)]);

            case 'payment':
                return view('inventory.transactions.payment.index', ['transactions' => Transaction::where('type', 'payment')->paginate(25)]);

            case 'income':
                return view('inventory.transactions.income.index', ['transactions' => Transaction::where('type', 'income')->paginate(25)]);
        }
    }
	
	public function create($type)
    {
        switch ($type) {
            case 'expense':
                return view('inventory.transactions.expense.create', ['payment_methods' => PaymentMethod::all(),]);

            case 'payment':
                return view('inventory.transactions.payment.create', ['payment_methods' => PaymentMethod::all(),'providers' => Provider::all(),]);

            case 'income':
                return view('inventory.transactions.income.create', ['payment_methods' => PaymentMethod::all(),]);
        }
    }
	
    public function store(Request $request, Transaction $transaction)
    {
        if ($request->get('client_id'))
        {
            switch ($request->get('type'))
            {
                case 'income':
                    $request->merge(['title' => 'Платеж полученный от покупателя(ID): ' . $request->get('client_id')]);
                    break;

                case 'expense':
                    $request->merge(['title' => 'Платеж возвращенный от покупателю(ID): ' . $request->get('client_id')]);

                    if ($request->get('amount') > 0)
                    {
                        $request->merge(['amount' => (float) $request->get('amount') * (-1)]);
                    }
                    break;
            }

            $transaction->create($request->all());

            return redirect()->route('transactions.index')->withStatus('Successfully registered transaction.');
        }

        switch ($request->get('type'))
        {
            case 'expense':
                if ($request->get('amount') > 0)
                {
                    $request->merge(['amount' => ((float) $request->get('amount') * (-1))]);
                }

                $transaction->create($request->all());

                return redirect()->route('transactions.type', ['type' => 'expense'])->withStatus('Expense recorded successfully.');

            case 'payment':
                if ($request->get('amount') > 0)
                {
                    $request->merge(['amount' => ((float) $request->get('amount') * (-1))]);
                }

                $transaction->create($request->all());

                return redirect()->route('transactions.type', ['type' => 'payment'])->withStatus('Payment registered successfully.');

            case 'income':
                $transaction->create($request->all());

                return redirect()->route('transactions.type', ['type' => 'income'])->withStatus('Login successfully registered.');

            default:
                return redirect()->route('transactions.index')->withStatus('Successfully registered transaction.');
        }
    }
	
    public function show(Transaction $transaction)
    {
        // switch ($transaction->type) {
        //     case 'expense':
        //         return view('inventory.transactions.expense.edit', ['transaction' => $transaction,'payment_methods' => PaymentMethod::all()]);

        //     case 'payment':
        //         return view('inventory.transactions.payment.edit', ['transaction' => $transaction,'payment_methods' => PaymentMethod::all(),'providers' => Provider::all()]);

        //     case 'income':
        //         return view('inventory.transactions.income.edit', ['transaction' => $transaction,'payment_methods' => PaymentMethod::all(),]);
        // }
    }
    
    public function edit(Transaction $transaction)
    {
        switch ($transaction->type) {
            case 'expense':
                return view('inventory.transactions.expense.edit', ['transaction' => $transaction,'payment_methods' => PaymentMethod::all()]);

            case 'payment':
                return view('inventory.transactions.payment.edit', ['transaction' => $transaction,'payment_methods' => PaymentMethod::all(),'providers' => Provider::all()]);

            case 'income':
                return view('inventory.transactions.income.edit', ['transaction' => $transaction,'payment_methods' => PaymentMethod::all(),]);
        }
    }
	
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update($request->all());

        switch ($request->get('type'))
        {
            case 'expense':
                if ($request->get('amount') > 0)
                {
                    $request->merge(['amount' => ((float) $request->get('amount') * (-1))]);
                }
                return redirect()->route('transactions.type', ['type' => 'expense'])->withStatus('Expense updated sucessfully.');

            case 'payment':
                if ($request->get('amount') > 0)
                {
                    $request->merge(['amount' => ((float) $request->get('amount') * (-1))]);
                }

                return redirect()->route('transactions.type', ['type' => 'payment'])->withStatus('Payment updated satisfactorily.');

            case 'income':
                return redirect()->route('transactions.type', ['type' => 'income'])->withStatus('Income successfully updated.');

            default:
                return redirect()->route('transactions.index')->withStatus('Transaction updated successfully.');
        }
    }
	
    public function destroy(Transaction $transaction)
    {
        //if ($transaction->sale)
        //{
        //    return back()->withStatus('You cannot remove a transaction from a completed sale. You can delete the sale and its entire record.');
        //}

        if ($transaction->transfer)
		{
            return back()->withStatus('You cannot remove a transaction from a transfer. You must delete the transfer to delete its records.');
        }

        $type = $transaction->type;
        $transaction->delete();

        switch ($type) {
            case 'expense':
                return back()->withStatus('Expenditure successfully removed.');

            case 'payment':
                return back()->withStatus('Payment successfully removed.');

            case 'income':
                return back()->withStatus('Entry successfully removed.');

            default:
                return back()->withStatus('Transaction deleted successfully.');
        }
    }
}
