<style>
    #cart-div {
        height:calc(100vh - 156px);
        width:100%;
        display:flex;
        flex-direction:row;
        
        padding:10px;
        gap:1rem;
    }

    #products {
        display:flex;
        flex-direction:column;
        width:70%;
        gap:1rem;
    }


    #cart-div .item {
        border:1px solid #000;
        background-color:#fefefa;
        border-radius:10px;
        height:120px;
        width:calc(100vw - 500px);
        min-width:400px;

        display:flex;
        flex-direction:row;
        gap:0.5rem;
    }

    #cart-div .item > .image>img {
        border-radius:10px;
        margin-left:10px;
    }

    #cart-div .item > .image {
        display:flex;
        justify-content:center;
        align-items:center;
        padding:10px 0;
    }

    .item .details-options  {
        width:calc(100% - 110px);
    }

    .item .details-options {
        display:flex;
        flex-direction:row;
        padding:10px;
        justify-content:space-between;
    }


    .set-quantity-div {
        width:90px;
        height:30px;
        
        display:flex;
        flex-direction:row;
        justify-content:center;
        gap:0.5rem;
        margin:auto;
        margin-left:0;
        font-weight:bold;
        font-size:1.3rem;
    }

    .set-quantity-div  p {
        text-align:center;
        user-select:none;
        width:40px;
    }

    .set-quantity-div i {
        cursor:pointer;
    }

    .set-quantity-div i:hover {
        cursor:pointer;
    }

    .item .remove {
        text-decoration:underline;
        cursor:pointer;
        user-select:none;
    }


    #checkout {
        border:1px solid #000;
        border-radius:10px;
        min-width:300px;
        max-width:500px;
    }

</style>

<div class="order-process" style="height:50px; border:1px solid #000;">
    <h1 style="margin-left:10px;">Your cart</h1>
</div>
<div id="cart-div" class="overflow-auto">
    @include('cart.products')
    @include('cart.checkout')
</div>
