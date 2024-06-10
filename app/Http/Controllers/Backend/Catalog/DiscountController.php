<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Discount;
use App\Models\Catalog\DiscountProduct;
use App\Models\Catalog\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.catalog.discount.index', [
            'discounts' => Discount::orderBy('id','DESC')->get(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $discount = new Discount();
        return view('backend.catalog.discount.form', [
            'discount' => $discount,
        ]);
    }

    /**
     * Create and store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|unique:catalog_discounts|min:3|max:255|required',
            'percentage' => 'integer|min:1|max:100|required',
            //'icon' => 'in:star,heart,bolt,gift,snowflake,grill-hot,fish,leaf,award,head-side,meat,sparkles,bookmark,circle-euro,mug-tea,watermelon-slice,tree-palm,user-tie|required',
            'start_date' => 'date|required|after_or_equal:yesterday',
            'end_date' => 'date|required|after_or_equal:start_date',
            'short_description' => 'string|max:255|nullable',
            'active' => 'nullable',
        ]);
        @$validated['active'] = $validated['active'] == 'on' ? 1 : 0;
        $discount = Discount::create($validated);
        return to_route('backend.catalog.discounts.edit', $discount)->withSuccess('Promotion ajoutée avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        return view('backend.catalog.discount.form', [
            'discount' =>   $discount,
            'products_list' => Product::orderBy('id', 'DESC')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {
        $validated = $request->validate([
            'name' => 'string|min:3|max:255|required',
            'percentage' => 'integer|min:1|max:100|required',
            'icon' => 'in:star,heart,bolt,gift,snowflake,grill-hot,fish,leaf,award,head-side,meat,sparkles,bookmark,circle-euro,mug-tea,watermelon-slice,tree-palm,user-tie|required',
            'start_date' => 'date|required',
            'end_date' => 'date|required|after_or_equal:start_date',
            'short_description' => 'string|max:255|nullable',
            'active' => 'nullable',
        ]);
        @$validated['active'] = $validated['active'] == 'on' ? 1 : 0;
        $discount->update($validated);
        return redirect()->route('backend.catalog.discounts.edit', [
            'discount' => $discount,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return back()->withSuccess('Promotion supprimée');
    }


    public function add_products(Request $request, Discount $discount)
    {
         $validated = $request->validate([
                'discount_products' => 'array|nullable'
         ]);
        foreach ($validated['discount_products'] as $product) {
            $product = json_decode($product, true);
            DiscountProduct::create([
                'discount_id' => $discount->id,
                'product_id' => $product['id'],
                'base_ht' => $product['price_ht'],
                'base_ttc' => $product['price_ttc'],
                'base_tva' => $product['tva'],
                'discounted_ht' => $product['price_ht'] + ($product['price_ht'] * ($discount->percentage / 100)),
                'discounted_ttc' => $product['price_ttc'] + ($product['price_ttc'] * ($discount->percentage / 100)),
            ]);
        }

        return view('backend.catalog.discount.partial.discounted_products', [
            'discount' =>   Discount::with('products')->findOrFail($discount->id),
        ]);
    }

    public function destroy_product(DiscountProduct $product)
    {
        $product->delete();
    }

}
