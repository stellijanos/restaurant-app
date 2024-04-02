@extends('layouts.admin')

@section('admin-panel')
<link rel="stylesheet" href="{{asset('/public/css/admin/menu_categories.css')}}">

<?php $source = 'admin.options.menu_categories.';?>

@include($source.'bar')
<div id="category-listing" class="overflow-auto">
    @if(count($categories) === 0)
        @include($source.'no-categories')
    @else
        @include($source.'list-all')
    @endif
</div>

@endsection
