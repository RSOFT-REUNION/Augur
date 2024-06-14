<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Controllers\Controller;
use App\Imports\CatalogCategoryImport;
use App\Models\Catalog\Category;
use App\Models\Catalog\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.catalog.category.index', [
            'categories' => Category::whereNull('category_id')->with('childrenCategories')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        $categories_list = Category::get();
        return view('backend.catalog.category.form', [
            'category' => $category,
            'categories_list' => $categories_list,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|min:3|max:255|string',
            'description' => 'nullable|string',
            'category_id' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_menu' => '',
            'active' => '',
        ]);
        @$validated['is_menu'] = $validated['is_menu']=='on' ? 1:0;
        @$validated['active'] = $validated['active']=='on' ? 1:0;
        if ($validated['category_id']) {
            $slugParent = Category::where('id', '=', $validated['category_id'])->pluck('slug')->first();
            $validated['slug'] = $slugParent . '/' . Str::slug($validated['name']);
        } else {
            $validated['slug'] = Str::slug($validated['name']);
        }
        if(@$validated['image']){
            $imageName = Str::slug($validated['image']->getClientOriginalName(), '.');
            $validated['image']->storeAs('public/upload/catalog/category', $imageName);
            $validated['image'] = $imageName;
        }
        Category::create($validated);
        return redirect()->route('backend.catalog.categories.index')->withSuccess('Catégorie ajoutée avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories_list = Category::with(['childrenCategories' => function ($q) {
            $q->orderBy('name');
        }])->get();
        return view('backend.catalog.category.form')->with([
            'category' => $category,
            'categories_list' => $categories_list,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name'      => 'required|min:3|max:255|string',
            'description' => 'nullable|string',
            'category_id' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_menu' => '',
            'active' => '',
        ]);
        @$validated['is_menu'] = $validated['is_menu']=='on' ? 1:0;
        @$validated['active'] = $validated['active']=='on' ? 1:0;
        /*** Mise a jour du slug de la categorie ***/
        if ($validated['category_id']) {
            $slug = Category::where('id', '=', $validated['category_id'])->pluck('slug')->first();
            $parentCategories = explode('/', $slug);
            if (in_array($validated['name'], $parentCategories)) {
                return back()->withErrors('Cette catégorie ne peut être parente de ' . $validated['name'] . ' car elle est déjà défini comme sa sous-catégorie.');
            } else {
                $validated['slug'] = $slug . '/' . Str::slug($validated['name']);
            }
        } else {
            $validated['slug'] = Str::slug($validated['name']);
        }
        /*** Mise a jour de l'iamage ***/
        if(@$validated['image']){
            /*** Suppresion de l'ancienne image ***/
            $imgold = Category::select('image')->where('id', $category->id)->first();
            Storage::delete('public/upload/catalog/category/'.$imgold->image);
            /*** ***/
            $imageName = Str::slug($validated['image']->getClientOriginalName(), '.');
            $validated['image']->storeAs('public/upload/catalog/category', $imageName);
            $validated['image'] = $imageName;
        }
        /*** Mise a jour du slug des produits lier a  la categorie
        if (count($category->products) > 0) {
           foreach($category->products as $product){
               $product->slug = $validated['slug'].'/'.Str::slug($product->name);
               $product->save();
           };
        }***/
        $category->update($validated);
        return redirect()->route('backend.catalog.categories.index')->withSuccess('Catégorie modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (count(Product::where('category_id', "=", $category->id)->get())) {
            return back()->withErrors('Il n\'est pas possible de supprimer cette catégorie car elle a des produits associées.');
        } else {
            if (count($category->getAllDescendantsRecursive($category->id))) {
                foreach ($category->getAllDescendantsRecursive($category->id) as $children) {
                    if (count(Product::where('category_id', "=", $children)->get())) {
                        return back()->withErrors('Il n\'est pas possible de supprimer cette catégorie car elle a des pages associées à des sous-catégories.');
                    } else {
                        Category::where('category_id', '=', $children)->delete();
                    }
                }
            }
            if (count($category->getChildren($category->id))) {
                foreach ($category->getChildren($category->id) as $children) {
                    if (count(Product::where('category_id', "=", $children)->get())) {
                        return back()->withErrors('Il n\'est pas possible de supprimer cette catégorie car elle a des produits associées à des sous-catégories.');
                    } else {
                        Category::where('id', '=', $children)->delete();
                    }
                }
            }
            $category->delete();
            return back()->withSuccess('Catégorie supprimée avec succès');
        }
    }

    public function import(Request $request)
    {
        Excel::import(new CatalogCategoryImport(), $request->csv, $request->csv);
        return back()->withSuccess('Categorie importer avec succès');
    }
}
