<?php

namespace App\Http\Livewire\Popups\Frontend\Evenements;

use App\Models\evenement_guests;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class PopupEventGuest extends ModalComponent
{

    public $mail, $lastname, $firstname, $phone, $evenement_id;


    protected function rules()
    {
        return [
            'lastname' => 'required|min:3',
            'firstname' => 'required|min:3',
            'mail' => 'required|email',
            'phone' => 'required|digits:10'
        ];
    }

    protected function messages()
{
    return [
        'lastname.required' => 'Le nom est obligatoire.',
        'lastname.min' => 'Le nom doit contenir au moins 3 caractères.',
        'firstname.required' => 'Le prénom est obligatoire.',
        'firstname.min' => 'Le prénom doit contenir au moins 3 caractères.',
        'mail.required' => 'L\'adresse e-mail est obligatoire.',
        'mail.email' => 'L\'adresse e-mail doit être une adresse e-mail valide.',
        // 'mail.unique' => 'L\'adresse e-mail participe déjà',
        'phone.required' => 'Le numéro de téléphone est obligatoire.',
        'phone.digits' => 'Le numéro de téléphone doit contenir exactement 10 chiffres.'
    ];
}

    public function create()
    {

        $evenement_email = evenement_guests::where('email', $this->mail)->where('evenement_id', $this->evenement_id)->first();

        if(!$evenement_email) {
            if($this->validate()) {
                $evenement_guest = new evenement_guests;
                $evenement_guest->firstname = $this->firstname;
                $evenement_guest->evenement_id = $this->evenement_id;
                $evenement_guest->lastname = $this->lastname;
                $evenement_guest->email = $this->mail;
                $evenement_guest->phone = $this->phone;
                if($evenement_guest->save()) {
                    $this->closeModal();
                }    
            }
        } else {
            Session::flash('error', 'L\'invité participe déjà pour cet événement.');
        }


    }

    public function render()
    {
        return view('livewire.popups.frontend.evenements.popup-event-guest');
    }
}
