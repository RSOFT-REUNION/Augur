<?php

namespace App\Http\Livewire\Popups\Backend\Products;


use App\Models\Product;
use App\Models\productUnivers;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AddProduct extends ModalComponent
{
    use WithFileUploads;

    public $title, $image, $description, $labels, $tags, $univers;
    protected $rules = [
        'title' => 'required|unique:products,title'
    ];

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
                // Optimisation de l'image
                $optimizedImage = Image::make($this->image)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
                Storage::disk('local')->put('public/products/'.$this->title.'.'.$this->image->extension(), $optimizedImage);
            }
            return redirect()->route('bo.products.list');
        }
    }

    public function render()
    {
        $data = [];
        $data['uni'] = productUnivers::orderby('key', 'asc')->get();
        return view('livewire.popups.backend.products.add-product', $data);
    }
}
