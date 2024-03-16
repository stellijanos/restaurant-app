<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{


    /**
     * Displays the home page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {

        return view('index',  ['page_title' => 'Home - Restaurant App']);
    }


    /**
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show_menu() {

        $categories = Category::whereHas('food', function($query) {
            $query->where('show_on_menu', '=', 1);
        })
        ->orderBy('menu_position')
        ->with(['food' => function($query) {
            $query->where('show_on_menu', '=', 1)
            ->orderBy('menu_position');
        }])
        ->get();
        return view('menu.index', [
            'page_title' => 'Menu - Restaurant app',
            'categories' => $categories
        ]);
    }
}
