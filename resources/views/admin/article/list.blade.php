@extends('layouts.admin')

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered"  data-b-info="false"   data-ordering="" id="dataTable" width="100%" cellspacing="0" data-order="[]">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>标题</th>
                        <th>头图</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['articles'] as $k=>$v)
                        <tr>
                            <td>{{$v->id}}</td>
                            <td>{{$v->title}}</td>
                            <td><img src="{{$v->pic}}" width="50" alt=""></td>
                            <td><a href="{{url('/article/'.$v->id.'/edit')}}" class="btn btn-info btn-sm">修改</a>&nbsp;&nbsp;<a href="{{url('/article/'.$v->id)}}" class="btn btn-danger btn-sm del">删除</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


