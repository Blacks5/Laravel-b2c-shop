<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
    @yield('title')
    <link href="{{asset('UI/assets/css/admin.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('UI/assets/css/amazeui.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/personal.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('UI/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('UI/assets/js/amazeui.js')}}"></script>
    @yield('css')
</head>

<body>
<!--头 -->
<header>
    <article>
        <div class="mt-logo">
            <!--顶部导航条 -->
            <div class="am-container header">
                <ul class="message-l">
                    <div class="topMessage">
                        <div class="menu-hd">
                            @if(!Auth::check())
                            <a href="{{url('login')}}" target="_top" class="h">亲，请登录</a>
                            <a href="{{url('register')}}" target="_top">免费注册</a>
                            @else
                            <a href="{{url('user')}}" class="h">欢迎您,{{Auth::user()->name}}</a>
                            <a href="{{url('loginout')}}">退出</a>
                            @endif
                        </div>
                    </div>
                </ul>
                <ul class="message-r">
                    <div class="topMessage home">
                        <div class="menu-hd"><a href="{{url('/')}}" target="_top" class="h">商城首页</a></div>
                    </div>
                    <div class="topMessage my-shangcheng">
                        <div class="menu-hd MyShangcheng"><a href="{{url('user')}}" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
                    </div>
                    <div class="topMessage mini-cart">
                        <div class="menu-hd"><a id="mc-menu-hd" href="{{url('cart')}}" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
                    </div>
                    <div class="topMessage favorite">
                        <div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
                </ul>
            </div>

            <!--悬浮搜索框-->

            <div class="nav white">
                <div class="logoBig">
                    <li><img src="{{asset('images/logobig.png')}}" /></li>
                </div>

                <div class="search-bar pr">
                    <a name="index_none_header_sysc" href="#"></a>
                    <form>
                        <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
                        <input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
                    </form>
                </div>
            </div>

            <div class="clear"></div>
        </div>
        </div>
    </article>
</header>
<div class="nav-table">
    <div class="long-title"><span class="all-goods">全部分类</span></div>
    <div class="nav-cont">
        <ul>
            <li class="index"><a href="{{url('/')}}">首页</a></li>
            <li class="qc"><a href="#">闪购</a></li>
            <li class="qc"><a href="#">限时抢</a></li>
            <li class="qc"><a href="#">团购</a></li>
            <li class="qc last"><a href="#">大包装</a></li>
        </ul>
        <div class="nav-extra">
            <i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
            <i class="am-icon-angle-right" style="padding-left: 10px;"></i>
        </div>
    </div>
</div>
<b class="line"></b>
<div class="center">
    <div class="col-main">
        @yield('body')
        <!--底部-->
        <div class="footer">
            <div class="footer-hd">
                <p>
                    <a href="#">恒望科技</a>
                    <b>|</b>
                    <a href="#">商城首页</a>
                    <b>|</b>
                    <a href="#">支付宝</a>
                    <b>|</b>
                    <a href="#">物流</a>
                </p>
            </div>
            <div class="footer-bd">
                <p>
                    <a href="#">关于恒望</a>
                    <a href="#">合作伙伴</a>
                    <a href="#">联系我们</a>
                    <a href="#">网站地图</a>
                    <em>© 2015-2025 Hengwang.com 版权所有</em>
                </p>
            </div>
        </div>

    </div>

    <aside class="menu">
        <ul>
            <li class="person active">
                <a href="{{url('/user')}}"><i class="am-icon-user"></i>个人中心</a>
            </li>
            <li class="person">
                <p><i class="am-icon-newspaper-o"></i>个人资料</p>
                <ul>
                    <li> <a href="{{url('user/info')}}">个人信息</a></li>
                    <li> <a href="{{url('user/safety')}}">安全设置</a></li>
                    <li> <a href="{{url('user/address')}}">地址管理</a></li>
                    <li> <a href="cardlist.html">快捷支付</a></li>
                </ul>
            </li>
            <li class="person">
                <p><i class="am-icon-balance-scale"></i>我的交易</p>
                <ul>
                    <li><a href="{{url('user/order')}}">订单管理</a></li>
                    <li> <a href="{{url('user/order/change')}}">退款售后</a></li>
                    <li> <a href="{{url('user/order/comment')}}">评价商品</a></li>
                </ul>
            </li>
            <li class="person">
                <p><i class="am-icon-dollar"></i>我的资产</p>
                <ul>
                    <li> <a href="points.html">我的积分</a></li>
                    <li> <a href="coupon.html">优惠券 </a></li>
                    <li> <a href="bonus.html">红包</a></li>
                    <li> <a href="walletlist.html">账户余额</a></li>
                    <li> <a href="bill.html">账单明细</a></li>
                </ul>
            </li>

            <li class="person">
                <p><i class="am-icon-tags"></i>我的收藏</p>
                <ul>
                    <li> <a href="collection.html">收藏</a></li>
                    <li> <a href="foot.html">足迹</a></li>
                </ul>
            </li>

            <li class="person">
                <p><i class="am-icon-qq"></i>在线客服</p>
                <ul>
                    <li> <a href="consultation.html">商品咨询</a></li>
                    <li> <a href="suggest.html">意见反馈</a></li>

                    <li> <a href="news.html">我的消息</a></li>
                </ul>
            </li>
        </ul>

    </aside>
</div>
<!--引导 -->
<div class="navCir">
    <li><a href="{{url('/')}}"><i class="am-icon-home "></i>首页</a></li>
    <li><a href="../home/sort.html"><i class="am-icon-list"></i>分类</a></li>
    <li><a href="{{url('/cart')}}"><i class="am-icon-shopping-basket"></i>购物车</a></li>
    <li class="active"><a href="{{url('/user')}}"><i class="am-icon-user"></i>我的</a></li>
</div>
</body>
<script type="text/javascript" src="{{asset('plugins/layui/layui.js')}}"></script>
@yield('js')
</html>