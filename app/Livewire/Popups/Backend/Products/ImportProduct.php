<?php

namespace App\Livewire\Popups\Backend\Products;

use App\Imports\ProductImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Maatwebsite\Excel\Facades\Excel;

class ImportProduct extends ModalComponent
{
    use WithFileUploads;
    public $file_import;

    protected $rules = [
        'file_import' => 'required'
    ];

    protected $messages = [
        'file_import.required' => "Il vous faut un fichier.",
    ];

    public function updated($file_import)
    {
        $this->validateOnly($file_import);
    }

    public function import()
    {
        if($this->file_import){
            Excel::import(new ProductImport(), $this->file_import);
        }
        return redirect()->route('bo.products.list');
    }
    public function render()
    {
        return view('livewire.popups.backend.products.import-product');
    }
}
