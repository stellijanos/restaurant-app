<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class CartController extends Controller
{

    

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
        if (url()->previous() !== route('show_cart')) {
            return redirect()->route('show_cart');
        }

        echo('ok');
    }
}
