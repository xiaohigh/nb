@extends('layouts.home')

@section('title','博客列表')

@section('content')
<!-- 左侧侧边栏 start -->
<aside class="col-md-9 left article-list">
    <ul class="list-unstyled item-list">
        @if(count($blogs) == 0)
        <li class="text-center">暂无数据</li>
        @else
        @foreach($blogs as $k=>$v)
        <li class="shadow">
            <div class="col-md-4 img">
                <a href="{{route('blog-detail',['id'=>$v->id])}}"><img src="{{$v->pic}}" class="img-responsive img-thumbnail"></a>
            </div>
            <div class="col-md-8">
                <h4><a href="{{route('blog-detail',['id'=>$v->id])}}">{{$v->title}}</a></h4>
                <p class="intro">
                    {{$v->intro}}
                </p>
            </div>
        </li>
        @endforeach
        @endif
    </ul>

    <nav aria-label="Page navigation" class="">
        {{$blogs->appends(request()->all())->render()}}
    </nav>
</aside>
<!-- 左侧侧边栏 start -->
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