<?php

namespace App\Livewire\Popups\Backend;

use App\Mail\Support\Message;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class SupportMessage extends ModalComponent
{
    public $type, $other, $message;

    public function send()
    {
        $support = new \App\Models\SupportMessage;
        $support->lastname = auth()->user()->lastname;
        $support->firstname = auth()->user()->firstname;
        $support->email = auth()->user()->email;
        $support->type = $this->type;
        $support->other = $this->other;
        $support->message = $this->message;
        if($support->save()) {
            $user = auth()->user();
            Mail::to(Config::get('augur.support.main_mail'))->cc(Config::get('augur.support.second_mail'))->send(new Message($user, $support));
            return redirect()->route('bo.dashboard')->with('success', 'Votre message a été envoyé avec succès');
        }
    }
    public function render()
    {
        return view('livewire.popups.backend.support-message');
    }
}
