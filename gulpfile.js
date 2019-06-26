const gulp = require('gulp');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const debug = require('gulp-debug');
const rename = require('gulp-rename');
const del = require('del');

var buildDir = 'public/assets';
var assetsDir = 'resources/assets';

// SASS Files
var scssFiles = [
    assetsDir + '/sass/main.scss',
    assetsDir + '/sass/dashboard.scss'
]

// JS Files
var jsFiles = [
    assetsDir + '/js/*.js'
]

//Arquivos externos js
var vendorJsFiles = [
    'node_modules/jquery/dist/jquery.js',
    'node_modules/popper.js/dist/umd/popper.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.js',
    'node_modules/parsleyjs/dist/parsley.js',
    'node_modules/parsleyjs/dist/i18n/pt-br.js',
    'node_modules/bootbox/dist/bootbox.min.js',
    'node_modules/moment/moment.js',
    'node_modules/moment/locale/pt-br.js',
    'node_modules/mdbootstrap/js/mdb.min.js',
]

//Arquivos externos css
var vendorCssFiles = [
    'node_modules/bootstrap/dist/css/bootstrap.css',
    'node_modules/animate.css/animate.css',
    'node_modules/@fortawesome/fontawesome-free/css/all.css',
    'node_modules/mdbootstrap/css/mdb.min.css',
]

/**
 * Concatena os arquivos sass, converte e comprime em css
 * @param env
 * @returns
 */
function sass2Css(files, outputName, env='dev') {

    var sassConfig = { outputStyle: env=='prod'?'compressed':'expanded' };

    return gulp.src(files)
        .pipe(debug({ title: 'css-debug' }))
        .pipe(concat(outputName + '.scss'))
        .pipe(sass(sassConfig).on('error', sass.logError))
        .pipe(rename(outputName + '.min.css'))
        .pipe(gulp.dest(buildDir + '/css'));

}

/**
 * Concatena e mimifica os arquivos css se estiver em produção
 * @param files
 * @param outputName
 * @param env
 * @returns
 */
function css(files, outputName, env='dev') {

    var sassConfig = { outputStyle: env=='prod'?'compressed':'expanded' };

    return gulp.src(files)
        .pipe(debug({ title: 'css-debug' }))
        .pipe(concat(outputName + '.css'))
        .pipe(rename(outputName + '.min.css'))
        .pipe(gulp.dest(buildDir + '/css'));
}

/**
 * Gera os arquivos css em desenvolvimento
 * @returns
 */
function cssDev() {
    return sass2Css(scssFiles, 'styles');
}

/**
 * Gera os arquivos css em produção
 * @returns
 */
function cssProd() {
    return sass2Css(scssFiles, 'styles', 'prod');
}

/**
 * Gera os arquivos css vendor em desenvolvimento
 * @returns
 */
function vendorCssDev() {
    return css(vendorCssFiles, 'vendor');
}

/**
 * Gera os arquivos css vendor em produção
 * @returns
 */
function vendorCssProd() {
    return css(vendorCssFiles, 'vendor', 'prod');
}

/**
 * Concatena os arquivos js e comprime em js
 * @param env
 * @returns
 */
function js2Mimify(files, outputName , env='dev') {

    var obj = gulp.src(files)
        .pipe(debug({ title: 'js-debug' }));

    if (env=='prod') {
        obj.pipe(uglify())
    }

    return obj.pipe(concat(outputName + '.js'))
        .pipe(rename(outputName + '.min.js'))
        .pipe(gulp.dest(buildDir + '/js'));

}

/**
 * Gera os arquivos js em desenvolvimento
 * @returns
 */
function jsDev() {
    return js2Mimify(jsFiles, 'scripts');
}

/**
 * Gera os arquivos js em produção
 * @returns
 */
function jsProd() {
    return js2Mimify(jsFiles, 'scripts', 'prod');
}

/**
 * Gera os arquivos js vendor em desenvolvimento
 * @returns
 */
function vendorJsDev() {
    return js2Mimify(vendorJsFiles, 'vendor');
}

/**
 * Gera os arquivos js vendor em produção
 * @returns
 */
function vendorJsProd() {
    return js2Mimify(vendorJsFiles, 'vendor', 'prod');
}

/**
 * Limpa o diretório de build
 * @returns
 */
function cleanBuild() {
    return del([ buildDir ]);
}

/**
 * Copia as imagens da aplicação
 * @returns
 */
function images() {

    return gulp.src('img/**/*', { cwd : assetsDir })
    .pipe(gulp.dest('public/assets/img'));

}

/**
 * Copia as fontes de aplicação
 * @returns
 */
function fonts() {

    return gulp.src('fonts/**/*', { cwd : assetsDir })
    .pipe(gulp.dest('public/assets/fonts')) &&

    gulp.src('node_modules/@fortawesome/fontawesome-free/webfonts/*',)
    .pipe(gulp.dest('public/assets/webfonts'));

}

/**
 * Monitora a alteração e realiza a publicação dos arquivos
 * @returns
 */
function watch() {
    gulp.watch(scssFiles, cssDev);
    gulp.watch(jsFiles, jsDev);
}

/**
 * Tasks
 */
gulp.task('clean', gulp.series(cleanBuild));
gulp.task('build', gulp.series(cleanBuild, jsProd, cssProd, vendorJsProd, vendorCssProd, images, fonts));
gulp.task('default', gulp.series(cleanBuild, jsDev, cssDev, vendorJsDev, vendorCssDev, images, fonts));
gulp.task('watch', gulp.series('default', watch));