

<script>
    const chart = document.getElementById('orders-chart');

    // const labels = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']

    new Chart(chart, {
    type: 'bar',
    data: {
      labels: ['Today ({{date('d-m-Y')}})'],
      datasets: [{
        label: 'nr. of orders',
        data: {{json_encode($chart_data)}},
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

