<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\User\AddForm;
use App\Forms\User\UpdateForm;

use App\Models\User;

class UserController extends Controller
{
    /**
     * 列表显示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //读取数据库
        $d['users'] = User::all();
        $d['title'] = '用户列表';

        return view('admin.user.list', ['data' => $d]);
    }

    /**
     * 添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        //创建表单
        $data['form'] = $formBuilder->create(AddForm::class, [
            'method' => 'POST',
            'url' => '/user'
        ]);
        $data['title'] = '用户添加';
        //解析模板
        return view('admin.user.create', compact('data'));
    }

    /**
     * 入库
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormBuilder $formBuilder, Request $request)
    {
        //检测表单数据
        $form = $formBuilder->create(AddForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        //获取用户数据
        $user = new User;
        $user->email = $request->email;
        $user->password = encrypt($request->password);

        if($user->save()) {
            return rt(1, '添加成功', '/user');
        }else{
            return rt(0, '添加失败');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 显示修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,FormBuilder $formBuilder)
    {
        $user = User::findOrFail($id);
        //创建表单
        $data['form'] = $formBuilder->create(UpdateForm::class, [
            'method' => 'POST',
            'url' => '/user/'.$id,
            'model' => $user
        ]);
        $data['title'] = '用户修改';
        //解析模板
        return view('admin.user.edit', compact('data'));

    }

    /**
     * 更新数据库
     */
    public function update(FormBuilder $formBuilder,Request $request, $id)
    {
        //表单验证
        $form = $formBuilder->create(UpdateForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        //读取用户信息
        $user = User::findOrFail($id);
        //更新数据
        $user->email = $request->email;

        if($user->save()) {
            return rt(1, '更新成功', url('/user'));
        }else{
            return rt(0, '更新失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //获取用户信息
        $user = User::findOrFail($id);

        if($user->delete()) {
            return rjson(1, '成功');
        }else{
            return rjson(0, '失败');
        }

    }

    /**
     * 激活用户
     * @param $token 用户验证token
     */
    public function confirmEmail($token)
    {
        //激活用户
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activation_token = null;
        $user->activated = true;

        if($user->save()) {
            Auth::login($user);
            return rt(1, '更新成功', url('/'));
        }else{
            return rt(0, '更新失败', url('/'));
        }

    }
}
