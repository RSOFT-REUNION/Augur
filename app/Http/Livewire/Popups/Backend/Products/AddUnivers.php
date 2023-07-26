<?php

namespace App\Http\Livewire\Popups\Backend\Products;

use App\Models\Media;
use App\Models\productUnivers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AddUnivers extends ModalComponent
{
    use WithFileUploads;

    public $image, $key, $title, $description;

    protected $rules = [
        'title' => 'nullable|unique:product_univers,title',
    ];
    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function create()
    {
        if($this->image) {
            $media = new Media;
            $media->title = str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->title)).'.'.$this->image->extension();
            $media->key = Str::random(10);
            $media->alt = $this->title;
            $media->save();
        }

        $univers = productUnivers::where('key', $this->key)->first();
        if($univers) {
            $univers->title = $this->title;
            $univers->media_id = $media->id;
            $univers->description = $this->description;
            $univers->active = 1;
            if($univers->update()){
                if($this->image) {
                    // Optimisation de l'image
                    $optimizedImage = Image::make($this->image)->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->encode();
                    Storage::disk('local')->put('public/medias/'.str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->title)).'.'.$this->image->extension(), $optimizedImage);
                }
                return redirect()->route('bo.products.list');
            }
        } else {
            $univers = new productUnivers;
            $univers->key = $this->key;
            $univers->title = $this->title;
            $univers->media_id = $media->id;
            $univers->description = $this->description;
            $univers->active = 1;
            if($univers->save()){
                if($this->image) {
                    $this->image->storeAs('public/medias', str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->title)).'.'.$this->image->extension());
                }
                return redirect()->route('bo.products.list');
            }
        }
    }

    public function render()
    {
        return view('livewire.popups.backend.products.add-univers');
    }
}
