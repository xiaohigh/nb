<?php

namespace App\Http\Controllers;

use App\Models\ArcCate;
use Illuminate\Http\Request;
use App\Forms\Arccate\addForm;
use App\Forms\Arccate\updateForm;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;

class ArccateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取数据
        $d['cates'] = ArcCate::getCateByLevelForList();
        $d['title'] = '分类列表';
        //解析模板
        return view('admin.arccate.list', ['data' => $d]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        //
        $d['form'] = $formBuilder->create(AddForm::class, [
            'method' => 'POST',
            'url' => url('/arccate')
        ]);

        $d['title'] = '分类添加';

        return view('layouts.form', ['data'=>$d]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormBuilder $formBuilder,Request $request)
    {
        $form = $formBuilder -> create (AddForm::class);
        //验证合法性
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }
        //实例化模型
        $arccate = new ArcCate;
        $arccate->name = $request->name;
        $arccate->pid = $request->pid;
        //生成path
        if($arccate->pid == 0) {
            $arccate -> path = '0';
        }else{
            //获取父级分类
            $parent = ArcCate::findOrFail($arccate->pid);
            $arccate->path = $parent->path .'_'. $parent->id;
        }

        if($arccate->save()) {
            return rt(1, '添加成功', url('arccate'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FormBuilder $formBuilder, $id)
    {
        $arc = ArcCate::findOrFail($id);
        $data['form'] = $formBuilder -> create(updateForm::class,[
            'method' => 'POST',
            'url' => '/arccate/'.$id,
            'model' => $arc
        ]);
        $data['title'] = '更新文章分类';

        return view('layouts.form', ['data' => $data]);
    }

    /**
     * 更新数据库
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //获取数据
        $arccate = ArcCate::findOrFail($id);
        $arccate -> name = $request->name;
        //更新
        if($arccate -> save()) {
            return rt(1, '更新成功', url('/arccate'));
        }else{
            return rt(0, '更新失败');
        }

    }

    /**
     * 删除数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arccate = ArcCate::findOrFail($id);
        //删除该分类下的子分类
        ArcCate::where('path','like',$arccate->path.'_'.$arccate->id.'%')->delete();
        if($arccate->delete()) {
            return rjson(1, '删除成功');
        }else{
            return rjson(0,'删除失败');
        }
    }
}
