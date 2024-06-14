<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Users\Address;
use App\Models\Users\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends FrontendBaseController
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('frontend.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->newsletter = $request->newsletter == 'on' ? 1 : 0;
        $request->validate([
            'civility' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'address2' => ['required', 'string', 'max:255'],
            'cities' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'civility' => $request->civility,
            'name' => $request->first_name .' '. $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'newsletter' => $request->newsletter,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        /* Creation de l'adresse */
        $adresse = Address::create([
            'user_id' => $user->id,
            'alias' => $request->first_name .' '. $request->last_name,
            'civility' => $request->civility,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'address2' => $request->address2,
            'cities' => $request->cities,
            'phone' => $request->phone,
        ]);
        $adresse->favorite = $adresse->id;
        $adresse->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
