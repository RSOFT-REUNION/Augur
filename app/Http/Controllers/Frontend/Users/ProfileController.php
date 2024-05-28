<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Http\Requests\Frontend\Auth\ProfileUpdateRequest;
use App\Models\Users\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends FrontendBaseController
{
    public function index()
    {
        return view('frontend.profile.dashboard');
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        return view('frontend.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function newsletter(Request $request)
    {
        $validated = $request->validate([
            'newsletter' => '',
        ]);
        $validated['newsletter'] = $validated['newsletter']=='on' ? 1:0;
        User::where('id', Auth::user()->id)->update($validated);
        return view('frontend.profile.partials.newsletter');
    }
}
