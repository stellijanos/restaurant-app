<!-- <div style="display:flex; justify-content:center; align-items:center; height:300px;">
    <h1 style="font-size:20;">No status chosen.</h1>
</div> -->

<?php

$uri = explode("/", $_SERVER['REQUEST_URI']);
$data_range = end($uri);

if ($data_range === 'orders') {
  $data_range = 'today';
}
?>

<select name="show-range" id="show-range" class="form-select" style="width:500px">
    <option value="">Today ({{date('d-m-Y')}})</option>
	<option value="">Last 7 days()</option>
</select>

<?php try { ?>
	@include('admin.options.orders.ranges.'.$data_range)
<?php } catch (InvalidArgumentException $e) { 
		abort(404);
} 
?>
