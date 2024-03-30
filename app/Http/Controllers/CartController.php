<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function redirect_to_cart() {
        return redirect()->route('show_cart');
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


    public function create_order() {

        request()->validate([
            'delivery-type' => 'required|string'
        ]);

        $validations = [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email'
        ];

        if (request()->get('delivery-type') !== 'pickup') {
            $validations['street'] = 'required|string';
            $validations['number'] = 'required|string';
        }


        request()->validate($validations); 


        $data = request()->all();

        print_r($data);
    }
}

