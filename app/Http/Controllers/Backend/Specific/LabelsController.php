<?php

namespace App\Http\Controllers\Backend\Specific;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specific\Labels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LabelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.specific.labels.index', [
            'labels' => Labels::orderBy('id','ASC')->get()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $label = new Labels();
        return view('backend.specific.labels.form', [
            'label' => $label,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255|string',
            'description'=>'string|nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favorite' => '',
        ]);
        @$validated['favorite'] = $validated['favorite']=='on' ? 1:0;
        $imageName = Str::slug($validated['image']->getClientOriginalName(), '.');
        $validated['image']->storeAs('public/upload/specific/labels', $imageName);
        $validated['image'] = $imageName;
        Labels::create($validated);
        return redirect()->route('backend.specific.labels.index')->withSuccess('Label ajouter avec succès');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Labels $label)
    {
        return view('backend.specific.labels.form', [
            'label' => $label,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Labels $label)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255|string',
            'description'=>'string|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favorite' => '',
        ]);
        @$validated['favorite'] = $validated['favorite']=='on' ? 1:0;
        if(@$validated['image']){
            /*** Suppresion de l'ancienne image ***/
            $imgold = Labels::select('image')->where('id', $label->id)->first();
            Storage::delete('public/upload/specific/labels/'.$imgold->image);
            /*** ***/
            $imageName = Str::slug($validated['image']->getClientOriginalName(), '.');
            $validated['image']->storeAs('public/upload/specific/labels', $imageName);
            $validated['image'] = $imageName;
            Labels::where('id', $label->id)->update($validated);
            return back()->withSuccess('Label modifiée avec succès');
        } else {
            Labels::where('id', $label->id)->update($validated);
            return back()->withSuccess('Label modifiée avec succès');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Labels $label)
    {
        Storage::delete('public/upload/specific/labels/'.$label->image);
        $label->delete();
        return back()->withSuccess('Label supprimée avec succès');
    }
}
