

<h1 style="padding:20px">Welcome back, <strong>{{ auth()->user()->name }}</strong>!</h1> 

@if($errors->any()) 
    <div style="background-color:#ff7f7f; color:#000; padding:10px;">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif


<div id="orders">
    <h2>Orders</h2>
    <li>Total orders:</li>


</div>
<div id="menu-categories">
    <h2>Menu categories</h2>
</div>
<div id="menu-items">
    <h2>Menu items</h2>
</div>
<hr>

<?php

$today = new DateTime();

$start = clone $today;

$start->sub(new DateInterval('P7D'));


echo $start->format('d-m-Y') . ' - '. $today->format('d-m-Y').'<br>';


########################## last week

$start_date = new DateTime();
$start_date->modify('monday this week');

$end_date = new DateTime();
$end_date->modify('sunday this week');


echo $start_date->format('d-m-Y') . ' - '. $end_date->format('d-m-Y');


?>


