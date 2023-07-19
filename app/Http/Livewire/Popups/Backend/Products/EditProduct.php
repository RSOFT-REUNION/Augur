<?php

namespace App\Http\Livewire\Popups\Backend\Products;

use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\productUnivers;

class EditProduct extends ModalComponent
{
    use WithFileUploads;

    public Product $product;

    public $title, $image, $description, $labels, $tags, $univers;
    protected $rules = [
        'title' => 'required|unique:products,title'
    ];

    public function mount() {
        $products = Product::find($this->product);
        $this->title = $products->title;
        $this->image = $products->picture;
        $this->description = $products->description;
        $this->labels = $products->labels;
        $this->tags = $products->tags;
        $this->univers = $products->univers_id;
    }

    protected $messages = [
        'title.required' => "Le nom du produit est obligatoire",
        'title.unique' => "Un produit existe déjà avec nom",
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function create()
    {
        $this->validate();

        $product = new Product;
        $product->title = $this->title;
        $product->univers_id = $this->univers;
        $product->description = $this->description;
        if($this->image) {
            $product->picture = $this->title.'.'.$this->image->extension();
        }
        $product->tags = strtoupper($this->tags);
        $product->labels = $this->labels;
        $product->active = 1;
        if($product->save()) {
            if($this->image) {
                $this->image->storeAs('public/products', $this->title.'.'.$this->image->extension());
            }
            return redirect()->route('bo.products.list');
        }
    }

    public function render()
    {
        $data = [];
        $data['uni'] = productUnivers::orderby('key', 'asc')->get();
        return view('livewire.popups.backend.products.edit-product', $data);
    }
}
