@foreach($orders as $order)
    <div class="order-list">
        @include('admin.options.orders.item')
    </div>
    <hr>
@endforeach