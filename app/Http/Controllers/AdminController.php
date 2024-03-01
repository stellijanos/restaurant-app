<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{


    /**
     * Display the admin panel.
     * 
     * This methods cheks if the token cookie matches the expected value.
     * If the token is invalid or missing, it redirects the user to logout.
     * Otherwise, it displays the admin panel view.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show_admin_panel() {

        if (($_COOKIE['token'] ?? '') != env('RESTAURANT_TOKEN')) {
            return redirect()->route('logout');
        }
        return view('admin_panel');
    }
}


