<h1>Orders</h1>

<style>
  .fixed-div {
    position: fixed;
    top: 50px; /* Adjust as needed */
    left: 50px; /* Adjust as needed */
    width: 300px;
    height: 300px;
    background-color: lightgray;
    border: 1px solid black;
    overflow: hidden; /* Ensures the scrollbars stay within the fixed div */
  }

  .scrollable-div {
    height: 100%; /* Make sure it takes the full height of the parent */
    overflow-y: auto; /* Enable vertical scrolling */
  }

  /* Style for content inside the scrollable div */
  .content {
    padding: 10px;
  }
</style>

<div class="fixed-div">
  <div class="scrollable-div">
    <div class="content">
      <!-- Your content here -->
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at justo neque. Integer non feugiat dolor. Duis id neque vel est rutrum fermentum. Nullam luctus libero sit amet odio eleifend, sit amet efficitur est gravida. Vivamus et mauris sed purus scelerisque vehicula.</p>
      <p>Fusce nec maximus ligula. Mauris ut nisi vel justo accumsan viverra. In in commodo tortor. Vivamus consequat semper lectus, non tristique dui gravida vitae. Sed ullamcorper vehicula nibh id cursus. Pellentesque posuere magna eu metus ultricies, sit amet fermentum libero varius.</p>
      <p>Etiam sit amet ligula eget magna dapibus gravida. Integer nec mauris id dolor tempor rutrum. Vivamus tincidunt mi sit amet interdum fermentum. Nullam in lorem a mi varius convallis eu at felis. Morbi vehicula dolor quis nisi dapibus, et bibendum est consequat.</p>
      <p>Phasellus id ex nec odio faucibus lobortis vel vel leo. Duis non neque eget arcu dictum pretium. Nulla vel diam vitae mi dapibus rhoncus vitae nec nulla. Sed consequat nisl id pharetra consequat.</p>
      <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam eget sodales odio. Curabitur a libero sed urna eleifend vulputate nec at felis. Ut in dolor vitae metus vehicula vulputate.</p>
      <p>Nunc vel turpis eget est varius tempus. Nullam sit amet magna a quam vestibulum tincidunt nec at ligula. Sed non eros varius, vestibulum tortor at, vestibulum lacus. Phasellus volutpat auctor elit, vel egestas nunc placerat ut.</p>
      <p>Donec tristique bibendum mi, sit amet fermentum nulla. Duis convallis convallis justo, sit amet tempor odio commodo ac. Nullam dignissim lacus sed elit dapibus venenatis. Phasellus aliquam rutrum magna, vitae aliquam urna mollis in. Fusce id efficitur quam.</p>
    </div>
  </div>
</div>