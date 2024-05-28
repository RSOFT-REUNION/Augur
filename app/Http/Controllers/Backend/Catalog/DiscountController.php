<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Discount;
use App\Models\Catalog\DiscountRule;
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
        return view('backend.catalog.discounts.index', [
            'discounts' => Discount::orderBy('start_date','DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $discount = new Discount();
        $rules_list = DiscountRule::groupBy('id')->get();
        return view('backend.catalog.discounts.form', [
            'discount' => $discount,
            'rules_list' => $rules_list,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'nullable',
            'name' => 'string|min:3|max:255|required',
            'description' => 'string|nullable',
            'image'  => 'nullable',
            'discount_rule_id' => 'nullable',
            'start_date' => 'required',
            'end_date' => 'required',
            'active' => 'required',
        ]);
        @$validated['active'] = $validated['active'] == 'on' ? 1 : 0;
        if ($request->hasFile('image')) {
            $imageName = Str::slug($validated['image']->getClientOriginalName(), '.');
            $validated['image']->storeAs('public/upload/catalog/discounts/', $imageName);
            $validated['image'] = $imageName;
        }
        Discount::create($validated);
        return redirect()->route('backend.catalog.discounts.index')->withSuccess('Promotion ajoutée');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        return view('backend.catalog.discounts.form', [
            'discount' => $discount,
            'rules_list' => DiscountRule::groupBy('id')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {
        $validated = $request->validate([
            'code' => 'string|nullable',
            'name' => 'string|min:3|max:255|required',
            'description' => 'string|nullable',
            'image'  => 'nullable',
            'rule_id' => 'nullable',
            'start_date' => 'required',
            'end_date' => 'required',
            'active' => 'required',
        ]);
        @$validated['active'] = $validated['active'] == 'on' ? 1 : 0;
        if (@$validated['image']) {
            /*** Suppresion de l'ancienne image ***/
            $old = Discount::select('image')->where('id', $discount->id)->first();
            Storage::delete('public/upload/catalog/discounts/' . $old->image);
            /*** ***/
            $imageName = Str::slug($validated['image']->getClientOriginalName(), '.');
            $validated['image']->storeAs('public/upload/catalog/discounts/', $imageName);
            $validated['image'] = $imageName;
        }
        $discount->update($validated);
        return back()->withSuccess('Promotion modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return back()->withSuccess('Promotion supprimée avec succès');
    }


    /**
     * Ajouter une règle de calcul.
     */
    public function add_rule(Request $request)
    {
        $validated = $request->validate([
            'code' => 'string|nullable',
            'name' => 'string|unique|required|min:3|max:255',
            'formula' => 'string|unique|required|min:3|max:30',
            'short_description' => 'string|nullable',
        ]);
        DiscountRule::create($validated);
        return back()->withSuccess('Régle de calcul ajoutée avec succès');
    }


    public function add_product(Product $produit)
    {
        $cart_id = $this->getCart();
        $cart = Carts::firstwhere('id', $cart_id);
        if (count($cart->product()->where('product_id', $produit->id)->get()) == 0)
        {
            $cart->product()->create([
                'product_id' => $produit->id,
                'price_ht' => $produit->price_ht,
                'tva' => $produit->tva,
                'price_ttc' => $produit->price_ttc,
                'quantity' => 1,
            ]);
        } else
        {
            $product = CartsProducts::where('product_id', $produit->id)->first();
            $product->quantity = $product->quantity + 1;
            $product->save();
        }
        $sum = 0;
        foreach ($cart->product as $prod) {
            $sum += $prod->quantity;
        }
        return '<span id="nb_produit">'.$sum.'</span>';
    }
}
