<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户激活邮件</title>
</head>
<body>
    恭喜您 {{$user->email}}  注册成功, 请点击以下链接完成激活。 <br>
    <a href="{{route('confirm_email',['token'=>$user->activation_token])}}">激活</a>
</body>
</html>