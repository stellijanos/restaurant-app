

document.addEventListener("DOMContentLoaded", function() {

    const cookieBanner = document.getElementById("cookie-consent");
    const acceptBtn = document.getElementById("accept-cookies");
    const declineBtn = document.getElementById("decline-cookies");

    let cookieValue = Cookie.get('cookie_consent');

    if (cookieValue !== 'accepted') {
        cookieBanner.style.display = "block";
    } else {
        Cookie.set("cookie_consent", "accepted", 30);
        if (!Cookie.get('cart')) {
            Cookie.set("cart", JSON.stringify({}), 30);
        }
    }

    acceptBtn.addEventListener("click", function() {
        Cookie.set("cookie_consent", "accepted", 30);
        Cookie.set("cart", JSON.stringify({}), 30);
        cookieBanner.style.display = "none";
        window.location.reload();
    });

    declineBtn.addEventListener("click", function() {
        Cookie.set("cookie_consent", "declined", 30);
        cookieBanner.style.display = "none";
    });
});
