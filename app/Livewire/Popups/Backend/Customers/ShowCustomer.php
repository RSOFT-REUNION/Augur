<?php

namespace App\Livewire\Popups\Backend\Customers;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ShowCustomer extends ModalComponent
{
    public $user;

    public function mount($user)
    {
        $this->user = User::where('id', $user)->first();
    }
    public function render()
    {
        return view('livewire.popups.backend.customers.show-customer');
    }
}
