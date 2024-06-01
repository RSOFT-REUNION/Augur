<?php

namespace App\Http\Controllers\Frontend\Users;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Users\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressesController extends FrontendBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.profile.partials.address', [
            'address' => Address::where('user_id', '=', Auth::user()->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $adresse = new Address();
        return view('frontend.profile.partials.address_form', [
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
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address2' => 'max:255',
            'other' => 'max:255',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'other_phone' => 'max:20',
            'favorite' => '',
        ]);
        $validated['user_id'] = Auth::user()->id;
        Address::create($validated);
        return redirect()->route('address.index')->withSuccess('Adresse ajouter avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $mes_adress)
    {
        return view('frontend.profile.partials.address_form', [
            'adresse' => $mes_adress,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $mes_adress)
    {
        $validated = $request->validate([
            'alias' => 'required|string|min:3|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address2' => 'max:255',
            'other' => 'max:255',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'other_phone' => 'max:20',
            'favorite' => '',
        ]);
        $validated['user_id'] = Auth::user()->id;
        Address::where('id', $mes_adress->id)->update($validated);
        return back()->withSuccess('Adresse modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $mes_adress)
    {
        $mes_adress->delete();
        return back()->withSuccess('Adresse supprimée avec succès');
    }

    public function fav_address(Address $address)
    {
        Address::where('user_id', Auth::user()->id)->update(['favorite' => '']);
        $address->favorite = $address->id;
        $address->save();
        $add = Address::where('user_id', Auth::user()->id)->get();
        return view('frontend.profile.partials.address_list', [
            'address' => $add,
        ]);
    }
}
