<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Activity extends Model
{
    use HasFactory;

    public function getDate()
    {
        $date = Carbon::parse($this->created_at)->timezone('Indian/Reunion');
        $formattedDate = $date->format('d/m/Y H:i');
        return $formattedDate;
    }
}
