import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            hotFile: 'storage/vite.hot', // fuerza la ruta correcta
        }),
        tailwindcss(),
    ],
    build: {
        manifest: true,
        outDir: 'public/build',
        manifestDir: '',
        input: [
            'resources/css/app.css',
            'resources/js/app.js',
        ],
        emptyOutDir: true,
    },
    server: {
        host: 'localhost',
        port: 5173,
        cors: true,
        hmr: {
            host: 'localhost',
            port: 5173,
            protocol: 'ws'
        },
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    }
});
