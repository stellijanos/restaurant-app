<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * Redirects to the cart page.
     * 
     * This method redirects the user to the cart page using the route named 'show_cart'. 
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect_to_cart() {
        return redirect()->route('show_cart');
    }

    /**
     * Display the cart page.
     * 
     * This method retrieves the cart items stored in cookies, fetches the corresponding food items from the database
     * calculates the total price of the items in the cart, and returns a view representing the cart page.
     * 
     * @return \Illuminate\Contracts\View\View
     */
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



    /**
     * Display the checkout page.
     * 
     * This method validates the referer URL to ensure it is either the cart page or the checkout page.
     * Then, it retrieves cart items stored in cookies, fetches the corresponding food items from the 
     * database, calculates the total price of the items in the cart and determines the shipping fee based 
     * on the total price and the delivery type chosen, finally, it returns a view representing the checkout page.
     */
    public function show_checkout() {
        if (url()->previous() !== route('show_cart') && url()->previous() !== route('show_checkout') ) {
            return redirect()->route('show_cart');
        }

        $json_cart = $_COOKIE['cart'] ?? '{}';
        $cart = json_decode($json_cart, true);

        $ids = array_keys($cart);
        $foods = Food::whereIn('id', $ids)->get();

        $products_price = 0; 

        $delivery_type = request()->get('delivery-type');

        foreach($foods as $food) {
            $food->quantity = $cart[$food->id];
            $products_price += $food->price * $food->quantity;
        }

        $shipping_fee = $products_price > 100 || $delivery_type === 'pickup' ? 0 : 5;


        return view('checkout.index',[
            'page_title' => 'Checkout - Restaurant App',
            'cart' => $foods,
            'products_price' => $products_price,
            'shipping_fee' => $shipping_fee,
            'delivery_type' => $delivery_type
        ]);
    }
}
