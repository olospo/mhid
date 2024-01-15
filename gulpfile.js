const { series, parallel } = require('gulp');
var gulp = require('gulp');
var sass = require('gulp-sass');
var minify = require('gulp-clean-css');

var plugins = require("gulp-load-plugins")({
  pattern: ['gulp-*', 'gulp.*'],
  replaceString: /\bgulp[\-.]/
});

// Input and Output folders
var input = './css/**/*.scss';
var output = './css/';
var jsinput = './js/vendor/*.js';
var jsoutput = './js/';

// CSS
function css(cb) {
  gulp.src(input)
  // Compile Sass
  .pipe(sass())
  // Error reporting
  .on("error", plugins.notify.onError(function (error) {
    return error.message;
  }))
  // Minify
  .pipe(minify())
  // Save
  .pipe(gulp.dest(output))
  
  cb();
}

// Javascript
function javascript(cb) {
  gulp.src(jsinput)
    .pipe(plugins.concat('/application.js'))
    .on("error", plugins.notify.onError(function (error) {
      return error.message;
    }))
    .pipe(plugins.rename({ suffix: '.min' }))
    .pipe(plugins.uglify())
    .on("error", plugins.notify.onError(function (error) {
      return error.message;
    }))
    .pipe(gulp.dest(jsoutput));
  cb();
}

// Tasks
exports.css = css;
exports.javascript = javascript;
exports.build = parallel(javascript, css);

// Watch task
gulp.task('watch', function(done) {
  gulp.watch(input, gulp.series('css'));
  gulp.watch(jsinput, gulp.series('javascript'));
  done();
});