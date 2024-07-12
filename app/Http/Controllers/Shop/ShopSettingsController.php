<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;

use App\Models\Shop\ShopSetting;

use App\Http\Controllers\Controller;

class ShopSettingsController extends Controller
{
    public function index()
    {
        $shop_settings = ShopSetting::all();
        return view('inventory.shop_settings.index', compact('shop_settings'));
    }

    public function create()
    {
        return view('inventory.shop_settings.create');
    }

    public function store(Request $request, ShopSetting $shop_setting)
    {
        $shop_setting->create($request->all());
        
        return redirect()->route('shop_settings.index')->withStatus('Successfully registered setting.');
    }

    public function show(ShopSetting $shop_setting)
    {
        return view('inventory.shop_settings.show', compact('shop_setting'));
    }

    public function edit(ShopSetting $shop_setting)
    {
        return view('inventory.shop_settings.edit', compact('shop_setting'));
    }

    public function update(Request $request, ShopSetting $shop_setting, ShopSettingsFactory $cache)
    {
        $shop_setting->update($request->all());

        $cache->forget('shop_settings');

        return redirect()->route('shop_settings.index')->withStatus('Successfully modified setting.');
    }

    public function destroy(ShopSetting $shop_setting)
    {
        $shop_setting->delete();

        return redirect()->route('shop_settings.index')->withStatus('ShopSetting successfully removed.');
    }
}
