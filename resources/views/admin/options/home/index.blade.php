<style>
    #charts {
        display:flex;
        flex-direction:row;
        flex-wrap:wrap;
        justify-content:center;
        align-items:center;
    }

    #customers-data {
        display:flex;
        flex-direction:row;
        flex-wrap:wrap;
        margin:auto;
        gap:3rem;
        padding:20px;
    }

    #general {
        display:flex;
        flex-direction:column;
    }


</style>

<h1 style="padding:20px">Welcome back, <strong>{{ auth()->user()->name }}</strong>!</h1> 

@if($errors->any()) 
    <div style="background-color:#ff7f7f; color:#000; padding:10px;">
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif

<?php

function print_data($array) {
    
    $result = [];

    foreach($array as $key => $value) {
        $result[] = $key.' ('.$value.')';
    }

    return implode(', ',$result);
}

?>

<div id="customers-data">

    <div class="general">
        <div id="orders">
            <h2>Orders</h2>
            <ul>
                <li>Total orders: {{$statistics['num_of_orders']}}</li>
                <li>Total price of orders: {{number_format($statistics['total_price_of_orders'], 2)}} &euro;</li>
                <li>Order average price: {{number_format($statistics['total_price_of_orders'] / $statistics['num_of_orders'], 2)}}</li>
            </ul>
        </div>
        <div id="menu-categories">
            <h2>Menu categories</h2>
            <ul>
                <li>Total number of categories: {{$statistics['total_number_of_categories']}}</li>
                <li>Most ordered category/ies: {{print_data($statistics['most_ordered_categories'])}}</li>
                <li>Least ordered category/ies: {{print_data($statistics['least_ordered_categories'])}}</li>
            </ul>
        </div>
        <div id="menu-items">
            <h2>Menu items</h2>
            <ul>
                <li>Total number of menu items: {{$statistics['total_number_of_menu_items']}}</li>
                <li>Most ordered menu item(s): {{print_data($statistics['most_ordered_menu_items'])}}</li>
                <li>Least ordered menu item(s): {{print_data($statistics['least_ordered_menu_items'])}}</li>
        </ul>
        </div>
    </div>

    <div id="charts">
        <div id="menu-categories-chart-div" style="width:350px;">
            <p>Number of orders for each (ordered) category</p>
            <canvas id="categories-chart"></canvas>
        </div>
        <div id="menu-categories-chart-div" style="width:350px;">
            <p>Number of orders for each (ordered) menu item</p>
            <canvas id="menu-items-chart"></canvas>
        </div>
    </div>

</div>

<?php
    $label_arr = array_keys($statistics['total_ordered_categories']);
    $category_labels = json_encode($label_arr);

    $label_arr = array_keys($statistics['total_ordered_menu_items']);
    $menu_item_labels = json_encode($label_arr);

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const category_labels = JSON.parse("{{$category_labels}}".replace(/&quot;/g,'"'));
const category_config = {
  type: 'polarArea',
  data: {
  labels: category_labels,
  datasets: [{
    label: 'Nr of orders for each category',
    data: {{json_encode(array_values($statistics['total_ordered_categories']))}},
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(75, 192, 192)',
      'rgb(255, 205, 86)',
      'rgb(201, 203, 207)',
      'rgb(54, 162, 235)'
    ]
  }]
},
  options: {}
};

const categories_chart = document.getElementById('categories-chart');
new Chart(categories_chart, category_config);


const menu_item_labels = JSON.parse("{{$menu_item_labels}}".replace(/&quot;/g,'"'));
const menu_item_config = {
  type: 'polarArea',
  data: {
  labels: menu_item_labels,
  datasets: [{
    label: 'Nr of orders for each category',
    data: JSON.parse("{{json_encode(array_values($statistics['total_ordered_menu_items']))}}".replace(/&quot;/g,'"')),
    backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(75, 192, 192)',
      'rgb(255, 205, 86)',
      'rgb(201, 203, 207)',
      'rgb(54, 162, 235)'
    ]
  }]
},
  options: {}
};

const menu_item_chart = document.getElementById('menu-items-chart');
new Chart(menu_item_chart, menu_item_config);
</script>