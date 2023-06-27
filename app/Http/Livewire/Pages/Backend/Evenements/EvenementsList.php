<?php

namespace App\Http\Livewire\Pages\Backend\Evenements;

use App\Models\Evenement;
use Livewire\Component;

class EvenementsList extends Component
{
    public function render()
    {
        $data = [];
        $data['evenements'] = Evenement::orderBy('created_at', 'desc')->get();
        return view('livewire.pages.backend.evenements.evenements-list', $data);
    }
}
