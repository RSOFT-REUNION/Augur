<?php

namespace App\Http\Controllers\Backend\Clients;

use App\Http\Controllers\Controller;
use App\Models\Users\Address;
use App\Models\User;

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
}
