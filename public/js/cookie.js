

function getCookieValue(cookie_name) {
    let cookies_array = document.cookie.split(';');

    cookies_array = cookies_array.filter(function(cookie) {
        arr = cookie.split('=');

        return arr[0].trim() == cookie_name;
    });

    if (cookies_array.length === 0) {
        return null;
    }
    cookie_str = cookies_array[0].trim();
    return cookie_str.split('=')[1].trim();
}

document.addEventListener("DOMContentLoaded", function() {

    const cookieBanner = document.getElementById("cookie-consent");
    const acceptBtn = document.getElementById("accept-cookies");
    const declineBtn = document.getElementById("decline-cookies");

    let cookieValue = getCookieValue('cookie_consent');

    if (cookieValue !== 'accepted') {
        cookieBanner.style.display = "block";
    } else {
        setCookie("cookie_consent", "accepted", 30);
        if (!getCookieValue('cart')) {
            setCookie("cart", JSON.stringify({}), 30);
        }
    }

    acceptBtn.addEventListener("click", function() {
        setCookie("cookie_consent", "accepted", 30);
        setCookie("cart", JSON.stringify({}), 30);
        cookieBanner.style.display = "none";
    });

    declineBtn.addEventListener("click", function() {
        setCookie("cookie_consent", "declined", 30);
        cookieBanner.style.display = "none";
    });
});