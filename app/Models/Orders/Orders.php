<?php

namespace App\Models\Orders;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    protected $table = 'orders';
    protected $fillable = [
        'ref_order',
        'user_id',
        'delivery_type',
        'delivery_location',
        'status_id',
        'total_ttc',
    ];

    public function user() {
        return $this->hasOne(User::class);
    }

    public function status() {
        return $this->hasOne(Status::class);
    }
}
