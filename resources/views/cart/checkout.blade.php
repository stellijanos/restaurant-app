<div id="checkout">
    <p>Order summary</p><hr>
    <input type="radio" name="delivery-type" id="delivery" value="delivery" checked onclick="cart.updateCheckoutShippingFee(this)">
    <label for="delivery">Delivery</label>
    <input type="radio" name="delivery-type" id="pickup" value="pickup" onclick="cart.updateCheckoutShippingFee(this)">
    <label for="pickup">Personal pick-up</label>
    <p>Products price: <span id="products-sum">{{$products_price}}</span><hr></p>
    <p>Shipping fee: <span id="shipping-fee">0</span><hr></p>
    <p>Total price: <span id="total-price">0</span><hr></p>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    cart.cartUI.setCheckoutElements();
});
</script>

