<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;

use App\Models\Product\Product;
use App\Models\Product\ProductCategory;

use App\Http\Requests\ProductCategoryRequest;

class ProductCategoryController extends Controller
{
    public function index(ProductCategory $product_category)
    {
        $categories = ProductCategory::paginate(25);

        return view('inventory.product_categories.index', compact('categories'));
    }
    
    public function create()
    {
        return view('inventory.product_categories.create');
    }

    public function store(ProductCategoryRequest $request, ProductCategory $product_category)
    {
        $product_category->create($request->all());

        return redirect()->route('product_categories.index')->withStatus('Category successfully created.');
    }

    public function show(ProductCategory $product_category)
    {
        return view('inventory.product_categories.show', [
            'category' => $product_category,
            'products' => Product::where('product_category_id', $product_category->id)->paginate(25)
        ]);
    }

    public function edit(ProductCategory $category)
    {
        return view('inventory.product_categories.edit', compact('category'));
    }

    public function update(ProductCategoryRequest $request, ProductCategory $product_category)
    {
        $product_category->update($request->all());

        return redirect()->route('product_categories.index')->withStatus('Category successfully updated.');
    }

    public function destroy(ProductCategory $product_category)
    {
        $product_category->delete();

        return redirect()->route('product_categories.index')->withStatus('Category successfully deleted.');
    }
}
