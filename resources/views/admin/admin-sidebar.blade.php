
<?php
$options = [
            'home' => 'Home', 
            'orders' => 'Orders', 
            'customers' => 'Customers',
            'menu_categories' => 'Menu Categories',
            'menu_items' => 'Menu Items'
        ];
?>

<script type="text/javascript" src="{{asset('/public/js/admin/script.js')}}"></script>


<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;" id="admin-panel-options-list">
    <p class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">Admin panel</span>
    </p>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        @foreach($options as $key => $value)
            <li class="nav-item">
                <a href="{{route('admin_panel_show_'.$key)}}" class="nav-link text-white" aria-current="page" id="admin-{{$key}}">{{$value}}</a>
            </li>
        @endforeach
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{asset('storage/app/public/images/profile/'.(is_null(auth()->user()->image) ? 'blank-profile-picture.png' : auth()->user()->image))}}" alt="profile-picture" width="32" height="32" class="rounded-circle me-2">
            <strong>{{auth()->user()->name}}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-profile">Edit Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
        </ul>
    </div>
</div>

@include('admin/edit-profile-modal')

<script src="{{asset('/public/js/admin/script.js')}}"></script>
