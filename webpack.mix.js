let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    /**
     * ---------------------
     * Element UI icons
     * ---------------------
     * */
    .copyDirectory('./node_modules/element-ui/lib/theme-default/fonts', 'public/css/fonts')
    /**
     * ----------------------
     * Custom WebpackConfig
     * ----------------------
     * Add aliases to help resolve paths used in the app.
     * */
    .webpackConfig({
        resolve: {
            alias: {
                'sass': path.resolve(__dirname, './resources/assets/sass'),
                '@': path.resolve(__dirname, './resources/assets/js'),
            }
        }

    })
    /**
     * ----------------------
     * Options
     * ----------------------
     * Remove auto processing of urls to prevent coping of files to wrong
     * directories, especially once in node modules
     * */
    .options({
        processCssUrls: false
    });