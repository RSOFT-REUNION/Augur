<?php

namespace App\Http\Livewire\Pages\Frontend\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $univers;

    public function mount($univers)
    {
        $this->univers = $univers;
    }
    public function render()
    {
        $data = [];
        $data['univers'] = $this->univers;
        $data['products'] = Product::where('univers_id', $this->univers->id)->paginate(16);
        return view('livewire.pages.frontend.products.products', $data);
    }
}
