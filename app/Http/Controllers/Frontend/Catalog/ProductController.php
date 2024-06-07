<?php

namespace App\Http\Controllers\Frontend\Catalog;

use App\Http\Controllers\Frontend\FrontendBaseController;
use App\Models\Catalog\Category;
use App\Models\Catalog\Discount;
use App\Models\Catalog\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

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

        /*** Query products with search and initial filtering ***/
        $productsQuery = Product::query()
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
            ->where('name', 'LIKE', "%{$request->input('search')}%");

        /*** Filter by stock ***/
        if ($request->stock == 'on') {
            $productsQuery->where('stock', '>', 0);
        } elseif ($request->stock == 'none') {
            $productsQuery->where('stock', '>=', 0);
        }

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

        /*** Fetch products before applying discount calculations ***/
        $products = $productsQuery->get();

        /*** Filter by discount and calculate final price ***/
        $discountProducts = collect();
        $discounts = Discount::currently()->with('products')->orderBy('percentage')->get();
        foreach ($discounts as $discount) {
            $discountPercentage = $discount->percentage;
            foreach ($discount->products as $product) {
                $discountProducts->put($product->product_id, $discount->percentage);
            }
        }

        // Calculate the final price including discount or fixed_pricettc
        $products = $products->map(function ($product) use ($discountProducts) {
            $discount = $discountProducts->get($product->id, 0);

            if (isset($product->fixed_pricettc) && $product->fixed_pricettc !== null) {
                $product->final_price = $product->fixed_pricettc;
            } else {
                $product->final_price = $product->price_ttc - ($product->price_ttc * ($discount / 100));
            }

            return $product;
        });

        // Apply discount filter if requested
        if ($request->discount == 'on') {
            $products = $products->filter(function ($product) {
                return $product->final_price < $product->price_ttc;
            });
        }

        // Sort products by final_price
        $products = $products->sortBy('final_price');

        /*** Sort by final price ***/
        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') {
                $products = $products->sortBy('final_price');
            } elseif ($request->sort == 'price_desc') {
                $products = $products->sortByDesc('final_price');
            } elseif ($request->sort == 'name') {
                $products = $products->sortBy('name');
            } else {
                $products = $products->sortByDesc('id');
            }
        } else {
            $products = $products->sortByDesc('id');
        }

        /*** Convert the sorted collection back to a paginator ***/
        $perPage = 16;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $products->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedProducts = new LengthAwarePaginator($currentPageItems, $products->count(), $perPage);
        $paginatedProducts->setPath($request->url());
        $paginatedProducts->appends($request->all());

        if ($request->header('hx-request') && $request->header('hx-target') == 'list_product') {
            return view('frontend.product.partials.list_product', [
                'category_curent' => $category_current,
                'products' => $paginatedProducts,
                'products_minprice' => $products_minprice,
                'products_maxprice' => $products_maxprice,
            ]);
        }

        return view('frontend.product.list', [
            'category_list' => $categories,
            'category_curent' => $category_current,
            'products' => $paginatedProducts,
            'products_minprice' => $products_minprice,
            'products_maxprice' => $products_maxprice,
        ]);
    }

    public function product_show(string $slug, Product $product)
    {
        $product = $product->with(['category', 'images', 'labels'])->where('slug', $slug)->first();
        if($product) {
            return view('frontend.product.show', [
                'product' => $product,
            ]);
        }
    }
}
