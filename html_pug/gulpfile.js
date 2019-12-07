var gulp = require('gulp'),
    gls = require('gulp-live-server'),
    browserify = require('browserify'),
    babelify     = require('babelify'),
    reactify = require('reactify'),
    streamify = require('gulp-streamify'),
    plumber = require('gulp-plumber'),
    uglify = require('gulp-uglify'),
    source = require('vinyl-source-stream'),
    sourcemaps = require('gulp-sourcemaps'),
    less = require('gulp-less'),
    cleancss = require('less-plugin-clean-css'),
    autoprefixer = require('less-plugin-autoprefix'),
    path = require('path'),
    sourcemaps = require('gulp-sourcemaps'),
    rename = require('gulp-rename'),
    watchify = require('watchify'),
    buffer = require('vinyl-buffer'),
    merge = require('utils-merge'),
    gutil = require('gulp-util'),
    chalk = require('chalk'),
    gulpImports = require('gulp-imports'),
    pug = require('gulp-pug');
require('dotenv').config();
const _publicFolder = process.env.PUBLICFOLDER ? ('/' + process.env.PUBLICFOLDER) : '/public'
var reactModule = [''];
reactModule = [
    'main'
];
var publicFolder = "." + _publicFolder
var paths = {
    distFolder: publicFolder + '/',
    server: {
        start: ["./index.js"],
        src: "./index.js",
        watch: ['./app/**/*.pug','./app/**/*.js'],
    },
    copyAssets: {
        src: "./app/assets/**/*.*",
        dist: publicFolder + "/assets/",
        watch: ["./app/assets/**/*.*", "./app/assets/**/**/*.*"]
    },
    reactJs: function (_module) {
        var rootPath = _module || 'js';
        return {
            distFile: "app.js",
            rename: rootPath +'.js',
            src: "./src/" + rootPath + "/app.js",
            dist: publicFolder + "/js/",
            watch: "./src/" + rootPath + "/**/*.{js,jsx}"
        };
    },
    less: {
        distFile: "theme.css",
        src: ["./app/less/**/*.less", "!./app/**/_*.less"],
        dist: publicFolder + "/assets/css",
        watch: ["./app/**/*.{less, css}","./app/less/**/*.less",]
    }
};

gulp.task('server', function () {
    var options = {
        cwd: undefined
    }
    options.env = process.env;
    options.env.NODE_ENV = 'development';

    var server = gls.new(paths.server.start, options, true);
    server.start();

    //use gulp.watch to trigger server actions(notify, start or stop)
    gulp.watch(paths.server.watch, function (file) {
        server.notify.apply(server, [file]);
    });

    gulp.watch(paths.server.watch, function () {
        server.start.bind(server)()
    });
});

//react ES5 jsx task
var es5Task = 'reactify';
var es6Task = 'babelify';
var mainTask = es6Task;
function transform(filename) {
    var code = '';
    return through(
        function (data) { code += data; },
        function () {
            try {
                this.queue(reactTransform(code));
            } catch (e) {
                console.log('Error:', filename, e);
            }
            this.queue(null);
        }
    );
}

function map_error(err) {
    if (err.fileName) {
        // regular error
        gutil.log(chalk.red(err.name)
            + ': '
            + chalk.yellow(err.fileName.replace(__dirname + '/src/js/', ''))
            + ': '
            + 'Line '
            + chalk.magenta(err.lineNumber)
            + ' & '
            + 'Column '
            + chalk.magenta(err.columnNumber || err.column)
            + ': '
            + chalk.blue(err.description))
    } else {
        // browserify error..
        gutil.log(chalk.red(err.name)
            + ': '
            + chalk.yellow(err.message))
    }
    this.emit('end');
}

gulp.task('watchify', function () {
    var args = merge(watchify.args, { debug: true });
    if (reactModule.length>0) {
        reactModule.forEach(function (element) {
            watchifyFn(args, element)
        }, this);
    }
    else
        watchifyFn(args, 'js');
})

function watchifyFn(args, _module) {
    var element = _module || 'js';
    var rootPath = element && paths.reactJs(element);
    var bundler = watchify(browserify(rootPath.src, merge(args, {extensions: ['.jsx']}))).transform(mainTask)
    bundle_js(bundler, rootPath)

    bundler.on('update', function () {
        gutil.log( chalk.magenta('Module changed: ') + chalk.blue(element));
        bundle_js(bundler, rootPath)
    })
}

function bundle_js(bundler, rootPath) {
    return bundler.bundle()
        .on('error', map_error)
        .pipe(source(rootPath.distFile))
        .pipe(buffer())
        .pipe(rename(rootPath.rename))
        //.pipe(uglify()
        // .on('error', function(err) {
        //     gutil.log(gutil.colors.red('[Error]'), err.toString());
        //     this.emit('end');
        //     }))
        .pipe(gulp.dest(rootPath.dist))
}

gulp.task('copy', function () {
    gulp.src(paths.copyAssets.src)
        .pipe(gulp.dest(paths.copyAssets.dist));
});

gulp.task('less', function () {
    gulp.src(paths.less.src)
        .pipe(sourcemaps.init())
        .pipe(less({ plugins: [new autoprefixer({ browsers: ["last 10 versions"] })] }))
        .pipe(sourcemaps.write('./maps'))
        .pipe(plumber())
        .pipe(gulp.dest(paths.less.dist));
});
gulp.task('build_less', function () {
    gulp.src(paths.less.src)
        .pipe(sourcemaps.init())
        .pipe(less({
            plugins: [
                new cleancss({ advanced: true }),
                new autoprefixer({ browsers: ["last 10 versions"] })
            ]
        }))
        .pipe(plumber())
        .pipe(gulp.dest(paths.less.dist));
});

gulp.task('views', function () {
    console.log('Views Render')
    gulp.src(
        [
            '!./app/views/**/_*.pug',
            '!./app/views/mixin/*.pug',
            '!./app/views/ui/*.pug',
            './app/views/**/*.pug',
            './app/views/*.pug',
            '!app/views/_*.pug'
        ])
        .pipe(plumber())
        .pipe(pug({
            pretty: true 
        }))
        .pipe(gulp.dest(publicFolder + "/"));    
});

gulp.task('watch', function () {
    gulp.watch(paths.less.watch, ['less']);
    gulp.watch(paths.copyAssets.watch, ['copy']);    
    gulp.watch(
        [
            '!./app/views/**/_*.pug',
            '!./app/views/mixin/*.pug',
            '!./app/views/mixin/*.pug',
            './app/views/**/*.pug', 
            './app/controlers/*.js',
            './app/controlers/**/*.js', 
            './app/controlers/**/**/*.js',
            './app/views/renderer.pug'
        ], 
        ['views']
    );
});

gulp.task('build', ['build_less', 'views', 'copy', 'watch']);
gulp.task('default', ['less', 'copy', 'watchify', 'server', 'watch', 'views']);