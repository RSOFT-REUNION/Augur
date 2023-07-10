<?php

namespace App\Http\Livewire\Popups\Backend\Settings;

use App\Models\Media;
use App\Models\Shop;
use Illuminate\Support\Facades\View;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AddShop extends ModalComponent
{
    use WithFileUploads;
    public $title, $cover, $address, $postal, $city, $description;

    protected $rules = [
        'title' => 'required|unique:shops,title|string',
        'cover' => 'nullable|image',
        'address' => 'required|string',
        'postal' => 'required|digits:5',
        'city' => 'required|string',
        'description' => 'nullable|string',
    ];

    protected $messages = [
        'title.required' => "Le nom est obligatoire.",
        'title.unique' => "Un magasin existe déjà avec ce nom.",
        'title.string' => "Le nom n'est pas conforme.",
        'cover.image' => "Il ne s'agit pas d'une image.",
        'address.required' => "L'adresse est obligatoire.",
        'address.string' => "L'adresse n'est pas conforme.",
        'city.required' => "La ville est obligatoire.",
        'city.string' => "La ville n'est pas conforme.",
        'description.string' => "La description n'est pas conforme.",
        'postal.required' => "Le code postal est obligatoire.",
        'postal.digits' => "Le code postal n'est pas conforme."
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
            $media->key = str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->title));
            $media->alt = $this->title;
            $media->save();
        }

        $shop = new Shop;
        $shop->title = $this->title;
        if($this->cover) {
            $shop->media_id = $media->id;
        }
        $shop->description = $this->description;
        $shop->address = $this->address;
        $shop->postal_code = $this->postal;
        $shop->city = strtoupper($this->city);
        if($shop->save())
        {
            if($this->cover)
            {
                $this->cover->storeAs('public/medias', str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($this->title)). '.' . $this->cover->extension());
            }
            return redirect()->route('bo.setting.shop.create', ['id' => $shop->id]);
        } else {
            $med = Media::where('id', $media->id)->first();
            $med->delete();
            return redirect()->route('bo.setting.shop.create', ['id' => $shop->id]);
        }

    }
    public function render()
    {
        return view('livewire.popups.backend.settings.add-shop');
    }
}
