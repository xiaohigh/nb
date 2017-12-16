@extends('layouts.home')

@section('title')
    {{$article->title}}
@endsection

@section('content')
    <div class="col-md-9">
        <aside class="left detail">
            <h1>{{$article->title}}</h1>
            <div class="detail-info">
                <div class="pull-left m-r-10">
                    <a href="{{route('blog-list', ['cate_id'=>$article->cate_id])}}"><span class="label label-warning">分类:{{isset($article->cate) ? $article->cate->name : '无'}}</span></a>
                </div>
                <div class="pull-left m-r-10">
                    <span class="label label-success">{{substr($article->created_at, 0, 10)}}</span>
                </div>
                <div class="pull-left m-r-10">
                    @foreach($article->tags as $k=>$v)
                        <a href="{{route('blog-list',['tag'=>$v->name])}}"><span class="label label-info">{{$v->name}}</span></a>
                    @endforeach
                </div>
            </div>
            <div class="clearfix"></div>
            <hr>
            <div class="blog  markdown-body">
                {!!$article->content!!}
            </div>
            <hr>
            <div class="share-component" data-disabled="google,twitter,facebook" data-description="Share.js - 一键分享到微博，QQ空间，腾讯微博，人人，豆瓣"></div>

        </aside>
    </div>
@endsection

@section('aside')
    <!-- 右侧侧边栏 start -->
    <aside class="col-md-3 right">
        @component('home.components.cate')
        @endcomponent

        @component('home.components.tags')
        @endcomponent

        @component('home.components.author')
        @endcomponent

    </aside>
    <!-- 右侧侧边栏 end -->
@endsection

@section('css')
    <link rel="stylesheet" href="/bower_components/social-share.js/dist/css/share.min.css">
@stop


@section('js')
    <script src="/bower_components/social-share.js/dist/js/share.min.js"></script>
@stop