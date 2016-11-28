const elixir = require('laravel-elixir');

require('laravel-elixir-vueify');


var uglify = require('gulp-uglify');
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

elixir.config.sourcemaps = true;

elixir(mix => {

    mix.sass('app.scss');
    mix.browserify('app.js');

    //mix.browserify('app.js');


});
