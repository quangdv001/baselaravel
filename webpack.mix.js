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

// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/assets/site/js/app.js', 'public/assets/site/themes/js')
   .sass('resources/assets/site/sass/app.scss', 'public/assets/site/themes/css').options({
      processCssUrls: false
      }).version();
