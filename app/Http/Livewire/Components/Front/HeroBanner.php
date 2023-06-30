<?php

namespace App\Http\Livewire\Components\Front;

use App\Models\CarouselMain;
use Livewire\Component;

class HeroBanner extends Component
{
    public function render()
    {
        $data = [];
        $data['mainCarousel'] = CarouselMain::all();
        return view('livewire.components.front.hero-banner', $data);
    }
}
