<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/test', 'CommonController@test');
Route::get('/test1', 'CommonController@test1');

//登录授权路由组
Auth::routes();

// 三方登录
Route::group([], function(){
    Route::get('/oauth/github', 'SocialiteController@github')->name('auth_github');
    Route::get('/oauth/google', 'SocialiteController@google')->name('auth_google');
});

//前台用户个人中心
Route::group(['middleware'=>'auth'], function(){
    Route::any('/setting', 'UserController@setting')->name('user-setting');
    Route::any('/set-password', 'UserController@setPassword')->name('set-password');
});

//前台路由组
Route::group([], function(){

    Route::get('/', 'HomeController@index')->name('home');

    //博客详情
    Route::get('/blog/{id}.html', 'ArticleController@show')->name('blog-detail');

    //博客列表
    Route::get('/blog','ArticleController@list')->name('blog-list');

    //邮箱验证
    Route::get('/register/confirm/{token}', 'UserController@confirmEmail')->name('confirm_email');

    //视频详情
    Route::get('/course/{course_id}/lesson-{lesson_id}.html','LessonController@detail')->name('lesson');

    //课程列表
    Route::get('/courses', 'CourseController@lists')->name('course-list');

    //课程详情
    Route::get('/course/{id}', 'CourseController@show')->name('course-detail');
    
    //退出登录
    Route::get('/exit', 'Auth\LoginController@logout')->name('exit');
});

//后台路由组
Route::group(['middleware'=>['auth','admin']], function(){

    //后台首页
    Route::get('/admin', 'AdminController@index');

    //用户管理
    Route::resource('user', 'UserController');

    //分类管理
    Route::resource('arccate', 'ArccateController');

    //标签管理
    Route::resource('tag', 'TagController');

    //标签ajax添加
    Route::post('/tag/ajaxadd','TagController@ajaxStore');

    //博客文件管理
    Route::resource('article', 'ArticleController');

    //课程管理
    Route::resource('course', 'CourseController');

    //视频
    Route::resource('lesson','LessonController');

    //网站配置管理
    Route::get('/config', 'ConfigController@edit');
    Route::post('/config', 'ConfigController@update');
});





