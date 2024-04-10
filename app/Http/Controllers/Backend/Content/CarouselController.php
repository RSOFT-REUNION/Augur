<?php

namespace App\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Content\CarouselRequest;
use App\Http\Requests\Backend\Content\CarouseUpdatelRequest;
use App\Models\Backend\Content\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.content.carousel.index', [
            'sliders' => Carousel::orderBy('id','DESC')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarouselRequest $request)
    {
        $validated = $request->validated();
        $imageName = Str::slug($validated['image']->getClientOriginalName(), '.');
        $validated['image']->storeAs('public/upload/content/carousel', $imageName);
        $validated['image'] = $imageName;
        Carousel::create($validated);
        return redirect()->route('backend.content.carrousel.index')->withSuccess('Image du carrousel ajouter avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carousel $carrousel)
    {
        return view('backend.content.carousel.edit', [
            'sliders' => $carrousel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarouseUpdatelRequest $request, Carousel $carrousel)
    {
        $validated = $request->validated();
        Carousel::where('id', $carrousel->id)->update($validated);
        return back()->withSuccess('Informations modifiée avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carousel $carrousel)
    {
        Storage::delete('public/upload/content/carousel/'.$carrousel->image);
        $carrousel->delete();
        return back()->withSuccess('Image supprimée avec succès');
    }
}
