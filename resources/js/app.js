import './bootstrap';
import './theme';
import 'htmx.org';

import.meta.glob('../images/logo/*.{png,jpg,jpeg,svg,webp}', { eager: true });

import Alpine from 'alpinejs';

import focus from '@alpinejs/focus';

import { initSmoothScroll } from './ui/smoothScroll';

Alpine.plugin(focus);
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    try {
        const shouldRestore = sessionStorage.getItem('restoreScroll') === '1';
        if (shouldRestore) {
            const x = Number(sessionStorage.getItem('restoreScrollX') || '0');
            const y = Number(sessionStorage.getItem('restoreScrollY') || '0');
            sessionStorage.removeItem('restoreScroll');
            sessionStorage.removeItem('restoreScrollX');
            sessionStorage.removeItem('restoreScrollY');
            window.scrollTo({ left: x, top: y, behavior: 'auto' });
        }
    } catch (e) {
    }

    initSmoothScroll();
});
