var gulp = require('gulp'),
less = require('gulp-less'),
rename = require("gulp-rename"),
watch = require('gulp-watch'),
uglify = require('gulp-uglifyjs'),
header = require('gulp-header'),
concat = require('gulp-concat'),
foreach = require('gulp-foreach'),
minifyCss = require('gulp-minify-css'),
mainBowerFiles = require('main-bower-files');


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


var mainFiles = mainBowerFiles();


// Catches errors.  Will play a system tone and display your mistake.
function catchErrors(error){
console.log("\007");
console.log(error);
}

var paths = {
  scripts: {
    support: ['./js/support/*.js', '!./js/support/*.min.js'],
  }
}

gulp.task('default', function() {
  
});


// Builds both dev and minified version of our JS files.
gulp.task('scripts', function() {

  
  gulp.src([ './js/_*.js'])
    .pipe(concat('uwaa.site.dev.js'))
    .on('error', catchErrors)
    .pipe(gulp.dest('./js'));

  gulp.src([ './js/admin/_*.js'])
      .pipe(concat('admin.dev.js'))
      .on('error', catchErrors)
      .pipe(gulp.dest('./js/admin'));

 gulp.src(paths.scripts.support)
 .pipe(foreach(function(stream, file){
    return stream
    .pipe(rename(function (path){
      path.basename += ".min";
      path.extname = ".js";
    }))
    .pipe(uglify({
      mangle: true,
      output: {
        beautify: false
      }
    }))    
    .on('error', catchErrors)
  }))
    .pipe(gulp.dest('./js/support'));

  gulp.src(['./js/_*.js'])
    .pipe(uglify('uwaa.site.js', {
      mangle: true,
      output: {
        beautify: false
      }
    }))
    .on('error', catchErrors)
    .pipe(gulp.dest('./js'));

gulp.src(['./js/admin/_*.js'])
    .pipe(uglify('admin.js', {
      mangle: true,
      output: {
        beautify: false
      }
    }))
    .on('error', catchErrors)
    .pipe(gulp.dest('./js/admin'));
});



gulp.task('less', function () {
     gulp.src('./less/style.less')     
    .pipe(less())
    .pipe(minifyCss())
    .pipe(header(banner, { pkg : pkg } ))
    .on('error', catchErrors)     
    .pipe(gulp.dest('./'));

    gulp.src('./less/style.less')    
    .pipe(header(banner, { pkg : pkg } ))
    .pipe(less())
    .pipe(rename("style.dev.css"))    
    .on('error', catchErrors)     
    .pipe(gulp.dest('./'));

    gulp.src('./less/gradpack/gradpack.less')     
    .pipe(less())
    .pipe(minifyCss())
    .on('error', catchErrors)     
    .pipe(gulp.dest('./'));

    gulp.src('./less/admin/admin.less')     
    .pipe(less())
    .pipe(minifyCss())
    .on('error', catchErrors)     
    .pipe(gulp.dest('./'));


  });

gulp.task('watch', function () {
    gulp.watch('less/**/*.less', ['less']);
    gulp.watch(['js/_*.js', 'js/admin/_*.js', 'js/support/*.js', '!js/support/*.min.js'], ['scripts']);
});


gulp.task('library', function() {
    gulp.src(mainBowerFiles(/* options */), { base: 'bower_components' })
    .pipe(gulp.dest('./js/libraries'));
});
 
 