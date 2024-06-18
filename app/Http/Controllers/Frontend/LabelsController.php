<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Catalog\Product;
use App\Models\Specific\Labels;

class LabelsController extends FrontendBaseController
{
    public function index()
    {
        return view('frontend.specific.labels.index', [
            'labels' => Labels::orderby('name')->paginate(16),
        ]);
    }
    public function show(Labels $label)
    {
        $products__label_random = Product::with('images')->whereHas('labels', function($query) use ($label) {
            $query->where('id', $label->id);
        })->where('active',1)->inRandomOrder()->limit(6)->get();
        return view('frontend.specific.labels.show', [
            'label' => $label,
            'products' => $products__label_random,
        ]);
    }
}
