<?php

namespace App\Http\Livewire\Popups\Backend\Customers;

use App\Mail\User\CreateAccount;
use App\Models\User;
use App\Models\UserTemp;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ConfigureCustomer extends ModalComponent
{
    public $user_temp;
    public $EBP_customer;

    public function mount($user)
    {
        $this->user_temp = UserTemp::where('id', $user)->first();
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
            $user->EBP_customer = $this->EBP_customer;
            $user->EBP_linked = 1;
        }
        $user->active = 1;
        if($user->save())
        {
            // ** Envoi d'un email d'information
            Mail::to($user->email)->send(new CreateAccount($user));

            // ** Suppression de l'utilisateur dans la table temporaire
            try {
                $this->user_temp->delete();
            } catch (\Exception $e) {
                // ** Ajoute l'erreur dans une table de logs
            }

            return redirect()->route('bo.customers');
        }
    }

    public function render()
    {
        return view('livewire.popups.backend.customers.configure-customer');
    }
}
