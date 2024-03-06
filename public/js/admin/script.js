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

    function handleClick(event) {
        const inputId = this.previousElementSibling.id;
        const input = document.getElementById(inputId);

        input.disabled = false;
        input.style.color="#000";
    }
    
    editButtons.forEach(function(button) {
        button.addEventListener('click', handleClick, false);
    });



});
