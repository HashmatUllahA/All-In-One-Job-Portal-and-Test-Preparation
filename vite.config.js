import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/layouts/app.js'],
            refresh: true,
        }),
    ],
    assetsInclude: ['**/*.JPG', '**/*.jpg', '**/*.png'],
});
