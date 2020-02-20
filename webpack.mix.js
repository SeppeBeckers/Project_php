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

mix.browserSync({
    proxy: 'team62.test',
    port: 3000
});

mix.setPublicPath('public_html');

mix.js('resources/js/app.js', 'js')
    .sass('resources/sass/app.scss', 'css');
