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
    public function show() {
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

        $rules = [
            'category_name' => 'required|string|min:1|max:64'
        ];

        request()->validate($rules);

        $category = new Category();
        $category->name = request()->get('category_name');
        $category->menu_position = Category::count()+1;
        $category->save();

        return redirect()->route('admin_panel_show_menu_categories')->with('create_message', 'Category added successfully!');
    }



    /**
     * Update a category
     * 
     * This method updated an existing category with the provided Id.
     * It validates the incoming request to ensure the 'name' field is provided and meets the specified criteria.
     * If the category is found, its name attribute is updated based on the request.
     * After updating the category, the user is redirected to the admin panel menu categories page.
     * 
     * @param int $id The Id of the category to update
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id) {

    
        try {
            $category = Category::findOrFail($id);
            $category->name = request()->get('name') ?? $category->name;
            $category->save();
            return redirect()->back();
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }



    /**
     * Update category positions.
     * 
     * This method updates the positions of two categories.
     * It finds the categories with the provided Id's. 
     * It swaps their 'menu_position' attributes.
     * After updateing the positions, it redirects the user to the admin panel menu categories page.
     * 
     * @param int $id The id of one of the categories to update
     * @return \Illuminate\Http\RedirectResponse
     */
    public function patch($id) {

        try {
            $category = Category::findOrFail($id);

            $otherCategory = Category::findOrFail(request()->get('prev'));
            [$category->menu_position, $otherCategory->menu_position] = [$otherCategory->menu_position,  $category->menu_position];

            $category->save();
            $otherCategory->save();

            return redirect()->back()->with('message', 'Moved successfully!');

        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }



    /**
     * Delete a category.
     * 
     * This method deletes a category with the provided Id.
     * It first attempts to find the category using its Id.
     * Then it updates the 'menu_position' of categories with a higher position than the deleted category.
     * After updating the menu positions, it deletes the category.
     * Finally, it redirects the user to the admin panel menu categories page.
     * 
     * @param int $id The Id of the category to delete
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {
        try {
            $category = Category::findOrFail($id);
            $menu_position = $category->menu_position;
            $category->delete();
            DB::update("UPDATE categories set menu_position = menu_position - 1 WHERE menu_position > ? ", [$menu_position]);
            return redirect()->route('admin_panel_show_menu_categories')->with('message');
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

}

