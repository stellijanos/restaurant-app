<?php


$range_types = ['today', 'last7days', 'weekly', 'monthly', 'yearly'];

$uri = explode("/", $_SERVER['REQUEST_URI']);
$data_range = end($uri);

if (!in_array($data_range, $range_types)) {
  	$data_range = 'today';
}


$today = new DateTime();
$last7days = clone $today;
$last7days = $last7days->modify('-7 days');


$firstDayOfWeek = (new DateTime)->modify('monday this week');
$lastDayOfWeek = (new DateTime)->modify('sunday this week');

$firstDayOfMonth = date('01.m.Y');
$lastDayOfMonth = date('t.m.Y');

$firstDayOfYear = date('01.01.Y');
$lastDayOfYear = date('31.12.Y');
?>

<select name="show-range" id="show-range" class="form-select" style="width:500px" onchange="getChart(this)">
    <option value="{{route('admin_panel_show_orders')}}" {{$data_range === 'today' ? 'selected' : ''}}>Today ({{$today->format('d.m.Y')}})</option>
    <option value="{{route('admin_panel_show_orders',['range' => 'last7days'])}}" {{$data_range === 'last7days' ? 'selected' : ''}}>Last 7 days ({{$last7days->format('d.m.Y')}} - {{$today->format('d.m.Y')}})</option>
    <option value="{{route('admin_panel_show_orders',['range' => 'weekly'])}}" {{$data_range === 'weekly' ? 'selected' : ''}}>This week ({{$firstDayOfWeek->format('d.m.Y')}} - {{$lastDayOfWeek->format('d.m.Y')}})</option>
    <option value="{{route('admin_panel_show_orders',['range' => 'monthly'])}}" {{$data_range === 'monthly' ? 'selected' : ''}}>This month ({{$firstDayOfMonth}} - {{$lastDayOfMonth}})</option>
    <option value="{{route('admin_panel_show_orders',['range' => 'yearly'])}}" {{$data_range === 'yearly' ? 'selected' : ''}}>This year ({{$firstDayOfYear}} - {{$lastDayOfYear}})</option>
</select>

<div id="chart-div" style="width:60%; height: 60%; margin:auto; display:flex; justify-content:center; align-items:center">
    <canvas id="orders-chart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


@include('admin.options.orders.ranges.'.$data_range)

<script>
	function getChart(select) {
		window.location.href = select.value;
	}
</script>


