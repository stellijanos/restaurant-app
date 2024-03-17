

@extends('layouts.header-footer')
@section('content')

<link rel="stylesheet" href="{{asset('public/css/menu.css')}}">

<div id="menu" class="overflow-auto">
    @foreach($categories as $category)
        @include('menu/item')
    @endforeach
</div>

<script src="{{asset('public/js/menu.js')}}"></script>


@endsection
