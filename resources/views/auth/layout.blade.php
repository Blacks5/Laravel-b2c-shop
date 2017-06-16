<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    @yield('title')
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="{{asset('UI/assets/css/amazeui.css')}}" />
    <link href="{{asset('css/dlstyle.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('plugins/layui/layui.js')}}"></script>
    @yield('css')
</head>

<body>

<div class="login-boxtitle">
    <a href="home.html"><img alt="logo" src="{{asset('images/logobig.png')}}" /></a>
</div>

<div class="login-banner">
    <div class="login-main">
        <div class="login-banner-bg"><span></span><img src="{{asset('images/big.jpg')}}" /></div>
        @yield('body')
    </div>
</div>


<div class="footer ">
    <div class="footer-hd ">
        <p>
            <a href="# ">恒望科技</a>
            <b>|</b>
            <a href="# ">商城首页</a>
            <b>|</b>
            <a href="# ">支付宝</a>
            <b>|</b>
            <a href="# ">物流</a>
        </p>
    </div>
    <div class="footer-bd ">
        <p>
            <a href="# ">关于恒望</a>
            <a href="# ">合作伙伴</a>
            <a href="# ">联系我们</a>
            <a href="# ">网站地图</a>
            <em>© 2015-2025 Hengwang.com 版权所有</em>
        </p>
    </div>
</div>
</body>
@yield('js')
</html>