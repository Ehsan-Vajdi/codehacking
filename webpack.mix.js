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
   .sass('resources/sass/app.scss', 'public/css')

    .styles('resources/css/libs/CoolAdmin-master/fontface/*.css', 'public/css/fontface.css')
    .styles('resources/css/libs/CoolAdmin-master/vendor/*.css', 'public/css/vendor.css')
    .styles('resources/css/libs/CoolAdmin-master/bootstrap.min.css', 'public/css/bootstrap.css')
    .styles('resources/css/libs/CoolAdmin-master/theme.css', 'public/css/main.css')

    .scripts('resources/js/libs/CoolAdmin-master/vendor/*.js', 'public/js/vendor.js')
    .scripts('resources/js/libs/CoolAdmin-master/jquery-3.2.1.min.js', 'public/js/jquery.js')
    .scripts('resources/js/libs/CoolAdmin-master/bootstrap/*.js', 'public/js/bootstrap.js')
    .scripts('resources/js/libs/CoolAdmin-master/main.js', 'public/js/main.js');

