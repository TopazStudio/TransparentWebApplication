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
     * BrowserSync
     *
     * Note: Domain name refers to url of application. It can be
     * localhost.
     * */
    // .browserSync('laravel.dev')
    /**
     * Element UI icons and images
     * */
    .copyDirectory('./node_modules/element-ui/lib/theme-default/fonts', 'public/css/fonts')
    .copyDirectory('./resources/assets/img', 'public/img')
    /**
     * ----------------------
     * Custom WebpackConfig
     * ----------------------
     * Add aliases to help resolve paths used in the app.
     * */
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve(__dirname, './resources/assets/js'),
                'img': path.resolve(__dirname, './resources/assets/img'),
                'sass': path.resolve(__dirname, './resources/assets/sass'),
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
        processCssUrls: false,
        extractVueStyles: false
    });