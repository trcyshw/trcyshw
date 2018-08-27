/**
 * If you are getting errors when you run gulp,
 * check your version of gulp in Terminal:
 * $ gulp -v
 *
 * If your version is less than 4.0.x, you should upgrade. See:
 * https://www.liquidlight.co.uk/blog/article/how-do-i-update-to-gulp-4/
 */

// Your local site name.
var proxy = 'http://trcyshw.local';

/**
 * Dependencies.
 */
var autoprefixer = require( 'gulp-autoprefixer' );
var browserSync = require( 'browser-sync' ).create();
var concat = require( 'gulp-concat' );
var gulp = require( 'gulp' );
var minify = require( 'gulp-clean-css' );
var port = Math.floor( Math.random() * ( 9999 - 3001 ) + 3001 );
var sass = require( 'gulp-sass' );
var svgmin = require( 'gulp-svgmin' );
var uglify = require( 'gulp-uglify' );

/**
 * SASS.
 */
gulp.task( 'sass', function() {
  return gulp.src( '_dev/css/**/*.scss' ) // Files to watch
  .pipe( sass().on( 'error', sass.logError ) ) // Show errors insode the console
  .pipe( autoprefixer() ) // Run autoprefixer
  .pipe( minify({
    keepSpecialComments: 1 // Minify css keeping the theme header comment section
  }) )
  .pipe( gulp.dest( 'assets/css' ) ) // Output the file to the root directory
  .pipe( browserSync.stream() ); // Inject modified css into the browser
});

/**
 * JS.
 */
gulp.task( 'scripts', function() {
	return gulp.src( '_dev/js/**/*.js' )
	.pipe( concat( 'package.min.js' ) )
	.pipe( uglify() )
	.pipe( gulp.dest( 'assets/js' ) )
	.pipe( browserSync.stream() );
});

/**
 * Minify SVG files.
 */
gulp.task( 'svgmin', function() {
	return gulp.src( 'assets/**/*.svg' )
	.pipe( svgmin() )
	.pipe( gulp.dest( function( file ) {
		return file.base;
	}) );
});

gulp.task( 'svg-watch', function() {
	gulp.watch( 'assets/**/*.svg', [ 'svgmin' ]);
});

/**
 * BrowserSync.
 */
gulp.task( 'serve', gulp.series( 'sass', function() {

	browserSync.init({
		proxy: proxy, // Proxy must match your local host name.
		port: port // Randomised port number.
	});
	gulp.watch( '_dev/css/**/*.scss', gulp.series( 'sass' ) );
	gulp.watch( '_dev/js/**/*.js', gulp.series( 'scripts' ) ); // Run when a js file is changed.
	// gulp.watch( '_dev/js/**/*.js' ).on( 'change', browserSync.reload );
	gulp.watch( '**/*.php' ).on( 'change', browserSync.reload ); // Releoad upon php changes.
}) );

/**
 * The Gulp default task.
 * Basically, "do the thing".
 */
gulp.task( 'default', gulp.series( 'serve', 'svg-watch' ) );
