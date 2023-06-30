<?php

namespace App\Http\Livewire\Pages\Backend;

use App\Models\Activity;
use App\Models\Contact;
use App\Models\Evenement;
use App\Models\Label;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $data = [];
        $data['customers'] = User::where('team', 0)->get();
        $data['activities'] = Activity::orderBy('id', 'desc')->get();
        $data['evenements'] = Evenement::orderBy('id', 'desc')->get();
        $data['evenementsNow'] = Evenement::where('date', '>=', Carbon::now())->where('state', 0)->orderBy('created_at', 'asc')->get()->take(1);
        $data['labels'] = Label::all();
        $data['allContacts'] = Contact::all();
        $data['contacts'] = Contact::orderBy('id', 'desc')->get()->take(5);
        return view('livewire.pages.backend.dashboard', $data);
    }
}
