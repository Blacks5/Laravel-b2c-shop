@extends('user.layout')
@section('title')
    <title>{{$goods->name}}的售后进度</title>
@endsection
@section('css')
    <link href="{{asset('css/refstyle.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('body')
    <div class="main-wrap">
        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">退款进度</strong> / <small>Apply&nbsp;for&nbsp;returns</small></div>
        </div>
        <hr/>
        <div class="comment-list">

            <div class="record-aside">
                <div class="item-pic">
                    <a href="#" class="J_MakePoint">
                        <img src="{{asset($goods->img)}}" class="itempic">
                    </a>
                </div>

                <div class="item-title">

                    <div class="item-name">
                        <a href="#">
                            <p class="item-basic-info">{{$goods->name}}</p>
                        </a>
                    </div>
                    <div class="info-little">
                        <span>{{$goods->info}}</span>
                    </div>
                </div>
                <div class="item-info">
                    <div class="item-ordernumber">
                        <span class="info-title">退款编号：</span><a>{{$goods->refund_no}}</a>
                    </div>

                    <div class="item-time">
                        <span class="info-title">申请时间：</span><span class="time">{{$goods->refund_time}}</span>
                    </div>

                </div>
                <div class="clear"></div>
            </div>

            <div class="record-main">
                @if($goods->state>2)
                <div class="detail-list refund-process">
                    <div class="fund-tool">{{$goods->refund_pay}}</div>
                    <div class="money">{{$goods->refund_number}}</div>
                </div>
                @endif
                <div class="clear"></div>
                <!--进度条-->
                <div class="m-progress" style="height: 100px;">
                    <div class="m-progress-list">
                        <span class="step-1 step">
                            <em class="u-progress-stage-bg"></em>
                            <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                            <p class="stage-name">买家申请退款 </p>
                        </span>
                        <span class="step-{{$goods->state==2?'1':'2'}} step">
                            <em class="u-progress-stage-bg"></em>
                            <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                            <p class="stage-name">卖家同意退款</p>
                        </span>
                        <span class="step-{{$goods->state==3?'1':'2'}} step">
                            <em class="u-progress-stage-bg"></em>
                            <i class="u-stage-icon-inner">3<em class="bg"></em></i>
                            <p class="stage-name">发送银行受理</p>
                        </span>
                        <span class="step-{{$goods->state==4?'1':'2'}} step">
                            <em class="u-progress-stage-bg"></em>
                            <i class="u-stage-icon-inner">4<em class="bg"></em></i>
                            <p class="stage-name">成功退款给买家</p>
                        </span>

                        <span class="u-progress-placeholder"></span>
                    </div>
                    <div class="u-progress-bar total-steps-2">
                        <div class="u-progress-bar-inner"></div>
                    </div>
                </div>
            </div>

        </div>
        <div class="clear"></div>
    </div>
@endsection