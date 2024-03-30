<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
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


        $order = new Order();

        $order->firstname = filter_var(request()->get('firstname'), FILTER_SANITIZE_STRING);
        $order->lastname = filter_var(request()->get('lastname'),FILTER_SANITIZE_STRING);
        $order->email = filter_var(request()->get('email'),FILTER_SANITIZE_STRING);
        $order->phone = filter_var(request()->get('phone'),FILTER_SANITIZE_STRING);
        $order->phone = filter_var(request()->get('phone'),FILTER_SANITIZE_STRING);
        $order->address = filter_var(request()->get('street'),FILTER_SANITIZE_STRING) . ', ' .filter_var(request()->get('number'),FILTER_SANITIZE_STRING);

        $order->save();

        print_r($order);

        $json_cart = $_COOKIE['cart'] ?? '{}';
        $cart = json_decode($json_cart, true);

        $ids = array_keys($cart);
        $foods = Food::whereIn('id', $ids)->get();

        $products_price = 0; 

        foreach($foods as $food) {
            $food->quantity = $cart[$food->id];
            $products_price += $food->price * $food->quantity;


            $order_item = new OrderItem();

            $order_item->food_id = $food->id;
            $order_item->price = $food->price;
            $order_item->quantity = filter_var($food->quantity, FILTER_SANITIZE_STRING);
            $order->orderItems()->save($order_item);
        }

        return redirect()->route('order-successful');
    }


    public function order_successful() {

        if (url()->previous() !== route('place-order')) {
            abort(404);
        }

        return view('cart.order_successful', [
            'page_title' => 'Order successful - Restaurant App'
        ]);
    }
}

