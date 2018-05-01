//---------------------------------------------------
//  DEDPENDENCIES
//---------------------------------------------------
var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var minify = require('gulp-minify-css');
var browserSync = require('browser-sync').create();
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var svgmin = require('gulp-svgmin');

//---------------------------------------------------
//  SASS TASK
//---------------------------------------------------
gulp.task('sass', function() {
  return gulp.src('_dev/css/**/*.scss') // Files to watch
  .pipe(sass().on('error', sass.logError)) // Show errors insode the console
  .pipe(autoprefixer()) // Run autoprefixer
  .pipe(minify({
    keepSpecialComments: 1 // Minify css keeping the theme header comment section
  }))
  .pipe(gulp.dest('./')) // Output the file to the root directory
  .pipe(browserSync.stream()); // Inject modified css into the browser
});

//---------------------------------------------------
//  JS TASK
//---------------------------------------------------

gulp.task('scripts', function() {
    return gulp.src('_dev/js/**/*.js')
        .pipe(concat('package.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('assets/js'))
        .pipe(browserSync.stream());
});

//---------------------------------------------------
//  BROWSERSYNC TASK
//---------------------------------------------------
gulp.task('serve', ['sass'], function() {
    browserSync.init({
      proxy: "http://vagrant.local",
      port: 2378
    });
    gulp.watch('_dev/css/**/*.scss', ['sass']);
    gulp.watch('_dev/js/**/*.js', ['scripts']); // Run when a sass file is changed
    gulp.watch('**/*.php').on('change', browserSync.reload); // Releoad upon php changes
});

//---------------------------------------------------
// MINIFY SVGS
//---------------------------------------------------
gulp.task('svgmin', function() {
  return gulp.src('assets/**/*.svg')
  .pipe(svgmin())
  .pipe(gulp.dest(function(file) {
    return file.base;
  }));
});

gulp.task('svg-watch', function() {
  gulp.watch('assets/**/*.svg', ['svgmin'])
});

//---------------------------------------------------
// GULP DEFAULT TASK
//---------------------------------------------------
gulp.task('default', ['serve', 'svg-watch']);
