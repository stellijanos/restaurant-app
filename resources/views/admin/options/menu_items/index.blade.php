@extends('layouts.admin')

@section('admin-panel')
<?php $source = 'admin.options.menu_items.';?>

<link rel="stylesheet" href="{{asset('public/css/admin/menu-items.css')}}">

@include($source.'bar')

<div id="category-listing" class="overflow-auto">
    @if(is_null($foods)) 
        @include($source.'no-category-chosen')
    @elseif(count($foods) === 0)
        @include($source.'no-menu-items')
    @else
        @include($source.'list-all')
    @endif
</div>

@endsection
