<?php

namespace App\Http\Livewire\Pages\Backend\Products;

use App\Models\Label;
use App\Models\Pages;
use App\Models\Product;
use App\Models\productUnivers;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;
    public $search = '';
    public $jobs = [];

    public $short_description;
    public $description;

    public function mount()
    {
        $pages = Pages::where('key', 'product')->first();
        $this->description = Pages::where('key', 'product')->first();
        if($pages) {
            $this->short_description = $pages->content;
        }
    }

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

    public function updateDescription()
    {
        $page = Pages::where('key', 'product')->first();
        if($page) {
            $page->content = $this->short_description;
            if($page->update()) {
                return redirect()->route('bo.products.list');
            }
        } else {
            $page = new Pages;
            $page->key = 'product';
            $page->content = $this->short_description;
            if($page->save()) {
                return redirect()->route('bo.products.list');
            }
        }
    }

    public function deleted($id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();
        return redirect()->route('bo.products.list');
    }

    public function deleteUnivers($id)
    {
        $univers = productUnivers::where('id', $id)->first();
        $univers->delete();
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
        $data['description'] = Pages::where('key', 'product')->first();
        $data['univers'] = productUnivers::orderby('key', 'asc')->get();
        return view('livewire.pages.backend.products.product-list', $data);
    }
}
