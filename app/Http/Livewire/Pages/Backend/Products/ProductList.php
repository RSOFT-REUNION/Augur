<?php

namespace App\Http\Livewire\Pages\Backend\Products;

use App\Models\Label;
use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{
    public $search = '';
    public $jobs = [];
    public function updatedSearch()
    {
        $query = '%'.$this->search.'%';
        if(strlen($this->search) > 2) {
            $this->jobs = Product::where('title', 'like', $query)
                ->orWhere('tags', 'like', $query)
                ->orWhere('labels', 'like', $query)
                ->orderBy('id', 'desc')
                ->get();
        }
    }

    public function deleted($id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();
        return redirect()->route('bo.products.list');
    }
    public function render()
    {
        $data = [];
        if($this->jobs && strlen($this->search) > 2) {
            $data['products'] = $this->jobs->take(10);
        } else {
            $data['products'] = Product::orderBy('id', 'desc')->paginate(30);
        }
        return view('livewire.pages.backend.products.product-list', $data);
    }
}
