<!-- 标签  start -->
<?php $cates = \App\Models\ArcCate::getCates() ?>
<div class="panel panel-default" id="tags">
    <div class="panel-heading author">文章分类</div>
    <div class="panel-body">
        @if($cates->count() > 0)
            @foreach($cates as $k=>$v)
                <a href="{{url('/blog?cate_id='.$v->id)}}" class="block pull-left m-r-10 m-b-10 "><span class="label label-default label-mine @if(request('cate_id') == $v->id) active @endif">{{$v->name}}</span></a>
            @endforeach
        @endif
    </div>
</div>
<!-- 标签  end -->