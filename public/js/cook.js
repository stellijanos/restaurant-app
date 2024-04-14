class Cookie {

    static set(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 3600 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }

    static get(cookie_name) {
        return document.cookie.split("; ").find(row => row.startsWith(cookie_name + "="))?.split("=")[1];
    }
}
