

@extends('layouts.header-footer')
@section('content')

<style>

    #admin-panel {
        display:flex;
        flex-direction:row;
        /* background-color: #3c6e71; */
    }

    #admin-panel-options-list {
        height: calc(100vh - 106px);
    }

    #admin-panel-option {
        width: calc(100vw - 280px);
    }


    #admin-image{
        display:flex;
        justify-content:center;
        align-items:center;
    }

</style>


<div id="admin-panel">

    <?php   
        $uri = explode("/", $_SERVER['REQUEST_URI']);
        
        $index = array_search('admin', $uri);

        $option = $uri[$index+1] ?? '';
    ?>

    @include('admin.admin-sidebar')
    
    <div id="admin-panel-option">

       <?php try { ?>
            @include('admin.options.'.$option.'.index')
         <?php } catch (InvalidArgumentException $e) { ?>
            @include('admin.options.'.end($uri).'.index')
        <?php } ?>
    </div>
</div>

@endsection

