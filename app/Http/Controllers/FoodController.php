<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{


    
    /**
     * Display the menu items page of the admin panel.
     * 
     * This method returns a view that represents the menu items page of the admin panel.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show_menu_items() {
        return view('admin.admin_panel',[
            'page_title' => 'Admin Panel - Restaurant App',
            'categories' => Category::orderBy('name')->get(),
            'foods' => Food::orderBy('menu_position')->get()
        ]);
    }


    public function create() {
        $food = new Food();

        $food->name = request()->get('name') ?? '';
        $food->price = request()->get('price') ?? 0;
        $food->weight = request()->get('weight') ?? 0;
        $food->category_id = request()->get('category') ??Category::get()->first()->id;

        $food->save();

        return redirect('admin_panel_menu_items')->with('message', 'Menu item added successfully!');
    }
}
