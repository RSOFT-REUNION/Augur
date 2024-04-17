<?php

namespace App\Models\Backend\Orders;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{

    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['id', 'reference', 'delivery_type', 'delivery_location', 'customer_id', 'total', 'status'];


    /**
     * Retourne le nom du client
     */
    public function getCustomerName($user_id)
    {
        return User::find($user_id)->value('name');
    }
}
