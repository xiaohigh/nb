@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="/bower_components/editor.md/css/editormd.css">

    <form action="/lesson/{{$lesson->id}}" method="post" enctype="multipart/form-data">
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">课程</label>
            <input class="form-control" disabled value="{{$lesson->course->title}}">
            <input class="form-control" id="exampleInputEmail1" value="{{$lesson->course->id}}" name="course_id" type="hidden" aria-describedby="emailHelp" placeholder="">
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">视频标题</label>
            <input class="form-control" id="exampleInputEmail1" value="{{$lesson->title}}" name="title" type="text" aria-describedby="emailHelp" placeholder="">
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">视频排序</label>
            <input class="form-control" id="exampleInputEmail1" value="{{$lesson->pos}}" name="pos" type="text" aria-describedby="emailHelp" placeholder="">
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">视频</label>
            <input class="form-control" name="video" value="" id="exampleInputPassword1" type="file">
        </div>

        {{csrf_field()}}
        {{method_field('put')}}

        <div class="col-md-12">
            <button class="btn btn-primary">更新</button>
        </div>
    </form>

    <div id="bak">

    </div>
@endsection

@section('js')
    <script>

    </script>
@endsection


