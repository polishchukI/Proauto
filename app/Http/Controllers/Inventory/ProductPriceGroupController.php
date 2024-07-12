<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;

use App\Models\Product\Product;
use App\Models\Product\ProductPriceGroup;

use App\Http\Controllers\Controller;

class ProductPriceGroupController extends Controller
{

    public function index()
    {
        $product_price_groups = ProductPriceGroup::paginate(25);
        return view('inventory.product_price_groups.index', compact('product_price_groups'));
    }

    public function create()
    {
        return view('inventory.product_price_groups.create');
    }

    public function store(Request $request, ProductPriceGroup $product_price_group)
    {
        $product_price_group->create($request->all());

        return redirect()->route('product_price_groups.index')->withStatus('Product Price Group successfully created.');
    }
    
    public function show(ProductPriceGroup $product_price_group)
    {
        return view('inventory.product_price_groups.show', [
            'product_price_group' => $product_price_group,
            // 'products' => Product::where('product_category_id', $category->id)->paginate(25)
        ]);
    }
    
    public function edit(ProductPriceGroup $product_price_group)
    {
        return view('inventory.product_price_groups.edit', compact('product_price_group'));
    }
    
    public function update(Request $request, ProductPriceGroup $product_price_group)
    {
        $product_price_group->update($request->all());

        return redirect()->route('product_price_groups.index')->withStatus('ProductPriceGroup successfully updated.');
    }

    public function destroy(ProductPriceGroup $product_price_group)
    {
        $product_price_group->delete();

        return redirect()->route('product_price_groups.index')->withStatus('Category successfully deleted.');
    }
}
