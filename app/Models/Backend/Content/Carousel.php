<?php

namespace App\Models\Backend\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $table = 'content_carousel';
    protected $fillable = ['name', 'image', 'description', 'title_url', 'url'];
}
