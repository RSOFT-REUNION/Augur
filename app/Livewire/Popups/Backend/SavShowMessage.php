<?php

namespace App\Livewire\Popups\Backend;

use App\Models\Contact;
use LivewireUI\Modal\ModalComponent;

class SavShowMessage extends ModalComponent
{
    public $message;

    public function mount($message_id)
    {
        $this->message = Contact::where('id', $message_id)->first();
        if($this->message->read == 0){
            $this->message->read = 1;
            $this->message->update();
        }
    }
    public function render()
    {
        return view('livewire.popups.backend.sav-show-message');
    }
}
