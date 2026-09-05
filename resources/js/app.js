import './bootstrap';

const toggle = document.querySelector('[data-menu-toggle]');
const menu = document.querySelector('[data-mobile-menu]');

if (toggle && menu) {
    const setMenu = (open, returnFocus = false) => {
        toggle.setAttribute('aria-expanded', String(open));
        menu.classList.toggle('hidden', !open);
        toggle.querySelector('[data-menu-label]').textContent = open ? 'Close menu' : 'Open menu';
        toggle.querySelector('[data-menu-open]').classList.toggle('hidden', open);
        toggle.querySelector('[data-menu-close]').classList.toggle('hidden', !open);

        if (open) menu.querySelector('a')?.focus();
        if (!open && returnFocus) toggle.focus();
    };

    toggle.addEventListener('click', () => setMenu(toggle.getAttribute('aria-expanded') !== 'true'));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') setMenu(false, true);
    });
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) setMenu(false);
    });
}

document.querySelector('[data-validation-errors]')?.focus();
