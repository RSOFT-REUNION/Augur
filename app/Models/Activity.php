<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    public function getDate()
    {
        return date('d/m/Y H:i', strtotime($this->created_at));
    }
}
