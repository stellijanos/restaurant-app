document.addEventListener('DOMContentLoaded', function() {
    const getLastURLPart = () => {
        var path = window.location.pathname;
        var parts = path.split('/');
        return parts.pop();
    }

    console.log(getLastURLPart());
    const option = document.getElementById('admin-' + getLastURLPart());
    option.classList.add('active'); 


    const editButtons = document.querySelectorAll('[id^="btn_category_"]');

    const editCategory = () => {

    }

    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            let input = document.getElementById(button.id.replace("btn_", ""));
            input.disabled = false;
        });
    });
});
