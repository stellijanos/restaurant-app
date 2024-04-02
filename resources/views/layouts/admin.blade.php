@extends('layouts.header-footer')
@section('content')

<style>

    #admin-panel {
        display:flex;
        flex-direction:row;
        /* background-color: #3c6e71; */
        height:calc(100vh - 106px);
    }

    #admin-panel-options-list {
        height: calc(100vh - 106px);
    }

    #admin-panel-option {
        width: calc(100vw - 280px);
    }

    #admin-image {
        display:flex;
        justify-content:center;
        align-items:center;
    }

    .nav-link.active {
      background-color: grey !important; 
      color: white; 
    }

</style>


<div id="admin-panel">

    @include('admin.admin-sidebar')
    
    <div id="admin-panel-option" class="overflow-auto">
       @yield('admin-panel')
    </div>
</div>

@endsection
