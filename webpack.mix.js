const mix = require('laravel-mix');

mix.minify('node_modules/bootstrap/dist/css/*.css', 'public/css/styles.css');

mix.minify('')