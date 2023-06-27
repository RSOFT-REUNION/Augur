<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // Show General Setting page
    public function showGeneralSetting()
    {
        $data = [];
        $data['group'] = 'settings';
        $data['item'] = 'home';
        return view('pages.backend.settings.general', $data);
    }
}
