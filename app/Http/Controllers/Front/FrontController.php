<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Contact;
use App\Models\Label;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    // Maintenance page
    public function showMaintenance()
    {
        $data = [];
        return view('pages.maintenance_page', $data);
    }

    // Show Home page
    public function showHome()
    {
        $data = [];
        $data['labels'] = Label::where('show_home', 1)->get();
        return view('pages.frontend.home', $data);
    }

    /*
     * Show Login/Register page
     */
    public function showSign()
    {
        return view('pages.frontend.sign');
    }

    /*
     * Login / register function
     * Define the good form with a hidden input named "action"
     */
    public function handleSignAction(Request $request)
    {
        $action = $request->input('action');
        if ($action === 'register') {
            // Action d'inscription
            $request->validate([
                'lastname' => 'required',
                'firstname' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:6',
                'consent' => 'accepted'
            ], [
                'lastname.required' => 'Le nom de famille est obligatoire.',
                'firstname.required' => 'Le prénom est obligatoire.',
                'email.required' => "L'adresse e-mail est obligatoire.",
                'email.email' => "L'adresse e-mail n'est pas conforme.",
                'email.unique' => "L'adresse e-mail existe déjà.",
                'password.required' => "Le mot de passe est obligatoire.",
                'password.confirmed' => "Les mots de passes ne correspondent pas.",
                'password.min' => "Le mot de passe doit comporter au moin :min caractères.",
                'consent.accepted' => "Les mentions légales et Mentions légales doivent être accepté."
            ]);

            $user = new User;
            $user->customer_code = strtoupper('C'. $request->lastname .'-'. Str::random(5));
            $user->lastname = strtoupper($request->lastname);
            $user->firstname = $request->firstname;
            $user->email = strtolower($request->email);
            $user->password = bcrypt($request->password);
            if($request->newsletter == 1) {
                $user->newsletter = 1;
            }
            if($user->save()) {
                $activity = new Activity;
                $activity->message = $user->lastname.' '.$user->firstname.' viens de s\'inscrire !';
                $activity->save();

                return redirect()->route('fo.home')->with('success', 'Votre compte à été correctement créé. Je vous invite à vous connecter !');
            }
        } elseif ($action === 'login') {
            // Action de connexion
            $result = auth()->attempt([
                'email' => strtolower($request->log_email),
                'password' => $request->log_password
            ]);
            if($result) {
                return redirect()->route('fo.home');
            } else {
                return back()->with('error', 'Votre adresse e-mail ou votre mot de passe est incorrect.');
            }
        }
    }

    /*
     * Logout users and redirect to Home page
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->route('fo.home');
    }

    // ------------------------ Profile

    /*
     * Show Profile page
     */
    public function showProfile()
    {
        $data = [];
        $data['me'] = auth()->user();
        return view('pages.frontend.profile.profile', $data);
    }

    // ------------------------- Contact

    /*
     * Show Contact Page
     */
    public function showContact()
    {
        $data = [];
        $data['shops'] = Shop::orderBy('title', 'asc')->get();
        return view('pages.frontend.contact', $data);
    }

    /*
     * Post Contact
     */
    public function postContact(Request $request)
    {
        if(auth()->guest()) {
            $request->validate([
                'lastname' => 'required|string',
                'firstname' => 'required|string',
                'email' => 'required|email',
                'subject' => 'required|string',
                'message' => 'required|string',
            ], [
                'lastname.required' => "Le nom de famille est obligatoire.",
                'lastname.string' => "Le nom de famille n'est pas conforme.",
                'firstname.required' => "Le prénom est obligatoire.",
                'firstname.string' => "Le nom de famille n'est pas conforme.",
                'email.required' => "L'adresse e-mail est obligatoire.",
                'email.email' => "L'adresse e-mail n'est pas conforme.",
                'subject.required' => "Le sujet est obligatoire.",
                'subject.string' => "Le sujet n'est pas conforme.",
                'message.required' => "Le message est obligatoire.",
                'message.string' => "Le message n'est pas conforme.",
            ]);
        } else {
            $request->validate([
                'subject' => 'required|string',
                'message' => 'required|string',
            ], [
                'subject.required' => "Le sujet est obligatoire.",
                'subject.string' => "Le sujet n'est pas conforme.",
                'message.required' => "Le message est obligatoire.",
                'message.string' => "Le message n'est pas conforme.",
            ]);
        }

        $contact = new Contact;
        if(!auth()->guest()) {
            $contact->user_id = auth()->user()->id;
            $contact->lastname = auth()->user()->lastname;
            $contact->firstname = auth()->user()->firstname;
            $contact->email = auth()->user()->email;
        } else {
            $contact->lastname = strtoupper($request->lastname);
            $contact->firstname = $request->firstname;
            $contact->email = $request->email;
        }
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        if($contact->save()){
            $activity = new Activity;
            $activity->message = $contact->lastname.' '.$contact->firstname.' vous a envoyé un message !';
            $activity->save();

            return redirect()->route('fo.contact')->with('success', 'Votre message à été envoyé avec succés, nous reprendrons contact avec vous rapidement !');
        }
    }
}
