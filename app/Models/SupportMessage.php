<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    use HasFactory;

    public function getType()
    {
        $type = [
            '', // Correspond à 0
            'Bugs bloquants rencontrés',
            'Bugs non bloquants rencontrés',
            'Demande d\'amélioration',
            'Demande d\'ajout de fonctionnalités',
            'Autres',
        ];
        return isset($type[$this->type]) ? $type[$this->type] : null;
    }
}
