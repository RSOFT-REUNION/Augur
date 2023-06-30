<?php

namespace App\Http\Livewire\Pages\Backend\Medias;

use App\Models\Media;
use Livewire\Component;

class MediaList extends Component
{
    public function render()
    {
        $data = [];
        $data['media_product'] = Media::where('type', 1)->get();
        return view('livewire.pages.backend.medias.media-list', $data);
    }
}
