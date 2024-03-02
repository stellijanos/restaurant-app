<nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
	<div class="container-fluid">
		<a class="navbar-brand" href="{{route('home')}}">Restaurant App</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExample04">
			<ul class="navbar-nav me-auto mb-2 mb-md-0">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="#">Menu</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Cart</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('login')}}">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('admin_panel_option', ['option' => 'home'])}}">Admin</a>
				</li>
			</ul>
			<form role="search">
				<input class="form-control" type="search" placeholder="Search" aria-label="Search">
			</form>
		</div>
	</div>
</nav>
