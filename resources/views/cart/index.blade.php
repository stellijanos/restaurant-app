
@extends('layouts.header-footer')

@section('content')

@if($_COOKIE['cart'] == '{}') 
    @include('cart.empty')
@else 
    @include('cart.products')
@endif

@endsection
