<?php

namespace App\Livewire\Popups\Frontend\Evenements;

use App\Models\Evenement;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class PopupEvenement extends ModalComponent
{
    public $evenement;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }
    public function mount($evenement_id)
    {
        $this->evenement = Evenement::where('id', $evenement_id)->first();
    }
    public function render()
    {
        $data = [];
        $data['evenement'] = $this->evenement;
        return view('livewire.popups.frontend.evenements.popup-evenement', $data);
    }
}
