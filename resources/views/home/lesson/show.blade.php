@extends('layouts.home')

@section('css')
<style>
    body{
        background: #000;
    }
</style>
@stop

@section('container')

    <div class="video container">

        <div class="col-md-10">
            <video src="{{env('QINIU_URL')}}{{$lesson->video}}" width="100%" controls></video>
        </div>
        <div class="col-md-2">
            <div class="lessons">
                <div class="list-group">
                @foreach($course->getLessons() as $k=>$v)
                    <a href="{{route('lesson',['course_id'=>$course->id, 'lesson_id'=>$v->id])}}" class="list-group-item @if($v->id == $lesson->id) active @endif">
                        {{$v->title}}
                    </a>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@stop