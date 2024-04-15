<?php

namespace App\Models\Specific;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Labels extends Model
{
    protected $table = 'specific_labels';
    protected $fillable = ['name', 'image', 'description'];

    public function getSlug(){
        return Str::slug($this->name);
    }
}
