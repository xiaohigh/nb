@extends('layouts.admin')

@section('content')
    <h3>{{$course->title}}----课程列表</h3>
    <table class="table table-bordered">
        <tr><td>排序</td><td>ID</td><td>标题</td><td>时长</td><td>操作</td></tr>
        @foreach($course->lesson()->orderBy('pos')->get() as $k=>$v)
        <tr><td><input type="text" style="width:40px;" name="pos" value="{{$v->pos}}"></td><td>{{$v->id}}</td><td>{{$v->title}}</td><td>{{formatSeconds($v->long)}}</td><td>
                <a href="/lesson/{{$v->id}}/edit" class="btn btn-sm btn-info">修改</a>&nbsp;&nbsp;<button href="/lesson/{{$v->id}}" class="btn btn-danger btn-sm " onclick="del(this)">删除</button></td></tr>
        @endforeach
    </table>
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
@endsection


