const { src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const cleanCSS = require('gulp-clean-css');
const uglify = require('gulp-uglify');
const notify = require('gulp-notify');

// File paths
const sassFiles = './css/**/*.scss';
const cssOutput = './css/';
const jsFiles = './js/vendor/*.js';
const jsOutput = './js/';

// CSS task
function css() {
  return src(sassFiles)
    .pipe(sass().on('error', sass.logError))
    .pipe(concat('main.css'))
    .pipe(cleanCSS())
    .pipe(dest(cssOutput))
    .pipe(notify({ message: 'CSS task complete', onLast: true }));
}

// JavaScript task
function javascript() {
  return src(jsFiles)
    .pipe(concat('application.min.js'))
    .pipe(uglify().on('error', function (error) {
      console.error(error.message);
      this.emit('end');
    }))
    .pipe(dest(jsOutput))
    .pipe(notify({ message: 'JavaScript task complete', onLast: true }));
}

// Watch task
function watchFiles() {
  watch(sassFiles, css);
  watch(jsFiles, javascript);
}

// Export tasks
exports.css = css;
exports.javascript = javascript;
exports.build = parallel(css, javascript);
exports.watch = watchFiles;
exports.default = series(exports.build, exports.watch);
