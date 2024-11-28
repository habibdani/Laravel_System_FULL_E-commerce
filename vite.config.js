import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build', // Direktori output untuk build production
        assetsDir: '',          // Letakkan file di root `public/build`
    },
    publicDir: 'public', // Folder untuk static assets
});
