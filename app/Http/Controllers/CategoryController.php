<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
}
