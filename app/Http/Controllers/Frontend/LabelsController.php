<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Specific\Labels;

class LabelsController extends FrontendBaseController
{
    public function index()
    {
        $labels = Labels::paginate(16);
        return view('frontend.specific.labels.index', [
            'labels' => $labels,
        ]);
    }
    public function show(Labels $label)
    {
        return view('frontend.specific.labels.show', [
            'label' => $label
        ]);
    }
}
