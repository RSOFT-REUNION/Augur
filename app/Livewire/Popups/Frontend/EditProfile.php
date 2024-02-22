<?php

namespace App\Livewire\Popups\Frontend;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditProfile extends ModalComponent
{
    public $me;
    public $lastname, $firstname, $email, $password, $newsletter;
    public function mount()
    {
        $this->me = auth()->user();
        $this->lastname = $this->me->lastname;
        $this->firstname = $this->me->firstname;
        $this->email = $this->me->email;
    }

    public function edit()
    {
        $user = User::where('id', $this->me->id)->first();
        if(strtoupper($this->lastname) != $user->lastname) {
            $user->lastname = strtoupper($this->lastname);
        }
        if($this->firstname != $user->firstname) {
            $user->firstname = $this->firstname ;
        }
        if($this->email != $user->email) {
            $user->email = $this->email ;
        }
        if($this->password != $user->password && $this->password != null) {
            $user->password = bcrypt($this->password) ;
        }
        if($this->newsletter == 1 &&  $user->newsletter == 0) {
            $user->newsletter = 1;
        } elseif($this->newsletter == 0 &&  $user->newsletter == 1) {
            $user->newsletter = 0;
        }
        $user->update();

        return redirect()->route('fo.profile');
    }
    public function render()
    {
        return view('livewire.popups.frontend.edit-profile');
    }
}
