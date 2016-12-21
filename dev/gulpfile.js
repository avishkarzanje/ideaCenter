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
    return gulp.src('./CSS/*.css')
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
    return gulp.src('*.php')
        .pipe(changed(htmlDist))
        .pipe(bytediff.start())
        //.pipe(htmlmin({collapseWhitespace: true, removeComments: true,  ignoreCustomFragments: [ /<\?[\s\S]*?\?>/g ]}))
        // .pipe(bytediff.stop(function(data) {
        //     var difference = (data.savings > 0) ? ' smaller.' : ' larger.';
        //     return data.fileName + ' is ' + data.percent + '%' + difference;
        // }))
        .pipe(bytediff.stop())
        .pipe(gulp.dest(htmlDist));
})

gulp.task('js', function() {
    var minify = require('gulp-minify');
    var JSDist = build+'/JS';
    return new Promise(function(resolve, reject) {
        console.log("JS minify Started");
        gulp.src('./JS/*.js')
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
    return gulp.src('./JS/*.js')
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

gulp.task('copy-dependencies', function() {
    var rename = require('gulp-rename');
    var JSDist = build+'/JS';
    var CssDist = build+'/CSS';
    gulp.src(['./node_modules/intl-tel-input/build/css/*.css',
            './node_modules/tether/dist/css/*.min.css',
            './node_modules/bootstrap/dist/css/*.min.css',
            './node_modules/bootstrap-select/dist/css/*.min.css'])
        .pipe(changed(CssDist))
        .pipe(gulp.dest(CssDist));

    gulp.src(
            ['./JS/solutionJS.php',
            './node_modules/intl-tel-input/build/js/*.js',
            './node_modules/tether/dist/js/*.min.js',
            './node_modules/bootstrap/dist/js/*.min.js',
            './node_modules/bootstrap-select/dist/js/*.min.js',])
            .pipe(gulp.dest(JSDist))
        .pipe(gulp.src('./node_modules/intl-tel-input/build/js/utils.js'))
        .pipe(rename('intlTelInputUtils.js'))
        .pipe(gulp.dest(JSDist));
    
    gulp.src('./node_modules/intl-tel-input/build/img/*')
        .pipe(changed(dist))
        .pipe(gulp.dest('./images'));
    
    return gulp.src(['./favicon.ico','./settings.pass','./ftp.pass','./.htaccess','./package.json'])
        .pipe(changed(build))
        .pipe(gulp.dest(build));
    
    
    
    
});

gulp.task('upload', function() {
    var sftp = require('gulp-sftp');
    return gulp.src('./dist/*', {since: gulp.lastRun('default')})
        //.pipe(sftp({
        //    host: 'ftp.udeworld.com',
            // authFile: './ftp.pass', 
            // auth: 'keyMain',
       //    user: 'uds@udeworld.com',
       //     pass: '@6J4?+nFg!*3',
      //      remotePath: './V1/'
      //  }));
         .pipe(gulp.dest('./dist/changed'));
});

gulp.task('image', function() {
    const imagemin = require('gulp-imagemin');
    gulp.src('./images/*')
        .pipe(changed('build/images'))
        .pipe(bytediff.start())
        //.pipe(imagemin([imagemin.gifsicle(), imagemin.jpegtran(), imagemin.optipng(), imagemin.svgo()], {verbose: true}))
         .pipe(imagemin())        
        .pipe(bytediff.stop())
        .pipe(gulp.dest('build/images'));

    return gulp.src('./solution_images/*')
        .pipe(changed('build/solution_images'))
        .pipe(bytediff.start())
        //.pipe(imagemin([imagemin.gifsicle(), imagemin.jpegtran(), imagemin.optipng(), imagemin.svgo()], {verbose: true}))
         .pipe(imagemin())
        .pipe(bytediff.stop())
        .pipe(gulp.dest('build/solution_images'));
});

gulp.task('rev', function(){
    var RevAll = require('gulp-rev-all');
    var filter = require('gulp-filter');
    var revAll = new RevAll({ dontRenameFile: [/^\/favicon.ico$/g, '.php'], dontUpdateReference: [/^\/favicon.ico$/g, '.php'] });

    const f = filter(['**', '!*/src/*'],{restore: true});

    return gulp.src('./build/**/*')
            //.pipe(f)
            .pipe(revAll.revision())
            //.pipe(f.restore)
            .pipe(gulp.dest('./dist'))
            .pipe(revAll.manifestFile())
            .pipe(gulp.dest('./dist'))
            .pipe(revAll.versionFile())
            .pipe(gulp.dest('./dist'));
});

gulp.task('default', gulp.series(gulp.parallel('copy-dependencies','css', 'js-unmod', 'html','image'),'rev'));