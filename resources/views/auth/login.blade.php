@extends('auth.layout')
@section('title')<title>登录商城</title>@endsection
@section('body')
    <div class="login-box">
        <h3 class="title">登录商城</h3>
        <div class="clear"></div>
        <div class="login-form">
            <form id="form-body">
                <div class="user-name">
                    <label for="user"><i class="am-icon-user"></i></label>
                    <input type="text" name="email" id="user" placeholder="邮箱/手机/用户名">
                </div>
                <div class="user-pass">
                    <label for="password"><i class="am-icon-lock"></i></label>
                    <input type="password" name="password" id="password" placeholder="请输入密码">
                </div>
                {!! Geetest::render() !!}
            </form>
        </div>

        <div class="login-links">
            <label for="remember-me"><input id="remember" type="checkbox">记住密码</label>
            <a href="#" class="am-fr">忘记密码</a>
            <a href="{{url('register')}}" class="zcnext am-fr am-btn-default">注册</a>
            <br />
        </div>
        <div class="am-cf">
            <input type="hidden" name="url" value="{{$url}}">
            <input type="button" name="action" value="登 录" class="am-btn am-btn-primary am-btn-sm" onclick="">
        </div>
        <div class="partner">
            <h3>合作账号</h3>
            <div class="am-btn-group">
                <li><a href="#"><i class="am-icon-qq am-icon-sm"></i><span>QQ登录</span></a></li>
                <li><a href="#"><i class="am-icon-weibo am-icon-sm"></i><span>微博登录</span> </a></li>
                <li><a href="#"><i class="am-icon-weixin am-icon-sm"></i><span>微信登录</span> </a></li>
            </div>
        </div>

    </div>
@endsection

@section('js')
<script>
    layui.use('layer',function(){var layer=layui.layer;
        if('{{Auth::check()}}'){
            window.location.href="{{url('/')}}";
        }
    });
    function check(){
        if($('input[name=geetest_validate]').val()==""){layer.msg('请点击并通过验证!',{icon:2});return false;}
        if($('#user').val()==""){layer.msg('请输入用户名',{icon:2});return false;}
        if($('#password').val()==""){layer.msg('请输入密码',{icon:2});return false;}
        var postData={
            '_token':"{{csrf_token()}}",
            'email':$('#user').val(),
            'password':$('#password').val(),
            'remember':$('#remember').is(':checked'),
            'url':$('input[name=url]').val(),
        }
        $.post("{{url('checkLogin')}}",postData,function(data){
            if(data.s==1){
                window.location.href=data.url;
            }else{
                layer.msg(data.text,{icon:2});
                return false;
            }
        });
    }
</script>
@endsection