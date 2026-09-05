import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.store('confirmDialog', {
        open: false,
        message: '',
        form: null,
        ask(form) {
            this.form = form;
            this.message = form.dataset.confirm || 'Apakah Anda yakin?';
            this.open = true;
        },
        accept() {
            this.open = false;
            if (this.form) this.form.submit();
            this.form = null;
        },
        cancel() {
            this.open = false;
            this.form = null;
        },
    });
});

// Intercept forms with [data-confirm] and show styled dialog instead of window.confirm
document.addEventListener('submit', (e) => {
    const form = e.target.closest('form[data-confirm]');
    if (!form) return;
    e.preventDefault();
    e.stopImmediatePropagation();
    Alpine.store('confirmDialog').ask(form);
}, true);

Alpine.start();

// Reveal on scroll (subtle fade-up micro-interaction)
document.addEventListener('DOMContentLoaded', () => {
    const elements = document.querySelectorAll('[data-reveal]');
    if (elements.length && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.08, rootMargin: '0px 0px -40px 0px' }
        );
        elements.forEach((el) => observer.observe(el));
    } else {
        elements.forEach((el) => el.classList.add('revealed'));
    }

    // Navbar elevation on scroll
    const navbar = document.querySelector('[data-navbar]');
    if (navbar) {
        const onScroll = () => navbar.classList.toggle('scrolled', window.scrollY > 8);
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }
});