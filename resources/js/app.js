import './bootstrap';

import.meta.glob('../images/logo/*.{png,jpg,jpeg,svg,webp}', { eager: true });

const isVisible = (el) => !el.classList.contains('hidden');

const show = (el) => {
    el.classList.remove('hidden');
    document.documentElement.classList.add('overflow-hidden');
};

const hide = (el) => {
    el.classList.add('hidden');
    document.documentElement.classList.remove('overflow-hidden');
};

const showMobileNav = (navEl) => {
    const panel = navEl.querySelector('[data-mobile-nav-panel]');
    navEl.classList.remove('pointer-events-none', 'opacity-0');
    navEl.classList.add('pointer-events-auto', 'opacity-100');
    if (panel) {
        panel.classList.remove('translate-x-[-100%]');
        panel.classList.add('translate-x-0');
    }
    document.documentElement.classList.add('overflow-hidden');
};

const hideMobileNav = (navEl) => {
    const panel = navEl.querySelector('[data-mobile-nav-panel]');
    navEl.classList.add('pointer-events-none', 'opacity-0');
    navEl.classList.remove('pointer-events-auto', 'opacity-100');
    if (panel) {
        panel.classList.add('translate-x-[-100%]');
        panel.classList.remove('translate-x-0');
    }
    document.documentElement.classList.remove('overflow-hidden');
};

document.addEventListener('DOMContentLoaded', () => {
    const mobileNav = document.querySelector('[data-mobile-nav]');
    const mobileNavToggle = document.querySelector('[data-mobile-nav-toggle]');
    const mobileNavCloseButtons = document.querySelectorAll('[data-mobile-nav-close]');

    if (mobileNav && mobileNavToggle) {
        mobileNavToggle.addEventListener('click', () => showMobileNav(mobileNav));
        mobileNavCloseButtons.forEach((btn) => btn.addEventListener('click', () => hideMobileNav(mobileNav)));

        mobileNav.querySelectorAll('a[href^="#"]').forEach((link) =>
            link.addEventListener('click', () => hideMobileNav(mobileNav))
        );
    }

    const localeDropdown = document.querySelector('[data-locale-dropdown]');
    const localeButton = document.querySelector('[data-locale-dropdown-button]');
    const localeMenu = document.querySelector('[data-locale-dropdown-menu]');

    const closeLocaleMenu = () => {
        if (localeMenu) {
            localeMenu.classList.add('hidden');
        }
    };

    if (localeDropdown && localeButton && localeMenu) {
        localeButton.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            localeMenu.classList.toggle('hidden');
        });

        localeMenu.addEventListener('click', (e) => e.stopPropagation());

        document.addEventListener('click', () => closeLocaleMenu());
    }

    document.addEventListener('keydown', (e) => {
        if (e.key !== 'Escape') {
            return;
        }

        if (mobileNav && !mobileNav.classList.contains('pointer-events-none')) {
            hideMobileNav(mobileNav);
        }

        closeLocaleMenu();
    });
});
