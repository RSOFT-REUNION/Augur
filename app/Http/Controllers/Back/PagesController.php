<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function showGeneral()
    {
        $data = [];
        $data['group'] = 'pages';
        $data['item'] = 'home';
        return view('pages.backend.pages.general', $data);
    }

    public function showAbout()
    {
        $data = [];
        $data['group'] = 'pages';
        $data['item'] = 'about';
        $data['page'] = Pages::where('key', 'about')->first();
        return view('pages.backend.pages.about', $data);
    }

    public function postAbout(Request $request)
    {
        $page = Pages::where('key', 'about')->first();
        if($page) {
            $page->content = $request->page_content;
            if($page->update()) {
                return redirect()->route('bo.pages.about');
            }
        } else {
            $p = new Pages;
            $p->key = 'about';
            $p->content = $request->page_content;
            if($p->save()) {
                return redirect()->route('bo.pages.about');
            }
        }
    }
}
