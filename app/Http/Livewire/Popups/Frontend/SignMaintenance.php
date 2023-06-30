<?php

namespace App\Http\Livewire\Popups\Frontend;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class SignMaintenance extends ModalComponent
{
    public $email, $password;

    public function connect()
    {
        $result = auth()->attempt([
            'email' => strtolower($this->email),
            'password' => $this->password
        ]);
        if($result) {
            return redirect()->route('fo.home');
        } else {
            return back()->with('error', 'Votre adresse e-mail ou votre mot de passe est incorrect.');
        }
    }
    public function render()
    {
        return view('livewire.popups.frontend.sign-maintenance');
    }
}
