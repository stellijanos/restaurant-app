<style>
    #empty-cart {
        height:calc(100vh - 106px);
        display:flex;
        justify-content:center;
        align-items:center;
    }

    #empty-cart > button {
        width:200px;
        height:75px;
    }
</style>

<div id="empty-cart">
    <a href="{{route('home')}}"><button class="btn btn-secondary">Empty cart<br>Grab some food :)</button></a>
</div>
