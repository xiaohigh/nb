@extends('layouts.admin')

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" data-b-paginate="false" data-b-info="false" data-b-length-change="false" data-i-display-length="100" data-ordering="" id="dataTable" width="100%" cellspacing="0" data-order="[]">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>分类名称</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['cates'] as $k=>$v)
                        <tr>
                            <td>{{$v->id}}</td>
                            <td>{{$v->name}}</td>
                            <td><a href="{{url('/arccate/'.$v->id.'/edit')}}" class="btn btn-info btn-sm">修改</a>&nbsp;&nbsp;<a href="{{url('/arccate/'.$v->id)}}" class="btn btn-danger btn-sm del">删除</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


