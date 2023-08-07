<?php

namespace App\Http\Livewire\Pages\Frontend\Recipes;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;

class RecipesList extends Component
{
    use WithPagination;
    public function render()
    {
        $data = [];
        $data['recipes'] = Recipe::orderBy('title', 'asc')->paginate(12);
        return view('livewire.pages.frontend.recipes.recipes-list', $data);
    }
}
