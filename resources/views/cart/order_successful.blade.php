@extends('layouts.header-footer')

@section('content')

<style>
    #confirm-order {
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
        height:calc(100vh - 106px);
        padding:30px;
    }
</style>
<div id="confirm-order">
    <h1 style="text-align:center" class="text-wrap">Thank you for ordering, enjoy your meal!</h1>
    <h4>(<a href="{{route('home')}}">Go to homepage</a>)</h4>
</div>

<script>
    Cookie.set('cart', '{}', 30);
</script>

@endsection
