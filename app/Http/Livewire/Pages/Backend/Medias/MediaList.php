<?php

namespace App\Http\Livewire\Pages\Backend\Medias;

use App\Models\CarouselMain;
use App\Models\Evenement;
use App\Models\Label;
use App\Models\Media;
use App\Models\Product;
use App\Models\Shop;
use Livewire\Component;
use Livewire\WithPagination;

class MediaList extends Component
{
    use WithPagination;
    public $selected;

    public function deleteMedia($id)
    {
        $media = Media::where('id', $id)->first();
        $products = Product::where('media_id', $media->id)->get();
        $shops = Shop::where('media_id', $media->id)->get();
        $labels = Label::where('media_id', $media->id)->get();
        $evenements = Evenement::where('media_id', $media->id)->get();
        $main_carousel = CarouselMain::where('media_id', $media->id)->get();
        if($products->count() > 0) {
            foreach ($products as $product) {
                $product->media_id = null;
                $product->update();
                $media->delete();
            }
        }
        if($shops->count() > 0) {
            foreach ($shops as $shop) {
                $shop->media_id = null;
                $shop->update();
                $media->delete();
            }
        }
        if($labels->count() > 0) {
            foreach ($labels as $label) {
                $label->media_id = 1;
                $label->update();
                $media->delete();
            }
        }

        return redirect()->route('bo.media');
    }

    public function render()
    {
        $data = [];
        $data['medias'] = Media::paginate(15);
        $data['media_selected'] = Media::where('id', $this->selected)->first();
        return view('livewire.pages.backend.medias.media-list', $data);
    }
}
