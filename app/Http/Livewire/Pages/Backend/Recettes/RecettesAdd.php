<?php

namespace App\Http\Livewire\Pages\Backend\Recettes;

use App\Models\Media;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeSteps;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class RecettesAdd extends Component
{
    use WithFileUploads;
    public $temp;
    public $recipe;
    public $ingredient, $step, $content_step;
    public $title, $image, $number, $description;

    protected $rules = [
        'title' => 'required|min:3|unique:recipes,id',
        'image' => 'required',
        'number' => 'required',
        'description' => 'nullable|min:5'
    ];

    protected $messages = [
        'title.required' => "Le nom de la recette est obligatoire.",
        'title.min' => "Le nom de la recette doit comporter au moins :min caractères.",
        'title.unique' => "Une recette existe déjà avec ce nom.",
        'image.required' => "Une image de couverture est obligatoire.",
        'number.required' => "Vous devez indiquer une quantité.",
        'description.min' => "Votre description doit comporter au moins :min caractères."
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function mount($temp, $recipe_id)
    {
        $this->temp = $temp;
        $this->recipe = Recipe::where('id', $recipe_id)->first();
        if($recipe_id != null) {
            $this->title = $this->recipe->title;
            $this->number = $this->recipe->recipe_for;
            $this->description = $this->recipe->description;
        }
    }

    // Création de la recette complète
    public function publish()
    {
        $this->validate();

        // Ajout de l'image dans la table "media"
        if($this->image) {
            $media = new Media;
            $media->title = str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->title)).'.'.$this->image->extension();
            $media->key = Str::random(10);
            $media->alt = $this->title;
            $media->save();
        }

        // Création de la recette
        $recipe = new Recipe;
        $recipe->title = $this->title;
        if($this->image) {
            $recipe->media_id = $media->id;
        }
        $recipe->recipe_for = $this->number;
        $recipe->description = $this->description;
        if($recipe->save())
        {
            if($this->image) {
                // Optimisation de l'image
                $optimizedImage = Image::make($this->image)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
                Storage::disk('local')->put('public/medias/'. $media->title, $optimizedImage);
            }

            // Lié les ingrédients à la recette
            $ingredients = RecipeIngredient::where('temp_recipe_id', $this->temp)->get();
            foreach ($ingredients as $ingredient)
            {
                $ingredient->recipe_id = $recipe->id;
                $ingredient->temp_recipe_id = '';
                $ingredient->update();
            }

            // Lié les étapes à la recette
            $steps = RecipeSteps::where('temp_recipe_id', $this->temp)->get();
            foreach ($steps as $step)
            {
                $step->recipe_id = $recipe->id;
                $step->temp_recipe_id = '';
                $step->update();
            }

            return redirect()->route('bo.recette')->with('success', "Votre recette a été ajouté avec succèes.");

        } else {
            // Suppresion de la ligne nouvellement créée
            $med = Media::where('id', $media->id)->first()->delete();
        }

    }

    // Mise à jour d'un article
    public function upRecipe()
    {
        if($this->image) {
            $media = new Media;
            $media->title = str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->title)).'.'.$this->image->extension();
            $media->key = Str::random(10);
            $media->alt = $this->title;
            $media->save();
        }

        $old = $this->recipe;
        if($this->title != $old->title) {
            $old->title = $this->title;
        }
        if($this->description != $old->description) {
            $old->description = $this->description;
        }
        if($this->number != $old->recipe_for) {
            $old->recipe_for = $this->number;
        }
        if($this->image) {
            $old->media_id = $media->id;
        }
        if($old->update())
        {
            if($this->image) {
                // Optimisation de l'image
                $optimizedImage = Image::make($this->image)->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
                Storage::disk('local')->put('public/medias/'. $media->title, $optimizedImage);
            }

            return redirect()->route('bo.recette')->with('success', "Votre recette a été mise à jour avec succèes.");
        }
    }

    // Création de la liste des ingredients
    public function createIngredient()
    {
        $ingredient = new RecipeIngredient;
        $ingredient->temp_recipe_id = $this->temp;
        $ingredient->title = $this->ingredient;
        if($ingredient->save()) {
            $this->ingredient = '';
        }
    }

    // Suppression d'un ingrédient
    public function deleteIngredient($id)
    {
        $ingredient = RecipeIngredient::where('id', $id)->first();
        $ingredient->delete();
    }

    // Création des différentes étapes d'une recette
    public function createStep()
    {
        $steps = new RecipeSteps;
        $steps->temp_recipe_id = $this->temp;
        $steps->step = $this->step;
        $steps->content = $this->content_step;
        if($steps->save()) {
            $this->step = '';
            $this->content_step = '';
        }
    }

    // Suppression d'une étape
    public function deleteStep($id)
    {
        $step = RecipeSteps::where('id', $id)->first();
        $step->delete();
    }

    public function render()
    {
        $data = [];
        if($this->recipe != null) {
            $data['ingredients'] = RecipeIngredient::where('recipe_id', $this->recipe->id)->get();
            $data['steps'] = RecipeSteps::where('recipe_id', $this->recipe->id)->get();
        } else {
            $data['ingredients'] = RecipeIngredient::where('temp_recipe_id', $this->temp)->get();
            $data['steps'] = RecipeSteps::where('temp_recipe_id', $this->temp)->get();
        }
        return view('livewire.pages.backend.recettes.recettes-add', $data);
    }
}
