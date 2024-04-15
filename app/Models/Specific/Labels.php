<?php

namespace App\Models\Specific;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labels extends Model
{
    protected $table = 'specific_labels';
    protected $fillable = ['name', 'image', 'description'];
}
