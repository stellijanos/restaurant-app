<div class="order-status-details">
    <p style="font-size:2rem; font-weight:bold">Order nr. {{$order->id}}</p><hr>
    <form action="{{route('update_order_status',['id' => $order->id])}}" method="post">
        @csrf
        @method('put')
        <p>Status</p>
        @foreach($order_statuses as $status) 
            <div class="form-check mb-3">
                <input type="radio" class="form-check-input" name="status" id="status-{{$order->id}}-{{$status}}" value="{{$status}}" {{$order->status === $status ? 'checked' : ''}}>
                <label for="status-{{$order->id}}-{{$status}}">{{$status}}</label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Update status</button>
    </form>
</div>
<div class="order-items">
    <p style="font-size:1.5rem; font-weight:bold">Order items</p>
    @php
        $total_sum = 0;
    @endphp
    <table border=1>
        <tr>
            <th>Name</th>
            <th>Id</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        @foreach($order->orderItems as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->food_id}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->price}}&euro;</td>
                <td>{{$item->quantity * $item->price}}</td>
                @php 
                    $total_sum += $item->quantity * $item->price
                @endphp
            </tr>
        @endforeach
    </table>
</div>
<div class="customer-info">
    <p style="font-size:1.5rem; font-weight:bold">Customer Info:</p>
    <ul>
        <li>Firstname: {{$order->firstname}}</li>
        <li>Lastname: {{$order->lastname}}</li>
        <li>Phone: <a href="tel:{{$order->phone}}">{{$order->phone}}</a></li>
        <li>Email: <a href="mailto:{{$order->email}}">{{$order->email}}</a></li>
        <li>Address: {{$order->address}}</li>
        <li>Shipping fee: {{$order->shipping_fee}}</li>
        <li>Total: {{$order->shipping_fee + $total_sum}}</li>
    </ul>
</div>
