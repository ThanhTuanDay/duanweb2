console.log('Current Path:', window.location.pathname);
document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.nav-link');
    let currentPath = window.location.pathname.split('/').pop() || 'homepage';

    navLinks.forEach(link => {
        const linkPath = link.getAttribute('href');
        if (linkPath === currentPath) {
            link.parentElement.classList.add('active');
            link.innerHTML += ' <span class="sr-only">(current)</span>';
        }

        link.addEventListener('click', function (event) {
            event.preventDefault();
            navLinks.forEach(nav => {
                nav.parentElement.classList.remove('active');
                const srOnly = nav.querySelector('.sr-only');
                if (srOnly) srOnly.remove();
            });
            this.parentElement.classList.add('active');
            this.innerHTML += ' <span class="sr-only">(current)</span>';
            window.location.href = linkPath;
        });
    });
});