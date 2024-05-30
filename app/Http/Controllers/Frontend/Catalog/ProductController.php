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
            'fisrt_category' => Category::whereNull('category_id')->where('active', 1)->limit(4)->get(),
        ]);
    }

    public function category_list(string $slug, Request $request)
    {
        $category_current = Category::where('slug', $slug)->first();
        $categories = Category::withCount('products')
            ->having('products_count', '>', 0)
            ->where('category_id', $category_current->id)
            ->where('active', 1)
            ->get();

        /*** Query products with search and sort ***/
        $products = Product::query()
            ->with('images')
            ->where('active', 1)
            ->where(function ($query) use ($categories, $category_current) {
                $query->where('category_id', $category_current->id);
                foreach ($categories as $category) {
                    $query->orWhere('category_id', $category->id);
                    $subcategories = Category::where('category_id', $category->id)
                        ->where('active', 1)
                        ->pluck('id');
                    foreach ($subcategories as $subcategory) {
                        $query->orWhere('category_id', $subcategory);
                    }
                }
            })
            ->where('name', 'LIKE', "%{$request->input('search')}%")
            ->when($request->has('sort'), function ($query) use ($request) {
                if ($request->sort == 'name') $query->orderBy('name');
                if ($request->sort == 'price_asc') $query->orderBy('price_ttc');
                if ($request->sort == 'price_desc') $query->orderByDesc('price_ttc');
            });

        /*** Get min and max prices of all products in subcategories ***/
        $products_price = Product::query()
            ->where('active', 1)
            ->where(function ($query) use ($categories, $category_current) {
                $query->where('category_id', $category_current->id);
                foreach ($categories as $category) {
                    $query->orWhere('category_id', $category->id);
                    $subcategories = Category::where('category_id', $category->id)
                        ->where('active', 1)
                        ->pluck('id');
                    foreach ($subcategories as $subcategory) {
                        $query->orWhere('category_id', $subcategory);
                    }
                }
            });

        $products_minprice = $products_price->min('price_ttc');
        $products_maxprice = $products_price->max('price_ttc');

        if (!$request->has('sort') || $request->sort == 'none') {
            $products->orderByDesc('id');
        }

        /*** Filter by stock ***/
        if ($request->stock == 'on') {
            $products->where('stock', '>', 0);
        } elseif ($request->stock == 'none') {
            $products->where('stock', '>=', 0);
        }

        /*** Filter by price range ***/
        if ($request->price_min) {
            $products->where('price_ttc', '>=', formatPriceToInteger($request->price_min));
        }
        if ($request->price_max) {
            $products->where('price_ttc', '<=', formatPriceToInteger($request->price_max));
        }

        /*** Return with pagination ***/
        $products = $products->paginate(16)->withQueryString();


        if ($request->header('hx-request') && $request->header('hx-target') == 'list_product') {
            return view('frontend.product.partials.list_product', [
                'category_curent' => $category_current,
                'products' => $products,
                'products_minprice' => $products_minprice,
                'products_maxprice' => $products_maxprice,
            ]);
        }

        return view('frontend.product.list', [
            'category_list' => $categories,
            'category_curent' => $category_current,
            'products' => $products,
            'products_minprice' => $products_minprice,
            'products_maxprice' => $products_maxprice,
        ]);
    }

    public function product_show(string $slug, Product $product)
    {
        $product = $product->with(['category', 'images', 'labels'])->where('slug', $slug)->first();
        if($product) {
            return view('frontend.product.show', [
                'produit' => $product,
            ]);
        }
    }
}
