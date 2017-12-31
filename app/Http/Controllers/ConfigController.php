<?php

namespace App\Http\Controllers;

use App\Forms\Config\UpdateForm;
use App\Models\Config;
use App\Tools\Qiniu;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class ConfigController extends Controller
{
    /**
     * 配置修改
     */
    public function edit(FormBuilder $formBuilder)
    {
        $d['form'] = $formBuilder->create(UpdateForm::class, [
            'method' => 'POST',
            'url' => url('/config'),
            'model' => (Config::find(1) ? : (new Config))
        ]);

        $d['title'] = '网站配置';
        $d['qiniu_token'] = Qiniu::getToken();

        return view('layouts.form', ['data'=>$d]);
    }

    /**
     * 配置更新
     */
    public function update(Request $request)
    {
        $config = Config::find(1) ? : (new Config);
        $config->fill($request->all());

        if($config->save()) {
            return back()->with('msg', '更新成功');
        }
    }

}
