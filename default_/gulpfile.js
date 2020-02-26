var gulp = require('gulp');
var sass = require('gulp-sass');
var cssnano = require('gulp-cssnano');

gulp.task('styles', function() {
	gulp.src('./scss/*.scss')
	  .pipe(sass({
		includePaths: ['bower_components/foundation/scss']
	  }))
	  .pipe(gulp.dest('./css'));		
});


gulp.task('javascript', function () {
   gulp.src(['./bower_components/jquery/dist/*.js','./bower_components/modernizr/*.js','./bower_components/foundation/js/*.js'])      
      .pipe(gulp.dest('./js'));
});



gulp.task('default', function() {
    return gulp.src('./css/*.css')
        .pipe(cssnano())
        .pipe(gulp.dest('./css'));
});


gulp.task('watch', function() {
  gulp.watch('./scss/*.scss', ['styles']);
});

