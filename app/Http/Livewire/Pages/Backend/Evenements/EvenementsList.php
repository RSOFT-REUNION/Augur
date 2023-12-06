<?php

namespace App\Http\Livewire\Pages\Backend\Evenements;

use App\Mail\Evenement\DeleteEvenement;
use App\Models\Evenement;
use App\Models\User;
use App\Models\EvenementUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class EvenementsList extends Component
{
    public function editEvenement($id)
    {
        return redirect()->route('bo.evenements.edit', ['id' => $id]);
    }

    public function participantEvenement($id)
    {
        return redirect()->route('bo.evenements.participant', ['id' => $id]);
    }

    public function deleteEvenement($id)
    {
        $evenement = Evenement::where('id', $id)->first();
        $usersEvenement = EvenementUser::where('evenement_id', $id)->get();
        if($usersEvenement) {
            foreach ($usersEvenement as $userEv) {
                $user = User::where('id', $userEv->user_id)->first();
                Mail::to($user->email)->send(new DeleteEvenement($user, $evenement));
                $userEv->delete();
            }
        }
        $evenement->delete();
        return redirect()->route('bo.evenements');
    }

    public function render()
    {
        $data = [];
        $data['evenements'] = Evenement::orderBy('created_at', 'desc')->get();
        $data['old_evenements'] = Evenement::where('date', '<', Carbon::now())->orderBy('created_at', 'desc')->get();
        return view('livewire.pages.backend.evenements.evenements-list', $data);
    }
}
