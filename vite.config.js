import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/header-script.js',
            ],
        }),
    ],
    build: {
        outDir: 'public/build',   // Output utama di public/build
        assetsDir: 'assets',      // Aset disimpan di folder assets
        manifest: true,           // Buat manifest.json
        rollupOptions: {
            input: {
                main: 'resources/js/app.js',
                styles: 'resources/css/app.css',
            },
        },
        emptyOutDir: true,        // Hapus folder build sebelum build baru
    },
    base: '/build/', // Path dasar untuk semua resource
});
