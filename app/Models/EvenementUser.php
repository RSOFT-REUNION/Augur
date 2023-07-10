<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenementUser extends Model
{
    use HasFactory;

    public function getEvenement()
    {
        return Evenement::where('id', $this->evenement_id)->first();
    }
}
