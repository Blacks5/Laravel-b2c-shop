@extends('user.layout')
@section('title')
    <title>{{$goods->name}}退款/退货</title>
@endsection
@section('css')
    <link href="{{asset('css/refstyle.css')}}" rel="stylesheet" type="text/css">
    <style type="text/css">
        .upload_img{position: absolute;top:10px;left:105px;}
        .upload_img img{max-width:80px;max-height:80px;margin-right:5px;}
    </style>
@endsection

@section('body')
    <div class="main-wrap">
        <!--标题 -->
        <div class="am-cf am-padding">
            <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">退换货申请</strong> / <small>Apply&nbsp;for&nbsp;returns</small></div>
        </div>
        <hr/>
        <div class="comment-list">
            <!--进度条-->
            <div class="m-progress">
                <div class="m-progress-list">
							<span class="step-{{$goods->state==1?'1':'2'}} step" id="step1">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">买家申请退款</p>
                            </span>
                    <span class="step-{{$goods->state==2?'1':'2'}} step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">商家处理退款申请</p>
                            </span>
                    <span class="step-{{$goods->state==3?'1':'2'}} step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">3<em class="bg"></em></i>
                                <p class="stage-name">款项成功退回</p>
                            </span>
                    <span class="u-progress-placeholder"></span>
                </div>
                <div class="u-progress-bar total-steps-2">
                    <div class="u-progress-bar-inner"></div>
                </div>
            </div>


            <div class="refund-aside">
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
                        <span class="info-title">订单编号：</span><a>{{$goods->oid}}</a>
                    </div>
                    <div class="item-price">
                        <span class="info-title">价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格：</span><span class="price">{{$goods->sale}}元</span>
                        <span class="number">×{{$goods->number}}</span><span class="item-title">(数量)</span>
                    </div>
                    <div class="item-amount">
                        <span class="info-title">小&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计：</span><span class="amount">{{$goods->total}}元</span>
                    </div>
                    <div class="item-pay-logis">
                        <span class="info-title">运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：</span><span class="price">10.00元</span>
                    </div>
                    <div class="item-amountall">
                        <span class="info-title">总&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计：</span><span class="amountall">29.88元</span>
                    </div>
                    <div class="item-time">
                        <span class="info-title">成交时间：</span><span class="time">{{$goods->created_at}}</span>
                    </div>

                </div>
                <div class="clear"></div>
            </div>
            <form id="refundForm">
            @if($goods->refund==1)<fieldset disabled>@endif
            {!! csrf_field() !!}
            <div class="refund-main">
                <div class="item-comment">
                    <div class="am-form-group">
                        <label for="refund-type" class="am-form-label">退款类型</label>
                        <div class="am-form-content">
                            <select data-am-selected="" name="type">
                                <option value="退款" {{$goods->refund_type=='仅退款'?'selected':''}}>仅退款</option>
                                @if($goods->order_state>2)<option value="退款/退货" {{$goods->refund_type=='退款/退货'?'selected':''}}>退款/退货</option>@endif
                            </select>
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="refund-reason" class="am-form-label">退款原因</label>
                        <div class="am-form-content">
                            <select data-am-selected="{{$goods->refund_reason}}" name="reason">
                                <option value="请选择退款原因" selected>请选择退款原因</option>
                                <option value="不想要了" {{$goods->refund_reason=='不想要了'?'selected':''}}>不想要了</option>
                                <option value="买错了" {{$goods->refund_reason=='买错了'?'selected':''}}>买错了</option>
                                <option value="没收到货" {{$goods->refund_reason=='没收到货'?'selected':''}}>没收到货</option>
                                <option value="与说明不符" {{$goods->refund_reason=='与说明不符'?'selected':''}}>与说明不符</option>
                            </select>
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label for="refund-money" class="am-form-label">退款金额<span>（不可修改）</span></label>
                        <div class="am-form-content">
                            <input type="text" id="refund-money" name="price" readonly="readonly" placeholder="{{$goods->total}}" value="{{$goods->total}}" disabled>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="refund-info" class="am-form-label">退款说明<span>（可不填）</span></label>
                        <div class="am-form-content">
                            <textarea placeholder="请输入退款说明" id="info">{{$goods->refund_info}}</textarea>
                        </div>
                    </div>

                </div>
                <div class="refund-tip">
                    <div class="filePic">
                        <input type="file" class="inputPic" value="选择凭证图片" max="5" maxsize="5120" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" id="images" name="images">
                        <img src="{{asset('images/image.jpg')}}" alt="">

                    </div>
                    <span class="desc"></span>
                    <div class="upload_img" id="imgBody">
                        @if(!empty($goods->refund_img))
                        @foreach(explode(',',$goods->refund_img)  as $img)
                            <img src="{{asset($img)}}">
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="info-btn">
                    <input type="hidden" name="id" value="{{$goods->id}}">
                    <div class="am-btn am-btn-danger" onclick="refund()">提交申请</div>
                </div>
            </div>
                @if($goods->refund==1) </fieldset>@endif
            </form>
        </div>

        <div class="clear"></div>
    </div>
@endsection

@section('js')
<script>
layui.use('layer',function(){var layer=layui.layer;});
$('#images').change(function(){
    var data= new FormData($('#refundForm')[0]);
    $.ajax({
        url:"{{url('file/upload')}}",
        type:"POST",
        data:data,
        contentType:false,
        processData:false,
        cache:false,
        success:function(data){
            if(data.s==1){
                $('#imgBody').append('<a href="javascript:;" onclick="delImg(this)" value="'+data.img+'"><img src="'+data.imgs+'"><i class="fa fa-times" aria-hidden="true"></i> </a>')
            }
        },
        error:function(){
            layer.alert('系统发生未知错误',{icon:2})
        }

    })
});

function delImg(obj){
    var postData={'_token':"{{csrf_token()}}",'img':$(obj).attr('value')}
    $.post("{{url('file/delete')}}",postData,function(data){
        if(data.s==1) {
            $(obj).remove();
        }
        layer.msg(data.text)
    })
}

function refund(){
    var type=$('select[name=type]').val(),reason=$('select[name=reason]').val(),info=$('#info').val(),id=$('input[name=id]').val(),imgs='';
    $('#imgBody').children('a').each(function(){imgs+=$(this).attr('value')+',';});
    var postData={
        '_token':"{{csrf_token()}}",
        'id':id,
        'type':type,
        'info':info,
        'reason':reason,
        'img':imgs.substring(0,imgs.length-1)
    }
    $.post("{{url('user/order/refund')}}",postData,function (data){
        if(data.s==1){
            layer.msg(data.text);
            $('#step1').css('step-1 step');
        }
    })
}
</script>
@endsection