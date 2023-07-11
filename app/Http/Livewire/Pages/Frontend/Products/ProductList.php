<?php

namespace App\Http\Livewire\Pages\Frontend\Products;

use App\Models\Label;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;
    public function render()
    {
        $data = [];
        $data['products'] = Product::where('active', 1)->paginate(15);
        $data['labels'] = Label::all();
        return view('livewire.pages.frontend.products.product-list', $data);
    }
}
