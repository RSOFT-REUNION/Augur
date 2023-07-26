<?php

namespace App\Http\Livewire\Popups\Backend\Products;

use App\Models\Label;
use App\Models\Media;
use App\Models\Product;
use App\Models\productUnivers;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Spatie\ImageOptimizer\OptimizerChainFactory;

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
            /*$optimizedImage = Image::make($this->image)
                ->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            $optimizedImage->save(storage_path('app/public/products/'. $this->title.'.'.$this->image->extension()));

            $optimizedChain = OptimizerChainFactory::create();
            $optimizedChain->optimize(storage_path('app/public/products/'. $this->title.'.'.$this->image->extension()));*/
        }
        $product->tags = strtoupper($this->tags);
        $product->labels = $this->labels;
        $product->active = 1;
        if($product->save()) {
            if($this->image) {
                $this->image->storeAs('public/products', $product->picture);
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
