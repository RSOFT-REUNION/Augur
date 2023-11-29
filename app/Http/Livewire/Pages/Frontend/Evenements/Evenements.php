<?php

namespace App\Http\Livewire\Pages\Frontend\Evenements;

use App\Models\Evenement;
use App\Models\EvenementUser;
use App\Models\UserEvenement;
use Carbon\Carbon;
use Livewire\Component;

class Evenements extends Component
{
    public function updateParticipe($id)
    {
        $evenement = Evenement::where('id', $id)->first();
        $participation = EvenementUser::where('user_id', auth()->user()->id)->where('evenement_id', $evenement->id)->first();
        if($participation) {
            $participation->delete();
            return redirect()->route('fo.evenements');
        } else {
            $part = new EvenementUser;
            $part->user_id = auth()->user()->id;
            $part->evenement_id = $evenement->id;
            if($part->save()) {
                return redirect()->route('fo.evenements');
            }
        }

    }
    public function render()
    {
        $data = [];
        $data['evenements'] = Evenement::where('state', 0)->where('date', '>=', Carbon::now())->get();
        if(!auth()->guest()) {
        	$data['participations'] = EvenementUser::where('user_id', auth()->user()->id)->get();
        } else {
        	$data['participations'] = '';
        }
        $data['oldEvenements'] = Evenement::where('state', 0)->where('date', '<', Carbon::now())->get();
        return view('livewire.pages.frontend.evenements.evenements', $data);
    }
}
