
class CartUI {

    setCartNrElementsTag(nr) {
        let cart_nr_elements_tag = document.getElementById('cart-quantity');
        cart_nr_elements_tag.innerText = nr;
    }


    fillIcon(id, type) {
        document.getElementById('quantity-icon-'+ type + '-' + id).classList.remove('bi-' + type + '-circle');
        document.getElementById('quantity-icon-'+ type + '-' + id).classList.add('bi-' + type + '-circle-fill');
    }


    unfillIcon(id, type) {
        document.getElementById('quantity-icon-'+ type + '-' + id).classList.remove('bi-' + type + '-circle-fill');
        document.getElementById('quantity-icon-'+ type + '-' + id).classList.add('bi-' + type + '-circle');
    }

    _getItemQuantityValue(id) {
        return Number(document.getElementById('quantity-' + id).value);
    }

    _setItemQuantityValue(id, quantity) {
        document.getElementById('quantity-' + id).value =  document.getElementById('text-quantity-' + id).innerText = quantity;
    }

    /**
     * Updates the price in the UI
     * 
     * @param {Number} id - the Id of the item 
     * @param {Number} price - the price of the item
     * @param {NUmber} quantity - desired quantity
     */
    _setItemPrice(id, quantity, price) {
        document.getElementById('price-' + id).innerText = (price * quantity).toFixed(2);
    }


    setCheckoutElements() {
        let delivery_type = document.querySelector('input[name="delivery-type"]:checked');
        let products_sum_elem = document.getElementById('products-sum');
        let shipping_fee_elem = document.getElementById('shipping-fee');
        let total_price_elem = document.getElementById('total-price');

        // products_sum_elem.innerText = price;
        shipping_fee_elem.innerText = delivery_type.value === "pickup" || Number(products_sum_elem.innerText) >=100 ? 0 : 5;
        total_price_elem.innerText = Number(products_sum_elem.innerText) + Number(shipping_fee_elem.innerText); 
    }

    getPrices() {
        return document.querySelectorAll("span[id^='price-']");
    }


    setProductsPrice(price) {
        document.getElementById('products-sum').innerText = price;
    }

    

}






class Cart {


    // create
    constructor(cart) {
        this._cart = JSON.parse(cart);
        this.cartUI = new CartUI();
    }


    // read
    /**
     * @returns {Object}
     */
    get() {
        return this._cart;
    }


    /**
     * saves the cart object as a cookie
     */
    #save_cart() {
        Cookie.set('cart', JSON.stringify(this._cart), 30);
    }


    /**
     * 
     * @returns {Number} -nr of items in the cart.
     */
    getNrElements() {
        return Object.values(this._cart).reduce((sum, curr) => sum + curr, 0);
    }



    setCartItemsNr() {
        let nrItems = this.getNrElements()
        this.cartUI.setCartNrElementsTag(nrItems);
    }




    /**
     * Validates the quantity of an item to be added to the cart.
     * 
     * @param {Number} quantity - the quantity of item we want to add.
     * @param {Number} nrItems - the the quantity of that item that already exists in the cart.
     * @returns {boolean}  - returns true, if the final quantity of an item in the cart is between 1 and 10 (inclusive).
     */
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



    /**
     * Adds a new item to the cart.
     * 
     * @param {Number} id - the id of the item.
     * @param {Number}} quantity - the quantity we want to add.
     * @returns the cart with the given quantity if its valid, otherwise nothing.
     */
    #addNewItem(id, quantity) {
        if (!this.#isValidQuantity(quantity, 0)) {
            return;
        }
        this._cart[id] = quantity;
    }


    #addItem(id, quantity) {

        let nrElems= this._cart[id] || 0;
        if (!this.#isValidQuantity(quantity, nrElems)) {
            return;
        }

        this._cart[id] = nrElems + quantity;
    }


    /**
     * 
     * @param {Number} id 
     * @param {Number} quantity 
     * @returns 
     */
    #updateExisting(id, quantity) {

        let nrElems = this._cart[id];

        if (!this.#isValidQuantity(quantity, nrElems)) {
            return;
        } 
        this._cart[id] += quantity;
    }


    /**
     * Checks if the cart contains the id or not.
     * 
     * @param  {Number} id - the id of the element to check.
     * @returns {bool} - true if the item exists, false otherwise.
     */
    #existsItem(id) {
        return this._cart.hasOwnProperty(id);
    }



    updateItemQuantity(id, price, quantity) {

        let currentquantity = this.cartUI._getItemQuantityValue(id);

        if (!this.#isValidQuantity(quantity, currentquantity)) {
            return;
        }

        this.cartUI._setItemQuantityValue(id, currentquantity + quantity);
        this.cartUI._setItemPrice(id, currentquantity + quantity, price);
        return true;
    }



    addToCart(id) {
    
        let quantity = this.cartUI._getItemQuantityValue(id);
        
        this.#addItem(id, quantity);
        this.#save_cart();
        this.cartUI.setCartNrElementsTag(this.getNrElements());
    }

    #removeFromCart(id) {
        delete this._cart[id];
        this.#save_cart();
    }



    updateCartItem(id, price, quantity) {

        if (!this.#existsItem(id)) {
            return;
        } 

        if (this.updateItemQuantity(id, price, quantity)) {
            this._cart[id] += quantity;
            this.#save_cart();

            let total_price = this.#calculateTotalPrice();

            this.cartUI.setProductsPrice(total_price);
            this.cartUI.setCheckoutElements();
            this.cartUI.setCartNrElementsTag(this.getNrElements());
        }
    }


    #calculateTotalPrice() {
        return Array.from(this.cartUI.getPrices())
            .map(price => Number(price.innerText))
            .reduce((acc, curr) => {
                return acc + curr;
            },0);
    }



    removeItem(id) {
        if (!this.#existsItem(id)) {
            alert('item does not exist')
            return;
        }

        if(window.confirm("Are you sure you want to delete?")) {
            this.#removeFromCart(id);
            window.location.reload();
        }
    }

    updateCheckoutShippingFee(input) {
        input.checked = true;
        this.cartUI.setCheckoutElements();
    }

    updateCheckoutTotalPrice() {

    }

}

