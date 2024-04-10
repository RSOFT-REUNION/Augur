<?php

namespace App\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Content\CategoryRequest;
use App\Http\Requests\Backend\Content\CategoryUpdateRequest;
use App\Models\Backend\Content\Category;
use App\Models\Backend\Content\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.content.category.index', [
            'categories' => Category::whereNull('category_id')->with('childrenCategories')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        $categories_list = Category::groupBy('id')->get();
        return view('backend.content.category.form', [
            'category' => $category,
            'categories_list' => $categories_list,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $request = $request->validated();
        if ($request['category_id']) {
            $slugParent = Category::where('id', '=', $request['category_id'])->pluck('slug')->first();
            $request['slug'] = $slugParent . '/' . Str::slug($request['name']);
        } else {
            $request['slug'] = '/' . Str::slug($request['name']);
        }
        Category::create($request);
        return redirect()->route('backend.content.categories.index')->withSuccess('Catégorie ajoutée avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories_list = Category::get();
        return view('backend.content.category.form')->with([
            'category' => $category,
            'categories_list' => $categories_list,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $request = $request->validated();

        if ($request['category_id']) {
            $slug = Category::where('id', '=', $request['category_id'])->pluck('slug')->first();
            $parentCategories = explode('/', $slug);

            if (in_array($request['name'], $parentCategories)) {
                return back()->withErrors('Cette catégorie ne peut être parente de ' . $request['name'] . ' car elle est déjà défini comme sa sous-catégorie.');
            } else {
                $request['slug'] = $slug . '/' . Str::slug($request['name']);
            }
        } else {
            $request['slug'] = '/' . Str::slug($request['name']);
        }
        $category->update($request);
        return redirect()->route('backend.catalog.categories.index')->withSuccess('Catégorie modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (count(Pages::where('category_id', "=", $category->id)->get())) {
            return back()->withErrors('Il n\'est pas possible de supprimer cette catégorie car elle a des pages associées.');
        } else {
            if (count($category->getAllDescendantsRecursive($category->id))) {
                foreach ($category->getAllDescendantsRecursive($category->id) as $children) {
                    if (count(Pages::where('category_id', "=", $children)->get())) {
                        return back()->withErrors('Il n\'est pas possible de supprimer cette catégorie car elle a des pages associées à des sous-catégories.');
                    } else {
                        Category::where('category_id', '=', $children)->delete();
                    }
                }
            }
            if (count($category->getChildren($category->id))) {
                foreach ($category->getChildren($category->id) as $children) {
                    if (count(Pages::where('category_id', "=", $children)->get())) {
                        return back()->withErrors('Il n\'est pas possible de supprimer cette catégorie car elle a des pages associées à des sous-catégories.');
                    } else {
                        Category::where('id', '=', $children)->delete();
                    }
                }
            }
            $category->delete();
            return back()->withSuccess('Catégorie supprimée avec succès');
        }
    }
}
