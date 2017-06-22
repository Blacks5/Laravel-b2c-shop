@extends('user.layout')
@section('title')
    <title>订单详情</title>
@endsection
@section('css')
    <link href="{{asset('css/orstyle.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('body')
    <div class="main-wrap">

        <div class="user-orderinfo">

            <!--标题 -->
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">订单详情</strong> / <small>Order&nbsp;details</small></div>
            </div>
            <hr/>
            <!--进度条-->
            <div class="m-progress">
                <div class="m-progress-list">
								<span class="step-{{$order->state>0?'1':'3'}} step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                   <p class="stage-name">拍下商品</p>
                                </span>
                    <span class="step-{{$order->state>1?'2':'3'}} step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                   <p class="stage-name">买家付款</p>
                                </span>
                    <span class="step-{{$order->state>2?'2':'3'}} step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">3<em class="bg"></em></i>
                                   <p class="stage-name">卖家发货</p>
                                </span>
                    <span class="step-{{$order->state>3?'2':'3'}} step">
                                   <em class="u-progress-stage-bg"></em>
                                   <i class="u-stage-icon-inner">4<em class="bg"></em></i>
                                   <p class="stage-name">确认收货</p>
                                </span>
                    <span class="u-progress-placeholder"></span>
                </div>
                <div class="u-progress-bar total-steps-2">
                    <div class="u-progress-bar-inner"></div>
                </div>
            </div>
            <div class="order-infoaside">
                <div class="order-logistics">
                    @if($order->state<=2)
                    <div class="latest-logistics">
                        <p>@if($order->state==1)买家还没有付款@elseif($order->state==2)卖家还没有发货@endif</p>
                    </div>
                    @endif
                    @if($order->state>2)
                    <a href="{{url('user/order/express',['oid'=>$order->order_number])}}">
                        <div class="icon-log">
                            <i><img src="{{asset('images/receive.png')}}"></i>
                        </div>
                        <div class="latest-logistics">
                            <p class="text">{{end($order->express->Traces)->AcceptStation}}</p>
                            <div class="time-list">
                                <span class="date">{{end($order->express->Traces)->AcceptTime}}</span>
                            </div>
                            <div class="inquire">
                                <span class="package-detail">物流：{{$order->post_name}}</span>
                                <span class="package-detail">快递单号: </span>
                                <span class="package-number">{{$order->post_no}}</span>
                                <a href="javascript:;">查看</a>
                            </div>
                        </div>
                        <span class="am-icon-angle-right icon"></span>
                    </a>
                    @endif
                    <div class="clear"></div>
                </div>
                <div class="order-addresslist">
                    <div class="order-address">
                        <div class="icon-add">
                        </div>
                        <p class="new-tit new-p-re">
                            <span class="new-txt">{{$order->name}}</span>
                            <span class="new-txt-rd2">{{$order->phone}}</span>
                        </p>
                        <div class="new-mu_l2a new-p-re">
                            <p class="new-mu_l2cw">
                                <span class="title">收货地址：</span>
                                <span class="street">{{$order->address}}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="order-infomain">

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

                    <div class="order-status3">
                        <div class="order-title">
                            <div class="dd-num">订单编号：<a href="javascript:;">{{$order->order_number}}</a></div>
                            <span>成交时间：{{$order->create_at}}</span>
                            <!--    <em>店铺：小桔灯</em>-->
                        </div>
                        <div class="order-content">
                            <div class="order-left">
                                @foreach($order->goods as $g)
                                <ul class="item-list">
                                    <li class="td td-item">
                                        <div class="item-pic">
                                            <a href="#" class="J_MakePoint">
                                                <img src="{{asset($g->img)}}" class="itempic J_ItemImg">
                                            </a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-basic-info">
                                                <a href="#">
                                                    <p>{{$g->name}}</p>
                                                    <p class="info-little">{{$g->info}}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="td td-price">
                                        <div class="item-price">
                                            {{$g->sale}}
                                        </div>
                                    </li>
                                    <li class="td td-number">
                                        <div class="item-number">
                                            <span>×</span>{{$g->number}}
                                        </div>
                                    </li>
                                    <li class="td td-operation">
                                        <div class="item-operation">
                                            {{$order->state>2?'退款':''}}{{$order->state>3?'/退货':''}}
                                        </div>
                                    </li>
                                </ul>
                                @endforeach
                            </div>
                            <div class="order-right">
                                <li class="td td-amount">
                                    <div class="item-amount">
                                        合计：{{$order->total}}
                                        <p>含运费：<span>{{$order->postage}}</span></p>
                                    </div>
                                </li>
                                <div class="move-right">
                                    <li class="td td-status">
                                        <div class="item-status">
                                            @if($order->state==0)<p class="Mystatus">交易关闭</p>@endif
                                            @if($order->state==1)<p class="Mystatus">未付款</p>@endif
                                            @if($order->state==2)<p class="Mystatus">买家已付款</p>@endif
                                            @if($order->state==3)
                                                <p class="Mystatus">卖家已发货</p>
                                                <p class="Mystatus">延长收货</p>
                                            @endif
                                            @if($order->state==4)<p class="Mystatus">交易完成</p>@endif
                                        </div>
                                    </li>
                                    <li class="td td-change">
                                        @if($order->state==1)<div class="am-btn am-btn-danger anniu">去付款</div>@endif
                                        @if($order->state==2)<div class="am-btn am-btn-danger anniu">提醒发货</div>@endif
                                        @if($order->state==3)<div class="am-btn am-btn-danger anniu">确认收货</div>@endif
                                        @if($order->state==4)<div class="am-btn am-btn-danger anniu">评价</div>@endif
                                    </li>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection