const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/auto/jquery-1.10.2.js', 'public/js/auto/jquery-1.10.2.js')
   .js('resources/js/auto/jquery-ui.js', 'public/js/auto/jquery-ui.js')
   .sass('resources/sass/app.scss', 'public/css');
