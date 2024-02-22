<?php

namespace App\Livewire\Pages\Backend\Settings;

use App\Models\Shop;
use Livewire\Component;

class Shops extends Component
{
    public function delete($id)
    {
        $shop = Shop::where('id', $id)->first();
        $shop->delete();
        return redirect()->route('bo.setting.shop');
    }
    public function render()
    {
        $data = [];
        $data['shops'] = Shop::orderBy('title', 'asc')->get();
        return view('livewire.pages.backend.settings.shops', $data);
    }
}
