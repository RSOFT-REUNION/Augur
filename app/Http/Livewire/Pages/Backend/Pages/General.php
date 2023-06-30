<?php

namespace App\Http\Livewire\Pages\Backend\Pages;

use App\Models\CarouselMain;
use Livewire\Component;

class General extends Component
{
    public function deleteCarousel($id)
    {
        $carousel = CarouselMain::where('id', $id)->first();
        $carousel->delete();
        return redirect()->route('bo.pages.general');
    }
    public function render()
    {
        $data = [];
        $data['mainCarousel'] = CarouselMain::orderBy('id', 'asc')->get();
        return view('livewire.pages.backend.pages.general', $data);
    }
}
