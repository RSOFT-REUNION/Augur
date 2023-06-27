<?php

namespace App\Http\Livewire\Popups\Backend\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AddProduct extends ModalComponent
{
    use WithFileUploads;

    public $title, $image, $description;

    protected $rules = [
        'title' => 'required'
    ];

    public function render()
    {
        return view('livewire.popups.backend.products.add-product');
    }
}
