

@extends('layouts.header_footer')

@section('content')

<style>
    body {
        background-color: #3c6e71;
    }
</style>

<h1>Homepage - Restaurant App</h1>

<ul><a href="{{route('login_form')}}">Login</a></ul>

@endsection
