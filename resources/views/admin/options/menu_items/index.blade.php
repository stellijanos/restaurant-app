
<style>
    #menu-items-header,  #form-add-menu-item{
        display:flex;
        flex-direction:row;
        align-items:center;
    }

    #form-add-menu-item {
        justify-content:space-between;
        gap:1rem;
    }

    #category-listing {
        max-height:calc(100vh - 240px);
    }
</style>


@include('admin.options.edit_menu.bar')

<div id="category-listing" class="overflow-auto">
    @if(count($foods) === 0)
        @include('admin.options.edit_menu.no_menu_items')
    @else
        @include('admin.options.edit_menu.list_all')
    @endif
</div>
