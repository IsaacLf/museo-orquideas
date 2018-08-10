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
   .styles([
       'node_modules/jquery-ui-dist/jquery-ui.min.css',
       'node_modules/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css',
       'node_modules/dropzone/dist/min/dropzone.min.css'
   ], 'public/css/all.css')
   .scripts([
       'node_modules/plupload/js/plupload.full.min.js'
   ], 'public/js/plupload.js')
   .scripts([
        'node_modules/material-dashboard/assets/js/core/bootstrap-material-design.min.js',
        'node_modules/material-dashboard/assets/js/plugins/perfect-scrollbar.jquery.min.js',
        'node_modules/material-dashboard/assets/js/plugins/chartist.min.js',
        'node_modules/material-dashboard/assets/js/plugins/bootstrap-notify.js',
        'node_modules/material-dashboard/assets/js/material-dashboard.min.js',
   ], 'public/js/material-dasboard.js')
   .scripts([
        // 'node_modules/jquery-ui-dist/jquery-ui.min.js',
        'node_modules/plupload/js/jquery.ui.plupload/jquery.ui.plupload.js',
        'node_modules/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js'
   ], 'public/js/jquery.ui.plupload.js')
   ;
//    .copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/fonts');