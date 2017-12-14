<!-- 标签  start -->
<div class="panel panel-default" id="tags">
    <div class="panel-heading author">标签</div>
    <div class="panel-body">
        @if($tags->count() > 0)
        @foreach($tags as $k=>$v)
            <a href="{{url('/blog?tag='.$v->name)}}" class="block pull-left m-r-10 m-b-10 "><span class="label label-default label-mine @if(request('tag') == $v->name) active @endif">{{$v->name}}</span></a>
        @endforeach
        @endif
    </div>
</div>
<!-- 标签  end -->