import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'https://andalprima.handmade.online/css/app.css',
                'https://andalprima.handmade.online/js/app.js',
                'https://andalprima.handmade.online/js/maps-script.js'
                // 'resources/js/shop-script.js',
                // 'resources/js/product-script.js',
            ],
            // input: [
            //     'resources/css/app.css',
            //     'resources/js/app.js',
            //     'resources/js/maps-script.js'
            //     // 'resources/js/shop-script.js',
            //     // 'resources/js/product-script.js',
            // ],
            refresh: true,
        }),
    ],
    // server: {
    //     host: '0.0.0.0', // Dengarkan semua alamat IP
    //     // port: 5173,      // Gunakan port default
    //     https: true,
    //     hmr: {
    //         // host: 'andalprima.hansmade.online', // IP atau domain publik Anda
    //         host: 'vite.hansmade.online', // IP atau domain publik Anda
    //         protocol: 'wss',
    //     },
    // },
    // Menambahkan rule agar folder fonts termasuk dalam build
    publicDir: 'public',
});
