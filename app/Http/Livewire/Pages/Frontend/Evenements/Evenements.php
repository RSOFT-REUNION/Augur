<?php

namespace App\Http\Livewire\Pages\Frontend\Evenements;

use App\Models\Evenement;
use App\Models\UserEvenement;
use Carbon\Carbon;
use Livewire\Component;

class Evenements extends Component
{
    protected $listeners = ['refreshLines' => '$refresh'];
    public function updateParticipe($id)
    {
        $evenement = Evenement::where('id', $id)->first();
        $participation = UserEvenement::where('user_id', auth()->user()->id)->where('evenement_id', $evenement->id)->first();
        if($participation) {

        } else {
            $part = new UserEvenement;
            $part->user_id = auth()->user()->id;
            $part->evenement_id = $evenement->id;
            if($part->save()) {
                $this->emit('refreshLines');
            }
        }

    }
    public function render()
    {
        $data = [];
        $data['evenements'] = Evenement::where('state', 0)->where('date', '>=', Carbon::now())->get();
        $data['oldEvenements'] = Evenement::where('state', 0)->where('date', '<', Carbon::now())->get();
        return view('livewire.pages.frontend.evenements.evenements', $data);
    }
}
