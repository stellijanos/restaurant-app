<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{



    /**
     * Display the menu cateogories page of the admin panel.
     * 
     * This method returns a view that represents the menu categories page of the admin panel.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show_menu_categories() {
        return view('admin.admin_panel', [
            'page_title' => 'Admin Panel - Restaurant App', 
            'categories' => Category::orderBy('menu_position')->get()
        ]);
    }



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
        $category->menu_position = Category::count()+1;
        $category->save();

        return redirect()->route('admin_panel_menu_categories')->with('create_message', 'Category added successfully!');
    }


    public function update($id) {

        try {

            $category = Category::findOrFail($id);
            echo  request()->get('menu-position-'.$category->menu_position);
            $category->name = request()->get('name') ?? $category->name;
            $category->show_on_menu = request()->has('show') ? 1 : 0;
            $category->save();
            // echo $category->menu_position;
            return redirect()->route('admin_panel_menu_categories')->with('message');
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    public function delete($id) {
        try {
            $category = Category::findOrFail($id);
            $menu_position = $category->menu_position;
            DB::update("UPDATE categories set menu_position = menu_position - 1 WHERE menu_position > ? ", [$menu_position]);
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

    public function update_category_patch($id) {
        print_r(request()->all());

        try {
            $category = Category::findOrFail($id);

            $otherCategory = Category::findOrFail(request()->get('prev'));
            [$category->menu_position, $otherCategory->menu_position] = [$otherCategory->menu_position,  $category->menu_position];

            $category->save();
            $otherCategory->save();

            return redirect()->route('admin_panel_menu_categories')->with('message', 'Moved successfully!');

        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }
}


