
<link rel="stylesheet" href="{{asset('/public/css/admin/menu_categories.css')}}">

@include('admin.options.edit_menu.bar')

<div id="category-listing" class="overflow-auto">
    @if(count($categories) === 0)
        @include('admin.options.edit_menu.no_categories')
    @else
        @include('admin.options.edit_menu.list_all')
    @endif
</div>
