<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$data['title'] or '网站后台'}}</title>
    <!-- Bootstrap core CSS-->
    <link href="/admins/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="/admins/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="/admins/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="/admins/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="/admins/css/main.css">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- 左侧导航 start -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">网站后台</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text">用户管理</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseComponents">
                    <li>
                        <a href="/user/create">用户添加</a>
                    </li>
                    <li>
                        <a href="/user">用户列表</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#arccate" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text">分类管理</span>
                </a>
                <ul class="sidenav-second-level collapse" id="arccate">
                    <li>
                        <a href="/arccate/create">分类添加</a>
                    </li>
                    <li>
                        <a href="/arccate">分类列表</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#tag" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text">标签管理</span>
                </a>
                <ul class="sidenav-second-level collapse" id="tag">
                    <li>
                        <a href="/tag/create">标签添加</a>
                    </li>
                    <li>
                        <a href="/tag">标签列表</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#arc" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text">文章管理</span>
                </a>
                <ul class="sidenav-second-level collapse" id="arc">
                    <li>
                        <a href="/article/create">文章添加</a>
                    </li>
                    <li>
                        <a href="/article">文章列表</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="" data-placement="right" title="Components">
                <a class="nav-link" href="/config">
                    <i class="fa fa-fw fa-user"></i>
                    <span class="nav-link-text">网站配置</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">New Messages:</h6>

                    <a class="dropdown-item small" href="#">View all messages</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header">New Alerts:</h6>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item small" href="#">View all alerts</a>
                </div>
            </li>
            <li class="nav-item">
                <form class="form-inline my-2 my-lg-0 mr-lg-2">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
                    </div>
                </form>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fa-sign-out"></i>退出</a>
            </li>
        </ul>
    </div>
</nav>
<!-- 左侧导航 end -->

<div class="content-wrapper">

    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">网站后台</a>
            </li>
            <li class="breadcrumb-item active">{{$data['title'] or ''}}</li>
        </ol>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @section('content')
        @show
    </div>

    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © xiaohigh.com 2017</small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">提示信息</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">确认离开么?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">取消</button>
                    <form action="/logout" method="post">
                        {{csrf_field()}}
                        <button class="btn btn-primary" href="/logout">退出</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="remind" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">提示信息</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="msg"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">文件上传</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"><button  domain="{{env("QINIU_URL")}}" bucket="{{env("QINIU_BUCKET")}}" token="{{$data['qiniu_token'] or ''}}" type="button" class="form-control" id="common-upload">点击上传</button></label>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 pull-left">
                                <input type="text"  class="form-control" id="uploaded-url" aria-describedby="emailHelp" placeholder="">
                            </div>
                            <div class="col-md-4 pull-left">
                                <button id="copy" type="button" class="btn btn-danger">点击复制</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/admins/vendor/jquery/jquery.min.js"></script>
    <script src="/admins/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="/admins/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="/admins/vendor/chart.js/Chart.min.js"></script>
    <script src="/admins/vendor/datatables/jquery.dataTables.js"></script>
    <script src="/admins/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="/admins/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="/admins/js/sb-admin-datatables.min.js"></script>
    <script src="/bower_components/plupload/js/plupload.full.min.js"></script>
    <script src="/bower_components/qiniu/dist/qiniu.min.js"></script>
    <script src="/bower_components/zeroclipboard/dist/ZeroClipboard.min.js"></script>
    <script src="/admins/js/main.js"></script>

    @if(session('msg'))
    <script>
        $(function(){
            remind('{{session('msg')}}')
        })
    </script>
    @endif

    @yield('js')
</div>
</body>

</html>
