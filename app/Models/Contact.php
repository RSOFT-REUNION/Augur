<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public function getDate()
    {
        return date('d/m/Y H:i', strtotime($this->created_at));
    }

    // Savoir par le biais d'une icone si c'est lu on non
    public function getReadState()
    {
        if($this->read == 0) {
            return '<i class="fa-solid fa-circle-xmark text-red-500"></i>';
        } else {
            return '<i class="fa-solid fa-circle-check text-green-500"></i>';
        }
    }
}
