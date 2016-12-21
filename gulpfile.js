var gulp = require('gulp');
var dist = 'dist';
var build = 'build';
var changed = require('gulp-changed');
var bytediff = require('gulp-bytediff');

gulp.task('css', function () {
    var postcss      = require('gulp-postcss');
    var sourcemaps   = require('gulp-sourcemaps');
    var autoprefixer = require('autoprefixer');
    var cssnano      = require('cssnano'); 

    var CssDist = build+'/CSS';
    return gulp.src('./dev/CSS/*.css')
        .pipe(changed(CssDist))
        // .pipe(bytediff.start())
        .pipe(sourcemaps.init())
        .pipe(postcss([ autoprefixer({ browsers: ['last 2 versions'] }), cssnano(), ]))
        .pipe(sourcemaps.write('.'))
        // .pipe(bytediff.stop())
        .pipe(gulp.dest(CssDist));

});

gulp.task('html', function(){
    var htmlmin = require('gulp-htmlmin');
    
    var htmlDist = build+'/src';
    return gulp.src('./dev/*.php')
        .pipe(changed(htmlDist))
        .pipe(bytediff.start())
        .pipe(htmlmin({collapseWhitespace: true, removeComments: true,  ignoreCustomFragments: [ /<\?[\s\S]*?\?>/g ]}))
        // .pipe(bytediff.stop(function(data) {
        //     var difference = (data.savings > 0) ? ' smaller.' : ' larger.';
        //     return data.fileName + ' is ' + data.percent + '%' + difference;
        // }))
        .pipe(bytediff.stop())
        .pipe(gulp.dest(htmlDist));
});

gulp.task('js', function() {
    var minify = require('gulp-minify');
    var JSDist = build+'/JS';
    return new Promise(function(resolve, reject) {
        console.log("JS minify Started");
        gulp.src('./dev/JS/*.js')
            .pipe(changed(JSDist))
            //.pipe(bytediff.start())
            .pipe(minify({
                ext:{
                    src:'.js',
                    min:'.min.js'
                },
                exclude: ['tasks'],
                ignoreFiles: ['.combo.js', '.min.js']
            }))
            //.pipe(bytediff.stop())
            .pipe(gulp.dest(JSDist));
            resolve();
    });
});

gulp.task('js-unmod', function() {
    var minify = require('gulp-minify');
    var dest = require('gulp-dest');
    var JSDist = build+'/JS';

    return gulp.src('./dev/JS/*.js')
        .pipe(changed(JSDist))
        .pipe(bytediff.start())
        // .pipe(minify({
        //     ext:{
        //         src:'.js',
        //         min:'.min.js'
        //     },
        //     exclude: ['tasks'],
        //     ignoreFiles: ['.combo.js', '-min.js']
        // }))
        .pipe(bytediff.stop())
        .pipe(dest(JSDist, {ext: '.min.js'}))
        .pipe(gulp.dest('./'));
});

gulp.task('copy-js-php', function(){
    var JSDist = build+'/JS';
    return gulp.src('./dev/JS/*.php')
    .pipe(gulp.dest(JSDist));
})

