<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Specific\Animations;

class AnimationsController extends FrontendBaseController
{
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
