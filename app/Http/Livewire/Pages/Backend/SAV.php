<?php

namespace App\Http\Livewire\Pages\Backend;

use App\Models\Activity;
use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class SAV extends Component
{
    use WithPagination;

    public function deleteMessage($id)
    {
        $message = Contact::where('id', $id)->first();

        /*$activity = new Activity;
        $activity->type = 1;
        $activity->message = Auth()->user()->lastname .' '. Auth()->user()->firstname . ' a supprimé un message de '. $message->lastname .' '. $message->firstname .' sur le sujet suivant : '. $message->suject;*/

        $message->delete();

        return redirect()->route('bo.sav')->with('success', "Le message a été supprimé avec succèes");
    }

    public function render()
    {
        $data = [];
        $data['messages'] = Contact::orderBy('id', 'desc')->paginate(30);
        return view('livewire.pages.backend.s-a-v', $data);
    }
}
