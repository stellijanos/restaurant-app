

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
                <a href="{{route('admin_panel_option', ['option' => $key])}}" class="nav-link text-white" aria-current="page" id="admin-{{$key}}">{{$value}}</a>
            </li>
        @endforeach
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>{{$_COOKIE['username']}}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="#">New project...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
        </ul>
    </div>
</div>
