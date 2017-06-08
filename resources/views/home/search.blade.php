<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>首页</title>

    <link href="{{asset('UI/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('UI/assets/css/admin.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('basic/css/demo.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('css/seastyle.css')}}" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="{{asset('basic/js/jquery-1.7.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
</head>

<body>
@include('layouts.header')
        <div class="am-g am-g-fixed">
            <div class="am-u-sm-12 am-u-md-12">
                <div class="theme-popover">
                    <div class="searchAbout">
                        <span class="font-pale">相关搜索：</span>
                        <a title="坚果" href="#">坚果</a>
                        <a title="瓜子" href="#">瓜子</a>
                        <a title="鸡腿" href="#">豆干</a>

                    </div>
                    <ul class="select">
                        <p class="title font-normal">
                            <span class="fl">松子</span>
                            <span class="total fl">搜索到<strong class="num">{{$count}}</strong>件相关商品</span>
                        </p>
                        <div class="clear"></div>


                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="search-content">
                    <div class="sort">
                        <li class="first"><a href="?order=" title="综合">综合排序</a></li>
                        <li><a href="?order=saleNum" title="销量">销量排序</a></li>
                        <li><a href="?order=sale" title="价格">价格优先</a></li>
                        <li class="big"><a title="评价" href="#">评价为主</a></li>
                    </div>
                    <div class="clear"></div>

                    <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 boxes">
                        @foreach($goods as $g)
                            <?php $img=explode(',',$g->imgs);?>
                        <li>
                            <div class="i-pic limit">
                                <a href="{{url('goods',['id'=>$g->id])}}">
                                    <img src="{{asset($img[0])}}" />
                                    <p class="title fl">{{$g->name}}</p>
                                    <p class="price fl">
                                        <b>¥</b>
                                        <strong>{{$g->sale}}.00</strong>
                                    </p>
                                    <p class="number fl">
                                        销量<span>{{$g->saleNum}}</span>
                                    </p>
                                </a>

                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="search-side">

                    <div class="side-title">
                        经典搭配
                    </div>

                    <li>
                        <div class="i-pic check">
                            <img src="../images/cp.jpg" />
                            <p class="check-title">萨拉米 1+1小鸡腿</p>
                            <p class="price fl">
                                <b>¥</b>
                                <strong>29.90</strong>
                            </p>
                            <p class="number fl">
                                销量<span>1110</span>
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="i-pic check">
                            <img src="../images/cp2.jpg" />
                            <p class="check-title">ZEK 原味海苔</p>
                            <p class="price fl">
                                <b>¥</b>
                                <strong>8.90</strong>
                            </p>
                            <p class="number fl">
                                销量<span>1110</span>
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="i-pic check">
                            <img src="../images/cp.jpg" />
                            <p class="check-title">萨拉米 1+1小鸡腿</p>
                            <p class="price fl">
                                <b>¥</b>
                                <strong>29.90</strong>
                            </p>
                            <p class="number fl">
                                销量<span>1110</span>
                            </p>
                        </div>
                    </li>

                </div>
                <div class="clear"></div>
                <!--分页 -->
                {!! $goods->render() !!}

            </div>
        </div>
@include('layouts.footer')