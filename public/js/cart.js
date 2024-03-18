class Cart {

    constructor(cart) {
        this._cart = JSON.parse(cart);
    }


    get() {
        return this._cart;
    }


    getNrElements() {
        return Object.values(this._cart).reduce((sum, curr) => sum + curr, 0);
    }


    #addNewItem(id, quantity) {
        this._cart[id] = quantity;
    }


    #updateExisting(id, quantity) {

        let nrElems = this._cart[id];

        if (!this.#isValidQuantity(quantity, nrElems)) {
            return;
        } 
        this._cart[id] += quantity;
    }


    #save_cart() {
        Cookie.set('cart', JSON.stringify(this._cart), 30);
    }


    #existsItem(id) {
        return this._cart.hasOwnProperty(id);
    }


    #isValidQuantity(quantity, nrItems) {

        if (quantity + nrItems < 1) {
            alert('Minimum quantity of a menu item is 1.');
            return false;
        } else if (quantity + nrItems > 10) {
            alert('Maximum quantity of a menu item is 10.');
            return false;
        }
        return true;
    }


    #update_price_tag(id, price, quantity) {
        document.getElementById('price-' + id).innerText = (price * quantity).toFixed(2);
    }


    setNrElementsTag() {
        let cart_nr_elements_tag = document.getElementById('cart-quantity');
        cart_nr_elements_tag.innerText = this.getNrElements();
    }


    update_quantity_tag(id, price, quantity) {

        let quantityInput =  document.getElementById('quantity-' + id);

        let currentquantity = Number(quantityInput.value);

        if (!this.#isValidQuantity(quantity, currentquantity)) {
            return;
        }
        quantityInput.value =  document.getElementById('text-quantity-' + id).innerText = currentquantity += quantity;

        this.#update_price_tag(id, price, currentquantity);

    }


    fill_icon(id, type) {
        document.getElementById('quantity-icon-'+ type + '-' + id).classList.remove('bi-' + type + '-circle');
        document.getElementById('quantity-icon-'+ type + '-' + id).classList.add('bi-' + type + '-circle-fill');
    }


    unfill_icon(id, type) {
        document.getElementById('quantity-icon-'+ type + '-' + id).classList.remove('bi-' + type + '-circle-fill');
        document.getElementById('quantity-icon-'+ type + '-' + id).classList.add('bi-' + type + '-circle');
    }


    add_to_cart_tag(id) {
    
        let quantity = Number(document.getElementById('quantity-' + id).value);
        this.add_to_cart(id, quantity);
    }

   
    add_to_cart(id, quantity) {
        
        if (!this.#existsItem(id)) {
            this.#addNewItem(id, quantity);
        } else {
            this.#updateExisting(id, quantity);
        }
        this.#save_cart();
        this.setNrElementsTag();
    }

}
