<?php

namespace App\Http\Livewire\Components\Back;

use Livewire\Component;

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
        return view('livewire.components.back.sidebar-nav');
    }
}
