<?php

namespace App\Http\Livewire\Popups\Backend\Pages;

use App\Models\CarouselMain;
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
        'key.unique' => "Cette clé est déjà utilisé.",
        'cover.required' => "L'image est obligatoire.",
    ];

    public function updated($key)
    {
        $this->validateOnly($key);
    }

    public function create()
    {
        $this->validate();

        $carousel = new CarouselMain;
        $carousel->key = strtoupper($this->key);
        $carousel->cover = 'main-carousel-'.str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->key)).'.'.$this->cover->extension();
        if($carousel->save()) {
            $this->cover->storeAs('public/images/medias', 'main-carousel-'.str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->key)). '.' . $this->cover->extension());
            return redirect()->route('bo.pages.general');
        }
    }
    public function render()
    {
        return view('livewire.popups.backend.pages.add-picture-carousel');
    }
}
