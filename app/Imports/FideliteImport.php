<?php

namespace App\Imports;

use App\Models\User;
use App\Models\userFidelite;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FideliteImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $value) {
            if($value[0] != null) {
                // Si la ligne existe
                $user = User::where('EBP_customer', $value[0])->first();
                if($user) {
                    // L'utilisateur correspondant est trouvé
                    $fidelite = userFidelite::where('user_id', $user->id)->first();
                    if($fidelite) {
                        // L'utilisateur possède déjà de la fidélité
                        $fidelite->points = $value[1];
                        $fidelite->update();
                    } else {
                        $fidelite = new userFidelite;
                        $fidelite->user_id = $user->id;
                        $fidelite->points = $value[1];
                        $fidelite->save();
                    }
                }
            }
        }
    }
}
