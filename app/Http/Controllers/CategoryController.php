<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * Create a category.
     * 
     * This method creates a new category using the name provided in the request.
     * After creating the category, it redirects the user to the admin panel menu cateogries page
     * with a success message indicating that the category was added successfully.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create() {
        $category = new Category();
        $category->name = request()->get('category_name');
        $category->save();

        return redirect()->route('admin_panel_menu_categories')->with('create_message', 'Category added successfully!');
    }


    public function update($id) {

        try {

            $category = Category::findOrFail($id);
            echo  request()->get('menu-position-'.$category->menu_position);
            $category->name = request()->get('name') ?? $category->name;
            $category->show_on_menu = request()->has('show') ? 1 : 0;
            $category->menu_position = request()->get('menu-position-'.$category->menu_position) ?? $category->menu_position;
            $category->save();
            // echo $category->menu_position;
            // return redirect()->route('admin_panel_menu_categories')->with('message');
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    public function delete($id) {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()->route('admin_panel_menu_categories')->with('message');
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    public function update_all() {

        $data = request()->all();

        print_r($data);

        // return redirect()->route('admin_panel_menu_categories')->with('message');
    }
}


