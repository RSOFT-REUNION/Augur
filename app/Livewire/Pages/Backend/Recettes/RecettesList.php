<?php

namespace App\Livewire\Pages\Backend\Recettes;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;

class RecettesList extends Component
{
    use WithPagination;
    public function render()
    {
        $data = [];
        $data['recipes'] = Recipe::orderBy('title', 'asc')->paginate(9);
        return view('livewire.pages.backend.recettes.recettes-list', $data);
    }
}
