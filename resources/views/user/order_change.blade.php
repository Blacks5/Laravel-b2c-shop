@extends('user.layout')

@section('title')
    <title>退款管理</title>
@endsection

@section('css')
    <link href="{{asset('css/orstyle.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('body')
<div class="main-wrap">
        <div class="user-order">
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">退换货管理</strong> / <small>Change</small></div>
            </div>
            <hr/>

            <div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

                <ul class="am-avg-sm-2 am-tabs-nav am-nav am-nav-tabs">
                    <li class="am-active"><a href="#tab1">退款管理</a></li>
                    <li><a href="#tab2">售后管理</a></li>
                </ul>

                <div class="am-tabs-bd">
                    <div class="am-tab-panel am-fade am-in am-active" id="tab1">
                        <div class="order-top">
                            <div class="th th-item">
                                <td class="td-inner">商品</td>
                            </div>
                            <div class="th th-orderprice th-price">
                                <td class="td-inner">交易金额</td>
                            </div>
                            <div class="th th-changeprice th-price">
                                <td class="td-inner">退款金额</td>
                            </div>
                            <div class="th th-status th-moneystatus">
                                <td class="td-inner">交易状态</td>
                            </div>
                            <div class="th th-change th-changebuttom">
                                <td class="td-inner">交易操作</td>
                            </div>
                        </div>
                        @foreach($goods as $key =>$g)
                            @if($g->refund_type=='退款')
                        <div class="order-main">
                            <div class="order-list">
                                <div class="order-title">
                                    <div class="dd-num">退款编号：<a href="javascript:;">{{$g->refund_no}}</a></div>
                                    <span>申请时间：{{$g->refund_time}}</span>
                                    <!--    <em>店铺：小桔灯</em>-->
                                </div>
                                <div class="order-content">
                                    <div class="order-left">
                                        <ul class="item-list">
                                            <li class="td td-item">
                                                <div class="item-pic">
                                                    <a href="#" class="J_MakePoint">
                                                        <img src="{{asset($g->img)}}" class="itempic J_ItemImg">
                                                    </a>
                                                </div>
                                                <div class="item-info">
                                                    <div class="item-basic-info">
                                                        <a href="{{url('goods',['id'=>$g->gid])}}">
                                                            <p>{{$g->name}}</p>
                                                            <p class="info-little">{{$g->info}}</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>

                                            <ul class="td-changeorder">
                                                <li class="td td-orderprice">
                                                    <div class="item-orderprice">
                                                        <span>交易金额：</span>{{$g->total}}
                                                    </div>
                                                </li>
                                                <li class="td td-changeprice">
                                                    <div class="item-changeprice">
                                                        <span>退款金额：</span>{{$g->pay_number}}
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="clear"></div>
                                        </ul>

                                        <div class="change move-right">
                                            <li class="td td-moneystatus td-status">
                                                <div class="item-status">
                                                    @if($g->state==1)<p class="Mystatus">您已经申请退款,等待卖家确定</p>@endif
                                                    @if($g->state==2)<p class="Mystatus">卖家已同意退款,等待退款到账</p>@endif
                                                    @if($g->state==3)<p class="Mystatus">退款成功</p>@endif
                                                </div>
                                            </li>
                                        </div>
                                        <li class="td td-change td-changebutton">
                                            <a href="{{url('user/order/change/record',['id'=>$g->id])}}">
                                                <div class="am-btn am-btn-danger anniu">
                                                    查看详情</div>
                                            </a>
                                        </li>

                                    </div>
                                </div>
                            </div>

                        </div>
                            @endif
                        @endforeach

                    </div>
                    <div class="am-tab-panel am-fade" id="tab2">
                        <div class="order-top">
                            <div class="th th-item">
                                <td class="td-inner">商品</td>
                            </div>
                            <div class="th th-orderprice th-price">
                                <td class="td-inner">交易金额</td>
                            </div>
                            <div class="th th-changeprice th-price">
                                <td class="td-inner">退款金额</td>
                            </div>
                            <div class="th th-status th-moneystatus">
                                <td class="td-inner">交易状态</td>
                            </div>
                            <div class="th th-change th-changebuttom">
                                <td class="td-inner">交易操作</td>
                            </div>
                        </div>

                        @foreach($goods as $key =>$g)
                            @if($g->refund_type=='退款\退货')
                                <div class="order-main">
                                    <div class="order-list">
                                        <div class="order-title">
                                            <div class="dd-num">退款编号：<a href="javascript:;">{{$g->refund_no}}</a></div>
                                            <span>申请时间：{{$g->refund_time}}</span>
                                            <!--    <em>店铺：小桔灯</em>-->
                                        </div>
                                        <div class="order-content">
                                            <div class="order-left">
                                                <ul class="item-list">
                                                    <li class="td td-item">
                                                        <div class="item-pic">
                                                            <a href="#" class="J_MakePoint">
                                                                <img src="{{asset($g->img)}}" class="itempic J_ItemImg">
                                                            </a>
                                                        </div>
                                                        <div class="item-info">
                                                            <div class="item-basic-info">
                                                                <a href="{{url('goods',['id'=>$g->gid])}}">
                                                                    <p>{{$g->name}}</p>
                                                                    <p class="info-little">{{$g->info}}</p>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <ul class="td-changeorder">
                                                        <li class="td td-orderprice">
                                                            <div class="item-orderprice">
                                                                <span>交易金额：</span>{{$g->total}}
                                                            </div>
                                                        </li>
                                                        <li class="td td-changeprice">
                                                            <div class="item-changeprice">
                                                                <span>退款金额：</span>{{$g->pay_number}}
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="clear"></div>
                                                </ul>

                                                <div class="change move-right">
                                                    <li class="td td-moneystatus td-status">
                                                        <div class="item-status">
                                                            @if($g->state==1)<p class="Mystatus">您已经申请退款,等待卖家确定</p>@endif
                                                            @if($g->state==2)<p class="Mystatus">卖家已同意退款,等待退款到账</p>@endif
                                                            @if($g->state==3)<p class="Mystatus">退款成功</p>@endif
                                                        </div>
                                                    </li>
                                                </div>
                                                <li class="td td-change td-changebutton">
                                                    <a href="{{url('user/order/change/record',['id'=>$g->id])}}">
                                                        <div class="am-btn am-btn-danger anniu">
                                                            查看详情</div>
                                                    </a>
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
@endsection