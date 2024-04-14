

@extends('layouts.header-footer')
@section('content')

<link rel="stylesheet" href="{{asset('public/css/menu.css')}}" type="text/css">

<div id="menu" class="overflow-auto">
    @foreach($categories as $category)
        @include('menu/item')
    @endforeach
</div>

@endsection
