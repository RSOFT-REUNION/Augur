<?php

namespace App\Http\Livewire\Pages\Backend;

use App\Models\User;
use Livewire\Component;

class TeamList extends Component
{
    protected $listeners = ['refreshLines' => '$refresh'];
    public function deletedRole($id)
    {
        $user = User::where('id', $id)->first();
        $user->team = 0;
        $user->update();

        $this->emit('refreshLines');
    }
    public function render()
    {
        $data = [];
        $data['teams'] = User::where('team', 1)->get();
        return view('livewire.pages.backend.team-list', $data);
    }
}
