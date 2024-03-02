document.addEventListener('DOMContentLoaded', function() {
    const getLastURLPart = () => {
        var path = window.location.pathname;
        var parts = path.split('/');
        return parts.pop();
    }

    console.log(getLastURLPart());
    const option = document.getElementById('admin-' + getLastURLPart());
    option.classList.add('active'); 
});
