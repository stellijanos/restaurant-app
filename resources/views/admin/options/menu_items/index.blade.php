
<?php $source = 'admin.options.menu_items.';?>



<style>
   
    #category-listing {
        max-height:calc(100vh - 240px);
        user-select:none;
    }


    .menu-item-block {
        background-color:rgba(211, 211, 211, 0.6);
        margin:10px;
        padding:10px;
        justify-content:space-between;
    }

    .menu-item-form-block, .menu-item-position-block{
        gap:1rem;
    }

    .menu-item-block, .menu-item-value-block, .menu-item-form-block, .menu-item-position-block {
        display:flex;
        flex-direction:row;
        align-items:center;
    }


    .menu-item-value-block>input {
        height:40px;
        border-radius: 5px 0 0 5px;
    }

    .menu-item-value-block>button {
        height:40px;
        border-radius:0 5px 5px 0;
    }

    .menu-item-input-values {
        display:flex;
        flex-direction:column; 
        gap:1rem;
    }


    /* .menu-items-block {
        display:flex;
        flex-direction:column;
    } */

</style>


@include($source.'bar')

<div id="category-listing" class="overflow-auto">
    @if(count($foods) === 0)
        @include($source.'no_menu_items')
    @else
        @include($source.'list_all')
    @endif
</div>
