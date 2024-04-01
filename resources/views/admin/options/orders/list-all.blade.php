@foreach($orders as $order)
    <div id="order-list">
        @include('admin.options.orders.item')
    </div>
    <hr>
@endforeach
