@extends('auth.layout')
@section('title')<title>注册用户</title>@endsection

@section('body')
<div class="login-box">

        <div class="am-tabs" id="doc-my-tabs">
            <ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
                <li class="am-active"><a href="">邮箱注册</a></li>
                <li><a href="">手机号注册</a></li>
            </ul>

            <div class="am-tabs-bd">
                <div class="am-tab-panel am-active">
                    <form method="post" action="{{url('register')}}" id="register">
                        {!! csrf_field() !!}
                        <div class="user-name am-form-group {{$errors->has('name')?'':'am-form-error'}}">
                            <label for="email"><i class="am-icon-envelope-o"></i></label>
                            <input type="text" name="name" id="email" placeholder="请输入用户名" value="{{old('name')}}" required>
                        </div>
                        <div class="user-email {{$errors->has('email')?'am-form-error':''}}">
                            <label for="email"><i class="am-icon-envelope-o"></i></label>
                            <input type="email" name="email" id="email" placeholder="请输入邮箱账号" value="{{old('email')}}" required>
                        </div>
                        <div class="user-pass am-form-group am-form-error">
                            <label for="password"><i class="am-icon-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="设置密码" required>
                        </div>
                        <div class="user-pass">
                            <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                            <input type="password" name="passwordAg" id="passwordRepeat" placeholder="确认密码" required>
                        </div>
                        {!! Geetest::render() !!}
                    </form>

                    <div class="am-checkbox">
                        <label>
                            <input type="checkbox" name="agr"> 点击表示您同意商城<a href="javascript:;" id="protocol">《服务协议》</a>
                        </label>
                    </div>
                    <div class="am-cf">
                        <input type="submit" name="action"  class="am-btn am-btn-primary am-btn-sm am-fl" value="注册">
                    </div>

                </div>

                <!--<div class="am-tab-panel">
                    <form method="post">
                        <div class="user-phone">
                            <label for="phone"><i class="am-icon-mobile-phone am-icon-md"></i></label>
                            <input type="tel" name="" id="phone" placeholder="请输入手机号">
                        </div>
                        <div class="verification">
                            <label for="code"><i class="am-icon-code-fork"></i></label>
                            <input type="tel" name="" id="code" placeholder="请输入验证码">
                            <a class="btn" href="javascript:void(0);" onclick="sendMobileCode();" id="sendMobileCode">
                                <span id="dyMobileButton">获取</span></a>
                        </div>
                        <div class="user-pass">
                            <label for="password"><i class="am-icon-lock"></i></label>
                            <input type="password" name="" id="password" placeholder="设置密码">
                        </div>
                        <div class="user-pass">
                            <label for="passwordRepeat"><i class="am-icon-lock"></i></label>
                            <input type="password" name="" id="passwordRepeat" placeholder="确认密码">
                        </div>
                    </form>
                    <div class="login-links">
                        <label for="reader-me">
                            <input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
                        </label>
                    </div>
                    <div class="am-cf">
                        <input type="submit" name="" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
                    </div>

                    <hr>
                </div> -->

                <script>
                    $(function() {
                        $('#doc-my-tabs').tabs();
                    })
                </script>

            </div>
        </div>

@endsection

@section('js')
<script>
layui.use('layer',function(){var layer=layui.layer;});
$('#protocol').click(function(){
    layer.open({
        type: 1,
        title:'商城协议',
        skin: 'layui-layer-rim', //加上边框
        area: ['420px', '240px'], //宽高
        content: '<p>1231231231231233333333333333333333333333333</p>'
    })
})

function check(){
    var name=$('input[name=name]').val(),email=$('input[name=email]').val(),password=$('input[name=password]').val(),passwordAg=$('input[name=passwordAg]').val(),greetest=$('input[name=geetest_validate]').val(),agr=$('input[name=agr]').is(':checked');
    if(name==""){layer.msg('请输入用户名!',{icon:2});return false;}
    if(email==""){layer.msg('请输入邮箱地址!',{icon:2});return false;}
    if(password==""){layer.msg('请输入密码!',{icon:2});return false;}
    if(passwordAg==""){layer.msg('请输入重复密码!',{icon:2});return false;}
    if(agr==""){layer.msg('请同意商城协议!',{icon:2});return false;}
    if(greetest==""){layer.msg('请同点击并按钮并进行验证!',{icon:2});return false;}
    if(passwordAg!=password){layer.msg('两次密码输入不正确!',{icon:2});return false;}
    //$('#register').submit();
    var postData={
        '_token':"{{csrf_token()}}",
        'name':name,
        'email':email,
        'password':password,
        'password_confirmation':passwordAg,
        'greetest':geetest(),
        'agr':agr
    }
    $.ajax({
        url:"{{url('register')}}",
        type:"POST",
        dataType:'json',
        data:postData,
        success:function(data){
            if(data.s==1){
                window.location.href="{{url('/user/activated')}}";
            }
        },error:function(data){
            var msg=JSON.parse(data.responseText);
            var text='';
            if(msg.name){text+=msg.name+';<br/>';}
            if(msg.email){text+=msg.email+';<br/>';}
            if(msg.password){text+=msg.password;}
            layer.msg(text);
        }
    })
}
</script>
@endsection