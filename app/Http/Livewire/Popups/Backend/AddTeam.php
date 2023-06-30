<?php

namespace App\Http\Livewire\Popups\Backend;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class AddTeam extends ModalComponent
{
    public $member;

    public function add()
    {
        $user = User::where('id', $this->member)->first();
        $user->team = 1;
        if($user->update()) {
            return redirect()->route('bo.team');
        }
    }
    public function render()
    {
        $data = [];
        $data['users'] = User::where('team', 0)->get();
        return view('livewire.popups.backend.add-team', $data);
    }
}
