<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function getPicture()
    {
        if($this->media_id) {
            return Media::where('id', $this->media_id)->first()->title;
        } else {
            return 'none_picture.svg';
        }
    }

    public function isUsed()
    {
        $evenements = Evenement::where('shop_id', $this->id)->get();
        if($evenements->count() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}
