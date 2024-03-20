
@extends('layouts.header-footer')
@section('content')
@if($_COOKIE['cart'] == '{}') 
    @include('cart.empty')
@else 
    @php
        $cookie_cart = json_decode($_COOKIE["cart"], true);
    @endphp
    @include('cart.cart')
@endif
@endsection
