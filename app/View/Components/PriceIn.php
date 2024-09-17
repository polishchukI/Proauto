<?php

namespace App\View\Components;

use Illuminate\View\Component;

use App\Http\Controllers\Inventory\AddProductController;

class PriceIn extends Component
{
    public $productId;
    public $currency;
    public $date;
    public $priceType;
    public $priceIn;
    
    public function __construct($priceType, $productId, $currency, $date)
    {
        $this->priceType = $priceType;
        $this->productId = $productId;
        $this->currency = $currency;
        $this->date = $date;
        $this->priceIn = AddProductController::get_product_price($productId, 'in', $currency);
    }
    
    public function render()
    {
        return view('components.price-in');
    }
}
