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
    server: {
        host: '0.0.0.0', // Dengarkan semua alamat IP
        port: 5173,      // Gunakan port default
        hmr: {
            host: 'https://andalprima.hansmade.online', // IP atau domain publik Anda
        },
    },
    // Menambahkan rule agar folder fonts termasuk dalam build
    publicDir: 'public',
});