gulp.task('copy-dependencies', function() {
    var rename = require('gulp-rename');
    var JSDist = build+'/JS';
    var CssDist = build+'/CSS';
    gulp.src(['./node_modules/intl-tel-input/build/css/*.css',
            './node_modules/tether/dist/css/*.min.css',
            './node_modules/bootstrap/dist/css/*.min.css',
            './lib/data-tables/css/*.css',
            './lib/jquery-mobile-switch/*.min.css',
            './lib/dropzone-4.3.0/dist/dropzone.css',
            './lib/awesome-bootstrap-checkbox-1.0.0-alpha.2/*.css',
            './node_modules/bootstrap-select/dist/css/*.min.css'])
        .pipe(changed(CssDist))
        .pipe(gulp.dest(CssDist));

    gulp.src(
            ['./dev/JS/solutionJS.php',
            './node_modules/intl-tel-input/build/js/*.js',
            './node_modules/tether/dist/js/*.min.js',
            './node_modules/bootstrap/dist/js/*.min.js',
            './node_modules/progressbar.js/dist/*.js',
            './lib/data-tables/js/*.js',
            './lib/jquery-mobile-switch/*.min.js',
            './lib/dropzone-4.3.0/dist/dropzone.js',
            './node_modules/bootstrap-select/dist/js/*.min.js',])
            .pipe(gulp.dest(JSDist))
        .pipe(gulp.src('./node_modules/intl-tel-input/build/js/utils.js'))
        .pipe(rename('intlTelInputUtils.js'))
        .pipe(gulp.dest(JSDist));
    
    gulp.src(
        [
            './node_modules/intl-tel-input/build/img/*',
            './lib/data-tables/images/*'
        ])
        .pipe(changed('./dev/images'))
        .pipe(gulp.dest('./dev/images'));
    
    return gulp.src(['./dev/favicon.ico','./dev/settings.pass','./dev/ftp.pass','./dev/\.htaccess','./dev/package.json'])
        .pipe(changed(build))
        .pipe(gulp.dest(build));
    
    
    
    
});

gulp.task('upload', function() {
    var sftp = require('gulp-sftp');
    return gulp.src('./dist/*', {since: gulp.lastRun('default')})
         .pipe(gulp.dest('./dist/changed'));
});

gulp.task('docs', function() {
    return gulp.src('./dev/Docs/content/*')
            .pipe(changed('./dev/Docs/content'))
            .pipe(gulp.dest('./build/Docs/content'));
});

gulp.task('image', function() {
    const imagemin = require('gulp-imagemin');
    gulp.src('./dev/images/*')
        .pipe(changed('./build/images'))
        .pipe(bytediff.start())
        //.pipe(imagemin([imagemin.gifsicle(), imagemin.jpegtran(), imagemin.optipng(), imagemin.svgo()], {verbose: true}))
         .pipe(imagemin())        
        .pipe(bytediff.stop())
        .pipe(gulp.dest('./build/images'));

    return gulp.src('./dev/solution_images/*')
        .pipe(changed('./build/solution_images'))
        .pipe(bytediff.start())
        //.pipe(imagemin([imagemin.gifsicle(), imagemin.jpegtran(), imagemin.optipng(), imagemin.svgo()], {verbose: true}))
         .pipe(imagemin())
        .pipe(bytediff.stop())
        .pipe(gulp.dest('./build/solution_images'));
});

gulp.task('rev', function(){
    var revAll = require('gulp-rev-all');
    var filter = require('gulp-filter');
    var clean = require('gulp-clean');
    // var revAll = new RevAll({ dontRenameFile: [/^\/favicon.ico$/g, '.php', 'intlTelInput.min.js', 'intlTelInput.js','.htaccess'], dontUpdateReference: [/^\/favicon.ico$/g, '.php', 'intlTelInput.js','intlTelInput.min.js','.htaccess'], dontSearchFile: ['.pdf']});

    const f = filter(['**', '!*/src/*'],{restore: true});

            gulp.src('./dist/', {read: false})
            .pipe(clean());

    return gulp.src(['./build/**/*'],{ dot: true })
            //.pipe(f)
            .pipe(revAll.revision())
            //.pipe(f.restore)
            .pipe(gulp.dest('./dist'))
            .pipe(revAll.manifestFile({ dontRenameFile: [/^\/favicon.ico$/g, '.php', 'intlTelInput.min.js', 'intlTelInput.js','.htaccess'], dontUpdateReference: [/^\/favicon.ico$/g, '.php', 'intlTelInput.js','intlTelInput.min.js','.htaccess'], dontSearchFile: ['.pdf']}))
            .pipe(gulp.dest('./dist'))
            .pipe(revAll.versionFile())
            .pipe(gulp.dest('./dist'));
});

gulp.task('notify', function(){
    var notify = require("gulp-notify");
    return gulp.src("./dist")
            .pipe(notify("Gulp complete"));
});

gulp.task('default', gulp.series(gulp.parallel('copy-dependencies', 'copy-js-php' ,'css', 'js-unmod', 'html','image','docs'),'rev','notify'));