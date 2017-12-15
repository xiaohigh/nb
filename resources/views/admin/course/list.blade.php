@extends('layouts.admin')

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered"  data-b-info="false"   data-ordering="true" id="dataTable" width="100%" cellspacing="0" data-order="[]">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>标题</th>
                        <th>图片</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $k=>$v)
                        <tr>
                            <td>{{$v->id}}</td>
                            <td>{{$v->title}}</td>
                            <td><img src="{{$v->pic}}" width="50" alt=""></td>
                            <td><a href="{{url('/course/'.$v->id.'/edit')}}" class="btn btn-info btn-sm">修改</a>&nbsp;&nbsp;<button href="{{url('/course/'.$v->id)}}" class="btn btn-danger btn-sm del" onclick="del(this)">删除</button></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
//点击删除按钮删除元素
function del(obj){
    var obj = $(obj);
    //获取tr元素
    var tr = obj.parents('tr');
    //确认
    var res = confirm('确定要删除么?');
    if(res) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //获取url
        var url = obj.attr('href');
        var data = {'_method':'delete'};
        $.post(url, data, function(data){
            if(data.status == 1) {
                tr.remove();
                remind('删除成功');
            }else{
                remind('删除失败');
            }
        },'json');
    }else{

    }
    return false;
}
</script>

@stop


