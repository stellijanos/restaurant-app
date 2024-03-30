@extends('layouts.header-footer')

@section('content')
<style>
    #checkout {
        height:calc(100vh - 108.4px);

        display:flex;
        flex-direction:row;
    }

    #summary, #personal-info {
        width:50%;
        padding:10px 20px 20px;
        margin:0 auto;
    }

    @media screen and (max-width:800px) {
        #checkout {
            flex-direction:column;
        }

        #summary, #personal-info {
            width:100%;
        }
    }

    .item img {
        border-radius:10px;
    }

    .item {
        display:flex;
        flex-direction:row;
        gap:1rem;
    }
    #products {
        display:flex;
        flex-direction:column;
        /* gap:1rem; */
    }

    ul > li {
        font-size:1.1rem;
    }


</style>


<div id="checkout" class="overflow-auto">
    @include('checkout.summary')
    @include('checkout.personal-info')
</div>

@endsection
