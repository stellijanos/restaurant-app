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
    finalPrice.innerText = input.value * price;
}
