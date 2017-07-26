@extends('user.layout')
@section('title')
<title>用户资料管理</title>
@endsection
@section('css')
    <link href="{{asset('css/infstyle.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('body')
    <div class="main-wrap">

        <div class="user-info">
            <!--标题 -->
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
            </div>
            <hr/>

            <!--头像 -->
            <div class="user-infoPic">

                <div class="filePic">
                    <input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
                    <img class="am-circle am-img-thumbnail" src="{{asset($user->img)}}" alt="{{$user->name}}" value="{{$user->img}}" name="img"/>
                </div>

                <p class="am-form-help">头像</p>

                <div class="info-m">
                    <div><b>用户名：<i>{{$user->name}}</i></b></div>
                    <div class="vip">
                        <span></span><a href="javascript:;">会员专享</a>
                    </div>
                </div>
            </div>

            <!--个人信息 -->
            <div class="info-main">
                <form class="am-form am-form-horizontal">
                    {!! csrf_field() !!}
                    <div class="am-form-group">
                        <label for="name" class="am-form-label">昵称</label>
                        <div class="am-form-content">
                            <input type="text" id="name" placeholder="昵称" value="{{$user->name}}" readonly>
                            <small>昵称长度不能超过40个汉字</small>
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="nick_name" class="am-form-label">姓名</label>
                        <div class="am-form-content">
                            <input type="text" id="nick_name" placeholder="name" value="{{$user->nick_name}}" name="nick_name">

                        </div>
                    </div>

                    <div class="am-form-group">
                        <label class="am-form-label">性别</label>
                        <div class="am-form-content sex">
                            <label class="am-radio-inline">
                                <input type="radio" name="sex" value="1" {{$user->sex==1?'checked="checked"':''}} data-am-ucheck> 男
                            </label>
                            <label class="am-radio-inline">
                                <input type="radio" name="sex" value="2" {{$user->sex==2?'checked="checked"':''}} data-am-ucheck> 女
                            </label>
                            <label class="am-radio-inline">
                                <input type="radio" name="sex" value="3" {{$user->sex==3?'checked="checked"':''}} data-am-ucheck> 保密
                            </label>
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="birth" class="am-form-label">生日</label>
                        <div class="am-form-content">
                            <input type="text" id="birth" placeholder="请选择你的生日" @if(!empty($user->born_y))value="{{$user->born_y.'-'.$user->born_m.'-'.$user->bron_d}}"@endif  class="am-form-field" data-am-datepicker readonly required data-am-datepicker="{format: 'yyyy-mm-dd', viewMode: 'years'}">
                        </div>

                    </div>
                    <div class="am-form-group">
                        <label for="user-phone" class="am-form-label">电话</label>
                        <div class="am-form-content">
                            <input id="user-phone" placeholder="手机号码" type="tel" value="{{$user->phone}}" name="phone">

                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-email" class="am-form-label">电子邮件</label>
                        <div class="am-form-content">
                            <input id="user-email" placeholder="Email" type="email" readonly value="{{$user->email}}">

                        </div>
                    </div>
                    <div class="info-btn">
                        <div class="am-btn am-btn-danger" onclick="update()">保存修改</div>
                    </div>

                </form>
            </div>

        </div>

    </div>
@endsection

@section('js')
<script>
layui.use('layer',function(){var layer=layui.layer;});
//生日选择
var nowTemp = new Date();
var nowDay = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0).valueOf();
var nowMoth = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), 1, 0, 0, 0, 0).valueOf();
var nowYear = new Date(nowTemp.getFullYear(), 0, 1, 0, 0, 0, 0).valueOf();
var $myStart2 = $('#birth');

var checkin = $myStart2.datepicker({
    onRender: function(date, viewMode) {
        // 默认 days 视图，与当前日期比较
        var viewDate = nowDay;

        switch (viewMode) {
            // moths 视图，与当前月份比较
            case 1:
                viewDate = nowMoth;
                break;
            // years 视图，与当前年份比较
            case 2:
                viewDate = nowYear;
                break;
        }

        return date.valueOf() > viewDate ? 'am-disabled' : '';
    }
}).on('changeDate.datepicker.amui', function(ev) {
    checkin.close();
}).data('amui.datepicker');

function update(){
    var birth=$('#birth').val().split('-');
    var postData={
        '_token':"{{csrf_token()}}",
        'nick_name':$('input[name=nick_name]').val(),
        'sex':$('input[name=sex]:checked').val(),
        'bron_y':birth[0],
        'bron_m':birth[1],
        'bron_d':birth[2],
        'phone':$('input[name=phone]').val(),
        'img':$('img[name=img]').attr('value'),
    }
    $.post("{{url('user/info/update')}}",postData,function(data){
        layer.msg(data.text);
    })
}

</script>
@endsection