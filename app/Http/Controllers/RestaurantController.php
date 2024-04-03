<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\HomepageImage;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{

    
    /**
     * Displays the menu page with categories and their associated foods.
     * Retrieves categories with at least one food item marked to be shown on the menu. 
     * Orders categories by their menu position.
     * Eager loads food items for each category that are marked to be shown on the mneu, ordering them by menu position
     * Returns the view to display the menu page with relevant data.
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
            'page_title' => 'Home - Restaurant app',
            'categories' => $categories
        ]);
    }



    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function show_disclaimer() {
        return view('disclaimer', [
            'page_title' => 'Disclaimer - Restaurant App'
        ]);
    }
}
