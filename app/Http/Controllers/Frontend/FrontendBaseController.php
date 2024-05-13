<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Content\Carousel;
use App\Models\Content\Pages;
use App\Models\Settings\Informations;
use Illuminate\Support\Facades\View;

class FrontendBaseController extends Controller
{
    public function __construct()
    {
        $infos = Informations::select('address','email','phone','fax')->where('id', 1)->first();
        $sliders = Carousel::inRandomOrder()->get();
        $menu = Pages::select('name', 'slug')->where('is_menu', 1)->where('active', 1)->get();
        View::share(['infos' => $infos, 'sliders' => $sliders, 'menu' => $menu]);
    }
}
