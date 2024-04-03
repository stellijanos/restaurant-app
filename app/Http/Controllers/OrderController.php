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
    

    /**
     * Creates an order based on the submitted form data.
     * validates the form data including delivery type, firstname, lastname, phone, email,
     * and also street and number if the user chooses delivery option.
     * Saves the order details into the database, including customer information and shipping address. 
     * Retrieves the cart items from cookies, calculates the total price then saves the order items into the database.
     * applies shipping fee if the delivery type is not pickup or the total price is less then 100 (money-unit).
     * redirescts to order-successful' route to confirm order creation 
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create() {

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



    /**
     * Displays the order success page.
     * Checks if the previous URL is the 'place-order' route to assure that the user can only access it
     * when it is redirected from that previous URL.
     * Returns order successful view that confirms the order creation for the user.
     * 
     * @return \Illuminate\View\View
     */
    public function order_successful() {

        if (url()->previous() !== route('place-order')) {
            abort(404);
        }

        return view('cart.order_successful', [
            'page_title' => 'Order successful - Restaurant App'
        ]);
    }



    /**
     * Retrieves the number of orders for each (order) status.
     * Selects the status and counts the occurrences of each status.
     * Groups the results by status.
     * Returns a key-value array, where keys are statuses and values are the corresponding
     * number of order counts.
     * 
     * @return array
     */
    private function getStatusNrOrders() {
        $result = Order::select('status', DB::raw('COUNT(status) as nr'))
                        ->groupBy('status')
                        ->get();

        return $result->pluck('nr', 'status')->toArray();
    }



    /**
     * Returns today's date
     * 
     * @return Datetime
     */
    private function todaysDate() {
        return new Datetime();
    }



    /**
     * Returns the date that which was 6 days ago
     * 
     * @return Datetime
     */
    private function sixDayAgoDate() {
        return (new DateTime())->sub(new DateInterval('P7D'));
    }



    /**
     * Retrieves the number of orders created (placed) today.
     * Returns that number.
     * 
     * @return array
     */
    private function getTodayData() {
        $today = $this->todaysDate();

        $chart_data = Order::where(DB::raw('DATE(created_at)'), $today->format('Y-m-d'))->count();

        return [$chart_data];
    }



    /**
     * Retrieves chart data for orders created between the given start and end dates.
     * Selects the count of orders and the date of creation.
     * Filters orders based on the creation date falling within the specified range.
     * Groups the results by the creation date.
     * 
     * @param DateTime $start the start date 
     * @param DateTime $end the end date
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function getChartData($start, $end) {
        return Order::select(DB::raw('COUNT(created_at) as nr'),DB::raw('DATE(created_at) as date'))
                    ->whereBetween('created_at', [$start, $end])
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->get();
    }



    /**
     * Retrieves chart data for the last 7 days (inclusive today).
     * Calculates the start and end dates for the last 7 days
     * Iterates over the last 7 days and initializes each day with a count of 0.
     * Merges the fetched chart data with the initialized array, replacing counts for corresponding dates.
     * 
     * @return array
     */
    private function getLast7DaysData() {

        $start = $this->sixDayAgoDate();
        $today = $this->todaysDate();

        $chartData = $this->getChartData($start, $today);

        $last7days = [];

        for ($i = 6; $i >=0; $i--) {
            $last7days[ date('Y-m-d',strtotime("-$i days"))] = 0;
        }
        
        return array_merge($last7days, $chartData->pluck('nr', 'date')->toArray());
    }



    /**
     * Retrieves chart data for the current week.
     * Calculates the start and end dates for the current week (monday - sunday)
     * fetches chart data for the specified date range using "getChartData()" method
     * Initializes an array to hold the data for the current week.
     * Iterates over each day of the week and initializes each day with a count of 0.
     * Merges the fetched chart data with the initialized array, replacing counts for corresponding dates.
     * 
     * @return array
     */
    private function getWeeklyData() {
        $start = $this->todaysDate()->modify('monday this week');
        $end = $this->todaysDate()->modify('sunday this week');

        $chartData = $this->getChartData($start, $end);

        $week = [];

        for ($i = 0; $i <= 6; $i++) {
            $day = clone $start;
            $day->modify("+$i days");
            $week[$day->format('Y-m-d')] = 0;
        }
        
        return array_merge($week, $chartData->pluck('nr', 'date')->toArray());
    }



    /**
     * Retrieves chart data for the current month.
     * Calculates the first and last days of the current month.
     * Fetches chart data for the entire month using the "getChartData()" method.
     * Initializes an array to hold the data for each day of the month.
     * Iterates over each day of the month and initializes each day with a count of 0.
     * Merges the fetched chart data with the initialized array, replacing counts for corresponding dates.
     * 
     * @return array
     */
    private function getMonthlyData() {

        $firstDayOfMonth = new Datetime(date('Y-m-01'));
        $lastDayOfMonth = new DateTime(date('Y-m-t'));

        $chartData = $this->getChartData($firstDayOfMonth, $lastDayOfMonth);

        $month = [];

        for ($i = 0; $i <= $lastDayOfMonth->format('d'); $i++) {
            $day = clone $firstDayOfMonth;
            $day->modify("+$i days");
            $month[$day->format('Y-m-d')] = 0;
        }

        return array_merge($month, $chartData->pluck('nr', 'date')->toArray());
    }



    /**
     * Retrieves chart data for the current year.
     * Calculates the first and last days (dates) of the current year.
     * Fetches chart data for the entire year using the "getChartData()" method.
     * Initializes an array to hold the data for each day of the year.
     * Iterates over each day of the year and initializes each day with a count of 0.
     * merges the fetched chart data with the initialized array, replacing counts for corresponding dates.
     * 
     * @return array
     */
    private function getYearlyData() {
        $firstDayOfYear = new DateTime(date('01.01.Y'));
        $lastDayOfYear = new DateTime(date('31.12.Y'));

        $chartData = $this->getChartData($firstDayOfYear, $lastDayOfYear);

        $year = [];

        for ($i = 0; $i <= $lastDayOfYear->format('z'); $i++) {
            $day = clone $firstDayOfYear;
            $day->modify("+$i days");
            $year[$day->format('Y-m-d')] = 0;
        }

        return array_merge($year, $chartData->pluck('nr', 'date')->toArray());
    }



    /**
     * Display the orders page of the admin panel.
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

        return view('admin.options.orders.index',[
            'page_title' => 'Orders | Admin Panel - Restaurant App',
            'orders' => null,
            'status_counts' => $this->getStatusNrOrders(),
            'chart_data' => $data
        ]);
    }


    /**
     * Displays orders filtered by the specified status.
     * Sanitizes the input status string.
     * Returns the view to display orders with the specified status along with relevant data.
     * 
     * @param string $status the status of orders to filter by.
     * @return \Illuminate\View\View
     */
    function show_orders_by_status($status) {
        $status = filter_var($status, FILTER_SANITIZE_STRING);

        return view('admin.options.orders.index',[
            'page_title' => 'Orders | Admin Panel - Restaurant App',
            'orders' => Order::where('status', $status)->orderBy('updated_at')->with('orderItems')->get(),
            'current_status' => $status,
            'status_counts' => $this->getStatusNrOrders()
        ]);
    }


    /**
     * Updates the status of the specified order.
     * Validates the incoming request data, eunsuring the "status" field is provided and is a string.
     * sanitizes the input order Id.
     * 
     * attempts to find the order with the specified Id; if nt found, throws a 404 error.
     * updates the status of the order with the sanitized status value from the request.
     * redirects back to the previous page after updating the order status.
     * 
     * @param string #id the Id of the order to update.
     * @return \Illuminate\Http\RedirectResponse
     */
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
