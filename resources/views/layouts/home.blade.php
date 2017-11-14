<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>

    <meta charset="utf-8">

    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- markdown.css -->
    <link rel="stylesheet" href="/bower_components/github-markdown-css/github-markdown.css">
    <!-- main.css -->
    <link rel="stylesheet" type="text/css" href="/css/common.css">
</head>
<body>
<div class="container">
    <!-- 头部 start -->
    <header>
        <div class="col-md-2" id="logo"><a href="/"><img data-src="holder.js/200x100?text=XiaoHigh&size=16" class="img-responsive" src="{{C('logo')}}"></a></div>
    </header>
    <!-- 头部 end -->

    <div class="clearfix"></div>

    <!-- 导航 start -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" id="nav">
                    <li class="@if(!$request->cate_id) active @endif"><a href="/">首页</a></li>
                    @foreach($cates as $k=>$v)
                        <li class="@if($request->cate_id == $v->id) active @endif"><a href="{{url('/blog?cate_id='.$v->id)}}">{{$v->name}}</a></li>
                    @endforeach
                </ul>
                <form class="navbar-form navbar-right" action="/blog">
                    <div class="form-group">
                        <input type="text" class="form-control"  value="{{$request->keywords or ''}}" name="keywords" placeholder="关键字">
                    </div>
                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!-- 导航 end -->

    <!-- 内容 start -->
    <section id="content">
        <!-- 中间内容 start -->

        <!-- 左侧侧边栏 start -->
        @section('content')
        @show
        <!-- 左侧侧边栏 start -->


        @section('aside')
        @show

    <!-- 中间内容 end -->
    </section>
    <!-- 内容 end -->
    <div class="clearfix"></div>
    <hr>
    <footer>
        <div class="text-center copyright">Copyright © 2017 All Rights Reserved. 京ICP备13041202号 Powered by xiaohigh</div>
    </footer>

    <!-- jquery文件 -->
    <script src="/bower_components/jquery/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <!-- holder.js -->
    <script src="/bower_components/holderjs/holder.min.js"></script>
</div>

</body>
</html>