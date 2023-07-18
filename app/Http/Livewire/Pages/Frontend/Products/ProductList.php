<?php

namespace App\Http\Livewire\Pages\Frontend\Products;

use App\Models\Label;
use App\Models\Pages;
use App\Models\Product;
use App\Models\productUnivers;
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
        $data['description'] = Pages::where('key', 'product')->first();
        $data['univers'] = productUnivers::orderBy('key', 'asc')->get();
        return view('livewire.pages.frontend.products.product-list', $data);
    }
}
