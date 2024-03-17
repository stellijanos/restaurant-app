const change_quantity_price = (id, price, increment = false) => {

    let input = document.getElementById('quantity-'+id);
    let text = document.getElementById('text-quantity-' + id);

    let finalPrice = document.getElementById('price-' + id);


    if (increment) {
        if (input.value >= 10) {
            alert('Maximum quantity is 10');
            input.value = 10;
        } else {
            input.value++;
        }
    } else {
        if (input.value <=1) {
            alert('Minimum quantity is 1');
            input.value = 1;
        } else {
            input.value--;
        }
    }
    text.innerText = input.value;
    finalPrice.innerText = (input.value * price).toFixed(2);
}

function addToCart(id) {

    let quantity = Number(document.getElementById('quantity-' + id).value);

    if (cart.hasOwnProperty(id)) {
        cart[id] += quantity;
    } else {
        cart[id] = quantity;
    }

    setCookie('cart', JSON.stringify(cart), 30);

    food_cart_nr.innerText = getNrElements(cart);
}
