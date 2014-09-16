var gulp = require('gulp'),
less = require('gulp-less'),
rename = require("gulp-rename"),
watch = require('gulp-watch'),
uglify = require('gulp-uglifyjs'),
header = require('gulp-header');


var pkg = require('./package.json');
var banner = ['/*',
  ' Theme Name: <%= pkg.name %>',
  ' Theme Uri: <%= pkg.authorUri %>',
  ' Description: <%= pkg.description %>',
  ' Author: <%= pkg.authors %>',
  ' Template: <%= pkg.template %>',
  ' Version: <%= pkg.version %>',
  ' */',
  ''].join('\n');




// Catches errors.  Will play a system tone and display your mistake.
function catchErrors(error){
console.log("\007");
console.log(error);
}


gulp.task('default', function() {
  
});

gulp.task('uglify', function() {
  gulp.src('./js/_*.js')
    .pipe(uglify('site.min.js', {
      outSourceMap: true
    }))
    .on('error', catchErrors)
    .pipe(gulp.dest('./js'))
});



gulp.task('less', function () {
     gulp.src('./less/**/*.less')
     .pipe(header(banner, { pkg : pkg } ))
    .pipe(less())
    .on('error', catchErrors)     
    .pipe(gulp.dest('./'))
  });

gulp.task('watch', function () {
    gulp.watch('less/*.less', ['less']);
    gulp.watch('js/*.js', ['uglify']);
});



 
 