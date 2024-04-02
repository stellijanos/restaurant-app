<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{


    /**
     * Get the number of orders for each category.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getEachCategoryNrOfOrders() {
        return  Category::join('food', 'food.category_id', '=', 'categories.id')
                        ->join('order_items', 'order_items.food_id', '=', 'food.id')
                        ->groupBy('categories.name')
                        ->orderBy(DB::raw('COUNT(categories.name)'), 'desc')
                        ->select(DB::raw('categories.name as name, COUNT(categories.name) as nr'))
                        ->get();
    }


    /**
     * Get the number of orders for each menu item.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getEachMenuItemNrOfOrders() {
        return Food::select('food.name',DB::raw('SUM(order_items.quantity) as nr'))
                    ->join('order_items', 'order_items.food_id', '=', 'food.id')
                    ->groupBy('food.id', 'food.name')
                    ->orderBy('nr', 'desc')
                    ->get();
    }


    /**
     * Filter an array to get all the elements equal to a specific value.
     * 
     * @param array $result the array to filter.
     * @param string $compare_to the specific value to compare against.
     * @return array the filtered array.
     */
    private function getMostOrLeast(array $result, string $compare_to) {
            return array_filter($result, function($value) use ($compare_to) {
                return $value === $compare_to;
            });
    }


    /**
     * Display the home page of the admin panel.
     * 
     * This methods retrieves various statistics related to orders, categories and menu items 
     * and returns a view representing the home page of the admin panel with these statistics.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show_home() {

        $num_of_orders = Order::count();
        $total_price_of_orders = OrderItem::select(DB::raw('price * quantity as total'))->get()->sum('total');
        $total_number_of_categories = Category::count();
        $total_number_of_menu_items = Food::count();
            
    
        $total_ordered_categories = $this->getEachCategoryNrOfOrders()->pluck('nr', 'name')->toArray();
        $firstValue = reset($total_ordered_categories);
        $lastValue = end($total_ordered_categories);

        $most_ordered_categories = $this->getMostOrLeast($total_ordered_categories, $firstValue);
        $least_ordered_categories = $this->getMostOrLeast($total_ordered_categories, $lastValue);

        $total_ordered_menu_items = $this->getEachMenuItemNrOfOrders()->pluck('nr', 'name')->toArray();
        $firstValue = reset($total_ordered_menu_items);
        $lastValue = end($total_ordered_menu_items);

        $most_ordered_menu_items = $this->getMostOrLeast($total_ordered_menu_items, $firstValue);
        $least_ordered_menu_items = $this->getMostOrLeast($total_ordered_menu_items, $lastValue);


        $statistics = [
            'num_of_orders' => $num_of_orders,
            'total_price_of_orders' => $total_price_of_orders ,

            'total_number_of_categories' => $total_number_of_categories,
            'most_ordered_categories' => $most_ordered_categories,
            'least_ordered_categories' => $least_ordered_categories,

            'total_number_of_menu_items' => $total_number_of_menu_items,
            'most_ordered_menu_items' => $most_ordered_menu_items,
            'least_ordered_menu_items' => $least_ordered_menu_items,

            'total_ordered_categories' => $total_ordered_categories,
            'total_ordered_menu_items' => $total_ordered_menu_items
        ];


        return view('admin.options.home.index', [
            'page_title' => 'Admin Panel - Restaurant App',
            'statistics' => $statistics
        ]);
    }



    /**
     * Display the menu page of the admin panel.
     * 
     * This method retrieves categories ordered by their menu position
     * and returns a view representing the menu page of the admin panel.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show_edit_menu() {
        return view('admin.admin_panel', [
            'page_title' => 'Admin Panel - Restaurant App',
            'categories' => Category::orderBy('menu_position')->get()
        ]);
    }

    /**
     * Checks if the user input password equals the actual hashed password.
     * 
     * @param string $password the hashed password
     * @return bool true if they are equal, false otherwise
     */
    private function isCorrectPassword(string $password) {
        return Hash::check(request()->get('current_password'), $password);
    }

    /**
     * Update user profile information.
     * 
     * This method validates user input for updating profile information  such as name, email, password.
     * It updates the users information accordingly and handles profile picture updates.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_profile() {

        request()->validate([
            'name' => 'required|string|min:1|max:255',
            'email' => 'required|string|min:1|max:255',
            'current_password' => 'required|string|min:1,max:255'
        ]);

        $user = auth()->user();


        if (!$this->isCorrectPassword($user->password)) {
            return redirect()->back()->withErrors(['password' => 'Incorrect password']);
        }

        if (request()->get('new_password') !== null) {
            
            request()->validate([
                'confirm_password' => 'same:new_password'
            ]);
            $new_password = request()->get('new_password');
            $user->password = Hash::make($new_password);
        }


        if (request()->has('remove_picture')) {
            Storage::delete('public/images/profile/'.$user->image);
            $user->image = 'blank-profile-picture.png';
        } 
        else if (request()->hasFile('new_image')) {

            $file = request()->file('new_image');
            $file_name = bin2hex(random_bytes(10)).'.'. $file->getClientOriginalExtension();

            if ($user->image != 'blank-profile-picture.png') {
                Storage::delete('public/images/profile/'.$user->image);
            }
            
            Storage::putFileAs('public/images/profile/', $file, $file_name);
            $user->image = $file_name;
        }

        $user->name = request()->get('name');
        $user->email = request()->get('email');
        $user->save();

        return redirect()->back()->with(['message' => 'Successfully updated']);
    }


}

