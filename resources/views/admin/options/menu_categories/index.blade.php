
<link rel="stylesheet" href="{{asset('/public/css/admin/menu_categories.css')}}">

@include('admin.options.menu_categories.bar')

<div id="category-listing" class="overflow-auto">
    @if(count($categories) === 0)
        @include('admin.options.menu_categories.no_categories')
    @else
        @include('admin.options.menu_categories.list_all')
    @endif
</div>
