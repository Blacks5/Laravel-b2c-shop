@extends('user.layout')

@section('title')
    <title>{{$data->LogisticCode}}的物流追踪</title>
@endsection
@section('css')
    <link href="{{asset('css/lostyle.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('body')
    <div class="main-wrap">
        <div class="user-logistics">
            <!--标题 -->
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">物流跟踪</strong> / <small>Logistics&nbsp;History</small></div>
            </div>
            <hr/>
            <div class="package-title">
                <div class="m-item">
                    <div class="item-info">
                        <p class="log-status">物流状态:<span>已签收</span> </p>
                        <p>承运公司：{{$data->post_name}}</p>
                        <p>快递单号：{{$data->LogisticCode}}</p>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="package-status">
                <ul class="status-list">
                    @foreach($data->Traces as $key => $trace)
                    <li class="latest">
                        <p class="text">{{$trace->AcceptStation}}</p>
                        <div class="time-list">
                            <span class="date">{{$trace->AcceptTime}}</span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection