<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Controller;
use App\Models\Backend\Content\Carousel;
use App\Models\Backend\Settings\Informations;
use App\Models\Users\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AddressesController extends Controller
{
    public function __construct()
    {
        $infos = Informations::select('address','email','phone','fax')->where('id', 1)->first();
        $sliders = Carousel::inRandomOrder()->get();
        View::share(['infos' => $infos, 'sliders' => $sliders]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.profile.adresse.index', [
            'address' => Address::where('user_id', '=', Auth::user()->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $adresse = new Address();
        return view('frontend.profile.adresse.form', [
            'adresse' => $adresse,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'alias' => 'required|string|min:3|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address2' => 'max:255',
            'other' => 'max:255',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'other_phone' => 'max:20',
        ]);
        $validated['user_id'] = Auth::user()->id;
        Address::create($validated);
        return redirect()->route('adresse.index')->withSuccess('Adresse ajouter avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $adresse)
    {
        return view('frontend.profile.adresse.form', [
            'adresse' => $adresse,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $adresse)
    {
        $validated = $request->validate([
            'alias' => 'required|string|min:3|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address2' => 'max:255',
            'other' => 'max:255',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'other_phone' => 'max:20',
        ]);
        $validated['user_id'] = Auth::user()->id;
        Address::where('id', $adresse->id)->update($validated);
        return back()->withSuccess('Adresse modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $adresse)
    {
        $adresse->delete();
        return back()->withSuccess('Adresse supprimée avec succès');
    }
}
