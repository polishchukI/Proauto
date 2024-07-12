<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Inventory\InventorySetting;

class InventorySettingsController extends Controller
{
    public function index()
    {
        $inventory_settings = InventorySetting::all();
        return view('inventory.inventory_settings.index', compact('inventory_settings'));
    }

    public function create()
    {
        return view('inventory.inventory_settings.create');
    }

    public function store(Request $request, InventorySetting $inventory_setting)
    {
        $inventory_setting->create($request->all());
        
        return redirect()->route('inventory_settings.index')->withStatus('Successfully registered setting.');
    }

    public function show(InventorySetting $inventory_setting)
    {
        return view('inventory.inventory_settings.show', compact('inventory_setting'));
    }

    public function edit(InventorySetting $inventory_setting)
    {
        return view('inventory.inventory_settings.edit', compact('inventory_setting'));
    }

    public function update(Request $request, InventorySetting $inventory_setting)
    {
        $inventory_setting->update($request->all());

        return redirect()->route('inventory_settings.index')->withStatus('Successfully modified setting.');
    }

    public function destroy(InventorySetting $inventory_setting)
    {
        $inventory_setting->delete();

        return redirect()->route('inventory_settings.index')->withStatus('InventorySetting successfully removed.');
    }
}
