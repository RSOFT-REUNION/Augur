import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/sass/color-scheme.scss',
                'resources/sass/template.scss',
                'resources/sass/component.scss',
                'resources/sass/responsive.scss',
                'resources/js/app.js',
                'resources/js/functions.js',
                'resources/js/tinyMCE.js',
                'resources/js/screenDetect.js',
            ],
            refresh: true,
        }),
    ],
});
