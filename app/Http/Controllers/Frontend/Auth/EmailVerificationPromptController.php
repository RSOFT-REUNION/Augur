<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Backend\Settings\Informations;
use app\Models\Content\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class EmailVerificationPromptController extends Controller
{
    public function __construct()
    {
        $infos = Informations::select('address','email','phone','fax')->where('id', 1)->first();
        $sliders = Carousel::inRandomOrder()->get();
        View::share(['infos' => $infos, 'sliders' => $sliders]);
    }

    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard', absolute: false))
                    : view('frontend.auth.verify-email');
    }
}
