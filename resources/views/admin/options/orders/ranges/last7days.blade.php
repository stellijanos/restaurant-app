
<?php
    $label_arr = array_keys($chart_data);
    $labels = json_encode($label_arr);
?>

<script>
    const chart = document.getElementById('orders-chart');

    const labels = JSON.parse("{{$labels}}".replace(/&quot;/g,'"'))

    new Chart(chart, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'nr. of orders',
        data: {{json_encode(array_values($chart_data))}},
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          stepSize: 1
        }
      }
    }
  });

</script>

