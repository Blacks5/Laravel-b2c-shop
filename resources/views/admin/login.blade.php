<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>无标题文档</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">

    <link rel="stylesheet" href="{{asset('plugins/layui/css/layui.css')}}" media="all" />
    <link rel="stylesheet" href="{{asset('css/global.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body>
<div class="container">
    <div class="row" style="height:200px;"></div>
    <div class="row">
        <div class="col-sm-4 col-xs-12 col-sm-offset-4">
            <section class="panel panel-default">
                <header class="panel-heading">管理员登录</header>
                <form method="post" class="panel-body" onsubmit="return goLogin()" action="{{url('admin/checkLogin')}}">
                    {!! csrf_field() !!}
                    <div class="form-group {{$errors->has('email')?' has-error':' '}}">
                        <label class="control-label">邮箱:</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{$errors->has('password')?' has-error':' '}}">
                        <label class="control-label">密码:</label>
                        <input type="password" class="form-control" name="password" value="{{old('password')}}">
                        @if ($errors->has('password'))
                            <span class="help-block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="form-control btn-info">登录</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="{{asset('plugins/layui/layui.js')}}"></script>
<script src="//cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script>
layui.use(['layer'],function(){
    var layer=layui.layer;

});
function goLogin(){
    var email=$('input[name=Email]').val(),password=$('input[name=password]').val();
    var reg=/\w+[@]{1}\w+[.]\w+/;
    //if(email==""){layer.msg('请填写邮箱地址!',{icon:2});return false;}
    //if(password==""){layer.msg('清填写密码!',{icon:2});return false;}
    //if(!reg.test(email)){layer.msg('请填写正确的邮箱地址!');return false;}
return true;
}
</script>
</html>