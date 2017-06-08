<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">

    <link rel="stylesheet" href="{{asset('css/materialize.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/layui/css/layui.css')}}" media="all" />
    <link rel="stylesheet" href="{{asset('css/global.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('css/table.css')}}" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @yield('css')
</head>

<body>
@yield('body')
</body>
<script src="{{asset('plugins/layui/layui.js')}}"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>
@yield('js')
</html>