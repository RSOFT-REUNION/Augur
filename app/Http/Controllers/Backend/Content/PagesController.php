<?php

namespace App\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Content\PagesRequest;
use App\Http\Requests\Backend\Content\PagesUpdateRequest;
use App\Models\Backend\Content\Category;
use App\Models\Backend\Content\Pages;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.content.pages.index', [
            'pages' => Pages::orderBy('id','DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pages = new Pages();
        return view('backend.content.pages.form', [
            'pages' => $pages,
            'categories_list' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PagesRequest $request)
    {
        $validatedData = $request->validated();
        if($validatedData['category_id']) {
            $slugCategory = Category::where('id', '=', $validatedData['category_id'])->pluck('slug')->first();
            $validatedData['slug'] = $slugCategory.'/'.Str::slug($validatedData['title']);
        } else {
            $validatedData['slug'] = '/'.Str::slug($validatedData['title']);
        }
        $validatedData['user_id'] = auth()->id();
        Pages::create($validatedData);
        return redirect()->route('backend.content.pages.index')->withSuccess('Page ajoutée avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pages $page)
    {
        return view('backend.content.pages.form', [
            'pages' => $page,
            'categories_list' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PagesUpdateRequest $request, Pages $page)
    {
        $validatedData = $request->validated();
        if($validatedData['category_id']) {
            $slugCategory = Category::where('id', '=', $validatedData['category_id'])->pluck('slug')->first();
            $validatedData['slug'] = $slugCategory.'/'.Str::slug($validatedData['title']);
        } else {
            $validatedData['slug'] = '/'.Str::slug($validatedData['title']);
        }
        $validatedData['user_id_update'] = auth()->id();
        Pages::where('id', $page->id)->update($validatedData);
        return back()->withSuccess('Page modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pages $page)
    {
        if($page->id != '1') {
            $page->delete();
            return back()->withSuccess('Page supprimée avec succès');
        } else {
            return back()->withErrors('Vous ne pouvez pas supprimer la page d\'accueil.');

        }
    }
}
