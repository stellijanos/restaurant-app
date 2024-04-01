<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    
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
        if( request()->get('delivery-type') !== 'pickup' ) {
            $order->address = filter_var(request()->get('street'),FILTER_SANITIZE_STRING) . ', ' .filter_var(request()->get('number'),FILTER_SANITIZE_STRING);
        } else {
            $order->address = '- (pickup)';
        }

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


    private function getStatusNrOrders() {
        $result = Order::select('status', DB::raw('COUNT(status) as nr'))
                        ->groupBy('status')
                        ->get();

        return $result->pluck('nr', 'status')->toArray();
    }


         /**
     * Display the orders page of the admin panel.
     * 
     * This method returns a view that represents the orders page of the admin panel.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show_orders() { 
        return view('admin.admin_panel',[
            'page_title' => 'Orders | Admin Panel - Restaurant App',
            'orders' => null,
            'status_counts' => $this->getStatusNrOrders()
        ]);
    }



    function show_orders_by_status($status) {
        $status = filter_var($status, FILTER_SANITIZE_STRING);

        return view('admin.admin_panel',[
            'page_title' => 'Orders | Admin Panel - Restaurant App',
            'orders' => Order::where('status', $status)->orderBy('updated_at')->with('orderItems')->get(),
            'current_status' => $status,
            'status_counts' => $this->getStatusNrOrders()
        ]);
    }


    public function update_order_status($id) {
        
        request()->validate([
            'status' => 'required|string'
        ]);

        $id = filter_var($id, FILTER_SANITIZE_STRING);

        try {
            $order = Order::findOrFail($id);
            $order->status = filter_var(request()->get('status'), FILTER_SANITIZE_STRING);
            $order->save();
            return redirect()->back();
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }
}
