export const initLocaleDropdown = () => {
    const root = document.querySelector('[data-locale-dropdown]');
    const button = document.querySelector('[data-locale-dropdown-button]');
    const menu = document.querySelector('[data-locale-dropdown-menu]');

    if (!root || !button || !menu) {
        return;
    }

    const setExpanded = (expanded) => {
        button.setAttribute('aria-expanded', expanded ? 'true' : 'false');
    };

    const isOpen = () => !menu.classList.contains('hidden');

    const open = () => {
        menu.classList.remove('hidden');
        setExpanded(true);
    };

    const close = () => {
        menu.classList.add('hidden');
        setExpanded(false);
    };

    button.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        if (isOpen()) {
            close();
        } else {
            open();
        }
    });

    menu.addEventListener('click', (e) => e.stopPropagation());

    document.addEventListener('click', () => close());

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            close();
        }
    });

    setExpanded(false);
};
