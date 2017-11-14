<?php

    //公共的文件上传操作
    Route::post('admin/mkupload', 'CommonController@markdownUpload');

    Route::get('/test','CommonController@test');
