<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Catalog\BrandsRequest;
use App\Http\Requests\Backend\Catalog\BrandsUpdateRequest;
use App\Models\Backend\Catalog\Category;
use App\Models\Backend\Catalog\Brands;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.catalog.brands.index', [
            'brands' => Brands::orderBy('id','DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = new Brands();
        return view('backend.catalog.brands.form', [
            'brands' => $brands,
            'categories_list' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandsRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = '/'.Str::slug($validatedData['name']);
        Brands::create($validatedData);
        return redirect()->route('backend.catalog.brands.index')->withSuccess('Marque ajoutée avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brands $brand)
    {
        return view('backend.catalog.brands.form', [
            'brands' => $brand,
            'categories_list' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandsUpdateRequest $request, Brands $brand)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = '/'.Str::slug($validatedData['name']);
        Brands::where('id', $brand->id)->update($validatedData);
        return redirect()->route('backend.catalog.brands.index')->withSuccess('Marque modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brands $brand)
    {
            $brand->delete();
            return back()->withSuccess('Marque supprimée avec succès');
    }
}
