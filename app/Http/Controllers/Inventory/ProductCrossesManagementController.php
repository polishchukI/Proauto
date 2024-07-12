<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Product\ProductCross;

class ProductCrossesManagementController extends Controller
{
    public function index()
    {
        $product_crosses = ProductCross::paginate(25);
        
        // dd(compact('product_crosses'));
        return view('inventory.product_crosses_manager.index', compact('product_crosses'));
    }

    public function create()
    {
        return view('inventory.brands.create');
    }
}
