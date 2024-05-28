<?php

namespace App\Http\Controllers\Backend\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Catalog\Discount;
use App\Models\Catalog\DiscountRule;
use Illuminate\Http\Request;

class DiscountRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.catalog.discounts.rules.index', [
            'discounts_rules' => DiscountRule::orderBy('id','DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rule = new DiscountRule();
        return view('backend.catalog.discounts.form', [
            'discounts_rules' => $rule,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'string|nullable|unique',
            'name' => 'string|unique|min:3|max:255|required',
            'description' => 'string|nullable',
            'image'  => 'string|nullable',
            'rule_id' => 'nullable',
            'start_date' => 'required',
            'end_date' => 'required',
            'active' => 'required',
        ]);
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {
        //
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
     * Add règle de calcul.
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
}
