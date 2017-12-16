@extends('layouts.home')

@section('title','课程列表')

@section('container')
<div class="container courses">
    @foreach($courses as $k=>$v)
    <div class="col-md-4">
        <div class="item shadow">
            <a href="{{route('course-detail',['id'=>$v->id])}}"><img data-src="holder.js/100px200?bg=#aef&text=TT" src="{{$v->pic}}" class="img-responsive" alt=""></a>
            <h4><a href="{{route('course-detail',['id'=>$v->id])}}">{{$v->title}}</a></h4>
        </div>
    </div>

    @endforeach
    <div class="clearfix"></div>

    <div id="pages" class="pull-right">
        {{$courses->links()}}
    </div>

</div>
@stop