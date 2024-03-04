

@extends('layouts.header_footer')
@section('content')

<style>

    #admin-panel {
        display:flex;
        flex-direction:row;
        background-color: #3c6e71;
    }

    #admin-panel-options-list {
        height: calc(100vh - 106px);
    }

    #admin-panel-option {
        width: calc(100vw - 280px);
    }

</style>


<div id="admin-panel">

    <?php 
        $uri = explode("/", $_SERVER['REQUEST_URI']);
        $option = end($uri);
    ?>

    @include('admin.admin_sidebar')
    
    <div id="admin-panel-option">
        @include('admin.options.'.$option)
    </div>

</div>


@endsection

