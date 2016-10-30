var gulp        = require('gulp'),
    fs          = require('fs'),
    $           = require('gulp-load-plugins')(),
    pngquant    = require('imagemin-pngquant'),
    eventStream = require('event-stream');


// Sassのタスク
gulp.task('sass', function () {
  return gulp.src(['./src/scss/**/*.scss'])
    .pipe($.plumber({
      errorHandler: $.notify.onError('<%= error.message %>')
    }))
    .pipe($.sourcemaps.init({loadMaps: true}))
    .pipe($.sassBulkImport())
    .pipe($.sass({
      errLogToConsole: true,
      outputStyle    : 'compressed',
      includePaths   : [
        './src/scss',
        // './node_modules/bootstrap-sass/assets/stylesheets',
        // './node_modules/slick-carousel'
      ]
    }))
    .pipe($.autoprefixer({browser: ['last 2 version', '> 5%']}))
    .pipe($.sourcemaps.write('./map'))
    .pipe(gulp.dest('./assets/css'));
});


// Minify All
gulp.task('js', function () {
  return gulp.src(['./src/js/**/*.js'])
    .pipe($.sourcemaps.init({
      loadMaps: true
    }))
    .pipe($.uglify())
    .on('error', $.util.log)
    .pipe($.sourcemaps.write('./map'))
    .pipe(gulp.dest('./assets/js/'));
});


// JS Hint
gulp.task('jshint', function () {
  return gulp.src(['./src/js/**/*.js'])
    .pipe($.jshint('./src/.jshintrc'))
    .pipe($.jshint.reporter('jshint-stylish'));
});

// Build modernizr
gulp.task('copylib', function () {
  // return eventStream.merge(
  //   // Build Bootstrap
  //   gulp.src([
  //     './node_modules/bootstrap-sass/assets/javascripts/bootstrap.js'
  //   ])
  //     .pipe($.uglify())
  //     .pipe(gulp.dest('./assets/js/')),
  //   // Build unpacked Libraries.
  //   gulp.src([
  //     './node_modules/modernizr/modernizr.js',
  //     './node_modules/html5shiv/dist/html5shiv.js',
  //     './node_modules/respond.js/dest/respond.src.js',
  //     './node_modules/slick-carousel/slick/slick.js',
  //   ])
  //     .pipe($.uglify())
  //     .pipe(gulp.dest('./assets/js/')),
  //   // Copy slick font
  //   gulp.src([
  //     './node_modules/slick-carousel/slick/fonts/*'
  //   ]).pipe(gulp.dest('./assets/fonts/slick')),
  //   // Copy image
  //   gulp.src([
  //     './node_modules/slick-carousel/slick/ajax-loader.gif'
  //   ])
  //     .pipe($.imagemin({
  //       progressive: true,
  //       svgoPlugins: [{removeViewBox: false}],
  //       use        : [pngquant()]
  //     }))
  //     .pipe(gulp.dest('./assets/img'))
  // );
});

// Image min
gulp.task('imagemin', function () {
  return gulp.src('./src/img/**/*')
    .pipe($.imagemin({
      progressive: true,
      svgoPlugins: [{removeViewBox: false}],
      use        : [pngquant()]
    }))
    .pipe(gulp.dest('./assets/img'));
});


// watch
gulp.task('watch', function () {
  // Make SASS
  gulp.watch('./src/scss/**/*.scss', ['sass']);
  // JS
  gulp.watch(['./src/js/**/*.js'], ['js', 'jshint']);
  // Minify Image
  gulp.watch('./src/img/**/*', ['imagemin']);
});


// Build
gulp.task('build', ['copylib', 'jshint', 'js', 'sass', 'imagemin']);

// Default Tasks
gulp.task('default', ['watch']);
