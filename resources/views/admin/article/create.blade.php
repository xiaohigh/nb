@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="/bower_components/editor.md/css/editormd.css">

    <form action="/article" method="post">
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">标题</label>
            <input class="form-control" id="exampleInputEmail1" value="{{old('title')}}" name="title" type="text" aria-describedby="emailHelp" placeholder="">
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">分类</label>
            <select name="cate_id" id="" class="form-control">
                <option value="0">请选择</option>
                @foreach($data['cates'] as $k=>$v)
                <option value="{{$v->id}}">{{$v->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">图片</label>
            <input class="form-control" name="pic" value="{{old('pic')}}" id="exampleInputPassword1" type="text">
            <div style="min-height:50px;border:solid 1px #ddd;padding:20px;">
                <img src="" id="preview" width="200" alt="">
            </div>
            <button id="up" type="button" class="up btn btn-info form-control">点击上传</button>

            <div id="process">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputPassword1">摘要</label>
            <textarea name="intro" class="form-control">{{old('intro')}}</textarea>
        </div>

        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">内容</label>
            <div id="markdown">{{old('markdown')}}</div>
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">快速添加标签</label>
            <input class="form-control" id="addTag" type="text" aria-describedby="emailHelp" placeholder="">
            <input type="hidden" name="tag_id">
        </div>

        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">标签</label>
            <div id="labels">
                @if(count($data['tags']))
                    @foreach($data['tags'] as $k=>$v)
                    <button type="button" class="btn btn-xs btn-info label" tid="{{$v->id}}"><span>{{$v->name}}</span></button>
                    @endforeach
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
                height: 700,
                path : '/bower_components/editor.md/lib/',
                editorTheme : "pastel-on-dark",
                codeFold : true,
                name:'markdown',
                //syncScrolling : false,
                searchReplace : true,
                //watch : false,                // 关闭实时预览
                htmlDecode : "style,script,iframe|on*",            // 开启 HTML 标签解析，为了安全性，默认不开启
                //toolbar  : false,             //关闭工具栏
                //previewCodeHighlight : false, // 关闭预览 HTML 的代码块高亮，默认开启
                emoji : true,
                value:'{{old('markdown')}}',
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

            //七牛上传组件
            var uploader = Qiniu.uploader({
                runtimes: 'html5,flash,html4',      // 上传模式，依次退化
                browse_button: 'up',         // 上传选择的点选按钮，必需
                // 在初始化时，uptoken，uptoken_url，uptoken_func三个参数中必须有一个被设置
                // 切如果提供了多个，其优先级为uptoken > uptoken_url > uptoken_func
                // 其中uptoken是直接提供上传凭证，uptoken_url是提供了获取上传凭证的地址，如果需要定制获取uptoken的过程则可以设置uptoken_func
                 uptoken : '{{$data['qiniu_token']}}', // uptoken是上传凭证，由其他程序生成
                // uptoken_url: '/uptoken',         // Ajax请求uptoken的Url，强烈建议设置（服务端提供）
                // uptoken_func: function(){    // 在需要获取uptoken时，该方法会被调用
                //    // do something
                //    return uptoken;
                // },
                get_new_uptoken: false,             // 设置上传文件的时候是否每次都重新获取新的uptoken
                // downtoken_url: '/downtoken',
                // Ajax请求downToken的Url，私有空间时使用，JS-SDK将向该地址POST文件的key和domain，服务端返回的JSON必须包含url字段，url值为该文件的下载地址
                unique_names: true,              // 默认false，key为文件名。若开启该选项，JS-SDK会为每个文件自动生成key（文件名）
                // save_key: true,                  // 默认false。若在服务端生成uptoken的上传策略中指定了sava_key，则开启，SDK在前端将不对key进行任何处理
                domain: '{{env("QINIU_URL")}}',     // bucket域名，下载资源时用到，必需
                //container: 'container',             // 上传区域DOM ID，默认是browser_button的父元素
                max_file_size: '100mb',             // 最大文件体积限制
                flash_swf_url: '/bower_components/plupload/js/Moxie.swf',  //引入flash，相对路径
                max_retries: 3,                     // 上传失败最大重试次数
                //dragdrop: true,                     // 开启可拖曳上传
                //drop_element: 'container',          // 拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
                chunk_size: '4mb',                  // 分块上传时，每块的体积
                auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
                //x_vars : {
                //    查看自定义变量
                //    'time' : function(up,file) {
                //        var time = (new Date()).getTime();
                // do something with 'time'
                //        return time;
                //    },
                //    'size' : function(up,file) {
                //        var size = file.size;
                // do something with 'size'
                //        return size;
                //    }
                //},
                init: {
                    'FilesAdded': function(up, files) {
                        plupload.each(files, function(file) {
                            // 文件添加进队列后，处理相关的事情
                            var process = $(`<div class="progress" style="margin-bottom:10px;">
                                <div class="progress-bar-animated progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 0px" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>`);
                            process.addClass(file.id);
                            process.appendTo('#process');
                        });
                    },
                    'BeforeUpload': function(up, file) {
                        // 每个文件上传前，处理相关的事情
                    },
                    'UploadProgress': function(up, file) {
                        // 每个文件上传时，处理相关的事情
                        //克隆一个元素
                        $('#process').find('.'+file.id).find('.progress-bar').css('width', file.percent+'%');
                    },
                    'FileUploaded': function(up, file, info) {
                        //隐藏元素 提示用户
                        $('#process').find('.'+file.id).fadeOut('slow',function(){
                            remind('上传成功');
                        });

                        //将key存入到隐藏域中
                        var key = $.parseJSON(info.response).key;

                        //图片路径
                        var domain = up.getOption('domain');
                        var sourceLink = domain + key;

                        $('input[name=pic]').val(sourceLink);

                        //图片预览
                        $('#preview').attr('src', sourceLink);
                    },
                    'Error': function(up, err, errTip) {
                        //上传出错时，处理相关的事情
                    },
                    'UploadComplete': function() {
                        //队列文件处理完毕后，处理相关的事情
                    },
                    'Key': function(up, file) {
                        // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                        // 该配置必须要在unique_names: false，save_key: false时才生效
                        var key = "";
                        // do something with key here
                        return key
                    }
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


