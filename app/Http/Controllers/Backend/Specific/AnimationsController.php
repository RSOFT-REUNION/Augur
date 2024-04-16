<?php

namespace App\Http\Controllers\Backend\Specific;

use App\Http\Controllers\Controller;
use App\Models\Backend\Catalog\Shop;
use App\Models\Specific\Animations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AnimationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.specific.animations.index', [
            'animations' => Animations::orderBy('id','ASC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $animation = new Animations();
        return view('backend.specific.animations.form', [
            'animation' => $animation,
            'shops_list' => Shop::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:specific_animations|max:255',
            'description' => 'string',
            'start_date' => 'date_format:Y-m-d\\TH:i',
            'end_date' => 'date_format:Y-m-d\\TH:i',
            'date_field' => 'after:start_date|before:end_date',
            'shops_id' => 'string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = Str::slug($validated['image']->getClientOriginalName(), '.');
        $validated['image']->storeAs('public/upload/specific/animations', $imageName);
        $validated['image'] = $imageName;
        Animations::create($validated);
        return redirect()->route('backend.specific.animations.index')->withSuccess('Animation ajouter avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Animations $animation)
    {
        return view('backend.specific.animations.form', [
            'animation' => $animation,
            'shops_list' => Shop::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Animations $animation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'start_date' => 'date_format:Y-m-d\\TH:i',
            'end_date' => 'date_format:Y-m-d\\TH:i',
            'date_field' => 'after:start_date|before:end_date',
            'shops_id' => 'string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if(@$validated['image']){
            /*** Suppresion de l'ancienne image ***/
            $imgold = Animations::select('image')->where('id', $animation->id)->first();
            Storage::delete('public/upload/specific/animations/'.$imgold->image);
            /*** ***/
            $imageName = Str::slug($validated['image']->getClientOriginalName(), '.');
            $validated['image']->storeAs('public/upload/specific/animations/', $imageName);
            $validated['image'] = $imageName;
            Animations::where('id', $animation->id)->update($validated);
            return back()->withSuccess('Image modifiée avec succès');
        } else {
            Animations::where('id', $animation->id)->update($validated);
            return back()->withSuccess('Image modifiée avec succès');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animations $animation)
    {
        Storage::delete('public/upload/specific/animations/'.$animation->image);
        $animation->delete();
        return back()->withSuccess('Animation supprimée avec succès');
    }
}
