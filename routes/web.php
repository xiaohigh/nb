<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//登录授权路由组
Auth::routes();

Route::get('/register/confirm/{token}', 'UserController@confirmEmail')->name('confirm_email');
//前台路由组
Route::group([], function(){

    Route::get('/', 'ArticleController@list');

    Route::get('/home', 'HomeController@index');

    //博客详情
    Route::get('/blog/{id}.html', 'ArticleController@show')->name('blog-detail');

    //博客列表
    Route::get('/blog','ArticleController@list');

});

//后台路由组
Route::group(['middleware'=>'auth'], function(){

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

    //网站配置管理
    Route::get('/config', 'ConfigController@edit');
    Route::post('/config', 'ConfigController@update');

});





