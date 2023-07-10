<?php

namespace App\Http\Livewire\Popups\Backend\Evenements;

use App\Models\Evenement;
use App\Models\Media;
use App\Models\Shop;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AddEvenement extends ModalComponent
{
    use WithFileUploads;

    public $title, $cover, $description_small, $more_day, $start_date, $end_date, $start_time, $end_time, $date, $shop;

    protected $characters = ["é", "è", "ê", "ë", "à", "'", "\"", "«", "»", "<", ">", " ", "_", "&", "ç", "î", "ï", "ô", "ö", "/", "[", "(", ")", "]", "{", "}"];
    protected $correct_characters = ["e", "e", "e", "e", "a", "-", "-", "-", "-", "-", "-", "-", "-", "and", "c", "i", "i", "o", "o", "-", "-", "-", "-", "-", "-", "-"];

    protected $rules = [
        'title' => 'required',
        'cover' => 'image',
        'description_small' => 'required|min:5',
        'date' => 'nullable|date',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'start_time' => 'required',
        'end_time' => 'required',
    ];

    protected $messages = [
        'title.required' => "Le titre de l'événement est obligatoire.",
        'cover.image' => "Il ne s'agit pas d'une image.",
        'description_small.required' => "Le résumé est obligatoire.",
        'description_small.min' => "Le résumé doit comporter au moins :min caractères.",
        'date.date' => "Il ne s'agit pas d'une date.",
        'start_date.date' => "Il ne s'agit pas d'une date.",
        'end_date.date' => "Il ne s'agit pas d'une date.",
        'start_time.required' => "L'heure de début est obligatoire.",
        'end_time.required' => "L'heure de fin est obligatoire.",
    ];

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function create()
    {
        $this->validate();

        if($this->cover) {
            $media = new Media;
            $media->title = str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->title)).'.'.$this->cover->extension();
            $media->key = Str::random(10);
            $media->alt = $this->title;
            $media->save();
        }

        $anim = new Evenement;
        $anim->title = $this->title;
        if($this->cover) {
            $anim->media_id = $media->id;
        }
        $anim->description_short = $this->description_small;
        if($this->more_day) {
            $anim->date = $this->start_date;
            $anim->start_date = $this->start_date;
            $anim->end_date = $this->end_date;
            $anim->one_day = 0;
        } else {
            $anim->date = $this->date;
        }
        if($this->shop == 'ALL') {
            $anim->all_shops = 1;
        } else {
            $anim->shop_id = $this->shop;
        }
        $anim->start_time = $this->start_time;
        $anim->end_time = $this->end_time;
        if($anim->save())
        {
            if($this->cover) {
                $this->cover->storeAs('public/medias', str_replace($this->characters, $this->correct_characters, strtolower($this->title)). '.' . $this->cover->extension());
            }
            return redirect()->route('bo.evenements')->with('success', 'Votre évenement '. $anim->title .' a bien été créé !');
        }
    }

    public function render()
    {
        $data = [];
        $data['shops'] = Shop::all();
        return view('livewire.popups.backend.evenements.add-evenement', $data);
    }
}
