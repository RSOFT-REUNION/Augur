<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use App\Models\User;
use Illuminate\Http\Request;

class BackController extends Controller
{
    // Show dashboard
    public function showDashboard()
    {
        $data = [];
        $data['group'] = 'backend';
        $data['item'] = 'dashboard';
        return view('pages.backend.dashboard', $data);
    }

    // Show customers list
    public function showCustomerList()
    {
        $data = [];
        $data['group'] = 'backend';
        $data['item'] = 'customer';
        return view('pages.backend.customers.customers', $data);
    }

    // Show customers single
    public function showCustomerSingle($id)
    {
        $data = [];
        $data['group'] = 'backend';
        $data['item'] = 'customer';
        $data['customer'] = User::where('id', $id)->first();
        return view('pages.backend.customers.customer-single', $data);
    }

    // Show evenements page
    public function showEvenements()
    {
        $data = [];
        $data['group'] = 'backend';
        $data['item'] = 'evenement';
        return view('pages.backend.evenements.evenements', $data);
    }

    public function showEditEvenements($id)
    {
        $data = [];
        $data['group'] = 'backend';
        $data['item'] = 'evenement';
        $data['evenement'] = Evenement::where('id', $id)->first();
        return view('pages.backend.evenements.evenement-edit', $data);
    }

    // Show product list page
    public function showProducts()
    {
        $data = [];
        $data['group'] = 'backend';
        $data['item'] = 'product';
        return view('pages.backend.products.products', $data);
    }

    public function showAboutWebsite()
    {
        $data = [];
        $data['group'] = 'backend';
        $data['item'] = 'about';
        return view('pages.backend.about_website', $data);
    }

    public function showRecettes()
    {
        $data = [];
        $data['group'] = 'backend';
        $data['item'] = 'recette';
        return view('pages.backend.recettes.recettes', $data);
    }

    public function showTeam()
    {
        $data = [];
        $data['group'] = 'backend';
        $data['item'] = 'team';
        return view('pages.backend.teams', $data);
    }

    public function showMedias()
    {
        $data = [];
        $data['group'] = 'backend';
        $data['item'] = 'media';
        return view('pages.backend.medias.media-list', $data);
    }

}
