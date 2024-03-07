
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


@include('admin.options.menu_items.bar')


