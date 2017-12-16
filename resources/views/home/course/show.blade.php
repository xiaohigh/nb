@extends('layouts.home')

@section('container')
<div class="course container">
    <div class="col-md-6">
        <div class="pic">
            <h1 style="margin:0px;" class="no-padding">{{$course->title}}</h1>
            <hr>
            {!!$course->content!!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="lessons">
            <img data-src="holder.js/600x300?bg=#aef&text=TT" src="{{$course->pic}}" class="img-responsive" alt="">
            <hr>
            <table class="table table-hover border">
                @foreach($course->getLessons() as $k=>$v)
                <tr class="pointer">
                    <td width="5%">{{$k+1}}.</td>
                    <td width="70%"><a href="{{route('lesson',['course_id'=>$course->id,'lesson_id'=>$v->id])}}"><span class="glyphicon glyphicon-play-circle" aria-hidden="true" style="padding-right:5px;"></span>{{$v->title}}</a></td>
                    <td width="25%">{{formatSeconds($v->long)}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@stop