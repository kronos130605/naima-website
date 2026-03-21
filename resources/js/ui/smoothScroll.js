export const initSmoothScroll = () => {
    document.querySelectorAll('a[href^="#"]').forEach((a) => {
        a.addEventListener('click', (e) => {
            const href = a.getAttribute('href');
            if (!href || href === '#') {
                return;
            }

            const target = document.querySelector(href);
            if (!target) {
                return;
            }

            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });

            const url = new URL(window.location.href);
            url.hash = href;
            window.history.replaceState({}, '', url);
        });
    });
};
