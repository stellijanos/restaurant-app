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


    private function getEachCategoryNrOfOrders() {
        return  Category::join('food', 'food.category_id', '=', 'categories.id')
                        ->join('order_items', 'order_items.food_id', '=', 'food.id')
                        ->groupBy('categories.name')
                        ->orderBy(DB::raw('COUNT(categories.name)'), 'desc')
                        ->select(DB::raw('categories.name as name, COUNT(categories.name) as nr'))
                        ->get();
    }


    private function getEachMenuItemNrOfOrders() {
        return Food::select('food.name',DB::raw('SUM(order_items.quantity) as nr'))
                    ->join('order_items', 'order_items.food_id', '=', 'food.id')
                    ->groupBy('food.id', 'food.name')
                    ->orderBy('nr', 'desc')
                    ->get();
    }

         // SELECT f.name AS food_name, SUM(oi.quantity) AS total_quantity_ordered
        // FROM food f 
        // JOIN order_items oi ON oi.food_id = f.id 
        // GROUP BY f.name;


    private function getMostOrLeast($result, $compare_to) {
            return array_filter($result, function($value) use ($compare_to) {
                return $value === $compare_to;
            });
    }


    /**
     * Display the home page of the admin panel.
     * 
     * This methods returns a view that represents the home page of the admin panel.
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


        return view('admin.admin_panel', [
            'page_title' => 'Admin Panel - Restaurant App',
            'statistics' => $statistics
        ]);
    }



 
    /**
     * Display the customers page of the admin panel.
     * 
     * This method returns a view that represents the customers page of the admin panel.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show_dashboard() {
        return view('admin.admin_panel',[
            'page_title' => 'Admin Panel - Restaurant App'
        ]);
    }


    public function show_edit_menu() {
        return view('admin.admin_panel', [
            'page_title' => 'Admin Panel - Restaurant App',
            'categories' => Category::orderBy('menu_position')->get()
        ]);
    }


    private function isCorrectPassword($password) {
        return Hash::check(request()->get('current_password'), $password);
    }

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

