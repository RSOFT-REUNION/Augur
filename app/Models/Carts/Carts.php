<?php

namespace App\Models\Carts;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carts extends Model
{
    use HasFactory;

    protected $fillable = ['session_id', 'user_id', 'status', 'delivery_id' , 'delivery_price', 'total_ttc'];

    public function Product(): HasMany
    {
        return $this->hasMany(CartsProducts::class);
    }

    public function getUser($user)
    {
        if($user = User::where('id', $user)->first()) {
            return $user->name .' '. $user->first_name .' ('. $user->email.')';
        } else {
            return 'Utilisateur non enregistré';
        }
    }
    public function getStatus($status)
    {
        if ($status == 'En cours') {
            echo '<span class="badge badge-warning">En cours</span>';
        }
        if ($status == 'Abandoner') {
            echo '<span class="badge badge-danger">Abandoner</span>';
        }
        if ($status == 'Commander') {
            echo '<span class="badge badge-success">Commander</span>';
        }
    }

    public function priceProductQuantity($product_id)
    {
        $price = 0;
        foreach ($this->product as $prod) {
            if($prod->id == $product_id) {
                $price += $prod->price_ttc * $prod->quantity;
            }
        }
        return $price;
    }
    public function countProduct()
    {
        $sum = 0;
        foreach ($this->product as $prod) {
            $sum += $prod->quantity;
        }
        return $sum;
    }
    public function countProductsPrice()
    {
        $sum = 0;
        foreach ($this->product as $prod) {
            $sum += $prod->price_ttc * $prod->quantity;
        }
        return $sum;
    }

}
