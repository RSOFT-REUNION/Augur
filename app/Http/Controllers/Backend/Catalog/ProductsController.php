<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Catalog\Category;
use App\Models\Backend\Catalog\Products;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.catalog.products.index', [
            'products' => Products::orderBy('id','DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = new Products();
        return view('backend.catalog.products.form', [
            'products' => $products,
            'categories_list' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255|string|unique:catalog_products',
            'slug' => 'min:3|max:255|string',
            'category_id' => 'nullable',
            'price' => 'nullable',
            'size' => 'nullable',
            'description' => 'required|min:3|max:255|string',
            'image' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($validatedData['image']->getClientOriginalName(), '.');
            $validatedData['image']->storeAs('public/upload/catalog/products', $imageName);
            $validatedData['image'] = $imageName;
        }


        if($validatedData['category_id']) {
            $slugCategory = Category::where('id', '=', $validatedData['category_id'])->pluck('slug')->first();
            $validatedData['slug'] = $slugCategory.'/'.Str::slug($validatedData['title']);
        } else {
            $validatedData['slug'] = '/'.Str::slug($validatedData['title']);
        }
        $validatedData['user_id'] = auth()->id();
        Products::create($validatedData);
        return redirect()->route('backend.catalog.products.index')->withSuccess('Produit ajouté avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        return view('backend.catalog.products.form', [
            'products' => $product,
            'categories_list' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255|string',
            'slug' => 'min:3|max:255|string',
            'category_id' => 'nullable',
            'price' => 'nullable',
            'size' => 'nullable',
            'description' => 'required|min:3|max:255|string',
            'image' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (@$validatedData['image']) {
            /*** Suppresion de l'ancienne image ***/
            $old = Products::select('image')->where('id', $product->id)->first();
            Storage::delete('public/upload/catalog/products/' . $old->image);
            /*** ***/
            $imageName = Str::slug($validatedData['image']->getClientOriginalName(), '.');
            $validatedData['image']->storeAs('public/upload/catalog/products/', $imageName);
            $validatedData['image'] = $imageName;
            Products::where('id', $product->id)->update($validatedData);
            return back()->withSuccess('Produit modifié avec succès');
        } else {
            Products::where('id', $product->id)->update($validatedData);
            return back()->withSuccess('Produit modifié avec succès');
        }

        $validatedData['user_id_update'] = auth()->id();
        Products::where('id', $product->id)->update($validatedData);
        return redirect()->route('backend.catalog.products.index')->withSuccess('Produit modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
            Storage::delete('public/upload/catalog/products/' . $product->image);
            $product->delete();
            return back()->withSuccess('Produit supprimé avec succès');
    }
}
