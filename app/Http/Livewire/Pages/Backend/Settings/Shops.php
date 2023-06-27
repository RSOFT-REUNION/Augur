<?php

namespace App\Http\Livewire\Pages\Backend\Settings;

use App\Models\Shop;
use Livewire\Component;

class Shops extends Component
{
    public function render()
    {
        $data = [];
        $data['shops'] = Shop::orderBy('title', 'asc')->get();
        return view('livewire.pages.backend.settings.shops', $data);
    }
}
