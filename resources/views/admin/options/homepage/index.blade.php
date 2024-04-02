@extends('layouts.admin')

@section('admin-panel')

<?php $source = 'admin.options.homepage.';?>

@include($source.'bar')
<div id="images-listing" class="overflow-auto">
    @if(count($images) === 0)
        @include($source.'no-images')
    @else
        @include($source.'list-all')
    @endif
</div>

@endsection
