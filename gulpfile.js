var gulp = require ('gulp');
var sass = require ('gulp-sass');
var browserSync = require('browser-sync').create();
var useref = require ('gulp-useref');
var gulpIf = require ('gulp-if');
var uglify = require ('gulp-uglify');
var cssnano = require ('gulp-cssnano');
var imagemin = require ('gulp-imagemin');
var cache = require ('gulp-cache');
var del = require('del');
var runSequence = require('run-sequence');
var autoprefixer  = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var devip = require('dev-ip');



//--------------------
// dev variables
//--------------------

var source_php = 'app/**/*.php';
var destination = 'public_html'



//--------------------


//Compile Sass
gulp.task('sass', function(){
  return gulp.src('app/scss/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: true
        }))
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest('app/css'))
    .pipe(browserSync.reload({
  stream: true
}))
});

//Watch for changes
gulp.task('watch', ['browserSync', 'sass'], function (){
  gulp.watch('app/scss/**/*.scss', ['sass']);
  gulp.watch('app/**/*.php', browserSync.reload);
  gulp.watch('app/js/**/*.js', browserSync.reload);
});

//browserSync
gulp.task('browserSync', function() {
  browserSync.init({
    proxy: "dev.local"
  })
})

//Concat and minify js and css
gulp.task('useref', function(){
  return gulp.src('app/*.html')
    .pipe(useref())
    //Minify js files
    .pipe(gulpIf('*.js', uglify()))
    //Minify css files
    .pipe(gulpIf('*.css', cssnano()))
    .pipe(gulp.dest(destination))
});

//Optimize images
gulp.task('images', function() {
  return gulp.src('app/images/**/*.+(png|jpg|jpeg|gif|svg)')
  .pipe(cache(imagemin({
    //Options for images proccesing
  })))
  .pipe(gulp.dest('dist/images'))
});

//Copy fonts
gulp.task('fonts', function() {
  return gulp.src('app/fonts/**/*')
  .pipe(gulp.dest('dist/fonts'))
});

//Remove dist folder
gulp.task('remove:dist', function(){
  return del.sync('dist');
});

//Remove cached images
gulp.task('cache:remove', function (callback) {
return cache.clearAll(callback)
});

//IP for other devices
gulp.task('devip', function(){
console.log(devip())
});

//Task in sequence
gulp.task('build', function(callback){
  runSequence('remove:dist',
    ['sass', 'useref', 'images', 'fonts'],
    callback
  )
});

gulp.task('default', function(callback){
  runSequence(['devip', 'sass', 'browserSync', 'watch'],
  callback
  )
});
