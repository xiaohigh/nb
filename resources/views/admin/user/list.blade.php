@extends('layouts.admin')

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>邮箱</th>
                        <th>头像</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['users'] as $k=>$v)
                    <tr>
                        <td>{{$v->id}}</td>
                        <td>{{$v->email}}</td>
                        <td><img src="{{env('QINIU_URL')}}{{$v->profile}}" alt="" width="30"></td>
                        <td><a href="{{url('/user/'.$v->id.'/edit')}}" class="btn btn-info btn-sm">修改</a>&nbsp;&nbsp;<a href="{{url('/user/'.$v->id)}}" class="btn btn-danger btn-sm del">删除</a></td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

