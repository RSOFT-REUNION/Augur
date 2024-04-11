<?php

namespace App\Http\Controllers;

use App\Models\Backend\Content\Carousel;
use App\Models\Backend\Content\Pages;
use App\Models\Backend\Settings\Informations;
use Illuminate\Support\Facades\View;

class FrontController extends Controller
{
    public function __construct()
    {
        $infos = Informations::where('id', 1)->first();
        $sliders = Carousel::inRandomOrder()->get();
        View::share(['infos' => $infos, 'sliders' => $sliders]);
    }
    public function index()
    {
        $pages = Pages::where('id', '=', '1')->first();
        return view('frontend.index', [
            'page' => $pages,
        ]);
    }

    public function pages(string $slug, Pages $pages)
    {
        $pages = $pages->where('slug', '=', '/'.$slug)->first();
        if($pages) {
            return view('frontend.pages.show', [
                'page' => $pages,
            ]);
        } else {
            return view('frontend.errors.404', [
                'page' => '',
            ]);
        }
    }
}
