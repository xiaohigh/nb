@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="/bower_components/editor.md/css/editormd.css">

    <form action="/course" method="post">
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">课程标题</label>
            <input class="form-control" id="exampleInputEmail1" value="{{old('title')}}" name="title" type="text" aria-describedby="emailHelp" placeholder="">
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">价格</label>
            <input class="form-control" id="exampleInputEmail1" value="{{old('price')}}" name="price" type="text" aria-describedby="emailHelp" placeholder="">
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">图片</label>
            <input class="form-control" name="pic" value="{{old('pic')}}" id="exampleInputPassword1" type="text">
        </div>
        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">内容</label>
            <div id="markdown">{{old('content_m')}}</div>
        </div>


        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">快速添加标签</label>
            <input class="form-control" id="addTag" type="text" aria-describedby="emailHelp" placeholder="">
            <input type="hidden" name="tag_id">
        </div>

        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">标签</label>
            <div id="labels">
                @if(count($tags))
                    @foreach($tags as $k=>$v)
                        <button type="button" class="btn btn-xs btn-info label" tid="{{$v->id}}"><span>{{$v->name}}</span></button>
                    @endforeach
                @else
                    <button type="button" class="btn btn-xs btn-info label" tid="0"><span>test</span></button>
                @endif
            </div>
            <hr>
        </div>
        {{csrf_field()}}
        <div class="col-md-12">
            <button class="btn btn-primary">添加</button>
        </div>
    </form>

    <div id="bak">

    </div>
@endsection

@section('js')
    <script src="/bower_components/editor.md/editormd.min.js"></script>
    <script>
        $(function(){
            //编辑器实例化
            var testEditor = editormd("markdown", {
                width: "100%",
                height: 500,
                path : '/bower_components/editor.md/lib/',
                editorTheme : "pastel-on-dark",
                codeFold : true,
                name:'content_m',
                //syncScrolling : false,
                searchReplace : true,
                //watch : false,                // 关闭实时预览
                htmlDecode : "style,script,iframe|on*",            // 开启 HTML 标签解析，为了安全性，默认不开启
                //toolbar  : false,             //关闭工具栏
                //previewCodeHighlight : false, // 关闭预览 HTML 的代码块高亮，默认开启
                emoji : true,
                value:'{{old('content_m')}}',
                taskList : true,
                tocm            : true,         // Using [TOCM]
                tex : true,                   // 开启科学公式TeX语言支持，默认关闭
                flowChart : true,             // 开启流程图支持，默认关闭
                sequenceDiagram : true,       // 开启时序/序列图支持，默认关闭,
                //dialogLockScreen : false,   // 设置弹出层对话框不锁屏，全局通用，默认为true
                //dialogShowMask : false,     // 设置弹出层对话框显示透明遮罩层，全局通用，默认为true
                //dialogDraggable : false,    // 设置弹出层对话框不可拖动，全局通用，默认为true
                //dialogMaskOpacity : 0.4,    // 设置透明遮罩层的透明度，全局通用，默认值为0.1
                //dialogMaskBgColor : "#000", // 设置透明遮罩层的背景颜色，全局通用，默认为#fff
                imageUpload : true,
                imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                imageUploadURL : "{{url('common/admin/mkupload')}}",
                onload : function() {
                    console.log('onload', this);
                    //this.fullscreen();
                    //this.unwatch();
                    //this.watch().fullscreen();

                    //this.setMarkdown("#PHP");
                    //this.width("100%");
                    //this.height(480);
                    //this.resize("100%", 640);
                }
            });

            //添加标签
            $('#addTag').blur(function(){
                //获取当前的值
                var v = $(this).val();
                //值如果为空则不发送ajax请求
                if(v == '') return;
                //发送ajax给服务器进行添加
                $.post('/tag/ajaxadd', {name: v}, function(data) {
                    if(data.status == 1) {
                        addTag(data.data);
                    }else{
                        alert(data.msg);
                        $('#addTag').val('');
                    }
                },'json');
            });

            /* 添加标签的函数封装
             *
             * @data  {id:10,name:'abc'}
             */
            function addTag(data) {
                //克隆第一个标签
                var label = $('.label:first').clone(true);
                //修改标签名称
                label.find('span').html(data.name);
                label.attr('tid',data.id);
                //将label插入到
                label.appendTo('#labels');
                $('#addTag').val('');
            }

            //给标签绑定事件
            $('.label').click(function(){
                $(this).toggleClass('actived');
            });

            //表单提交事件
            $('form').submit(function(){
                //获取选中的标签
                var tags = $('#labels').find('.actived');
                //获取id
                var ids = '';
                tags.each(function(){
                    ids += $(this).attr('tid')+'_';
                });
                $('input[name=tag_id]').val(ids);
            });


        })
    </script>
@endsection


