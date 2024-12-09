import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
        }),
    ],
    build: {
        outDir: 'public/build',   // Direktori output untuk build production
        assetsDir: 'assets',      // Direktori tempat file aset
        manifest: true,           // Buat manifest.json
        rollupOptions: {
            input: 'resources/js/app.js', // Entry point
        },
    },
    base: '/build/', // Base path untuk semua aset
});
