process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');

elixir(function(mix) {
 mix
     .phpUnit()

    /**
     * Copy needed files from /node directories
     * to /public directory.
     */
     .copy(
       'node_modules/font-awesome/fonts',
       'public/build/fonts/font-awesome'
     )
     .copy(
       'node_modules/bootstrap-sass/assets/fonts/bootstrap',
       'public/build/fonts/bootstrap'
     )
     .copy(
       'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
       'public/js/vendor/bootstrap'
     )
     .copy(
         'node_modules/select2/dist/css/select2.min.css',
         'resources/assets/css/plugin/select2/select2.min.css'
     )
     .copy(
         'node_modules/select2/dist/js/select2.min.js',
         'resources/assets/js/plugin/select2/select2.min.js'
     )
     .copy(
         'node_modules/select2-bootstrap-theme/dist/select2-bootstrap.min.css',
         'resources/assets/css/plugin/select2/select2-bootstrap.min.css'
     )
     .copy(
         'resources/assets/js/plugin/dymo/Address.label',
         'public/Address.label'
     )

     /**
      * Process frontend SCSS stylesheets
      */
     .sass([
        'frontend/app.scss',
        'frontend/plugin/toastr/toastr.scss',
        'plugin/sweetalert/sweetalert.scss'
     ], 'resources/assets/css/frontend/app.css')

     /**
      * Combine pre-processed frontend CSS files
      */
     .styles([
        'frontend/app.css',
        'plugin/select2/select2.min.css',
        'plugin/select2/select2-bootstrap.min.css'
     ], 'public/css/frontend.css')

     /**
      * Combine frontend scripts
      */
     .scripts([
        'plugin/sweetalert/sweetalert.min.js',
        'plugins.js',
        'frontend/app.js',
        'frontend/plugin/toastr/toastr.min.js',
        'frontend/custom.js',
        'plugin/select2/select2.min.js'
     ], 'public/js/frontend.js')

     /**
      * Process backend SCSS stylesheets
      */
     .sass([
         'backend/app.scss',
         'backend/plugin/toastr/toastr.scss',
         'plugin/sweetalert/sweetalert.scss'
     ], 'resources/assets/css/backend/app.css')

     /**
      * Combine pre-processed backend CSS files
      */
     .styles([
         'backend/app.css',
         'plugin/select2/select2.min.css',
         'plugin/select2/select2-bootstrap.min.css'
     ], 'public/css/backend.css')

     /**
      * Combine backend scripts
      */
     .scripts([
         'plugin/sweetalert/sweetalert.min.js',
         'plugins.js',
         'backend/app.js',
         'backend/plugin/toastr/toastr.min.js',
         'backend/custom.js',
         'plugin/select2/select2.min.js'
     ], 'public/js/backend.js')

     /**
      * Combine dymo scripts
      */
     .scripts([
         'plugin/dymo/dymo.label.framework.js',
         'plugin/dymo/print.js'
     ], 'public/js/plugin/dymo/dymo.js')

     /**
      * Apply version control
      */
     .version(["public/css/frontend.css", "public/js/frontend.js", "public/css/backend.css", "public/js/backend.js"]);
});
