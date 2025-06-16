import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    // server: {
    //     host: '0.0.0.0',
    //     port: 5173,
    //     strictPort: true,
    //     hmr: {
    //     host: '90bb-180-246-203-157.ngrok-free.app',
    //     protocol: 'wss',
    //     },
    // },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
