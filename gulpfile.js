var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

var paths = {
    'vendor':'./resources/assets/vendor/',
    'template':'./resources/assets/'
}
elixir(function(mix) {
    mix.copy(
            [
                paths.vendor + 'bootstrap/fonts',
                paths.vendor + 'font-awesome/fonts'
            ],
            'public/fonts'
    ).styles(
        [
            paths.vendor +'bootstrap/dist/css/bootstrap.css',
            paths.vendor +'font-awesome/css/font-awesome.css',
            paths.template +'css/animate.css',
            paths.template +'css/style.css'
        ],'public/css/app.css'
    ).scripts(
        [
            paths.vendor +'jquery/dist/jquery.js',
            paths.vendor +'bootstrap/dist/js/bootstrap.js',
            paths.template +'js/jquery.metisMenu.js',
            paths.template +'js/jquery.slimscroll.js',
            paths.template +'js/inspinia.js'
        ],
        'public/js/app.js'
    );
});