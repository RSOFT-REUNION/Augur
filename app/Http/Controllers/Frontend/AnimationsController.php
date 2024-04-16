<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Content\Carousel;
use App\Models\Backend\Settings\Informations;
use App\Models\Specific\Animations;
use Illuminate\Support\Facades\View;

class AnimationsController extends Controller
{
    public function __construct()
    {
        $infos = Informations::select('address','email','phone','fax')->where('id', 1)->first();
        $sliders = Carousel::inRandomOrder()->get();
        View::share(['infos' => $infos, 'sliders' => $sliders]);
    }
    public function index()
    {
        $datenow = date('Y-m-d\\TH:i');
        $animations_avenir = Animations::orderBy('start_date','DESC')->where('start_date', '>=', $datenow)->get();
        $animations_encours = Animations::orderBy('start_date','DESC')
                                        ->where('start_date', '<=', $datenow)
                                        ->where('end_date', '>=', $datenow)
                                        ->get();
        $animations_old = Animations::orderBy('start_date','DESC')->where('end_date', '<=', $datenow)->get();
        return view('frontend.specific.animations.index', [
            'animations_avenir' => $animations_avenir,
            'animations_encours' => $animations_encours,
            'animations_old' => $animations_old,
        ]);
    }
}
