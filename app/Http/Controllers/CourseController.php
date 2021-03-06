<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Tag;
use App\Tools\Qiniu;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //读取课程
        $courses = Course::all();

        return view('admin.course.list',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取标签
        $tags = Tag::all();
        //获取七牛上传token
        $token = Qiniu::getToken();

        //解析模板
        return view('admin.course.create', compact('tags','token'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, \Parsedown $parsedown)
    {
        $course = new Course;
        $course -> title = $request->title;
        $course -> price = $request->price;
        $course -> pic = $request->pic;
        $course -> content_m = $request->content_m;
        $course -> content = $parsedown->text($request->content_m);

        //插入数据库
        if($course -> save()) {
            //处理标签
            $tags = handleTags($request->tag_id);
            //插入标签
            $course->tags()->sync($tags);
            return redirect('/course')->with('msg','课程添加成功');
        } else {
            return back()->with('error','添加失败!!!');
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
        //读取课程信息
        $course = Course::findOrFail($id);

        return view('home.course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);

        $tags = Tag::all();

        $token = Qiniu::getToken();

        return view('admin.course.edit', compact('course','tags','token'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, \Parsedown $parsedown)
    {
        $course = Course::findOrFail($id);
        $course -> title = $request->title;
        $course -> price = $request->price;
        $course -> pic = $request->pic;
        $course -> content_m = $request->content_m;
        $course -> content = $parsedown->text($request->content_m);

        //插入数据库
        if($course -> save()) {
            //处理标签
            $tags = handleTags($request->tag_id);
            //插入标签
            $course->tags()->sync($tags);
            return redirect('/course')->with('msg','课程更新成功');
        } else {
            return back()->with('error','更新失败!!!');
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
        //删除
        $course = Course::findOrFail($id);
        //删除标签
        $course->tags()->detach();
        if($course->delete()) {
            return rjson(1, '删除成功');
        }else{
            return rjson(2, '删除失败');
        }
    }

    /**
     * @param Request $request
     */
    public function lists(Request $request)
    {
        //读取课程信息
        $courses = Course::orderBy('id','desc')->paginate(6);

        return view('home.course.list',compact('courses'));
    }

}
