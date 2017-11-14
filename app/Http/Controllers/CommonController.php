<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 引入鉴权类
use Qiniu\Auth;
// 引入上传类
use Qiniu\Storage\UploadManager;

class CommonController extends Controller
{
    //
    public function markdownUpload(Request $request)
    {
        //将文件直接上传到七牛云
        $accessKey = env('QINIU_KEY');
        $secretKey = env('QINIU_SECRET');
        $auth = new Auth($accessKey, $secretKey);
        $bucket = env('QINIU_BUCKET');
        // 生成上传Token
        $token = $auth->uploadToken($bucket);

        // 要上传文件的本地路径
        $filePath = $request->file('editormd-image-file')->getPathname();
        // 上传到七牛后保存的文件名
        $suffix = $request->file('editormd-image-file')->getClientOriginalExtension();
        $key = uniqid(rand(), true).'.'.$suffix;

        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        if(!$err) {
            return response()->json(['message'=>'上传成功', 'url'=>env('QINIU_URL').$ret['key'],'success'=>1]);
        }else{
            return response()->json(['message'=>'上传失败']);
        }

    }


    public function test()
    {
        return view('test');
    }
}
