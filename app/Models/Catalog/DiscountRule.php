<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiscountRule extends Model
{
    use HasFactory;
    protected $table = 'catalog_discounts_rules';

    protected $fillable = ['code', 'name', 'formula', 'description', 'active'];

    public function discounts(): hasMany
    {
        return $this->hasMany(Discount::class);
    }

}
