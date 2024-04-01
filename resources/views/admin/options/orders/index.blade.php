
<style>
    #list-all-orders {
        height: calc(100vh - 106px);
    }

    table {
        border-collapse:collapse;
    }

    td, th {
        border:1px solid #000;
        padding:5px;
    }

    #order-list {
        display:flex;
        flex-direction:row;
        justify-content:space-between;
        padding:20px;
        flex-wrap:wrap;
        gap:2rem;
        min-width:370px;
    }

    #orders-header {
        display:flex;
        flex-direction:row;
        gap:1rem;
        justify-content:flex-start;
        align-items:center;
    }


    @media screen and (max-width:1150px) {
        
    }



</style>
<?php 
    $source = 'admin.options.orders.';
    $order_statuses = ['pending', 'preparing', 'delivering', 'delivered', 'cancelled'];
?>

<div id="list-all-orders" class="overflow-auto">
    @include($source.'bar')

    @if(is_null($orders)) 
        @include($source.'no-status-chosen')
    @elseif(count($orders) === 0)
        @include($source.'no-orders')
    @else
        @include($source.'list-all')
    @endif
</div>

<script>
    const getOrdersByStatus = select => {
        const url = select.value;
        if (url !== "") {
            window.location.href=url;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('admin-orders').classList.add('active'); 
    });

</script>
