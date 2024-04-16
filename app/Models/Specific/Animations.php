<?php

namespace App\Models\Specific;

use App\Models\Backend\Catalog\Shop;
use Illuminate\Database\Eloquent\Model;

class Animations extends Model
{
    protected $table = 'specific_animations';
    protected $fillable = ['name', 'image', 'description', 'start_date', 'end_date', 'shops_id'];

    public function getShopsName($shops_id)
    {
            return Shop::where('id', '=', $shops_id)->pluck('title')->first();
    }
}
