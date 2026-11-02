var gulp = require('gulp');
var uglify = require('gulp-uglify');
var cssMin = require('gulp-clean-css'); // gulp-css (clean-css 2.x) ломает селекторы вида :not(a, b)
var rename = require('gulp-rename');
var minimist = require('minimist');
var svgSprite = require('gulp-svg-sprite'); //svg sprite
var options = minimist(process.argv.slice(2), {string: ['src', 'dist']});

// Use `compress-js` task for JavaScript files 
gulp.task('compress-js', function () {
    var destDir = options.dist.substring(0, options.dist.lastIndexOf("/"));
    var destFile = options.dist.replace(/^.*[\\\/]/, '');
    return gulp.src(options.src)
        .pipe(uglify())
        .pipe(rename(destFile))
        .pipe(gulp.dest(destDir))
});

// Use `compress-css` task for CSS files
gulp.task('compress-css', function () {
    var destDir = options.dist.substring(0, options.dist.lastIndexOf("/"));
    var destFile = options.dist.replace(/^.*[\\\/]/, '');
    return gulp.src(options.src)
        .pipe(cssMin())
        .pipe(rename(destFile))
        .pipe(gulp.dest(destDir))
});

// Use `svg-sprite` task for make sprite (stack mode: sprite.svg#<file name>)
// Source: frontend/themes/v1/web/images/sprites/intermediate-svg/*.svg
// Result: frontend/themes/v1/web/images/sprites/sprite.svg
// Run: gulp svg-sprite --gulpfile gulpfileTask.js
var spritesDir = 'frontend/themes/v1/web/images/sprites';

gulp.task('svg-sprite', function () {
    return gulp.src(spritesDir + '/svg/*.svg')
        .pipe(svgSprite({
            svg: {
                namespaceClassnames: false // не переименовывать классы внутри иконок (на них завязан CSS)
            },
            mode: {
                stack: {
                    dest: '.',
                    sprite: 'sprite.svg'
                }
            }
        }))
        .pipe(gulp.dest(spritesDir));
});