document.addEventListener('DOMContentLoaded', function () {
    const header = document.querySelector('.header');

    if (!header) return;

    window.addEventListener('scroll', function () {
        if (window.scrollY > 50) {
            header.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
        } else {
            header.style.boxShadow = 'none';
        }
    });
});