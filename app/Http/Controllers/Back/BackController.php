<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
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

    // Show product list page
    public function showProducts()
    {
        $data = [];
        $data['group'] = 'backend';
        $data['item'] = 'product';
        return view('pages.backend.products.products', $data);
    }


}
