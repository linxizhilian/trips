// 引入组件
var gulp = require('gulp'),                    // 引入Gulp
	minifycss = require('gulp-minify-css'),    // css压缩
	uglify = require('gulp-uglify'),        // js压缩
	concat = require('gulp-concat'),        // 文件合并
	rename = require('gulp-rename'),        // 文件更名
	less = require('gulp-less'),            // less2css
	notify = require('gulp-notify'),        // 提示信息
	runSequence = require('run-sequence'), // 重命名 hash
	rev = require('gulp-rev'),
	revCollector = require('gulp-rev-collector'),
  del = require('del'),
  connect = require('gulp-connect');//使用connect启动一个Web服务器

// less to css
gulp.task('build-less', function () {
	return gulp.src('assets/less/*.less')
		.pipe(less())
		.pipe(gulp.dest('assets/css'));
		// .pipe(notify({ message: 'less2css task ok' }));
});

// 合并、压缩、重命名css
gulp.task('build-css', function() {
	return  gulp.src([
    'assets/css/common.css',
    'assets/css/main.css'
  ])
		.pipe(concat('all.css'))
		.pipe(gulp.dest('assets/css'))
    .pipe(rename({ suffix: '.min'}))
		.pipe(minifycss())
		.pipe(gulp.dest('dist/css'));
		// .pipe(notify({ message: 'css task ok' }));
});

// 合并、压缩js文件 -- 废弃
// gulp.task('js', function() {
// 	return gulp.src([
//     'assets/js/bootstrap.js'
//   ])
// 		.pipe(concat('all.js'))
// 		.pipe(gulp.dest('dist/js'))
// 		.pipe(rename({ suffix: `.min`}))
// 		.pipe(uglify())
// 		.pipe(gulp.dest('dist/js'))
// 		.pipe(notify({ message: 'js task ok' }));
// });

gulp.task('connect', function() {
  connect.server({
    // host: '192.168.1.172', //地址，可不写，不写的话，默认localhost
    port: 80, //端口号，可不写，默认8000
    root: './', //当前项目主目录
    livereload: true //自动刷新
  });
});
gulp.task('html', function() {
  gulp.src('./*.html')
    .pipe(concat('./app/*'))
    .pipe(concat('./app/*/*.html'))
    .pipe(connect.reload());
});

gulp.task('build-less-css', function(done) {
  runSequence(
    'build-less',
    'build-css',
    done);
});

gulp.task('watch', function () {
  gulp.watch('assets/less/*.less', ['build-less-css']); // less 变更 - 重新加载

  //监控js、css、html 文件, 重新刷新界面
  // gulp.watch('assets/js/*.js', ['html']);
  // gulp.watch('assets/css/all.css', ['html']); //监控css文件
  // gulp.watch(['app/*/*.html'], ['html']); //监控html文件
  // gulp.watch(['index.html'], ['html']); //监控html文件
});

// 开发构建 - 编译less文件
gulp.task('dev', ['watch']);
// gulp.task('dev', ['connect', 'watch']);


// 删除脏文件
gulp.task('clean', function(cb) {
  del([
    'dist/*/*',
    'static/**/*',
    '!static/*/rev-manifest.json' //  保留映射，不删除
  ], cb);
});

//CSS生成文件hash编码并生成 rev-manifest.json文件名对照映射
gulp.task('revCss', function() {
	return gulp.src('dist/css/all.css')
		.pipe(rev())
		.pipe(gulp.dest('static/css'))
		.pipe(rev.manifest())
		.pipe(gulp.dest('static/css'));
});

//js生成文件hash编码并生成 rev-manifest.json文件名对照映射
gulp.task('revJs', function() {
	return gulp.src('dist/js/all.js')
		.pipe(rev())                                //给文件添加hash编码
		.pipe(gulp.dest('static/js'))
		.pipe(rev.manifest())                       //生成rev-mainfest.json文件作为记录
		.pipe(gulp.dest('static/js'));
});


//Html替换css、js文件版本
gulp.task('revHtmlCss', function () {
	return gulp.src(['static/css/*.json', './index_template.html'])
		.pipe(revCollector())                         //替换html中对应的记录
		.pipe(gulp.dest('./index.html'));                     //输出到该文件夹中
});
gulp.task('revHtmlJs', function () {
	return gulp.src(['src/js/*.json', './index.html'])
		.pipe(revCollector())
		.pipe(gulp.dest('./index.html'));
});


// 默认任务
gulp.task('default', ['watch']);
// gulp.task('default', ['less2css'], function() {
// 	gulp.run('css');
// });

// 生产构建 TODO
gulp.task('build', function(done) {
	// gulp.run('less2css', 'css', 'js', 'revCss', 'revHtmlCss', 'revJs', 'revHtmlJs');
	condition = false;
	runSequence(
	  // ['clean'],
		['less2css'],
		['css'],
		// ['js'],
		['revCss'],
		['revHtmlCss'],
		// ['revJs'],
		// ['revHtmlJs'],
		done)

});
