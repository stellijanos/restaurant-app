<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{asset('/public/js/Cookie.js')}}" ></script>
<script src="{{asset('/public/js/cart.js')}}" ></script>
<script>
    const cart = new Cart(Cookie.get('cart'));
    cart.setCartItemsNr();
</script>
