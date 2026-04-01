import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
<<<<<<< HEAD
                'resources/css/index.css',
                'resources/css/home.css',
                'resources/css/search.css',
                'resources/css/profile.css',
=======
>>>>>>> 7ff808b13b4bb91e0aea268c5669f62f91580133
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
