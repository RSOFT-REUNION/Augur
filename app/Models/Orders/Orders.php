<?php

namespace App\Models\Orders;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    protected $table = 'orders';
    protected $fillable = ['id', 'reference', 'delivery_type', 'delivery_location', 'user_id', 'total', 'status_id'];

    public function user() {
        return $this->hasOne(User::class);
    }

    public function status() {
        return $this->hasOne(Status::class);
    }
}
