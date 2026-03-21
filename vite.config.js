import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/theme.js',
                'resources/js/app.js',
            ],
            refresh: true,
            hotFile: 'storage/vite.hot',
        }),
        tailwindcss(),
    ],

    server: {
        host: '0.0.0.0',
        port: 5173,
        cors: true,
        origin: 'http://localhost:8081',

        hmr: {
            host: 'localhost',
            port: 5173,
            clientPort: 8081,
            protocol: 'ws',
            path: '/@vite',
        },
    },
});
