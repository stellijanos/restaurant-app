
<div id="checkout-div">
    <div id="checkout">
        <p style="font-size:1.75rem;"><strong>Order summary</strong></p><hr>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="delivery-type" id="delivery" value="delivery" onclick="cart.updateCheckoutShippingFee(this)">
            <label  class="form-check-label" for="delivery">Delivery</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="delivery-type" id="pickup" value="pickup" onclick="cart.updateCheckoutShippingFee(this)">
            <label class="form-check-label" for="pickup">Personal pick-up</label>
        </div>
        <p>Products price: <span id="products-sum">{{$products_price}}</span>&euro;</p><hr>
        <p>Shipping fee: <span id="shipping-fee">0</span>&euro;</p><hr class="border-5">
        <p>Total price: <span id="total-price">0</span>&euro;</p><hr>

        <a href="{{route('show_checkout')}}"><button type="submit" class="btn btn-secondary">Proceed to checkout >></button></a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    cart.cartUI.setCheckoutElements();
});



</script>



