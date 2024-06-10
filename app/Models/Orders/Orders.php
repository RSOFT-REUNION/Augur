<?php

namespace App\Models\Orders;

use App\Models\Users\Cities;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orders extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'status_id',
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
    public function getStatus()
    {
        if($this->status_id == 1) {
            echo '<span class="badge bg-warning text-dark">En attente de paiement</span>';
        } elseif ($this->status_id == 2 ) {
            echo '<span class="badge bg-danger">Annulé</span>';
        } elseif ($this->status_id == 3 ) {
            echo '<span class="badge bg-success">Paiement accepté</span>';
        } elseif ($this->status_id == 4 ) {
            echo '<span class="badge bg-primary">En cours de préparation</span>';
        } elseif ($this->status_id == 5 ) {
            echo '<span class="badge bg-success">Prêt pour livraison</span>';
        } elseif ($this->status_id == 6 ) {
            echo '<span class="badge bg-info text-dark">En cours de livraison</span>';
        } elseif ($this->status_id == 7 ) {
            echo '<span class="badge bg-success">Livré</span>';
        } elseif ($this->status_id == 8 ) {
            echo '<span class="badge bg-danger">Remboursé</span>';
        }
    }
    public function getDeliverName(){
        return Delivery::where('id', $this->delivery_id)->pluck('name')->first();
    }
    public function getCity()
    {
        return Cities::where('postal_code', $this->user_delivery_cities)->pluck('city')->first();
    }
    public function getInvoiceCity()
    {
        return Cities::where('postal_code', $this->user_invoice_cities)->pluck('city')->first();
    }
}
