

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

<div id="chart-div">

<canvas id="janos-chart"></canvas>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chart = document.getElementById('janos-chart');

    new Chart(chart, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

