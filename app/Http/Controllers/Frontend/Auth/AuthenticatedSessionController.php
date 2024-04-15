<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Auth\LoginRequest;
use App\Models\Backend\Settings\Informations;
use app\Models\Content\Carousel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AuthenticatedSessionController extends Controller
{
    public function __construct()
    {
        $infos = Informations::select('address','email','phone','fax')->where('id', 1)->first();
        $sliders = Carousel::inRandomOrder()->get();
        View::share(['infos' => $infos, 'sliders' => $sliders]);
    }
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('frontend.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
