<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Catalog\ShopsRequest;
use App\Http\Requests\Backend\Catalog\ShopsUpdateRequest;
use App\Models\Backend\Catalog\Shop;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.catalog.shops.index', [
            'shops' => Shop::orderBy('id','DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shops = new Shop();
        return view('backend.catalog.shops.form', [
            'shops' => $shops
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShopsRequest $request)
    {
        $validated = $request->validated();
        $imageName = Str::slug($validated['image']->getClientOriginalName(), '.');
        $validated['image']->storeAs('public/upload/catalog/shops', $imageName);
        $validated['image'] = $imageName;
        Shop::create($validated);
        return redirect()->route('backend.catalog.shops.index')->withSuccess('Magasin ajouté avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        return view('backend.catalog.shops.form', [
            'shops' => $shop
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShopsUpdateRequest $request, Shop $shop)
    {
        $validatedData = $request->validated();
        Shop::where('id', $shop->id)->update($validatedData);
        return redirect()->route('backend.catalog.shops.index')->withSuccess('Magasin modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        Storage::delete('public/upload/catalog/shops/'.$shop->image);
        $shop->delete();
        return back()->withSuccess('Magasin supprimé avec succès');
    }
}
