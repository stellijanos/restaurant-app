<div id="orders-header" style="padding:10px; height:60px">
    <h3>Orders</h3>
    <select name="category" class="form-select form-select-lg mb-3" style="margin-top:10px; width:300px" onchange="getOrdersByStatus(this)">
            <option value="{{route('admin_panel_show_orders')}}" selected>Choose by status</option>
            @foreach($order_statuses as $status)
                <option value="{{route('show_orders_by_status',['status' => $status])}}" {{($current_status ?? '' )=== $status ? 'selected' : '' }}>{{$status}} ({{$status_counts[$status] ?? 0}})</option>
            @endforeach
    </select>
</div>
<hr>
