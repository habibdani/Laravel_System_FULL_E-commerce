import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/maps-script.js'
                // 'resources/js/shop-script.js',
                // 'resources/js/product-script.js',
            ],
            refresh: true,
        }),
    ],
    // Menambahkan rule agar folder fonts termasuk dalam build
    publicDir: 'public',
});
