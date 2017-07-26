@extends('user.layout')
@section('title')
    <title>修改密码</title>
@endsection
@section('css')
    <link href="{{asset('css/stepstyle.css')}}" rel="stylesheet" type="text/css">
    @endsection

@section('body')
    <div class="main-wrap">

        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改密码</strong> / <small>Password</small></div>
        </div>
        <hr/>
        <!--进度条-->
        <div class="m-progress">
            <div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">重置密码</p>
                            </span>
                <span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">完成</p>
                            </span>
                <span class="u-progress-placeholder"></span>
            </div>
            <div class="u-progress-bar total-steps-2">
                <div class="u-progress-bar-inner"></div>
            </div>
        </div>
        @if(session('success'))
        <div class="am-alert am-alert-success" data-am-alert>
            <button type="button" class="am-close">&times;</button>
            <p>{{session('success')}}</p>
        </div>
        @endif
        <form class="am-form am-form-horizontal" action="{{url('user/password')}}" method="post" onsubmit="return checked()">
            {!! csrf_field() !!}
            <div class="am-form-group {{$errors->has('password')?'am-form-error':''}}">
                <label for="user-old-password" class="am-form-label">原密码</label>
                <div class="am-form-content">
                    <input type="password" id="user-old-password" placeholder="请输入原登录密码" name="password" required>
                    @if($errors->has('password'))<small>{{$errors->first('password')}}</small>@endif
                </div>
            </div>
            <div class="am-form-group {{$errors->has('new_password')?'am-form-error':''}}">
                <label for="user-new-password" class="am-form-label">新密码</label>
                <div class="am-form-content">
                    <input type="password" id="user-new-password" placeholder="由数字、字母组合" name="new_password" required minlength="6">
                    @if($errors->has('new_password'))<small>{{$errors->first('new_password')}}</small>@endif
                </div>
            </div>
            <div class="am-form-group">
                <label for="user-confirm-password" class="am-form-label">确认密码</label>
                <div class="am-form-content">
                    <input type="password" id="user-confirm-password" placeholder="请再次输入上面的密码" name="new_password_confirmation" required>
                </div>
            </div>
            <div class="info-btn">
                <button type="submit" class="am-btn am-btn-danger">保存修改</button>
            </div>

        </form>

    </div>
@endsection

@section('js')
<script>
    layui.use('layer',function(){var layer=layui.layer;});
    function checked(){
        if($('#user-old-password').val()==""){layer.msg('请输入原密码',{icon:2});return false;}
        if($('#user-new-password').val()==""){layer.msg('请输入密码',{icon:2});return false;}
        if($('#user-confirm-password').val()==""){layer.msg('请输入重复密码',{icon:2});return false;}
        if($('#user-confirm-password').val()!=$('#user-new-password').val()){layer.msg('2次密码输入不正确',{icon:2});return false;}
        return true;
    }
</script>
@endsection