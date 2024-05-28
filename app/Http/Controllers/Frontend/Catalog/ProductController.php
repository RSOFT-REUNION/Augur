<?php

namespace App\Http\Controllers\Frontend\Catalog;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Catalog\Category;
use App\Models\Catalog\Product;
use Illuminate\Http\Request;

class ProductController extends FrontendBaseController
{
    public function fisrt_category_list()
    {
        return view('frontend.product.fisrt_category_list', [
            'fisrt_category' => Category::with(['childrenCategories' => function ($q) {
                $q->orderBy('name');
            }, 'products'])->whereNull('category_id')->where('active', 1)->paginate(16),
        ]);
    }

    public function category_list(string $slug, Request $request)
    {
        $category_curent = Category::where('slug', $slug)->first();
        $category = Category::where('category_id', $category_curent->id)->where('active', 1)->get();

        /*** Requettes des produits avec Recherche / Trie ***/
        $products = Product::query()->with('images')
            ->where('active', 1)
            ->where('category_id', $category_curent->id)
            ->where('name', 'LIKE', "%{$request->input('search')}%")
            ->when($request->has('sort'), function ($query) use ($request) {
                if($request->sort == 'name') $query->orderBy('name');
                if($request->sort == 'price_asc') $query->orderBy('price_ttc');
                if($request->sort == 'price_desc') $query->orderByDesc('price_ttc');
            });
        /*** Ajout des produits des sous categorie ***/
        foreach ($category as $item) {
            /*** Recherche de sous categorie a la sous categorie ***/
            $category_chidren = Category::where('category_id', $item->id)->where('active', 1)->get();
            foreach ($category_chidren as $chidren) {
                $products = $products->orWhere('category_id', $chidren->id);
            }
            $products = $products->orWhere('category_id', $item->id);
        }
        if(($request->sort == null) || ($request->sort == 'none')) $products->orderByDesc('id');
        /*** en stock ***/
        //return $request->stock;
        if ($request->stock == 'on') $products = $products->where('stock', '>', 0);
        if ($request->stock == 'none') $products = $products->where('stock', '>=', 0);

        /*** filtre min max ***/
        $products_minprice = $products->min('price_ttc');
        $products_maxprice = $products->max('price_ttc');
        if ($request->price_min) $products = $products->where('price_ttc', '>=', formatPriceToInteger($request->price_min));
        if ($request->price_max) $products = $products->where('price_ttc', '<=', formatPriceToInteger($request->price_max));


        /*** Retour avec pagination ***/
        $products = $products->paginate(16)->withQueryString();

        if ($request->header('hx-request') && $request->header('hx-target') == 'list_product') {
            return view('frontend.product.partials.list_product', [
                'category_curent' => $category_curent,
                'products' => $products,
                'products_minprice' => $products_minprice,
                'products_maxprice' => $products_maxprice,
            ]);
        }

        /*** Verifie si il y a une categorie supperieur pour afficher la liste en plus des produits ***/
        if(count($category) > 0){
            return view('frontend.product.category_list', [
                'category_list' => $category,
                'category_curent' => $category_curent,
                'products' => $products,
                'products_minprice' => $products_minprice,
                'products_maxprice' => $products_maxprice,
            ]);
        } else {
            return view('frontend.product.list', [
                'category_curent' => $category_curent,
                'products' => $products,
                'products_minprice' => $products_minprice,
                'products_maxprice' => $products_maxprice,
            ]);
        }
    }

    public function product_show(string $slug, Product $product)
    {
        $product = $product->with(['category', 'images'])->where('slug', $slug)->first();
        if($product) {
            return view('frontend.product.show', [
                'produit' => $product,
            ]);
        }
    }
}
