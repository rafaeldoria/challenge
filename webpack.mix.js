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
   .js('resources/js/jquery-1.11.2.min.js', 'public/js/jquery-1.11.2.min.js')
   .js('resources/js/jquery.easy-autocomplete.min.js', 'public/js/jquery.easy-autocomplete.min.js')
   // .styles('resources/js/auto/autocomplete.min.css', 'public/css/autocomplete.min.css')
   // .styles('resources/js/auto/autocomplete.themes.min.css', 'public/css/autocomplete.themes.min.css')
   .sass('resources/sass/app.scss', 'public/css');
