<?php

namespace App\Http\Controllers\Backend\Clients;

use App\Http\Controllers\Controller;
use App\Models\Carts\Carts;
use App\Models\Users\Address;
use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.clients.index', [
            'clients' => User::orderBy('id','DESC')->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $client)
    {
        $client->delete();
        return back()->withSuccess('Clients supprimée avec succès');
    }

    /**
     * Liste des adresses du client
     */
    public function addresses(User $client)
    {
        return view('backend.clients.addresses', [
            'client' => $client,
            'addresses' => Address::where('user_id', '=', $client->id)->get(),
        ]);
    }

    /**
     * Display a listing of Carts.
     */
    public function carts_index()
    {
        /*** Mise a jour des status en Abandonner apres 1 Mois ***/
        $carts = Carts::where('status', 'En cours')->orderBy('id','DESC')->get();
        foreach ($carts as $cart) {
            $d = date("Y-m-d\\TH:i",strtotime("-1 Months"));
            if($cart->created_at <= $d){
                $cart->status = "Abandonner";
                $cart->save();
            }
        }
        return view('backend.clients.carts', [
            'carts' => Carts::orderBy('id','DESC')->get()
        ]);
    }

    public function importcsv(Request $request)
    {
        $i = 0;
        $logtxt = 'Import du fichier '.$request->csv->getClientOriginalName() .', Le '. date('Y-m-d H:i:s').PHP_EOL ;
        foreach (csvToArray($request->csv) as $csv) {
            if($csv["erp_id"] != "PASSAGE") {
                if(!empty($csv["email"])) {
                    /*** Création de l'utilisateur ***/
                    $user = new User;
                    $user->name = ucfirst(strtolower(($csv["name"])));
                    $user->email = strtolower($csv["email"]);
                    $user->phone = $csv["phone"];
                    $user->erp_id = $csv["erp_id"];
                    $user->erp_loyalty_card = $csv["erp_loyalty_card"];
                    $user->active = 1;
                    $user->newsletter = 1;
                    $user->save();
                    /*** Création de l'adresse par dafault ***/
                    if(!empty($csv["address"])) {
                        $address = new Address;
                        $address->user_id = $user->id;
                        $address->alias = $csv["adrress_alias"];
                        $address->name = ucfirst(strtolower(($csv["name"])));
                        $address->address = $csv["address"];
                        $address->address2 = $csv["address2"];
                        $address->postal_code = $csv["postal_code"];
                        $address->city = $csv["city"];
                        $address->country = "La réunion";
                        $address->phone = $csv["phone"];
                        $address->other_phone = $csv["other_phone"];
                        $address->save();
                    }
                    $i++;
                    $logtxt .= $csv["erp_id"].' : ok'.PHP_EOL;
                } else {
                    $logtxt .= $csv["erp_id"].' : Client non importé, Aucune adresse mail'.PHP_EOL;
                }
            }
        }
        Storage::disk('local')->put('/import/users/import_'.date('Y_m_d_H_i_s').'.txt', $logtxt);
        return back()->withSuccess($i.' clients importer avec succès');
    }

}
