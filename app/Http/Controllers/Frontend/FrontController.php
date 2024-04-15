<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Content\Pages;
use App\Models\Backend\Settings\Informations;
use app\Models\Content\Carousel;
use Illuminate\Support\Facades\View;

class FrontController extends Controller
{
    public function __construct()
    {
        $infos = Informations::select('address','email','phone','fax')->where('id', 1)->first();
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
    public function legalnotice()
    {
        $legalnotice = Informations::select('legalnotice')->where('id', '=', '1')->first();
        return view('frontend.pages.legalnotice', [
            'legalnotice' => $legalnotice,
        ]);
    }
    public function termsofservice()
    {
        $termsofservice = Informations::select('termsofservice')->where('id', '=', '1')->first();
        return view('frontend.pages.termsofservice', [
            'termsofservice' => $termsofservice,
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
