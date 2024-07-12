<?php

namespace App\Http\Controllers\Inventory;

use App\Models\Inventory\Warehouse;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class WarehousesController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::paginate(25);
        return view('inventory.warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        return view('inventory.warehouses.create');
    }

    public function store(Request $request, Warehouse $warehouse)
    {
        $requestData = $request->all();
        $requestData['address']    = ($request->address == "on") ? 1 : 0;
        $requestData['active']    = ($request->active == "on") ? 1 : 0;

        $warehouse->create($requestData);
        
        return redirect()->route('warehouses.index')->withStatus('Successfully registered customer.');
    }

    public function show(Warehouse $warehouse)
    {
        return view('inventory.warehouses.show', compact('warehouse'));
    }

    public function edit(Warehouse $warehouse)
    {
        return view('inventory.warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $requestData = $request->all();
        $requestData['address']    = ($request->address == "on") ? 1 : 0;
        $requestData['active']    = ($request->active == "on") ? 1 : 0;

        $warehouse->update($requestData);

        return redirect()
            ->route('warehouses.index')
            ->withStatus('Successfully modified customer.');
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return redirect()
            ->route('warehouses.index')
            ->withStatus('Customer successfully removed.');
    }

    public function addtransaction(Warehouse $warehouse)
    {
        $payment_methods = PaymentMethod::all();

        return view('inventory.warehouses.transactions.add', compact('warehouse','payment_methods'));
    }
}
