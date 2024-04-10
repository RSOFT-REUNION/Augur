<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Settings\Teams\Administrator;
use Spatie\Permission\Traits\HasRoles;


class DashboardController extends Controller
{
    use HasRoles;

    public function index (Administrator $user) {
        return view('backend.dashboard');
    }
}
