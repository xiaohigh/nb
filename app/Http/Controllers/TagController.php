<?php

namespace App\Http\Controllers;

use App\Forms\Tag\AddForm;
use App\Forms\Tag\updateForm;
use App\Models\Tag;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['tags'] = Tag::all();
        $data['title'] = '标签列表';
        return view('admin.tag.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $data['form'] = $formBuilder->create(AddForm::class, [
            'url' => url('tag'),
            'method' =>'post'
        ]);
        $data['title'] = '标签添加';

        return view('layouts.form', ['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormBuilder $formBuilder, Request $request)
    {
        $form = $formBuilder->create(AddForm::class);
        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = [];
        //检测是否有,
        if(strpos($request->name, ',') > 0) {
            $tags = explode(',', $request->name);
        }else{
            $tags = [$request->name];
        }

        foreach($tags as $k=>$v) {
            $tag = new Tag;
            $tag->name = trim($v);
            $tag->save();
        }

        return rt('1','添加成功','/tag');
    }

    /**
     * ajax添加标签
     *
     * @param FormBuilder $formBuilder
     * @return $this|string
     */
    public function ajaxStore(FormBuilder $formBuilder, Request $request)
    {
        $form = $formBuilder->create(AddForm::class);
        if (!$form->isValid()) {
            return rjson(0,'标签已经存在');
        }

        $tag = new Tag;
        $tag->name = trim($request->name);
        //插入数据库
        if($tag->save()) {
            return rjson(1,'添加成功',['id'=>$tag->id,'name'=>$tag->name]);
        }else{
            return rjson(0,'添加失败');
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
    public function edit(FormBuilder $formBuilder,$id)
    {
        //查找数据
        $tag = Tag::findOrFail($id);
        //创建表单
        $data['form'] = $formBuilder->create(updateForm::class,[
            'url' => '/tag/'.$id,
            'method' => 'post',
            'model' => $tag
        ]);
        $data['title'] = '标签更新';
        return view('layouts.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $tag -> name = $request -> name;
        //更新
        if($tag->save()) {
            return rt(1, '更新成功',url('/tag'));
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
        //
        $tag = Tag::findOrFail($id);
        if($tag->delete()) {
            return rjson(1);
        }else{
            return rjson(0);
        }
    }
}
