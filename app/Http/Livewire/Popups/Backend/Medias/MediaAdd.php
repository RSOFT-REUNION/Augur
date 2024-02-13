<?php

namespace App\Http\Livewire\Popups\Backend\Medias;

use App\Models\Media;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class MediaAdd extends ModalComponent
{
    use WithFileUploads;

    public $picture, $title;

    protected $rules = [
        'title' => 'required|string',
        'picture' => 'required|image',
    ];

    protected $messages = [
        'title.required' => "Le titre est obligatoire.",
        'title.string' => "Le titre n'est pas conforme.",
        'picture.required' => "La photo est obligatoire.",
        'picture.image' => "Il ne s'agit pas d'une image.",
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function add()
    {
        $this->validate();
        $verifiedTitle = str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->title));

        $media = new Media;
        $media->key = Str::random(10);
        $media->alt = $verifiedTitle;
        $media->title = $this->title. '.' . $this->picture->extension();
        if($media->save()) {
            $this->picture->storeAs('public/medias', $verifiedTitle. '.' . $this->picture->extension());
            return redirect()->route('bo.media')->with('success', 'Votre photo a été ajoutée avec succés !');
        }

    }
    public function render()
    {
        return view('livewire.popups.backend.medias.media-add');
    }
}
