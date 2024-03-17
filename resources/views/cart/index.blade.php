
@extends('layouts.header-footer')

@section('content')

<style>
    #cart-div {
        height:calc(100vh - 106px);
    }
</style>

<div id="cart-div">
    <h1>Cart</h1>
    @foreach($cart as $item) 
    <div class="item">
        <p>{{$item->id}} - {{$item->quantity}} - {{$item->price}}</p>
    </div>
    @endforeach
</div>
@endsection
