
let mix = require('laravel-mix')

mix.webpackConfig({
    resolve: {
        alias: require('./aliases.config').webpack
    }
});

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

mix.setPublicPath('public');
mix.extract();
mix.version();
mix.js('resources/js/app.js', 'js').postCss('resources/css/app.css', 'css', [
    //
]).vue();
//mix.sass('resources/sass/app.scss', 'css');
