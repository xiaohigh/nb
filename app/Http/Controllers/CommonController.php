<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Models\Lesson;
use App\Models\User;
use Faker\Generator as Faker;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class CommonController extends Controller
{
    /**
     * markdown 编辑器上传文件到七牛云
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
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
        //测试翻译 gTkVf84kCueD
        $client = new Client;

        $response = $client->request('GET', 'https://www.google.com/', ['proxy' =>
                                                            '192.168.199.111:1087'
                                                        ]);
        echo $response -> getBody();

    }

}
