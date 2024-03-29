
@extends('layouts.header-footer')
@section('content')
@php
    $json_cart = $_COOKIE['cart'] ?? '{}';
@endphp
@if($json_cart == '{}') 
    @include('cart.empty')
@else 
    @php
        $cookie_cart = json_decode($json_cart, true);
    @endphp
    @include('cart.cart')
@endif
@endsection
