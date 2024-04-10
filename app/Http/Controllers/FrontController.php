<?php

namespace App\Http\Controllers;

use App\Http\Requests\Mail\ContactMailRequest;
use App\Mail\ContactMail;
use App\Models\Backend\Content\Pages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class FrontController extends Controller
{
    public function __construct()
    {
        $infos = DB::table('settings_informations')->where('id', 1)->first();
        View::share('infos', $infos);
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
