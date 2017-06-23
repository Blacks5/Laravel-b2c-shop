@extends('user.layout')
@section('title')
    <title>用户订单管理</title>
@endsection

@section('css')
    <link href="{{asset('css/orstyle.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('body')
<div class="main-wrap">
        <div class="user-order">
            <!--标题 -->
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单管理</strong> / <small>Order</small></div>
            </div>
            <hr/>

            <div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

                <ul class="am-avg-sm-5 am-tabs-nav am-nav am-nav-tabs">
                    <li class="am-active"><a href="#tab1" style="width:100%;">所有订单</a></li>
                    <li><a href="#tab2">待付款</a></li>
                    <li><a href="#tab3">待发货</a></li>
                    <li><a href="#tab4">待收货</a></li>
                    <li><a href="#tab5">待评价</a></li>
                </ul>

                <div class="am-tabs-bd">
                    <div class="am-tab-panel am-fade am-in am-active" id="tab1">
                        <div class="order-top">
                            <div class="th th-item">
                                <td class="td-inner">商品</td>
                            </div>
                            <div class="th th-price">
                                <td class="td-inner">单价</td>
                            </div>
                            <div class="th th-number">
                                <td class="td-inner">数量</td>
                            </div>
                            <div class="th th-operation">
                                <td class="td-inner">商品操作</td>
                            </div>
                            <div class="th th-amount">
                                <td class="td-inner">合计</td>
                            </div>
                            <div class="th th-status">
                                <td class="td-inner">交易状态</td>
                            </div>
                            <div class="th th-change">
                                <td class="td-inner">交易操作</td>
                            </div>
                        </div>

                        <div class="order-main">
                            <div class="order-list">
                                @foreach($order as $o)
                                <div class="order-status2">
                                    <div class="order-title">
                                        <div class="dd-num">订单编号：<a href="javascript:;">{{$o->order_number}}</a></div>
                                        <span>成交时间：{{$o->created_at}}</span>
                                        <!--    <em>店铺：小桔灯</em>-->
                                    </div>
                                    <div class="order-content">
                                        <div class="order-left">
                                            @foreach($o->goods as $goods)
                                            <ul class="item-list">
                                                <li class="td td-item">
                                                    <div class="item-pic">
                                                        <a href="#" class="J_MakePoint">
                                                            <img src="{{asset($goods->img)}}" class="itempic J_ItemImg">
                                                        </a>
                                                    </div>
                                                    <div class="item-info">
                                                        <div class="item-basic-info">
                                                            <a href="#">
                                                                <p>{{$goods->name}}</p>
                                                                <p class="info-little">{{$goods->info}}
                                                                    <br/>包装：裸装 </p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li class="td td-price">
                                                    <div class="item-price">
                                                        {{$goods->sale}}
                                                    </div>
                                                </li>
                                                <li class="td td-number">
                                                    <div class="item-number">
                                                        <span>×</span>{{$goods->number}}
                                                    </div>
                                                </li>
                                                <li class="td td-operation">
                                                    <div class="item-operation">
                                                        @if($o->state>1)<a href="{{url('user/order/refund',['id'=>$goods->id])}}">退款@if($o->state>2)/退货@endif</a>@endif
                                                    </div>
                                                </li>
                                            </ul>
                                            @endforeach
                                        </div>
                                        <div class="order-right">
                                            <li class="td td-amount">
                                                <div class="item-amount">
                                                    合计：{{$o->pay_number}}
                                                    <p>含运费：<span>{{$o->postage}}</span></p>
                                                </div>
                                            </li>
                                            <div class="move-right">
                                                <li class="td td-status">
                                                    <div class="item-status">
                                                        @if($o->state==0)<p class="Mystatus">交易关闭</p>@endif
                                                        @if($o->state==1)<p class="Mystatus">未付款</p>@endif
                                                        @if($o->state==2)<p class="Mystatus">买家已付款</p>@endif
                                                        @if($o->state==3)
                                                                <p class="Mystatus">卖家已发货</p>
                                                                <p class="Mystatus"><a href="{{url('user/order/express',['oid'=>$o->order_number])}}" 查看物流</p>
                                                                <p class="Mystatus">延长收货</p>
                                                        @endif
                                                        @if($o->state==4)<p class="Mystatus">交易完成</p>@endif
                                                        <p class="order-info"><a href="{{url('user/orderinfo',['oid'=>$o->order_number])}}">订单详情</a></p>
                                                    </div>
                                                </li>
                                                <li class="td td-change">
                                                    @if($o->state==1)<a href="{{url('user/order/repay',['oid'=>$o->order_number])}}" class="am-btn am-btn-danger anniu">去付款</a>@endif
                                                    @if($o->state==2)<div class="am-btn am-btn-danger anniu" onclick="remind({{$o->id}})">提醒发货</div>@endif
                                                    @if($o->state==3)<div class="am-btn am-btn-danger anniu">确认收货</div>@endif
                                                    @if($o->state==4)<a href="{{url('user/order/comment',['oid'=>$o->order_number])}}" class="am-btn am-btn-danger anniu">评价</a>@endif
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>

                    </div>
                    <div class="am-tab-panel am-fade" id="tab2">

                        <div class="order-top">
                            <div class="th th-item">
                                <td class="td-inner">商品</td>
                            </div>
                            <div class="th th-price">
                                <td class="td-inner">单价</td>
                            </div>
                            <div class="th th-number">
                                <td class="td-inner">数量</td>
                            </div>
                            <div class="th th-operation">
                                <td class="td-inner">商品操作</td>
                            </div>
                            <div class="th th-amount">
                                <td class="td-inner">合计</td>
                            </div>
                            <div class="th th-status">
                                <td class="td-inner">交易状态</td>
                            </div>
                            <div class="th th-change">
                                <td class="td-inner">交易操作</td>
                            </div>
                        </div>

                        <div class="order-main">
                            <div class="order-list">
                                @foreach($order as $o)
                                    @if($o->state==1)
                                    <div class="order-status2">
                                        <div class="order-title">
                                            <div class="dd-num">订单编号：<a href="javascript:;">{{$o->order_number}}</a></div>
                                            <span>成交时间：{{$o->created_at}}</span>
                                            <!--    <em>店铺：小桔灯</em>-->
                                        </div>
                                        <div class="order-content">
                                            <div class="order-left">
                                                @foreach($o->goods as $goods)
                                                    <ul class="item-list">
                                                        <li class="td td-item">
                                                            <div class="item-pic">
                                                                <a href="#" class="J_MakePoint">
                                                                    <img src="{{asset($goods->img)}}" class="itempic J_ItemImg">
                                                                </a>
                                                            </div>
                                                            <div class="item-info">
                                                                <div class="item-basic-info">
                                                                    <a href="#">
                                                                        <p>{{$goods->name}}</p>
                                                                        <p class="info-little">{{$goods->info}}
                                                                            <br/>包装：裸装 </p>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li class="td td-price">
                                                            <div class="item-price">
                                                                {{$goods->sale}}
                                                            </div>
                                                        </li>
                                                        <li class="td td-number">
                                                            <div class="item-number">
                                                                <span>×</span>{{$goods->number}}
                                                            </div>
                                                        </li>
                                                        <li class="td td-operation">
                                                            <div class="item-operation">
                                                                @if($o->state>1)<a href="{{url('user/order/refund',['id'=>$goods->id])}}">退款@if($o->state>2)/退货@endif</a>@endif
                                                            </div>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            </div>
                                            <div class="order-right">
                                                <li class="td td-amount">
                                                    <div class="item-amount">
                                                        合计：{{$o->pay_number}}
                                                        <p>含运费：<span>{{$o->postage}}</span></p>
                                                    </div>
                                                </li>
                                                <div class="move-right">
                                                    <li class="td td-status">
                                                        <div class="item-status">
                                                            @if($o->state==0)<p class="Mystatus">交易关闭</p>@endif
                                                            @if($o->state==1)<p class="Mystatus">未付款</p>@endif
                                                            @if($o->state==2)<p class="Mystatus">买家已付款</p>@endif
                                                            @if($o->state==3)
                                                                <p class="Mystatus">卖家已发货</p>
                                                                <p class="Mystatus"><a href="{{url('user/order/express',['oid'=>$o->order_number])}}" 查看物流</p>
                                                                <p class="Mystatus">延长收货</p>
                                                            @endif
                                                            @if($o->state==4)<p class="Mystatus">交易完成</p>@endif
                                                            <p class="order-info"><a href="{{url('user/orderinfo',['oid'=>$o->order_number])}}">订单详情</a></p>
                                                        </div>
                                                    </li>
                                                    <li class="td td-change">
                                                        @if($o->state==1)<a href="{{url('user/order/repay',['oid'=>$o->order_number])}}" class="am-btn am-btn-danger anniu">去付款</a>@endif
                                                        @if($o->state==2)<div class="am-btn am-btn-danger anniu" onclick="remind({{$o->id}})">提醒发货</div>@endif
                                                        @if($o->state==3)<div class="am-btn am-btn-danger anniu">确认收货</div>@endif
                                                        @if($o->state==4)<div class="am-btn am-btn-danger anniu">评价</div>@endif
                                                    </li>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="am-tab-panel am-fade" id="tab3">
                        <div class="order-top">
                            <div class="th th-item">
                                <td class="td-inner">商品</td>
                            </div>
                            <div class="th th-price">
                                <td class="td-inner">单价</td>
                            </div>
                            <div class="th th-number">
                                <td class="td-inner">数量</td>
                            </div>
                            <div class="th th-operation">
                                <td class="td-inner">商品操作</td>
                            </div>
                            <div class="th th-amount">
                                <td class="td-inner">合计</td>
                            </div>
                            <div class="th th-status">
                                <td class="td-inner">交易状态</td>
                            </div>
                            <div class="th th-change">
                                <td class="td-inner">交易操作</td>
                            </div>
                        </div>

                        <div class="order-main">
                            <div class="order-list">
                                @foreach($order as $o)
                                    @if($o->state==2)
                                    <div class="order-status2">
                                        <div class="order-title">
                                            <div class="dd-num">订单编号：<a href="javascript:;">{{$o->order_number}}</a></div>
                                            <span>成交时间：{{$o->created_at}}</span>
                                            <!--    <em>店铺：小桔灯</em>-->
                                        </div>
                                        <div class="order-content">
                                            <div class="order-left">
                                                @foreach($o->goods as $goods)
                                                    <ul class="item-list">
                                                        <li class="td td-item">
                                                            <div class="item-pic">
                                                                <a href="#" class="J_MakePoint">
                                                                    <img src="{{asset($goods->img)}}" class="itempic J_ItemImg">
                                                                </a>
                                                            </div>
                                                            <div class="item-info">
                                                                <div class="item-basic-info">
                                                                    <a href="#">
                                                                        <p>{{$goods->name}}</p>
                                                                        <p class="info-little">{{$goods->info}}
                                                                            <br/>包装：裸装 </p>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li class="td td-price">
                                                            <div class="item-price">
                                                                {{$goods->sale}}
                                                            </div>
                                                        </li>
                                                        <li class="td td-number">
                                                            <div class="item-number">
                                                                <span>×</span>{{$goods->number}}
                                                            </div>
                                                        </li>
                                                        <li class="td td-operation">
                                                            <div class="item-operation">
                                                                @if($o->state>1)<a href="{{url('user/order/refund',['id'=>$goods->id])}}">退款@if($o->state>2)/退货@endif</a>@endif
                                                            </div>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                            </div>
                                            <div class="order-right">
                                                <li class="td td-amount">
                                                    <div class="item-amount">
                                                        合计：{{$o->pay_number}}
                                                        <p>含运费：<span>{{$o->postage}}</span></p>
                                                    </div>
                                                </li>
                                                <div class="move-right">
                                                    <li class="td td-status">
                                                        <div class="item-status">
                                                            @if($o->state==0)<p class="Mystatus">交易关闭</p>@endif
                                                            @if($o->state==1)<p class="Mystatus">未付款</p>@endif
                                                            @if($o->state==2)<p class="Mystatus">买家已付款</p>@endif
                                                            @if($o->state==3)
                                                                <p class="Mystatus">卖家已发货</p>
                                                                <p class="Mystatus"><a href="{{url('user/order/express',['oid'=>$o->order_number])}}" 查看物流</p>
                                                                <p class="Mystatus">延长收货</p>
                                                            @endif
                                                            @if($o->state==4)<p class="Mystatus">交易完成</p>@endif
                                                            <p class="order-info"><a href="{{url('user/orderinfo',['oid'=>$o->order_number])}}">订单详情</a></p>
                                                        </div>
                                                    </li>
                                                    <li class="td td-change">
                                                        @if($o->state==1)<a href="{{url('user/order/repay',['oid'=>$o->order_number])}}" class="am-btn am-btn-danger anniu">去付款</a>@endif
                                                        @if($o->state==2)<div class="am-btn am-btn-danger anniu" onclick="remind({{$o->id}})">提醒发货</div>@endif
                                                        @if($o->state==3)<div class="am-btn am-btn-danger anniu">确认收货</div>@endif
                                                        @if($o->state==4)<div class="am-btn am-btn-danger anniu">评价</div>@endif
                                                    </li>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="am-tab-panel am-fade" id="tab4">
                        <div class="order-top">
                            <div class="th th-item">
                                <td class="td-inner">商品</td>
                            </div>
                            <div class="th th-price">
                                <td class="td-inner">单价</td>
                            </div>
                            <div class="th th-number">
                                <td class="td-inner">数量</td>
                            </div>
                            <div class="th th-operation">
                                <td class="td-inner">商品操作</td>
                            </div>
                            <div class="th th-amount">
                                <td class="td-inner">合计</td>
                            </div>
                            <div class="th th-status">
                                <td class="td-inner">交易状态</td>
                            </div>
                            <div class="th th-change">
                                <td class="td-inner">交易操作</td>
                            </div>
                        </div>

                        <div class="order-main">
                            <div class="order-list">
                                @foreach($order as $o)
                                    @if($o->state==3)
                                        <div class="order-status2">
                                            <div class="order-title">
                                                <div class="dd-num">订单编号：<a href="javascript:;">{{$o->order_number}}</a></div>
                                                <span>成交时间：{{$o->created_at}}</span>
                                                <!--    <em>店铺：小桔灯</em>-->
                                            </div>
                                            <div class="order-content">
                                                <div class="order-left">
                                                    @foreach($o->goods as $goods)
                                                        <ul class="item-list">
                                                            <li class="td td-item">
                                                                <div class="item-pic">
                                                                    <a href="#" class="J_MakePoint">
                                                                        <img src="{{asset($goods->img)}}" class="itempic J_ItemImg">
                                                                    </a>
                                                                </div>
                                                                <div class="item-info">
                                                                    <div class="item-basic-info">
                                                                        <a href="#">
                                                                            <p>{{$goods->name}}</p>
                                                                            <p class="info-little">{{$goods->info}}
                                                                                <br/>包装：裸装 </p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li class="td td-price">
                                                                <div class="item-price">
                                                                    {{$goods->sale}}
                                                                </div>
                                                            </li>
                                                            <li class="td td-number">
                                                                <div class="item-number">
                                                                    <span>×</span>{{$goods->number}}
                                                                </div>
                                                            </li>
                                                            <li class="td td-operation">
                                                                <div class="item-operation">
                                                                    @if($o->state>1)<a href="{{url('user/order/refund',['id'=>$goods->id])}}">退款@if($o->state>2)/退货@endif</a>@endif
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                </div>
                                                <div class="order-right">
                                                    <li class="td td-amount">
                                                        <div class="item-amount">
                                                            合计：{{$o->pay_number}}
                                                            <p>含运费：<span>{{$o->postage}}</span></p>
                                                        </div>
                                                    </li>
                                                    <div class="move-right">
                                                        <li class="td td-status">
                                                            <div class="item-status">
                                                                @if($o->state==0)<p class="Mystatus">交易关闭</p>@endif
                                                                @if($o->state==1)<p class="Mystatus">未付款</p>@endif
                                                                @if($o->state==2)<p class="Mystatus">买家已付款</p>@endif
                                                                @if($o->state==3)
                                                                    <p class="Mystatus">卖家已发货</p>
                                                                    <p class="Mystatus"><a href="{{url('user/order/express',['oid'=>$o->order_number])}}" 查看物流</p>
                                                                    <p class="Mystatus">延长收货</p>
                                                                @endif
                                                                @if($o->state==4)<p class="Mystatus">交易完成</p>@endif
                                                                <p class="order-info"><a href="{{url('user/orderinfo',['oid'=>$o->order_number])}}">订单详情</a></p>
                                                            </div>
                                                        </li>
                                                        <li class="td td-change">
                                                            @if($o->state==1)<a href="{{url('user/order/repay',['oid'=>$o->order_number])}}" class="am-btn am-btn-danger anniu">去付款</a>@endif
                                                            @if($o->state==2)<div class="am-btn am-btn-danger anniu" onclick="remind({{$o->id}})">提醒发货</div>@endif
                                                            @if($o->state==3)<div class="am-btn am-btn-danger anniu">确认收货</div>@endif
                                                            @if($o->state==4)<div class="am-btn am-btn-danger anniu">评价</div>@endif
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </div>

                    <div class="am-tab-panel am-fade" id="tab5">
                        <div class="order-top">
                            <div class="th th-item">
                                <td class="td-inner">商品</td>
                            </div>
                            <div class="th th-price">
                                <td class="td-inner">单价</td>
                            </div>
                            <div class="th th-number">
                                <td class="td-inner">数量</td>
                            </div>
                            <div class="th th-operation">
                                <td class="td-inner">商品操作</td>
                            </div>
                            <div class="th th-amount">
                                <td class="td-inner">合计</td>
                            </div>
                            <div class="th th-status">
                                <td class="td-inner">交易状态</td>
                            </div>
                            <div class="th th-change">
                                <td class="td-inner">交易操作</td>
                            </div>
                        </div>

                        <div class="order-main">
                            <div class="order-list">
                                @foreach($order as $o)
                                    @if($o->state==4)
                                        <div class="order-status2">
                                            <div class="order-title">
                                                <div class="dd-num">订单编号：<a href="javascript:;">{{$o->order_number}}</a></div>
                                                <span>成交时间：{{$o->created_at}}</span>
                                                <!--    <em>店铺：小桔灯</em>-->
                                            </div>
                                            <div class="order-content">
                                                <div class="order-left">
                                                    @foreach($o->goods as $goods)
                                                        <ul class="item-list">
                                                            <li class="td td-item">
                                                                <div class="item-pic">
                                                                    <a href="#" class="J_MakePoint">
                                                                        <img src="{{asset($goods->img)}}" class="itempic J_ItemImg">
                                                                    </a>
                                                                </div>
                                                                <div class="item-info">
                                                                    <div class="item-basic-info">
                                                                        <a href="#">
                                                                            <p>{{$goods->name}}</p>
                                                                            <p class="info-little">{{$goods->info}}
                                                                                <br/>包装：裸装 </p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li class="td td-price">
                                                                <div class="item-price">
                                                                    {{$goods->sale}}
                                                                </div>
                                                            </li>
                                                            <li class="td td-number">
                                                                <div class="item-number">
                                                                    <span>×</span>{{$goods->number}}
                                                                </div>
                                                            </li>
                                                            <li class="td td-operation">
                                                                <div class="item-operation">
                                                                    @if($o->state>1)<a href="{{url('user/order/refund',['id'=>$goods->id])}}">退款@if($o->state>2)/退货@endif</a>@endif
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                </div>
                                                <div class="order-right">
                                                    <li class="td td-amount">
                                                        <div class="item-amount">
                                                            合计：{{$o->pay_number}}
                                                            <p>含运费：<span>{{$o->postage}}</span></p>
                                                        </div>
                                                    </li>
                                                    <div class="move-right">
                                                        <li class="td td-status">
                                                            <div class="item-status">
                                                                @if($o->state==0)<p class="Mystatus">交易关闭</p>@endif
                                                                @if($o->state==1)<p class="Mystatus">未付款</p>@endif
                                                                @if($o->state==2)<p class="Mystatus">买家已付款</p>@endif
                                                                @if($o->state==3)
                                                                    <p class="Mystatus">卖家已发货</p>
                                                                    <p class="Mystatus"><a href="{{url('user/order/express',['oid'=>$o->order_number])}}" 查看物流</p>
                                                                    <p class="Mystatus">延长收货</p>
                                                                @endif
                                                                @if($o->state==4)<p class="Mystatus">交易完成</p>@endif
                                                                <p class="order-info"><a href="{{url('user/orderinfo',['oid'=>$o->order_number])}}">订单详情</a></p>
                                                            </div>
                                                        </li>
                                                        <li class="td td-change">
                                                            @if($o->state==1)<a href="{{url('user/order/repay',['oid'=>$o->order_number])}}" class="am-btn am-btn-danger anniu">去付款</a>@endif
                                                            @if($o->state==2)<div class="am-btn am-btn-danger anniu" onclick="remind({{$o->id}})">提醒发货</div>@endif
                                                            @if($o->state==3)<div class="am-btn am-btn-danger anniu">确认收货</div>@endif
                                                            @if($o->state==4)<a href="{{url('user/order/comment',['oid'=>$o->order_number])}}" class="am-btn am-btn-danger anniu">评价</a>@endif
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    layui.use('layer',function(){var layer=layui.layer});
    function remind(id){
        $.post("{{url('user/order/remind')}}",{'_token':"{{csrf_token()}}",'oid':id},function(data){
            layer.msg(data.text);
        })
    }
</script>
@endsection