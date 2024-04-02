<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{

    private function getNrOfFoodForEachCategory() {
        return Category::leftJoin('food', 'categories.id', '=', 'food.category_id')
                        ->select('categories.id as id','categories.name as name', DB::raw('COUNT(food.id) as count'))
                        ->orderBy('categories.name')
                        ->groupBy('categories.id', 'categories.name')->get();
    }



    /**
     * Display the menu items page of the admin panel.
     * 
     * This method returns a view that represents the menu items page of the admin panel.
     * 
     * @return \Illuminate\Contracts\View\View
     */
     public function show_menu_items() {
        return view('admin.options.menu_items.index',[
            'page_title' => 'Admin Panel - Restaurant App',
            'categories' => $this->getNrOfFoodForEachCategory(),
            'foods' => null,
            'option' => 'menu_items'
        ]);
    }



    /**
     * Display the items by category.
     * 
     * Retrieves and displays menu items belonging to the specified category.
     * If the category does not exist, it aborts with a 404 error.
     * 
     * @param int $Id the Id of the category/
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show_by_category($id) {
        try {
            $category = Category::findOrFail($id);
            return view('admin.admin_panel',[
                'page_title' => 'Admin Panel - Restaurant App',
                'foods' => Food::where('category_id', $id)->orderBy('menu_position')->get(),
                'categories' => $this->getNrOfFoodForEachCategory(),
                'option' => 'menu_items',
                'category_name' => $category->name
            ]);

        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }



    /**
     * Redirect to menu items filtered by category.
     * 
     * If a category Id is provided, it redirects to the admin panel to display
     * menu items belonging to that category. If no category Id is provided,
     * it redirects to the admin panel to display all menu items.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
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


   
    /**
     * Create a new menu item
     * 
     * Validates the incoming request data for createing a new menu item.
     * If the validation passes, a new menu item is created and saved to the database,
     * then it redirects to the admin panel to display menu items filtered by the category
     * to which the new item belongs.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create() {

        request()->validate([
            'name' => 'required|string|min:1|max:64',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'category' => 'required|numeric|min:1',
            'item_image' => 'required|file|mimes:jpeg,jpg,png|max:2048'
        ]);

        $food = new Food();

        $food->name = request()->get('name');
        $food->price = request()->get('price');
        $food->weight = request()->get('weight');
        $food->category_id = request()->get('category');
        
        $nr_of_category = Food::where('category_id', $food->category_id)->count();
        $food->menu_position = $nr_of_category + 1;

        $file = request()->file('item_image');
        $file_name = bin2hex(random_bytes(10)).'.'. $file->getClientOriginalExtension();
        Storage::putFileAs('public/images/menu_items', $file, $file_name);

        $food->image = $file_name;
        $food->save();

        return redirect()->route('admin_panel_show_menu_items_by_category', ['id' => $food->category_id])->with('message', 'Menu item added successfully!');
    }



    /**
     * Update an existing menu item.
     * 
     * Validates the request data for updateing a menu item.
     * If the validation passes and the menu item with the specified Id exists,
     * its attributes are updated and saved to the database.
     * If a new image is provided in the request, it replaces the existing image
     * after deleting the old one from the storage.
     * then it redirects to the admin panel to display menu items filtered by
     * the category to which the updated item belongs.
     * 
     * @param int $id the Id of the menu item to update.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id) {

        request()->validate([
            'name' => 'required|string|min:1|max:64',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'category' => 'required|numeric|min:1'
        ]);

        try {

            $food = Food::findOrFail($id);

            $food->name = request()->get('name');
            $food->price = request()->get('price');
            $food->weight = request()->get('weight');
            $food->category_id = request()->get('category');
            $food->show_on_menu = request()->has('show') ? 1 : 0;


            if (request()->has('remove_image')) {

                Storage::delete('public/images/menu_items/'.$food->image);
                $food->image = 'blank_image.png';
            } 
            
            else if (request()->hasFile('new_image')) {

                $file = request()->file('new_image');
                $file_name = bin2hex(random_bytes(10)).'.'. $file->getClientOriginalExtension();
                
                Storage::delete('public/images/menu_items/'.$food->image);
                Storage::putFileAs('public/images/menu_items', $file, $file_name);
    
                $food->image = $file_name;
            }

            $food->save();

            return redirect()->back()->with('message', 'Menu item updated successfully!');

        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }



    /**
     * Update the menu position of two menu items.
     * 
     * This method is used to update the menu positions of two menu items.
     * It swaps the menu positions of the menu item with the specified Id
     * and the menu item with the specified previous position.
     * 
     * @param int $id the Id of one of the menu item whose position is being updated.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function patch($id) {

        try {

            $food1 = Food::findOrFail($id);
            $food2 = Food::findOrFail(request()->get('prev'));

            if ($food1->category_id !== $food2->category_id) {
                abort(404);
            }

            [$food1->menu_position, $food2->menu_position] = [$food2->menu_position, $food1->menu_position];

            $food1->save();
            $food2->save();

            return redirect()->route('admin_panel_show_menu_items_by_category', ['id' => $food1->category_id]);

        } catch (ModelNotFoundException $e) {
            abort(404);
        }

    }



    /**
     * Delete a menu item.
     * 
     * Deletes the menu item with the speicifed Id. After deletion, it updates
     * the menu positions of the remaining items in the same category whose
     * menu position is greater than the deleted items menu position.
     * 
     * @param int $id the Id of the menu item to delete.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {

        try {
            $food = Food::findOrFail($id);
            DB::update("UPDATE food set menu_position = menu_position - 1 WHERE menu_position > ? AND category_id = ? ", [$food->menu_position, $food->category_id ]);
            Storage::delete('public/images/menu_items/'.$food->image);
            $food->delete();
            return redirect()->route('admin_panel_show_menu_items_by_category', ['id' => $food->category_id])->with('message', 'Menu item deleted successfully!');
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

}
