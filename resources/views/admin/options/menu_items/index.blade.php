
<?php $source = 'admin.options.menu_items.';?>



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


@include($source.'bar')

<div id="category-listing" class="overflow-auto">
    @if(count($foods) === 0)
        @include($source.'no_menu_items')
    @else
        @include($source.'list_all')
    @endif
</div>
