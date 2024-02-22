<?php

namespace App\Livewire\Popups\Backend\Recipes;

use App\Models\RecipeIngredient;
use App\Models\RecipeSteps;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Recipe extends ModalComponent
{
    public $recipe;

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }

    public function mount($recipe_id)
    {
        $this->recipe = \App\Models\Recipe::where('id', $recipe_id)->first();
    }

    // Suppression de la recette
    public function delete()
    {
        $this->recipe->delete();
        return redirect()->route('bo.recette');
    }

    public function render()
    {
        $data = [];
        $data['ingredients'] = RecipeIngredient::where('recipe_id', $this->recipe->id)->get();
        $data['steps'] = RecipeSteps::where('recipe_id', $this->recipe->id)->get();
        return view('livewire.popups.backend.recipes.recipe', $data);
    }
}
