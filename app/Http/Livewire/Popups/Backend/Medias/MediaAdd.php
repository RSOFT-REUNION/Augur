<?php

namespace App\Http\Livewire\Popups\Backend\Medias;

use App\Models\Media;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class MediaAdd extends ModalComponent
{
    use WithFileUploads;

    public $picture, $type, $title, $key;

    protected $rules = [
        'title' => 'required|string',
        'key' => 'nullable|unique:media,key',
        'picture' => 'required|image',
        'type' => 'required'
    ];

    protected $messages = [
        'title.required' => "Le titre est obligatoire.",
        'title.string' => "Le titre n'est pas conforme.",
        'picture.required' => "La photo est obligatoire.",
        'picture.image' => "Il ne s'agit pas d'une image.",
        'type.required' => "Le type est obligatoire.",
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function add()
    {
        $this->validate();
        $verifiedTitle = str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->title));
        $verifiedKey = str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->key));

        $media = new Media;
        if($this->key) {
            $media->key = $verifiedKey;
        } else {
            $media->key = $verifiedTitle;
        }
        $media->type = $this->type;
        $media->alt = $verifiedTitle;
        $media->title = $this->title;
        $media->picture = $verifiedTitle.'.'.$this->picture->extension();
        if($this->type == 1) {
            $media->url = 'storage/images/products/'.$verifiedTitle.'.'.$this->picture->extension();
        } elseif ($this->type == 2) {
            $media->url = 'storage/images/labels/'.$verifiedTitle.'.'.$this->picture->extension();
        } elseif ($this->type == 2) {
            $media->url = 'storage/images/shops/'.$verifiedTitle.'.'.$this->picture->extension();
        }

    }
    public function render()
    {
        return view('livewire.popups.backend.medias.media-add');
    }
}
