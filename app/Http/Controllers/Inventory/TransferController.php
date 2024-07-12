<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use App\Models\Inventory\Transfer;
use App\Models\Inventory\Transaction;
use App\Models\Inventory\PaymentMethod;

class TransferController extends Controller
{
    public function index(Transfer $transfer)
    {
        return view('inventory.transfers.index', [
            'transfers' => Transfer::paginate(25)
        ]);
    }

    public function create()
    {
        return view('inventory.transfers.create', [
            'methods' => PaymentMethod::all()
        ]);
    }

    public function store(Request $request, Transfer $transfer, Transaction $transaction)
    {
        $transfer = $transfer->create($request->all());

        $transaction->create([
            "type" => "expense",
            "title" => "TransferID: ".$transfer->id,
            "transfer_id" => $transfer->id,
            "payment_method_id" => $transfer->sender_method_id,
            "amount" => ((float) abs($transfer->sended_amount) * (-1)),
            "user_id" => Auth::id(),
            "reference" => $transfer->reference
        ]);

        $transaction->create([
            "type" => "income",
            "title" => "TransferID: ".$transfer->id,
            "transfer_id" => $transfer->id,
            "payment_method_id" => $transfer->receiver_method_id,
            "amount" => abs($transfer->received_amount),
            "user_id" => Auth::id(),
            "reference" => $transfer->reference
        ]);

        return redirect()
            ->route('transfer.index')
            ->withStatus('Transaction registered successfully.');
    }

    public function destroy(Transfer $transfer)
    {
        $transfer->delete();

        return back()
            ->withStatus('The transfer and its associated transactions have been successfully removed.');
    }
}
