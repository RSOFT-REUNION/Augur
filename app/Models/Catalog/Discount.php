<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'catalog_discounts';
    protected $fillable = ['code', 'name', 'image', 'description', 'discount_rule_id', 'start_date', 'end_date', 'active'];

    public function details(): hasMany
    {
        return $this->hasMany(DiscountDetail::class);
    }

    public function rule(): BelongsTo
    {
        return $this->belongsTo(DiscountRule::class);
    }

}
