<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\User\CreateAccount;
use App\Mail\User\DeleteAccount;
use App\Mail\User\DemandAccount;
use App\Models\Activity;
use App\Models\CarouselMain;
use App\Models\Consent;
use App\Models\Contact;
use App\Models\EvenementUser;
use App\Models\GeneralSetting;
use App\Models\Label;
use App\Models\Pages;
use App\Models\Product;
use App\Models\productUnivers;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeSteps;
use App\Models\Shop;
use App\Models\User;
use App\Models\UserTemp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    // Maintenance page
    public function showMaintenance()
    {
        if(view()->shared('settingGlobal')->site_active == 1) {
            return redirect()->route('fo.home');
        } else {
            if(!auth()->guest() && auth()->user()->team == 1) {
                return redirect()->route('fo.home');
            } else {
                return view('pages.maintenance_page');
            }
        }

    }

    public function connectMaintenance(Request $request)
    {
        $result = auth()->attempt([
            'email' => strtolower($request->email),
            'password' => $request->password
        ]);
        if($result) {
            return redirect()->route('fo.home');
        } else {
            return back()->with('error', 'Votre adresse e-mail ou votre mot de passe est incorrect.');
        }
    }

    // Show Home page
    public function showHome()
    {
        $data = [];
        $data['active'] = 'home';
        $data['labels'] = Label::where('show_home', 1)->get();
        $data['mainCarousel'] = CarouselMain::orderBy('id', 'asc')->get();
        $data['page'] = Pages::where('key', 'home')->first();
        return view('pages.frontend.home', $data);
    }

    /*
     * Show Login/Register page
     */
    public function showSign()
    {
        $data = [];
        $data['active'] = 'profile';
        return view('pages.frontend.sign', $data);
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
                'phone' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:6',
                'consent' => 'accepted'
            ], [
                'lastname.required' => 'Le nom de famille est obligatoire.',
                'firstname.required' => 'Le prénom est obligatoire.',
                'phone.required' => 'Le numéro de téléphone est obligatoire.',
                'phone.string' => 'Le numéro de téléphone n\'est pas correct.',
                'email.required' => "L'adresse e-mail est obligatoire.",
                'email.email' => "L'adresse e-mail n'est pas conforme.",
                'email.unique' => "L'adresse e-mail existe déjà.",
                'password.required' => "Le mot de passe est obligatoire.",
                'password.confirmed' => "Les mots de passes ne correspondent pas.",
                'password.min' => "Le mot de passe doit comporter au moin :min caractères.",
                'consent.accepted' => "Les mentions légales et les CGU doivent être acceptées."
            ]);

            $user = new UserTemp;
            $user->customer_code = strtoupper('C'. $request->lastname .'-'. Str::random(5));
            $user->lastname = strtoupper($request->lastname);
            $user->firstname = $request->firstname;
            $user->phone = $request->phone;
            $user->email = strtolower($request->email);
            $user->password = bcrypt($request->password);
            if($request->newsletter) {
                $user->newsletter = 1;
            }
            if($user->save()) {
                $activity = new Activity;
                $activity->message = $user->lastname.' '.$user->firstname.' a envoyé une demande d\'inscription !';
                $activity->item = $user->id;
                $activity->save();

                $main_user = GeneralSetting::where('id', 1)->first()->main_email;
                Mail::to($user->email)->bcc($main_user)->send(new DemandAccount($user));

                return redirect()->route('fo.home')->with('success', 'Votre demande de compte a bien été envoyée. Un mail vous sera envoyé pour vous informer que votre compte est accessible !');
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

    public function deletedAccount()
    {
        $random = Str::random(5);
        $user = User::where('id', auth()->user()->id)->first();

        $activity = new Activity;
        $activity->message = $user->lastname.' '.$user->firstname.' a supprimé complètement son compte !';
        $activity->save();

        if(Mail::to($user->email)->send(new DeleteAccount($user))) {
            $user->team = 0;
            $user->lastname = 'DELETED';
            $user->firstname = 'deleted';
            $user->email = $random.'@deleted.fr';
            $user->password = bcrypt($random);
            $user->newsletter = 0;
            $user->deleted = 1;
            $user->deleted_at = Carbon::now();
            if($user->update()) {
                auth()->logout();
                return redirect()->route('fo.home')->with('success', 'Votre compte ainsi que vos données ont bien été supprimés !');
            }
        }
    }

    // ------------------------ Profile

    /*
     * Show Profile page
     */
    public function showProfile()
    {
        $data = [];
        $data['active'] = 'profile';
        $data['me'] = auth()->user();
        $data['participations'] = EvenementUser::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return view('pages.frontend.profile.profile', $data);
    }

    // ------------------------- Contact

    /*
     * Show Contact Page
     */
    public function showContact()
    {
        $data = [];
        $data['active'] = 'contact';
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

            return redirect()->route('fo.contact')->with('success', 'Votre message a été envoyé avec succés, nous reprendrons contact avec vous rapidement !');
        }
    }

    public function showEvenementPage()
    {
        $data = [];
        $data['active'] = 'evenement';
        return view('pages.frontend.evenements', $data);
    }

    public function showLegalMentions()
    {
        $data = [];
        $data['active'] = 'mentions';
        return view('pages.frontend.legal-mentions', $data);
    }

    public function showConditions()
    {
        $data = [];
        $data['active'] = 'mentions';
        return view('pages.frontend.conditions', $data);
    }

    public function showLabelList()
    {
        $data = [];
        $data['active'] = 'label';
        return view('pages.frontend.labels.label-list', $data);
    }

    public function showLabelSingle($slug)
    {
        $data = [];
        $data['active'] = 'label';
        $data['label'] = Label::where('slug', $slug)->first();
        return view('pages.frontend.labels.label', $data);
    }

    public function showShopList()
    {
        $data = [];
        $data['active'] = 'shop';
        $data['shops'] = Shop::orderBy('title', 'asc')->get();
        return view('pages.frontend.shops.shops-list', $data);
    }

    public function showAbout()
    {
        $data = [];
        $data['active'] = 'about';
        $data['page'] = Pages::where('key', 'about')->first();
        return view('pages.frontend.about', $data);
    }

    public function showProductList()
    {
        $data = [];
        $data['active'] = 'products';
        return view('pages.frontend.products.products', $data);
    }

    public function showListProduct($id)
    {
        $data = [];
        $data['active'] = 'products';
        $data['univers'] = productUnivers::where('id', $id)->first();
        return view('pages.frontend.products.products-list', $data);
    }

    public function showProductSingle($id)
    {
        $data = [];
        $data['active'] = 'products';
        $data['product'] = Product::where('id', $id)->first();
        $data['labels'] = Label::all();
        return view('pages.frontend.products.product-single', $data);
    }

    // Affichage de la page des recettes
    public function showRecipes()
    {
        $data = [];
        $data['active'] = 'recipes';
        return view('pages.frontend.recipes.recipes', $data);
    }

    // Affichage d'une recette seule
    public function showRecipeSingle($id)
    {
        $data = [];
        $data['active'] ='recipes';
        $data['recipe'] = Recipe::where('id', $id)->first();
        $data['ingredients'] = RecipeIngredient::where('recipe_id', $id)->get();
        $data['steps'] = RecipeSteps::where('recipe_id', $id)->get();
        return view('pages.frontend.recipes.recipes-single', $data);
    }
}
