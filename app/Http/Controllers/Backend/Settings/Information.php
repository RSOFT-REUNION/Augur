<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Settings\InformationsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Information extends Controller
{
    /**
     * Informations
     */
    public function index()
    {
        return view('backend.settings.informations.index', [
            'infos' => DB::table('settings_informations')->where('id', 1)->first()
        ]);
    }
    public function update(InformationsRequest $request)
    {
        DB::table('settings_informations')
            ->where('id', 1)
            ->update(['address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'fax' => $request->input('fax'),
            'email' => $request->input('email')
        ]);
        return back()->with('success', 'Mise à jour effectuée avec success');
    }

    /**
     * Mentions Legale
     */
    public function legalnoticeindex()
    {
        return view('backend.settings.informations.legalnotice', [
            'infos' => DB::table('settings_informations')->where('id', 1)->first()
        ]);
    }

    public function legalnoticeupdate(Request $request)
    {
        DB::table('settings_informations')
            ->where('id', 1)
            ->update(['legalnotice' => $request->input('legalnotice')]);
        return back()->with('success', 'Mise à jour effectuée avec success');
    }

    /**
     * Mentions Legale
     */
    public function termsofserviceindex()
    {
        return view('backend.settings.informations.termsofservice', [
            'infos' => DB::table('settings_informations')->where('id', 1)->first()
        ]);
    }

    public function termsofserviceupdate(Request $request)
    {
        DB::table('settings_informations')
            ->where('id', 1)
            ->update(['termsofservice' => $request->input('termsofservice')]);
        return back()->with('success', 'Mise à jour effectuée avec success');
    }

}
