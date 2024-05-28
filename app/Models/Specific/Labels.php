<?php

namespace App\Models\Specific;

use App\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Labels extends Model
{
    protected $table = 'specific_labels';
    protected $fillable = ['name', 'image', 'description', 'favorite'];

    public function labels(): BelongsToMany
    {
        return $this->BelongsToMany (Product::class, 'catalog_product_labels');
    }

    public function getSlug(){
        return Str::slug($this->name);
    }
}
