<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Shop;
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

    // Show Shops Setting page
    public function showShopSetting()
    {
        $data = [];
        $data['group'] = 'settings';
        $data['item'] = 'shop';
        return view('pages.backend.settings.shops', $data);
    }
    // Show part 2 of Creation to new Shop
    public function showShopCreatePart2($id)
    {
        $data = [];
        $data['group'] = 'settings';
        $data['item'] = 'shop';
        $data['shop'] = Shop::where('id', $id)->first();
        return view('pages.backend.settings.shop-add-part_2', $data);
    }

    public function postShopCreatePart2(Request $request)
    {
        $shop = Shop::where('id', $request->shop_id)->first();
        $shop->schedules = $request->schedules;
        $shop->title = $request->title;
        $shop->address = $request->address;
        $shop->postal_code = $request->postal_code;
        $shop->city = $request->city;
        $shop->page_content = $request->page_content;
        if($shop->update()) {
            return redirect()->route('bo.setting.shop');
        } else {
        }
    }

    public function showLegalMentions()
    {
        $data = [];
        $data['group'] = 'settings';
        $data['item'] = 'legal';
        $data['setting'] = GeneralSetting::where('id', 1)->first();
        return view('pages.backend.settings.legal-mentions', $data);
    }

    public function postLegalMention(Request $request)
    {
        $setting = GeneralSetting::where('id', 1)->first();
        $setting->legal_mention = $request->legal;
        if($setting->update()) {
            return redirect()->route('bo.setting.legal')->with('success', 'Vos mentions légales ont bien été mise à jour');
        }
    }

    public function showConditions()
    {
        $data = [];
        $data['group'] = 'settings';
        $data['item'] = 'conditions';
        $data['setting'] = GeneralSetting::where('id', 1)->first();
        return view('pages.backend.settings.conditions', $data);
    }

    public function postConditions(Request $request)
    {
        $setting = GeneralSetting::where('id', 1)->first();
        $setting->conditions = $request->conditions;
        if($setting->update()) {
            return redirect()->route('bo.setting.conditions')->with('success', 'Vos conditions générales d\'utilisation ont bien été mise à jour');
        }
    }
}
