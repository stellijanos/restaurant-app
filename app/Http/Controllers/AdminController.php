<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    /**
     * Display the home page of the admin panel.
     * 
     * This methods returns a view that represents the home page of the admin panel.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show_home() {
        return view('admin.admin_panel', [
            'page_title' => 'Admin Panel - Restaurant App'
        ]);
    }


    /**
     * Display the orders page of the admin panel.
     * 
     * This method returns a view that represents the orders page of the admin panel.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show_orders() {
        return view('admin.admin_panel',[
            'page_title' => 'Admin Panel - Restaurant App'
        ]);
    }

 
    /**
     * Display the customers page of the admin panel.
     * 
     * This method returns a view that represents the customers page of the admin panel.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show_customers() {
        return view('admin.admin_panel',[
            'page_title' => 'Admin Panel - Restaurant App'
        ]);
    }


    public function show_edit_menu() {
        return view('admin.admin_panel', [
            'page_title' => 'Admin Panel - Restaurant App',
            'categories' => Category::orderBy('menu_position')->get()
        ]);
    }


}

