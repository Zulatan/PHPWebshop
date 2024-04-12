document.addEventListener("DOMContentLoaded", function() {
    var dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('click', function() {
            dropdown.querySelector('.dropdown-menu').classList.toggle('show');
        });

        dropdown.addEventListener('mouseleave', function() {
            dropdown.querySelector('.dropdown-menu').classList.remove('show');
        });
    });
});