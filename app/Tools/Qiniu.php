<?php

namespace App\Tools;
use Illuminate\Http\UploadedFile;
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

    /**
     * 七牛云在服务器上传文件
     * @param UploadedFile|null $file
     * @return bool
     * @throws \Exception
     */
    public static function uploadFile(UploadedFile $file=null)
    {
        if($file != null && $file->isValid()) {
            //上传文件
            //获取token
            $token = self::getToken();
            //生成文件名
            $name = uniqid('avatar_').'.'.$file->extension();
            //
            $uploadMgr = new UploadManager();
            $res = $uploadMgr->putFile($token, $name, $file->path());
            return $res[1] != null ? '' : $res[0]['key'];
        }
        return false;
    }

}