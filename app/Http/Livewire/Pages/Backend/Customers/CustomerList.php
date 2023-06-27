<?php

namespace App\Http\Livewire\Pages\Backend\Customers;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerList extends Component
{
    use WithPagination;

    public $search = '';
    protected $jobs = [];


    public function updatedSearch()
    {
        $query = '%'.$this->search.'%';
        if(strlen($this->search) > 2) {
            $this->jobs = User::where('lastname', 'like', $query)
                ->orWhere('firstname', 'like', $query)
                ->orWhere('customer_code', 'like', $query)
                ->orWhere('email', 'like', $query)
                ->paginate(25);
        }
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = [];
        if($this->jobs) {
            $data['customers'] = $this->jobs;
        } else {
            $data['customers'] = User::where('team', 0)->orderBy('created_at', 'desc')->paginate(25);
        }
        return view('livewire.pages.backend.customers.customer-list', $data);
    }
}
