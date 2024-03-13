<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index() {
        
        return view('index',  ['page_title' => 'Home - Restaurant App']);
    }


    public function show_menu() {

        $categories = Category::whereHas('food', function($query) {
            $query->where('show_on_menu', '=', '1')
                    ->orderBy('menu_position');
        })
        ->where('show_on_menu', '=', 1) 
        ->orderBy('menu_position')
        ->get();
        return view('menu.index', [
            'page_title' => 'Menu - Restaurant app',
            'categories' => $categories
        ]);
    }
}

