<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Content\Carousel;
use App\Models\Backend\Settings\Informations;
use App\Models\Specific\Labels;
use Illuminate\Support\Facades\View;

class LabelsController extends Controller
{
    public function __construct()
    {
        $infos = Informations::select('address','email','phone','fax')->where('id', 1)->first();
        $sliders = Carousel::inRandomOrder()->get();
        View::share(['infos' => $infos, 'sliders' => $sliders]);
    }
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
