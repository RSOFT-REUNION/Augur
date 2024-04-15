<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Backend\Settings\Informations;
use app\Models\Content\Carousel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\View;

class PasswordResetLinkController extends Controller
{
    public function __construct()
    {
        $infos = Informations::select('address','email','phone','fax')->where('id', 1)->first();
        $sliders = Carousel::inRandomOrder()->get();
        View::share(['infos' => $infos, 'sliders' => $sliders]);
    }
    /**
     * Display the password reset link request view.
     */
    public function create()
    {
        return view('frontend.auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->withSuccess('Lien de réinitialisation du mot de passe envoyée avec success')
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
