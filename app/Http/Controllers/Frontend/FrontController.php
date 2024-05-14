<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Catalog\Product;
use App\Models\Content\Pages;
use App\Models\Settings\Informations;
use App\Models\Specific\Labels;

class FrontController extends FrontendBaseController
{
    public function index()
    {
        $pages = Pages::where('id', '=', '1')->first();
        $produits = Product::where('active', 1)->get();
        $labels = Labels::where('favorite', 1)->inRandomOrder()->limit(4)->get();
        return view('frontend.index', [
            'page' => $pages,
            'produits' => $produits,
            'labels' => $labels
        ]);
    }
    public function legalnotice()
    {
        $legalnotice = Informations::select('legalnotice')->where('id', '=', '1')->first();
        return view('frontend.pages.legalnotice', [
            'legalnotice' => $legalnotice,
        ]);
    }
    public function termsofservice()
    {
        $termsofservice = Informations::select('termsofservice')->where('id', '=', '1')->first();
        return view('frontend.pages.termsofservice', [
            'termsofservice' => $termsofservice,
        ]);
    }

    /*** Gestion des produits ***/
    public function product(string $slug, Product $product)
    {
        $product = $product->where('id', $product->id)->first();
        if($product) {
            return view('frontend.product.show', [
                'produit' => $product,
            ]);
        }
    }

    /*** Gestion des pages ***/
    public function pages(string $slug, Pages $pages)
    {
        $pages = $pages->where('slug', '=', '/'.$slug)->where('active', 1)->first();
        if($pages) {
            return view('frontend.pages.show', [
                'page' => $pages,
            ]);
        } else {
            return view('frontend.errors.404', [
                'page' => '',
            ]);
        }
    }
}
