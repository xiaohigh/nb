<!--

   _  __   ____  ___     ____       __  __  ____  ______  __  __
  | |/ /  /  _/ /   |   / __ \     / / / / /  _/ / ____/ / / / /
  |   /   / /  / /| |  / / / /    / /_/ /  / /  / / __  / /_/ /
 /   |  _/ /  / ___ | / /_/ /    / __  / _/ /  / /_/ / / __  /
/_/|_| /___/ /_/  |_| \____/    /_/ /_/ /___/  \____/ /_/ /_/

-->
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')-{{C('title')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="{{C('author_name')}}">
    <meta name="description" content="{{C('description')}}">
    <meta name="keywords" content="{{C('keywords')}}">
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="/bower_components/github-markdown-css/github-markdown.css">
    <link rel="stylesheet" type="text/css" href="/css/common.css">
    <script src="/bower_components/jquery/jquery.min.js"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="/bower_components/holderjs/holder.min.js"></script>

    @yield('css')
</head>
<body>
@section('top-bar')
<div id="topbar"></div>
@show
<!-- 导航 start -->
<nav class="navbar navbar-default">
    <div class="container">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                @include('home.share.nav')

                @section('search')
                <form class="navbar-form navbar-left" action="/blog">
                    <div class="form-group">
                        <input type="text" class="form-control"  value="{{$request->keywords or ''}}" name="keywords" placeholder="搜索">
                    </div>
                </form>
                @show

                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())<li class="dropdown">
                        <a href="#" class="dropdown-toggle block" data-toggle="dropdown" role="button"><img data-src="holder.js/30x30?text=TT" src="{{Auth::user()->profile}}" width="30" class="img-circle profile" alt="">&nbsp;&nbsp;&nbsp;{{Auth::user()->name}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('user-setting')}}">基本信息</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('set-password')}}">修改密码</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route('exit')}}">退出</a></li>
                        </ul>
                    </li>
                    @else
                    <li><a href="{{route('login')}}">登录</a></li>
                    <li><a href="{{route('register')}}">注册</a></li>
                    @endif
                </ul>
            </div>

        </div><!-- /.container-fluid -->
    </div>
</nav>
<!-- 导航 end -->



@section('container')
<div class="container">
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
</div>
@show

@include('home.share.notifacation')

<footer>
    <div class="text-center copyright">Copyright © 2017 All Rights Reserved. 京ICP备13041202号 Powered by xiaohigh</div>
</footer>

@yield('js')
</body>
</html>