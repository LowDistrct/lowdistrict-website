var pump = require('pump');
var less = require('gulp-less');
var autoprefixer = require('gulp-autoprefixer');
var cleancss = require('gulp-clean-css');
var uglify = require('gulp-uglify');
var changed = require('gulp-changed');
var gulp = require('gulp');

gulp.task('stylesheet', function(cb) {
	pump([
		gulp.src('app/less/*.less'),
		changed('build/css'),
		less(),
    	autoprefixer('last 10 versions', 'ie 8'),
		cleancss(),
		gulp.dest('build/css')
	], cb);
});

gulp.task('scripts', function(cb) {
	pump([
		gulp.src('app/js/**/*.js'),
		changed('build/js'),
		uglify(),
		gulp.dest('build/js')
	], cb);
});

gulp.task('php', function(cb) {
	pump([
		gulp.src('app/**/*.php'),
		changed('build'),
		gulp.dest('build')
	], cb);
});

gulp.task('default', ['stylesheet', 'scripts', 'php']);

gulp.watch('app/less/**/*.less', ['stylesheet']);
gulp.watch('app/js/**/*.js', ['scripts']);
gulp.watch('app/**/*.php', ['php']);
