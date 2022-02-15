const iconfont = require('gulp-iconfont');
const iconfontCss = require('gulp-iconfont-css');
const gulp = require('gulp');

gulp.src(['assets/svg/**/*.svg'])
    .pipe(iconfontCss({
        fontName: `axtronic-icon`,
        path: 'assets/scss/icons/_template_function.scss',
        cssClass: `axtronic-icon`,
        targetPath: 'assets/scss/icons/_icons.scss',
        fontPath: './assets/'
    }))
    .pipe(iconfont({
        fontName: `axtronic-icon`,
        normalize: true,
        fontHeight: 1001,
        formats: ['ttf', 'eot', 'woff', 'svg', 'woff2'],
    }))
    .pipe(gulp.dest('./'))
