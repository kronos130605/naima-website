const THEME_STORAGE_KEY = 'theme';

function getPreferredTheme() {
    const stored = localStorage.getItem(THEME_STORAGE_KEY);
    if (stored === 'dark' || stored === 'light') {
        return stored;
    }

    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
}

function applyTheme(theme) {
    const isDark = theme === 'dark';
    document.documentElement.classList.toggle('dark', isDark);
    if (document.body) {
        document.body.classList.toggle('dark', isDark);
    }
}

function setTheme(theme) {
    localStorage.setItem(THEME_STORAGE_KEY, theme);
    applyTheme(theme);
}

function toggleTheme() {
    const next = document.documentElement.classList.contains('dark') ? 'light' : 'dark';
    setTheme(next);
    window.dispatchEvent(new CustomEvent('theme:changed', { detail: { theme: next } }));
}

// Aplica el tema lo antes posible.
try {
    applyTheme(getPreferredTheme());
} catch (e) {
}

window.__theme = {
    get: () => (document.documentElement.classList.contains('dark') ? 'dark' : 'light'),
    set: setTheme,
    toggle: toggleTheme,
};
