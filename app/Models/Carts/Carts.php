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
        if ($status == 'Abandonner') {
            echo '<span class="badge badge-danger">Abandonner</span>';
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
    public function countProductsPrice(?int $deliver_price_ttc, ?int $loyality)
    {
        $sum = 0;
        foreach ($this->product as $prod) {
            if($prod->discount_id) {
                $sum += ($prod->price_ttc * $prod->quantity) - (($prod->price_ttc * $prod->quantity) * $prod->discount_percentage) / 100;
            } else {
                $sum += $prod->price_ttc * $prod->quantity;
            }
        }
        if($loyality) {
            $sum = ($sum - (($loyality / 100) * $sum));
        }
        if($deliver_price_ttc) {
            $sum = ($sum + ($deliver_price_ttc * 100));
        }
        return $sum;
    }

}
