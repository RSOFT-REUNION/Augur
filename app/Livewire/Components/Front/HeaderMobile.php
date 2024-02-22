<?php

namespace App\Livewire\Components\Front;

use Livewire\Component;

class HeaderMobile extends Component
{
    public $menu = false;
    public function render()
    {
        $data = [];
        $data['menu'] = $this->menu;
        return view('livewire.components.front.header-mobile', $data);
    }
}
