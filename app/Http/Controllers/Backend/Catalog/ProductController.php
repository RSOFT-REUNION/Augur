<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Catalog\ProductsImages;
use Illuminate\Http\Request;
use App\Models\Catalog\Category;
use App\Models\Catalog\Product;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('backend.catalog.product.index', [
            'products' => Product::orderBy('id','DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return ['product' => new Product()];
        /*view('backend.catalog.product.create', [
            'product' => new Product(),
        ]);*/
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255|string|unique:catalog_products',
            'slug' => 'max:255|nullable',
            'category_id' => 'nullable',
            'brands' => 'nullable',
            'description' => 'max:400|string|nullable',
            'tags' => 'nullable',
            'images' => 'array',
            'images.*' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'uvc' => '',
            'prix_ht' => 'required',
            'prix_ttc' => 'required',
            'active' => 'required',
        ]);
       if($validatedData['category_id']) {
            $slugCategory = Category::where('id', '=', $validatedData['category_id'])->pluck('slug')->first();
            $validatedData['slug'] = $slugCategory.'/'.Str::slug($validatedData['name']);
        } else {
            $validatedData['slug'] = '/'.Str::slug($validatedData['name']);
      }
        $validatedData['user_id'] = auth()->id();
        $product = Product::create($validatedData);
        $product->update($validatedData);
        if ($request->hasFile('images')) {
            $product->attachImages($product->id, @$validatedData['images']);
        }
        return redirect()->route('backend.catalog.products.index' )->withSuccess('Produit enregistré');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('backend.catalog.product.edit', [
            'products' => $product,
            'categories_list' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255|string',
            'slug' => 'max:255|nullable',
            //'category_id' => 'nullable',
            'price' => 'integer|nullable',
            'size' => 'nullable',
            'description' => 'max:255|string|nullable',
            'active' => '',
        ]);
     /*   if($validatedData['category_id']) {
            $slugCategory = Category::where('id', '=', $validatedData['category_id'])->pluck('slug')->first();
            $validatedData['slug'] = $slugCategory.'/'.Str::slug($validatedData['name']);
        } else {*/
            $validatedData['slug'] = '/'.Str::slug($validatedData['name']);
      //  }
        //$validatedData['user_id_update'] = auth()->id();
        @$validatedData['active'] = $validatedData['active'] == 'on' ? 1 : 0;
        $product->update($validatedData);
        return back()->withSuccess('Produit modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
            foreach ($product->images as $image) {
                Storage::delete('public/upload/catalog/products/'.$image->products_id.'/'.$image->name);
                $image->delete();
            }
            $product->delete();
            return back()->withSuccess('Produit supprimé avec succès');
    }

    public function add_image(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'images' => 'array',
            'images.*' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product->attachImages($product->id, @$validatedData['images']);
        return back()->withSuccess('Image(s) ajoutée(s) avec succès');
    }

    public function destroy_image(ProductsImages $image)
    {
        $product = Product::find($image->product_id);
        if($product->fav_image == $image->id) {
            $product->fav_image = null;
            $product->save();
        }
        Storage::delete('public/upload/catalog/products/'.$image->product_id.'/'.$image->name);
        $image->delete();
        return '';
    }
    public function fav_image(ProductsImages $image)
    {
        $product = Product::find($image->product_id);
        $product->fav_image = $image->id;
        $product->save();
        return response()->view('backend.catalog.product.partial.images_list', [
            'products' => $product,
        ]);
    }



}
