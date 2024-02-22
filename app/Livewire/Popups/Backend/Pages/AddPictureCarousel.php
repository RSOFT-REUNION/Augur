<?php

namespace App\Livewire\Popups\Backend\Pages;

use App\Models\CarouselMain;
use App\Models\Media;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AddPictureCarousel extends ModalComponent
{
    use WithFileUploads;
    public $key, $cover;

    protected $rules = [
        'key' => 'required|unique:carousel_mains,key',
        'cover' => 'required',
    ];
    protected $messages = [
        'key.required' => "La clé est obligatoire.",
        'key.unique' => "Cette clé est déjà utilisée.",
        'cover.required' => "L'image est obligatoire.",
    ];

    public function updated($key)
    {
        $this->validateOnly($key);
    }

    public function create()
    {
        $this->validate();

        $media = new Media;
        $media->title = 'main-carousel-'.str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->key)).'.'.$this->cover->extension();
        $media->key = 'main-carousel-'.str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->key));
        $media->alt = 'main-carousel-'.$this->key;
        $media->save();

        $carousel = new CarouselMain;
        $carousel->key = strtoupper($this->key);
        $carousel->media_id = $media->id;
        if($carousel->save()) {
            $this->cover->storeAs('public/medias', 'main-carousel-'.str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->key)). '.' . $this->cover->extension());
            return redirect()->route('bo.pages.general');
        }
    }
    public function render()
    {
        return view('livewire.popups.backend.pages.add-picture-carousel');
    }
}
