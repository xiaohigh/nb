function remind(str) {
    $('#msg').html(str);
    $('#remind').modal();
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function(){
    


    //键盘按下事件 用于弹出上传文件组件
    $(window).keydown(function(e){
        //ctrl+u组合键弹出
        if(e.keyCode == 85 && e.ctrlKey== true) {
            $('#upload-modal').modal();
        }
    });

    var qiniu_token = $('#common-upload').attr('token');
    if(qiniu_token) {
        //公共上传组件
        Qiniu.uploader({
            runtimes: 'html5,flash,html4',      // 上传模式，依次退化
            browse_button: 'common-upload',         // 上传选择的点选按钮，必需
            // 在初始化时，uptoken，uptoken_url，uptoken_func三个参数中必须有一个被设置
            // 切如果提供了多个，其优先级为uptoken > uptoken_url > uptoken_func
            // 其中uptoken是直接提供上传凭证，uptoken_url是提供了获取上传凭证的地址，如果需要定制获取uptoken的过程则可以设置uptoken_func
            uptoken : qiniu_token, // uptoken是上传凭证，由其他程序生成
            get_new_uptoken: false,             // 设置上传文件的时候是否每次都重新获取新的uptoken
            unique_names: true,              // 默认false，key为文件名。若开启该选项，JS-SDK会为每个文件自动生成key（文件名）
            domain: $('#common-upload').attr('domain'),     // bucket域名，下载资源时用到，必需
            max_file_size: '100mb',             // 最大文件体积限制
            flash_swf_url: '/bower_components/plupload/js/Moxie.swf',  //引入flash，相对路径
            max_retries: 3,                     // 上传失败最大重试次数
            chunk_size: '4mb',                  // 分块上传时，每块的体积
            auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传

            init: {
                'FilesAdded': function(up, files) {
                    plupload.each(files, function(file) {

                    });
                },
                'BeforeUpload': function(up, file) {
                    // 每个文件上传前，处理相关的事情
                },
                'UploadProgress': function(up, file) {
                    //克隆一个元素
                },
                'FileUploaded': function(up, file, info) {
                    //将key存入到隐藏域中
                    var key = $.parseJSON(info.response).key;
                    // //图片路径
                    var domain = up.getOption('domain');
                    var sourceLink = domain +"/"+ key;
                    // //图片预览
                    $('#uploaded-url').val(sourceLink);
                    alert('上传成功');
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
    }

    //点击复制内容
    var client = new ZeroClipboard( document.getElementById("copy"));

    client.on("copy", function(e){
        e.clipboardData.setData("text/plain", $('#uploaded-url').val())
    });
})