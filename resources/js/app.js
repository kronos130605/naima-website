import './bootstrap';

import.meta.glob('../images/logo/*.{png,jpg,jpeg,svg,webp}', { eager: true });

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

import { initSmoothScroll } from './ui/smoothScroll';

Alpine.plugin(focus);
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initSmoothScroll();
});
