<?php

namespace App\Http\Livewire\Popups\Frontend;

use App\Models\Evenement;
use App\Models\Label;
use App\Models\Product;
use LivewireUI\Modal\ModalComponent;

class Search extends ModalComponent
{
    public $search;
    public $jobsLabel = [];
    public $jobsEvenement = [];
    public $jobsProduct = [];

    public function updatedSearch()
    {
        $query = '%'.$this->search.'%';
        $searchQuery = '%'.$this->search.'%';
        if (strlen($this->search) > 2) {
            $label_table = Label::where('title', 'like', $query)->get();
            $evenement_table = Evenement::where('title', 'like', $query)->get();
            $product_table = Product::where('title', 'like', $query)->get();
            if($label_table) {
                $this->jobsLabel = $label_table;
            }
            if($evenement_table) {
                $this->jobsEvenement = $evenement_table;
            }
            if($product_table) {
                $this->jobsProduct = $product_table;
            }
        }
    }
    public function render()
    {
        return view('livewire.popups.frontend.search');
    }
}
