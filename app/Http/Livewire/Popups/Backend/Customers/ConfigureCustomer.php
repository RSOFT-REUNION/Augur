<?php

namespace App\Http\Livewire\Popups\Backend\Customers;

use App\Models\User;
use App\Models\UserTemp;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ConfigureCustomer extends ModalComponent
{
    public $user_temp;
    public $EBP_customer;

    public function mount($user)
    {
        $this->user_temp = UserTemp::where('user_id', $user)->first();
    }

    public function createUser()
    {
        $user = new User;
        $user->customer_code = $this->user_temp->customer_code;
        $user->lastname = $this->user_temp->lastname;
        $user->firstname = $this->user_temp->firstname;
        $user->phone = $this->user_temp->phone;
        $user->email = $this->user_temp->email;
        $user->password = $this->user_temp->password;
        $user->newsletter = $this->user_temp->newsletter;
        if($this->EBP_customer != null) {
            $user->EBP_customer_code = $this->EBP_customer;
            $user->EBP_linked = 1;
        }
        $user->active = 1;
        if($user->save())
        {
            return redirect()->route('bo.customers');
        }
    }

    public function render()
    {
        return view('livewire.popups.backend.customers.configure-customer');
    }
}
