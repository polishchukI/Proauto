<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Requests;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Inventory\OrderStatus;

class OrdersStatusController extends Controller
{
    public function index(Request $request)
    {
        $ordersstatuses = OrderStatus::paginate(25);

        return view('inventory.orders-status.index', compact('ordersstatuses'));
    }
	
    public function create()
    {
        return view('inventory.orders-status.create');
    }
	
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        OrderStatus::create($requestData);

        return redirect('order_statuses')->withStatus('Online order status added!');
    }
	
    public function show($id)
    {
        $orderstatus = OrderStatus::findOrFail($id);

        return view('inventory.orders-status.show', compact('orderstatus'));
    }
	
    public function edit($id)
    {
        $orderstatus = OrderStatus::findOrFail($id);

        return view('inventory.orders-status.edit', compact('orderstatus'));
    }
	
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        $orderstatus = OrderStatus::findOrFail($id);
        $orderstatus->update($requestData);

        return redirect('order_statuses')->withStatus('Online order status updated!');
    }
	
    public function destroy($id)
    {
        OrderStatus::destroy($id);

        return redirect('order_statuses')->withStatus('Online order status deleted!');
    }
}
