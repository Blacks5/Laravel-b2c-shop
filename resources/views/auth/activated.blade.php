@extends('auth.layout')
@section('title')<title>请激活您的邮箱</title>@endsection

@section('body')
<div class="login-box">
    <div class="am-tabs">
        <div class="am-tabs-nav">
            请登录邮箱激活账号
        </div>
        <div class="am-table-bd am-vertical-align" style="height:150px;">
            <p class="am-kai">
                已发送邮件到:{{$user->email}}</br>
                <br/>
            </p>
            <p class="am-kai">没有收到激活邮件? <a href="javascript:;" id="reSend">重新发送</a> </p>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
layui.use('layer',function(){var layer=layui.layer;});
$('#reSend').click(function(){
    $.post("{{url('user/resend')}}",{'_token':"{{csrf_token()}}"},function(data){
        layer.msg(data.text);
    })
})
</script>
@endsection