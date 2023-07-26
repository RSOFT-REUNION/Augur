<?php

namespace App\Http\Livewire\Popups\Backend\Products;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\productUnivers;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class EditProduct extends ModalComponent
{
    use WithFileUploads;

    public $product;

    public $title, $image, $description, $labels, $tags, $univers;

    protected $rules = [
        'title' => 'required',
        'image' => 'nullable|mimes:jpg,png,jpeg'
    ];

    protected $messages = [
        'title.required' => "Le nom du produit est obligatoire",
        'title.unique' => "Un produit existe déjà avec nom",
        'image.mimes' => "Le fichier doit être au format: JPG, PNG ou JPEG"
    ];


    public function mount($product) {
        $this->product = Product::where('id', $product)->first();
        $this->title = $this->product->title;
        $this->description = $this->product->description;
        $this->labels = $this->product->labels;
        $this->tags = $this->product->tags;
        $this->univers = $this->product->univers_id;
    }

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function create()
    {
        $this->validate();

        $product = $this->product;
        $product->title = $this->title;
        $product->univers_id = $this->univers;
        $product->description = $this->description;
        if($this->image) {
            $product->picture = $this->title.'.'.$this->image->extension();
        }
        $product->tags = strtoupper($this->tags);
        $product->labels = $this->labels;
        $product->active = 1;
        if($product->update()) {
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
        return view('livewire.popups.backend.products.edit-product', $data);
    }
}
