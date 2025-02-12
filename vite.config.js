import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import viteCompression from 'vite-plugin-compression';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        viteCompression({ algorithm: 'gzip' }), // Enables Gzip compression
    ],
    build: {
        minify: 'terser', // Minifies JavaScript
        terserOptions: {
            compress: {
                drop_console: true, // Removes console logs for production
                drop_debugger: true,
            },
        },
        assetsInlineLimit: 4096, // Improves asset handling
    },
});
