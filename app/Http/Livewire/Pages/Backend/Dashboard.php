<?php

namespace App\Http\Livewire\Pages\Backend;

use App\Models\Activity;
use App\Models\Evenement;
use App\Models\Label;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $data = [];
        $data['customers'] = User::where('team', 0)->get();
        $data['activities'] = Activity::orderBy('id', 'desc')->get();
        $data['evenements'] = Evenement::orderBy('id', 'desc')->get();
        $data['labels'] = Label::all();
        return view('livewire.pages.backend.dashboard', $data);
    }
}
