@extends('user.layout')
@section('title')
    <title>评论列表</title>
@endsection

@section('css')
    <link href="{{asset('css/cmstyle.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('body')
<div class="main-wrap">

        <div class="user-comment">
            <!--标题 -->
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">评价管理</strong> / <small>Manage&nbsp;Comment</small></div>
            </div>
            <hr/>

            <div class="am-tabs am-tabs-d2 am-margin" data-am-tabs>

                <ul class="am-avg-sm-2 am-tabs-nav am-nav am-nav-tabs">
                    <li class="am-active"><a href="#tab1">所有评价</a></li>
                    <li><a href="#tab2">有图评价</a></li>

                </ul>

                <div class="am-tabs-bd">
                    <div class="am-tab-panel am-fade am-in am-active" id="tab1">

                        <div class="comment-main">
                            <div class="comment-list">
                                @foreach($comments as $c)
                                <ul class="item-list">


                                    <div class="comment-top">
                                        <div class="th th-price">
                                            <td class="td-inner">评价:{{$c->score}}</td>
                                        </div>
                                        <div class="th th-item">
                                            <td class="td-inner">商品</td>
                                        </div>
                                    </div>

                                    <li class="td td-item">
                                        <div class="item-pic">
                                            <a href="{{url('goods',['id'=>$c->order->gid])}}" class="J_MakePoint">
                                                <img src="{{asset($c->order->img)}}" class="itempic">
                                            </a>
                                        </div>
                                    </li>

                                    <li class="td td-comment">
                                        <div class="item-title">
                                            <div class="item-opinion">好评</div>
                                            <div class="item-name">
                                                <a href="{{url('goods',['id'=>$c->order->gid])}}">
                                                    <p class="item-basic-info">{{$c->order->name}}</p>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="item-comment">
                                            {{$c->content}}
                                            @if(!empty($c->img))<div class="filePic">
                                                @foreach(explode(',',$c->img) as $i)
                                                <img src="{{asset($i)}}" alt="{{$c->order->name}}">
                                                @endforeach
                                            </div>@endif
                                        </div>

                                        <div class="item-info">
                                            <div>
                                                <p class="info-little"><span>{{$c->order->info}}</span></p>
                                                <p class="info-time">{{$c->updated_time}}</p>

                                            </div>
                                        </div>
                                    </li>

                                </ul>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <div class="am-tab-panel am-fade" id="tab2">

                        <div class="comment-main">
                            <div class="comment-list">
                                @foreach($comments as $c)
                                    @if(!empty($c->img))
                                    <ul class="item-list">


                                        <div class="comment-top">
                                            <div class="th th-price">
                                                <td class="td-inner">评价:{{$c->score}}</td>
                                            </div>
                                            <div class="th th-item">
                                                <td class="td-inner">商品</td>
                                            </div>
                                        </div>

                                        <li class="td td-item">
                                            <div class="item-pic">
                                                <a href="{{url('goods',['id'=>$c->order->gid])}}" class="J_MakePoint">
                                                    <img src="{{asset($c->order->img)}}" class="itempic">
                                                </a>
                                            </div>
                                        </li>

                                        <li class="td td-comment">
                                            <div class="item-title">
                                                <div class="item-opinion">好评</div>
                                                <div class="item-name">
                                                    <a href="{{url('goods',['id'=>$c->order->gid])}}">
                                                        <p class="item-basic-info">{{$c->order->name}}</p>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="item-comment">
                                                {{$c->content}}
                                                @if(!empty($c->img))<div class="filePic">
                                                    @foreach(explode(',',$c->img) as $i)
                                                        <img src="{{asset($i)}}" alt="{{$c->order->name}}">
                                                    @endforeach
                                                </div>@endif
                                            </div>

                                            <div class="item-info">
                                                <div>
                                                    <p class="info-little"><span>{{$c->order->info}}</span></p>
                                                    <p class="info-time">{{$c->updated_time}}</p>

                                                </div>
                                            </div>
                                        </li>

                                    </ul>
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