<?php

namespace App\Http\Controllers;

use App\Forms\User\AddForm;
use App\Forms\User\UpdateForm;
use App\Models\User;
use App\Tools\Qiniu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kris\LaravelFormBuilder\FormBuilder;

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
        $user->password = bcrypt($request->password);
        $user->name = $request->name;
        $user->profile = Qiniu::uploadFile($request->profile);
        if($user->save()) {
            return rt(1, '添加成功', '/user');
        }else{
            return rt(0, '添加失败');
        }

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
        $user->name = $request->name;
        if($request->hasFile('profile')) {
            $user->profile = Qiniu::uploadFile($request->profile);
        }

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
            session()->flash('success','恭喜您,激活成功!!');
            Auth::login($user);
            return rt(1, '更新成功', url('/'));
        }else{
            return rt(0, '更新失败', url('/'));
        }
    }

    /**
     * 用户基本信息修改
     */
    public function setting(Request $request)
    {
        $user = Auth::user();

        //检测是 GET 还是 POST
        if(!$request->has('_token')) {
            return view('home.user.center', compact('user'));
        }

        //表单验证
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        //获取信息
        $user->email = $request->email;
        if($request->hasFile('profile')) {
            $user->profile = Qiniu::uploadFile($request->file('profile'));
        }

        //用户更新
        if($user->save()) {
            return back()->with('success','更新成功');
        }else{
            return back()->with('error','更新失败,请重试!');
        }
    }

    /**
     * 修改密码
     */
    public function setPassword(Request $request)
    {
        $user = Auth::user();

        if(!$request->has('_token')) {
            return view('home.user.password');
        }

        //验证密码
        if(!Hash::check($request->old_password, $user->password)) {
            return back()->with('danger','密码错误,请重新输入');
        }

        //表单验证
        $this->validate($request, [
            'new_password' => 'required|min:6',
            're_password' => 'same:new_password',
        ],[
            'new_password.required' => '新密码不能为空',
            'new_password.min' => '密码最低为6位',
            're_password.same' => '两次密码不一样',
        ]);

        // 加密密码
        $user->password = Hash::make($request->new_password);

        if($user->save()) {
            return back()->with('success','密码修改成功');
        } else {
            return back()->with('danger','密码修改是吧');
        }


    }
}
