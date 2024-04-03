
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top" aria-label="Fourth navbar example">
	<div class="container-fluid">
		<a class="navbar-brand" href="{{route('home')}}">Restaurant App |</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExample04">
			<ul class="navbar-nav me-auto mb-2 mb-md-0">
				<li class="nav-item">
					<a class="nav-link" href="{{route('show_cart')}}">
						Cart <i class="bi bi-cart-fill"></i>
						<span class="position-absolute translate-middle badge rounded-pill sm bg-danger">
							<span id="cart-quantity">0</span>
							<span class="visually-hidden">unread messages</span>
						</span>
					</a>
				</li>
				@if(Route::has('login'))
					<li class="nav-item">
						@auth
							<a class="nav-link position-relative" href="{{route('admin_panel_show_home')}}">Admin panel</a>
						@else 
							<a class="nav-link" href="{{route('login')}}">Login</a>
						@endauth
					</li>
				@endif
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="tel:+407********">Tel: +407********</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="mailto:contact@restaurant">Email: contact@restaurant</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
