<?php

namespace App\Http\Livewire\Components\Back;

use Livewire\Component;
use App\Models\GeneralSetting;

class SidebarNav extends Component
{
    public $group, $item;

    public function mount($group, $item)
    {
        $this->group = $group;
        $this->item = $item;
    }

    public function render()
    {
        $data['whoAreWe'] = GeneralSetting::first();
        return view('livewire.components.back.sidebar-nav', $data);
    }
}
