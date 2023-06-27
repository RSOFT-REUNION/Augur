<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    public function getDate()
    {
        if(!$this->more_date) {
            return date('d/m/Y', strtotime($this->date));
        } else {
            return date('d/m/Y', strtotime($this->start_date)). ' au '. date('d/m/Y', strtotime($this->end_date)) ;
        }
    }

    public function getShop()
    {
        if(!$this->all_shops) {
            return Shop::where('id', $this->shop_id)->first()->title;
        } else {
            return "Tous les magasins";
        }
    }
}
