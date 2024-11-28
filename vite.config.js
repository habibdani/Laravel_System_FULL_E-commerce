import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        https: true, // Aktifkan HTTPS
        host: '0.0.0.0', // Terima semua permintaan, termasuk dari subdomain
        hmr: {
            host: 'andalprima.hansmade.online', // Host subdomain Anda
            protocol: 'wss', // Gunakan WebSocket Secure
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/maps-script.js'
            ],
            refresh: true,
        }),
    ],
    publicDir: 'public', // Menambahkan rule agar folder fonts termasuk dalam build
});
