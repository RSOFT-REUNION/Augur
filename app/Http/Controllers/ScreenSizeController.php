<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ScreenSizeController extends Controller
{
    public function update(Request $request)
    {
        $screenWidth = $request->input('screenWidth');
        $screenHeight = $request->input('screenHeight');

        // Effectuer le traitement avec les nouvelles informations de taille d'écran
        Session::put('screenSize', ['width' => $screenWidth, 'height' => $screenHeight]);

        return response()->json(['message' => 'Screen size updated successfully']);
    }
}
