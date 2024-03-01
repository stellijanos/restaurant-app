

@extends('layouts.header_footer')
@section('content')

<h1>Welcome back, <?=isset($_COOKIE['username']) ? $_COOKIE['username']: ''?> </h1> 



<p><a href="{{route('logout')}}">Logout</a></p>

@endsection



