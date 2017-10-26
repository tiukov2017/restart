var gulp = require('gulp');
var elixir = require('laravel-elixir');
var env = require('dotenv').config();
var replace = require('gulp-replace');

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

elixir(function(mix) {

    
    mix.sass('app.scss','public/css/');

    mix
        .scripts('editor.js')
        .scripts('globals.js')
        .scripts('google_search.js')
        .scripts('report.js')
        .scripts('check_navbar.js')
        .scripts('google_api.js')
        .scripts('google_viewer_pagination.js')
        .scripts('keywords_search.js')
        .scripts('domains_controll.js')
        .scripts('iframe_screenshot.js')
        .scripts('tables_common.js')
        .scripts('references_table.js')
        .scripts('bookmarks.js')
        .scripts('report_double_check.js')
        .scripts('table_init.js')
        .scripts('reports_table.js')
        .scripts('users_table.js')
        .scripts('fields_reminder.js')
        .scripts('plugins/bootstrap-filestyle.min.js')
        .scripts('plugins/jquery.mark.min.js')
        .scripts('initCKEditors.js')
        .scripts('reportMigrationScript.js')
        .scripts('googleResultsPreview.js')
        .scripts('init_results_table.js')
        .scripts('googleClasses.js')
        .scripts('googleHelpers.js')
        .scripts('googleApiService.js');

    mix.task('changeUrl');

});


gulp.task('changeUrl', function() {
    gulp
        .src('public/js/**.js')
        .pipe(replace(/\{\{ (\S*) \}\}/g, env.PATH + '$1'))
        .pipe(gulp.dest('public/js'));
});