<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Tools\FFmpeg;
use App\Tools\Qiniu;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取课程id
        $course = Course::findOrFail($request->course_id);

        //读取课程视频
        return view('admin.lesson.list', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //检测分类id是否传递
        ($course_id = $request->course_id) || abort(404);

        $course = Course::findOrFail($course_id);

        return view('admin.lesson.create', compact('course'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lesson = new Lesson;

        $lesson -> title = $request->title;
        $lesson -> pos = $request->input('pos', 1);
        $lesson -> course_id = $request->course_id;
        if($request->hasFile('video') && $request->video->isValid()) {
            $lesson -> long = FFmpeg::getDuration($request->video->path());
            $lesson -> video = Qiniu::uploadFile($request->video);
        }

        if($lesson->save()) {
            return redirect('/course')->with('msg','视频添加成功');
        }else{
            return back()->with('msg','视频添加失败!');
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
    public function edit($id)
    {
        //读取视频课程视频
        $lesson = Lesson::findOrFail($id);

        return view('admin.lesson.edit', compact('lesson'));
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
        $lesson = Lesson::findOrFail($id);

        $lesson -> title = $request->title;
        $lesson -> pos = $request->input('pos', 1);
        $lesson -> course_id = $request->course_id;

        if($request->hasFile('video') && $request->video->isValid()) {
            $lesson -> long = FFmpeg::getDuration($request->video->path());
            $lesson -> video = Qiniu::uploadFile($request->video);
        }

        if($lesson->save()) {
            return redirect('/lesson?course_id='.$lesson->course->id)->with('msg','视频更新成功');
        }else{
            return back()->with('msg','视频更新失败!');
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
        $lesson = Lesson::findOrFail($id);

        if($lesson->delete()) {
            return rjson(1, '删除成功');
        }else{
            return rjson(0, '删除失败!!'); 
        }
    }
}
