<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use DateInterval;
use DateTime;
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
            $order->address = 'pickup';
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

            $order_item->name = $food->name;
            $order_item->food_id = $food->id;
            $order_item->price = $food->price;
            $order_item->quantity = filter_var($food->quantity, FILTER_SANITIZE_STRING);
            $order->orderItems()->save($order_item);
        }

        if ($order->shipping_fee = $order->address !== 'pickup' && $products_price >= 100) {
            $order->shipping_fee = 5;
            $order->save();
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


    private function todaysDate() {
        return new Datetime();
    }

    private function sevenDayAgoDate() {
        return (new DateTime())->sub(new DateInterval('P7D'));
    }



    private function getTodayData() {
        $today = $this->todaysDate();

        return array(Order::where('created_at', '=', $today)->count());
    }

    private function getLast7DaysData() {

        $start = $this->sevenDayAgoDate();
        $today = $this->todaysDate();

        $chartData = Order::select(DB::raw('COUNT(created_at) as nr'),DB::raw('DATE(created_at) as date'))
                            ->whereBetween('created_at', [$start, $today])
                            ->groupBy(DB::raw('DATE(created_at)'))
                            ->get();
        
        return $chartData->pluck('nr', 'date')->toArray();

    }

    private function getWeeklyData() {
        return array();
    }

    private function getMonthlyData() {
        return array();
    }

    private function getYearlyData() {
        return array();
    }

    /**
     * Display the orders page of the admin panel.
     * 
     * This method returns a view that represents the orders page of the admin panel.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show_orders($range = 'today') { 

        switch($range) {
            case 'today': 
                $data = $this->getTodayData();
                break;
            case 'last7days':
                $data = $this->getLast7DaysData();
                break;
            case 'weekly': 
                $data = $this->getWeeklyData();
                break;
            case 'monthly': 
                $data = $this->getMonthlyData();
                break;
            case 'yearly':
                $data = $this->getYearlyData();
                break;
            default:
                $data = array();
        }




        print_r($data);


        // return view('admin.admin_panel',[
        //     'page_title' => 'Orders | Admin Panel - Restaurant App',
        //     'orders' => null,
        //     'status_counts' => $this->getStatusNrOrders(),
        //     'chart_data' => $data
        // ]);
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
