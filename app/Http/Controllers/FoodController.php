<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
   

    public function create() {


        // request()->validate([
        //     'name' => 'required|string|min:1|max:64',
        //     'price' => 'required|numeric|min:0',
        //     'weight' => 'required|numeric|min:0',
        //     'category' => 'required|numeric|min:1'
        // ]);

        $food = new Food();

        $food->name = request()->get('name') ?? '';
        $food->price = request()->get('price') ?? 0;
        $food->weight = request()->get('weight') ?? 0;
        $food->category_id = request()->get('category') ??Category::get()->first()->id;

        $food->save();
            
        return redirect()->route('admin_panel_show_menu_items')->with('message', 'Menu item added successfully!');
    }

    public function show_menu_items() {
        return view('admin.admin_panel',[
            'page_title' => 'Admin Panel - Restaurant App',
            'categories' => Category::orderBy('name')->get(),
            'foods' => null,
            'option' => 'menu_items'
        ]);
    }



    public function update($id) {

    }

    public function patch($id) {

    }


    public function delete($id) {

    }



    public function get_by_category() {

        $id = request()->get('category') ?? 0;

        if ($id == 0) {
            return redirect()->route('admin_panel_show_menu_items');
        }

        try {
            $category = Category::findOrFail($id);
            return redirect()->route('admin_panel_show_menu_items_by_category', ['id' => $category->id]);
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }


    public function show_by_category($id) {

        return view('admin.admin_panel',[
            'page_title' => 'Admin Panel - Restaurant App',
            'categories' => Category::orderBy('name')->get(),
            'foods' => Food::where('category_id', $id)->orderBy('menu_position')->get(),
            'option' => 'menu_items',
            'category_name' => Category::find($id)->name
        ]);
    }
}
