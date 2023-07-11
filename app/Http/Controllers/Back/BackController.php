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

    /*
     * ----------------- EVENEMENTS
     */
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

    public function editEvenements(Request $request, $id)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
        ]);
        $evenement = Evenement::where('id', $id)->first();
        if($evenement->title != $request->title) {
            $evenement->title = $request->title;
        }
        if($evenement->description_short != $request->description) {
            $evenement->description_short = $request->description;
        }
        if($evenement->one_day == 1) {
            if($evenement->date != $request->date) {
                $evenement->date = $request->date;
            }
        } else {
            if($evenement->start_date != $request->start_date) {
                $evenement->start_date = $request->start_date;
            }
            if($evenement->end_date != $request->end_date) {
                $evenement->end_date = $request->end_date;
            }
        }
        if($evenement->start_time != $request->start_time) {
            $evenement->start_time = $request->start_time;
        }
        if($evenement->end_time != $request->end_time) {
            $evenement->end_time = $request->end_time;
        }
        if($evenement->page_content != $request->page_content) {
            $evenement->page_content = request('page_content');
        }
        if($evenement->update())
        {
            return redirect()->route('bo.evenements');
        }
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
    public function showAddRecettes()
    {
        $data = [];
        $data['group'] = 'backend';
        $data['item'] = 'recette';
        return view('pages.backend.recettes.recettes-add', $data);
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
