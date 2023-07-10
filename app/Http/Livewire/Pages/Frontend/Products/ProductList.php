<?php

namespace App\Http\Livewire\Pages\Frontend\Products;

use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{
    public function render()
    {
        $data = [];
        $data['products'] = Product::where('active', 1)->paginate(15);
        return view('livewire.pages.frontend.products.product-list', $data);
    }
}
