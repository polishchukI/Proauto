<?php

namespace App\Http\Controllers\Inventory;

use Artisan;

use App\Http\Requests;

use Illuminate\Http\Request;

use App\Models\Inventory\Currency;

use App\Http\Controllers\Controller;

class CurrenciesController extends Controller
{
	
    public function index(Request $request)
	{
		$currencies = Currency::paginate(25);

		return view('inventory.currencies.index', compact('currencies'));
    }
	
	public function create()
    {
        return view('inventory.currencies.create');
    }
	
	public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required',
			'code' => 'required',
			'symbol' => 'required',
			'format' => 'required',
			'exchange_rate' => 'required',
			'active' => 'required'
		]);
        $requestData = $request->all();
        
        Currency::create($requestData);

        return redirect('inventory/currencies')->with('flash_message', 'Currency added!');
    }
	
    public function show($id)
    {
        $currency = Currency::findOrFail($id);

        return view('inventory.currencies.show', compact('currency'));
    }
	
    public function edit($id)
    {
        $currency = Currency::findOrFail($id);

        return view('inventory.currencies.edit', compact('currency'));
    }
	
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'name' => 'required',
			'code' => 'required',
			'symbol' => 'required',
			'format' => 'required',
			'exchange_rate' => 'required',
		]);
        $requestData = $request->all();
        
        $currency = Currency::findOrFail($id);
        $currency->update($requestData);

        return redirect('inventory/currencies')->with('flash_message', 'Currency updated!');
    }
	
    public function destroy($id)
    {
        Currency::destroy($id);

        return redirect()->route('currencies.index')->withStatus('flash_message', 'Currency deleted!');
    }
	
    public function currencies_update(Request $request)
    {
		Artisan::call('currency:update -o');
        
        return redirect()->back()->withStatus('Currencieses updated!');
    }
}