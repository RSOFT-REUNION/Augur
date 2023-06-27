<?php

namespace App\Http\Livewire\Pages\Backend\Customers;

use App\Models\User;
use Livewire\Component;

class CustomerSingle extends Component
{
    public $customer;

    public function mount($customer_id)
    {
        $this->customer = User::where('id', $customer_id)->first();
    }

    public function render()
    {
        $data = [];
        $data['customer'] = $this->customer;
        return view('livewire.pages.backend.customers.customer-single', $data);
    }
}
