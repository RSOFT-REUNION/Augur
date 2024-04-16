<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Catalog\StocksRequest;
use App\Http\Requests\Backend\Catalog\StocksUpdateRequest;
use App\Models\Backend\Catalog\Stock;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.catalog.stocks.index', [
            'stocks' => Stock::orderBy('id','DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stocks = new Stock();
        return view('backend.catalog.stocks.form', [
            'stocks' => $stocks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StocksRequest $request)
    {
        $validated = $request->validated();
        $imageName = Str::slug($validated['image']->getClientOriginalName(), '.');
        $validated['image']->storeAs('public/upload/catalog/stocks', $imageName);
        $validated['image'] = $imageName;
        Stock::create($validated);
        return redirect()->route('backend.catalog.stocks.index')->withSuccess('Magasin ajouté avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        return view('backend.catalog.stocks.form', [
            'stocks' => $stock
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StocksUpdateRequest $request, Stock $stock)
    {
        $validatedData = $request->validated();
        Stock::where('id', $stock->id)->update($validatedData);
        return redirect()->route('backend.catalog.stocks.index')->withSuccess('Magasin modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
            Storage::delete('public/upload/catalog/stocks/'.$stock->image);
            $stock->delete();
            return back()->withSuccess('Magasin supprimé avec succès');
    }
}
