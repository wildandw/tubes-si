document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.nav-menu a');

    links.forEach(link => {
        link.addEventListener('click', function () {
            links.forEach(item => item.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
