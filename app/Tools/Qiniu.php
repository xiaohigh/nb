<?php

namespace App\Tools;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class Qiniu
{
    //获取上传token
    public static function getToken()
    {
        $accessKey = env('QINIU_KEY');
        $secretKey = env('QINIU_SECRET');
        $auth = new Auth($accessKey, $secretKey);
        $bucket = env('QINIU_BUCKET');
        // 生成上传Token
        $token = $auth->uploadToken($bucket);
        return $token;
    }

    public static function removeFile($key)
    {
        //获取token
        $accessKey = env('QINIU_KEY');
        $secretKey = env('QINIU_SECRET');
        $auth = new Auth($accessKey, $secretKey);
        $config = new \Qiniu\Config();
        $bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);
        $err = $bucketManager->delete(env('QINIU_BUCKET'), $key);
        return $err == null ? true : false;
    }

}