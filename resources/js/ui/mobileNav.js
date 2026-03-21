const getFocusable = (root) => {
    const selectors = [
        'a[href]',
        'button:not([disabled])',
        'input:not([disabled])',
        'select:not([disabled])',
        'textarea:not([disabled])',
        '[tabindex]:not([tabindex="-1"])',
    ];

    return Array.from(root.querySelectorAll(selectors.join(','))).filter((el) => {
        const style = window.getComputedStyle(el);
        return style.visibility !== 'hidden' && style.display !== 'none';
    });
};

export const initMobileNav = () => {
    const mobileNav = document.querySelector('[data-mobile-nav]');
    const toggle = document.querySelector('[data-mobile-nav-toggle]');
    const closeButtons = document.querySelectorAll('[data-mobile-nav-close]');
    const panel = mobileNav?.querySelector('[data-mobile-nav-panel]') ?? null;

    if (!mobileNav || !toggle || !panel) {
        return;
    }

    let lastActive = null;

    const setExpanded = (expanded) => {
        toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    };

    const isOpen = () => !mobileNav.classList.contains('pointer-events-none');

    const open = () => {
        if (isOpen()) {
            return;
        }

        lastActive = document.activeElement instanceof HTMLElement ? document.activeElement : null;

        mobileNav.classList.remove('pointer-events-none', 'opacity-0');
        mobileNav.classList.add('pointer-events-auto', 'opacity-100');

        panel.classList.remove('translate-x-[-100%]');
        panel.classList.add('translate-x-0');

        document.documentElement.classList.add('overflow-hidden');
        setExpanded(true);

        const focusable = getFocusable(panel);
        (focusable[0] ?? panel).focus?.();
    };

    const close = () => {
        if (!isOpen()) {
            return;
        }

        mobileNav.classList.add('pointer-events-none', 'opacity-0');
        mobileNav.classList.remove('pointer-events-auto', 'opacity-100');

        panel.classList.add('translate-x-[-100%]');
        panel.classList.remove('translate-x-0');

        document.documentElement.classList.remove('overflow-hidden');
        setExpanded(false);

        lastActive?.focus?.();
    };

    toggle.addEventListener('click', () => open());
    closeButtons.forEach((btn) => btn.addEventListener('click', () => close()));

    mobileNav.querySelectorAll('a[href^="#"]').forEach((link) => link.addEventListener('click', () => close()));

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            close();
            return;
        }

        if (e.key !== 'Tab' || !isOpen()) {
            return;
        }

        const focusable = getFocusable(panel);
        if (focusable.length === 0) {
            e.preventDefault();
            panel.focus?.();
            return;
        }

        const first = focusable[0];
        const last = focusable[focusable.length - 1];
        const active = document.activeElement;

        if (e.shiftKey) {
            if (active === first || active === panel) {
                e.preventDefault();
                last.focus();
            }
        } else {
            if (active === last) {
                e.preventDefault();
                first.focus();
            }
        }
    });

    setExpanded(false);
};
