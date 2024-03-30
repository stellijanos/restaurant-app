<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{


    /**
     * Displays the home page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {

        return view('home.index',  ['page_title' => 'Home - Restaurant App']);
    }


    /**
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
            'page_title' => 'Menu - Restaurant app',
            'categories' => $categories
        ]);
    }


    public function show_cart() {

        $json_cart = $_COOKIE['cart'] ?? '{}';
        $cart = json_decode($json_cart, true);

        $ids = array_keys($cart);
        $foods = Food::whereIn('id', $ids)->get();

        $products_price = 0; 

        foreach($foods as $food) {
            $food->quantity = $cart[$food->id];
            $products_price += $food->price * $food->quantity;
        }

        return view('cart.index',[
            'page_title' => 'Cart - Restaurant App',
            'cart' => $foods,
            'products_price' => $products_price
        ]);
    }

    public function show_checkout() {

    }
}

