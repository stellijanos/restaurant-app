<p>Restaurant app</p>

<a href="restaurant.stellijanos.com">Checkout the live app</a>


## Technologies used
- Frontend: HTML5, CSS3, Bootstrap, Javascript
- Backend: Laravel, Blade, also (basic) PHP


## ABOUT THIS APP

## User functionalities

![Homepage](https://restaurant.stellijanos.com/storage/app/public/images/documentation/homepage.png)
- Here is the homepage which shows instantly the menu items with their details
- The navbar is the same for all the pages of this web app it and contains
- Also here can the user click on any menu item and a modal will pop up
<br><br><br><br>

![Add to cart exception](https://restaurant.stellijanos.com/storage/app/public/images/documentation/add-to-cart-exception.png)
- Here is the previous mentioned modal, which provides a better view of the menu item
- The user cannot add to cart less then 1 item and more then 10 of the same item (just a number I random set)
- If it wants to, it throws a basic alert with exception message
<br><br><br><br>

![Add to cart](https://restaurant.stellijanos.com/storage/app/public/images/documentation/add-to-cart.png)
- Here can the user select the desired quantity (between 1 and 10)
- Then it can add to the cart and the cart quantity in the navbar will be automatically updated
- Add or cancel and it goes back to the menu 
<br><br><br><br>

![empty-cart](https://restaurant.stellijanos.com/storage/app/public/images/documentation/empty-cart.png)
- An empty cart looks like this
- It has a button that redirects the user to the homepage (which is also the menu page)
<br><br><br><br>

![cart](https://restaurant.stellijanos.com/storage/app/public/images/documentation/cart.png)
- A nonempty cart looks like this
- The menu items with quantity options / remove item are listed in the left
- The order summary is listed on the right and the user must choose between delivery or personal pickup (by defualt it is delivery)
- The prices change dynamically if a products quantity is changed or is removed, or when the sum of products is more then 100 and delivery option is selected 
<br><br><br><br>

![checkout sum-del](https://restaurant.stellijanos.com/storage/app/public/images/documentation/checkout-summary-delivery.png)
- This is example of delivery type of order
- On the left is listed a read-only version of the cart with the items
- On the right the user must enter their info in order to fullfill the order
<br><br><br><br>

![check-sum-pickup](https://restaurant.stellijanos.com/storage/app/public/images/documentation/checkout-summary-pickup.png)
- This is example of pick-up order
- The user must enter only his full name, phone and email, address is not required
<br><br><br><br>

![order confirm](https://restaurant.stellijanos.com/storage/app/public/images/documentation/order-confirm.png)
- After the user successfully enters their client info, the orders successfully procession is confirmed by this message
- Every orders status is automcatically set to 'pending'
- The cart is automatically emptied
- It also has a link back to the homepage
<br><br><br><br>


## Admin functionalities

![login](https://restaurant.stellijanos.com/storage/app/public/images/documentation/login.png)
- This is the login form / portal for the admin
- Currently the app has only 1 admin (1 email associated with 1 password)
- It is secured and validated in the backend with laraval's middleware auth
- All the admin options pages are protected with that middleware so they are available if the admin is successfully logged in
<br><br><br><br>


![admin panel home](https://restaurant.stellijanos.com/storage/app/public/images/documentation/admin-panel-home.png)
- After the admin successfully logs in, it is redirected to this 'Admin panel home', where statistics about the restaurants business-part are visible with numbers but also with the help of charts
- All the admin options are listed in the left sidebar of the view
<br><br><br><br>

![admin panel home](https://restaurant.stellijanos.com/storage/app/public/images/documentation/admin-panel-edit-profile.png)
- The admin has also the option to edit his profile, to upload/change profile picture, to edit his name, email address, but to also change his password
<br><br><br><br>

![Admin panel orders](https://restaurant.stellijanos.com/storage/app/public/images/documentation/admin-panel-orders.png)
- In this part, can the admin see data about the orders in different periods and are represented using bar charts
<br><br><br><br>

![Admin panel order statuses](https://restaurant.stellijanos.com/storage/app/public/images/documentation/admin-panel-order-statuses.png)
- If the admin chooses an order status option, it shows all the orders with that specific current status
- The admin can change the statuses so the order process is updated
<br><br><br><br>

![admin panel menu categories](https://restaurant.stellijanos.com/storage/app/public/images/documentation/admin-panel-menu-categories.png)
- Here can view the admin all the menu categories available and it can be renamed and arrange thei position on the menu page (homepage)
<br><br><br><br>

![Admin panel add menu category](https://restaurant.stellijanos.com/storage/app/public/images/documentation/admin-panel-add-menu-category.png)
- Here can the admin add new menu cateogory, it just has a name that is necessary to input
<br><br><br><br>


![admin-panel-menu-items](https://restaurant.stellijanos.com/storage/app/public/images/documentation/admin-panel-menu-items.png)
- Here are all the menu items visible grouped by categories
<br><br><br><br>


![edit menu](https://restaurant.stellijanos.com/storage/app/public/images/documentation/admin-panel-edit-menu-item.png)
- Here is an example for editing a menu item, the image can be changed/removed, name, weight, price, cateogry and to show in the menu can be modified 
<br><br><br><br>


That's it. It is a very short presentation. If you want to see live usage, contact me on [my website.](https://stellijanos.com/cl=gh)
