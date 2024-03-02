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
    public function show_option($option) {

        if (($_COOKIE['token'] ?? '') != env('RESTAURANT_TOKEN')) {
            return redirect()->route('logout');
        }

        $options = ['home' => 'Home', 'dashboard' => 'Dashboard', 'orders' => 'Orders', 'menu_items' => 'Menu Items', 'customers' => 'Customers'];


        if (!array_key_exists($option,$options)) {
            return abort(404);
        }
        return view('admin.admin_panel', ['page_title' => 'Admin Panel - Restaurant App', 'option' => $option, 'options' => $options]);
    }
}
