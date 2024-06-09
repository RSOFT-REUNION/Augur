<?php

namespace App\Models\Orders;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orders extends Model
{
    use HasUuids;
    protected $table = 'orders';
    protected $fillable = [
        'total_ttc',
        'delivery_id',
        'delivery_price',
        'delivery_date',
        'delivery_slot',
        'user_id',
        'user_loyality_used',
        'user_name',
        'user_email',
        'user_delivery_address',
        'user_delivery_address2',
        'user_delivery_cities',
        'user_delivery_phone',
        'user_delivery_other_phone',
        'user_civilite',
        'user_first_name',
        'user_last_name',
        'user_birthday',
        'user_invoice_address',
        'user_invoice_address2',
        'user_invoice_cities',
        'user_invoice_phone',
        'user_invoice_other_phone',
        'user_invoice_civilite',
        'user_invoice_first_name',
        'user_invoice_last_name',
    ];

    public function User() {
        return $this->hasOne(User::class);
    }
    public function Status() {
        return $this->hasOne(Status::class);
    }
    public function Product(): HasMany
    {
        return $this->hasMany(OrderProducts::class);
    }
}
