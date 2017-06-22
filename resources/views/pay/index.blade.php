<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>结算页面</title>

    <link href="{{asset('UI/assets/css/amazeui.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('basic/css/demo.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/cartstyle.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('css/jsstyle.css')}}" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="{{asset('js/address.js')}}"></script>

</head>

<body>

<!--顶部导航条 -->
<div class="am-container header">
    <ul class="message-l">
        <div class="topMessage">
            <div class="menu-hd">
                <a href="#" target="_top" class="h">亲，请登录</a>
                <a href="#" target="_top">免费注册</a>
            </div>
        </div>
    </ul>
    <ul class="message-r">
        <div class="topMessage home">
            <div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
        </div>
        <div class="topMessage my-shangcheng">
            <div class="menu-hd MyShangcheng"><a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
        </div>
        <div class="topMessage mini-cart">
            <div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
        </div>
        <div class="topMessage favorite">
            <div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
    </ul>
</div>

<!--悬浮搜索框-->

<div class="nav white">
    <div class="logo"><img src="../images/logo.png" /></div>
    <div class="logoBig">
        <li><img src="../images/logobig.png" /></li>
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
<div class="concent">
    <!--地址 -->
    <div class="paycont">
        <div class="address">
            <h3>确认收货地址 </h3>
            <div class="control am-input-group">
                <a class="am-btn am-btn-danger" onclick="createAdr()">使用新地址</a>
            </div>
            <div class="clear"></div>
            <ul>
                <div class="per-border"></div>
                @foreach($address as $a)
                <li class="user-addresslist {{$a->type==1?'defaultAddr':''}}" type="{{$a->id}}">

                    <div class="address-left">
                        <div class="user DefaultAddr">
                            <span class="buy-address-detail">
                                <span class="buy-user">{{$a->name}} </span>
                                <span class="buy-phone">{{$a->phone}}</span>
                            </span>
                        </div>
                        <div class="default-address DefaultAddr">
                            <span class="buy-line-title buy-line-title-type">收货地址：</span>
                            <span class="buy--address-detail">
                                <span class="province">{{$a->prov}}</span>
                                <span class="city">{{$a->city}}</span>
                                <span class="dist">{{$a->district}}</span>
                                <span class="street">{{$a->info}}</span>
                            </span>
                        </div>
                        {!! $a->type==1?'<ins class="deftip">默认地址</ins>':''!!}
                    </div>
                    <div class="address-right">
                        <a href="../person/address.html">
                            <span class="am-icon-angle-right am-icon-lg"></span></a>
                    </div>
                    <div class="clear"></div>

                    <div class="new-addr-btn">
                        <a href="javascript:;" {{$a->type==1?'class="hidden"':''}} onclick="defaultAdr({{$a->id}})">设为默认</a>
                        <span class="new-addr-bar hidden">|</span>
                        <a href="javascript:;" onclick="updateAdr({{$a->id}})">编辑</a>
                        <span class="new-addr-bar">|</span>
                        <a href="javascript:void(0);" onclick="deleteAdr({{$a->id}});">删除</a>
                    </div>

                </li>
                <div class="per-border"></div>
                @endforeach
            </ul>

            <div class="clear"></div>
        </div>
        <!--物流
        <div class="logistics">
            <h3>选择物流方式</h3>
            <ul class="op_express_delivery_hot">
                <li data-value="yuantong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -468px"></i>圆通<span></span></li>
                <li data-value="shentong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -1008px"></i>申通<span></span></li>
                <li data-value="yunda" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -576px"></i>韵达<span></span></li>
                <li data-value="zhongtong" class="OP_LOG_BTN op_express_delivery_hot_last "><i class="c-gap-right" style="background-position:0px -324px"></i>中通<span></span></li>
                <li data-value="shunfeng" class="OP_LOG_BTN  op_express_delivery_hot_bottom"><i class="c-gap-right" style="background-position:0px -180px"></i>顺丰<span></span></li>
            </ul>
        </div>
        <div class="clear"></div>
        -->

        <!--支付方式-->
        <div class="logistics">
            <h3>选择支付方式</h3>
            <ul class="pay-list">
                <li class="pay taobao selected" type="alipay"><img src="../images/zhifubao.jpg" />支付宝<span></span></li>
                <li class="pay card" type="yl"><img src="../images/wangyin.jpg" />银联<span></span></li>
                <li class="pay qq" type="wx"><img src="../images/weizhifu.jpg" />微信<span></span></li>
            </ul>
        </div>
        <div class="clear"></div>

        <!--订单 -->
        <div class="concent">
            <div id="payTable">
                <h3>确认订单信息</h3>
                <div class="cart-table-th">
                    <div class="wp">

                        <div class="th th-item">
                            <div class="td-inner">商品信息</div>
                        </div>
                        <div class="th th-price">
                            <div class="td-inner">单价</div>
                        </div>
                        <div class="th th-amount">
                            <div class="td-inner">数量</div>
                        </div>
                        <div class="th th-sum">
                            <div class="td-inner">金额</div>
                        </div>
                        <div class="th th-oplist">
                            <div class="td-inner">配送方式</div>
                        </div>

                    </div>
                </div>
                <div class="clear"></div>
                @foreach($cart as $c)
                <tr class="item-list" id="{{$c->id}}" name="goods">
                    <div class="bundle  bundle-last">

                        <div class="bundle-main">
                            <ul class="item-content clearfix">
                                <div class="pay-phone">
                                    <li class="td td-item">
                                        <div class="item-pic">
                                            <a href="{{url('goods',['id'=>$c->gid])}}" class="J_MakePoint">
                                                <img src="{{asset($c->img)}}" class="itempic J_ItemImg" style="max-width:80px;"></a>
                                        </div>
                                        <div class="item-info">
                                            <div class="item-basic-info">
                                                <a href="{{url('goods',['id'=>$c->gid])}}" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$c->name}}</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="td td-info">
                                        <div class="item-props">
                                            <span class="sku-line">{{$c->info}}</span>
                                        </div>
                                    </li>
                                    <li class="td td-price">
                                        <div class="item-price price-promo-promo">
                                            <div class="price-content">
                                                <em class="J_Price price-now">{{$c->sale}}</em>
                                            </div>
                                        </div>
                                    </li>
                                </div>
                                <li class="td td-amount">
                                    <div class="amount-wrapper ">
                                        <div class="item-amount ">
                                            <span class="phone-title">购买数量</span>
                                            <div class="sl">
                                                <input class="text_box" name="number" type="number" sno="{{$c->id}}" value="{{$c->number}}" min="1" style="width:30px;" />
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="td td-sum">
                                    <div class="td-inner">
                                        <em tabindex="0" class="J_ItemSum number" id="total{{$c->id}}" name="total[]">{{$c->total}}</em>
                                    </div>
                                </li>
                                <li class="td td-oplist">
                                    <div class="td-inner">
                                        <span class="phone-title">配送方式</span>
                                        <div class="pay-logis">
                                            快递
                                        </div>
                                    </div>
                                </li>

                            </ul>
                            <div class="clear"></div>

                        </div>
                </tr>
                <div class="clear"></div>
                @endforeach
            </div>
        </div>
        <div class="clear"></div>
        <div class="pay-total">
            <!--留言-->
            <div class="order-extra">
                <div class="order-user-info">
                    <div id="holyshit257" class="memo">
                        <label>买家留言：</label>
                        <input type="text" title="选填,对本次交易的说明（建议填写已经和卖家达成一致的说明）" placeholder="选填,建议填写和卖家达成一致的说明" class="memo-input J_MakePoint c2c-text-default memo-close" name="remake">
                        <div class="msg hidden J-msg">
                            <p class="error">最多输入500个字符</p>
                        </div>
                    </div>
                </div>

            </div>
            <!--优惠券 -->
            <div class="buy-agio">
                <li class="td td-coupon">

                    <span class="coupon-title">优惠券</span>
                    <select data-am-selected>
                        <option value="a">
                            <div class="c-price">
                                <strong>￥8</strong>
                            </div>
                            <div class="c-limit">
                                【消费满95元可用】
                            </div>
                        </option>
                        <option value="b" selected>
                            <div class="c-price">
                                <strong>￥3</strong>
                            </div>
                            <div class="c-limit">
                                【无使用门槛】
                            </div>
                        </option>
                    </select>
                </li>

                <li class="td td-bonus">

                    <span class="bonus-title">红包</span>
                    <select data-am-selected>
                        <option value="a">
                            <div class="item-info">
                                ¥50.00<span>元</span>
                            </div>
                            <div class="item-remainderprice">
                                <span>还剩</span>10.40<span>元</span>
                            </div>
                        </option>
                        <option value="b" selected>
                            <div class="item-info">
                                ¥50.00<span>元</span>
                            </div>
                            <div class="item-remainderprice">
                                <span>还剩</span>50.00<span>元</span>
                            </div>
                        </option>
                    </select>

                </li>

            </div>
            <div class="clear"></div>
        </div>
        <!--含运费小计 -->
        <div class="buy-point-discharge ">
            <p class="price g_price ">
                合计（含运费） <span>¥</span><em class="pay-sum">00.00</em>
            </p>
        </div>

        <!--信息 -->
        <div class="order-go clearfix">
            <div class="pay-confirm clearfix">
                <div class="box">
                    <div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
                        <span class="price g_price ">
                                    <span>¥</span> <em class="style-large-bold-red " id="J_ActualFee">00.00</em>
											</span>
                    </div>

                    <div id="holyshit268" class="pay-address">

                        <p class="buy-footer-address">
                            <span class="buy-line-title buy-line-title-type">寄送至：</span>
                            <span class="buy--address-detail">
								   <span class="province">{{$address[0]->prov}}</span>
												<span class="city">{{$address[0]->city}}</span>
												<span class="dist">{{$address[0]->district}}</span>
												<span class="street">{{$address[0]->info}}</span>
												</span>
                            </span>
                        </p>
                        <p class="buy-footer-address">
                            <span class="buy-line-title">收货人：</span>
                            <span class="buy-address-detail">
                                         <span class="buy-user">{{$address[0]->name}} </span>
												<span class="buy-phone">{{$address[0]->phone}}</span>
												</span>
                        </p>
                    </div>
                </div>

                <div id="holyshit269" class="submitOrder">
                    <form method="post" action="{{url('pay/add')}}" id="payAdd">
                        {!! csrf_field() !!}
                        <div class="go-btn-wrap">
                            <input name="goods" type="hidden">
                            <input name="address" type="hidden">
                            <input name="pay" type="hidden">
                            <input name="remake" type="hidden">
                            <input name="postage" type="hidden">
                            <a id="J_Go" class="btn-go" tabindex="0" title="点击此按钮，提交订单" onclick="add()">提交订单</a>
                        </div>
                    </form>

                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="clear"></div>
</div>
</div>
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

</body>
<script src="{{asset('plugins/layui/layui.js')}}"></script>
<script>
    layui.use('layer',function(){var layer=layui.layer;})
function totalAll(){
    var total=0;
    $("em[name='total[]'").each(function(){
        total+=parseInt($(this).text());
    });
    $('.pay-sum').text(total);
    $('#J_ActualFee').text(total);
}
totalAll();
function total(id,total){
    $('#total'+id).text(total)
}

function createAdr(){
    open("{{url('user/address/create')}}",'增加新地址');
}

function updateAdr(id){
    open("{{url('user/address/update')}}/"+id,'修改地址');
}

function open(url,title){
    layer.open({
        type:2,
        area:['1000px','700px'],
        fixed:false,
        shadeClose:true,
        title:title,
        content:url,
    });
}

function defaultAdr(id){
    $.post("{{url('/user/address/default')}}/"+id,{'_token':"{{csrf_token()}}"},function(data){
        if(data.s==1){
            $('.deftip').remove();
            $('li[type='+id+']').children('.address-left').append('<ins class="deftip">默认地址</ins>');
        }else{
            layer.msg(data.text,{icon:2});
        }
    })
}

function deleteAdr(id){
    layer.confirm('确定要删除?',{icon:3,title:'提示'},function (index){
        $.post("{{url('user/address/delete')}}/"+id,{'_token':"{{csrf_token()}}"},function(data){
            if(data.s==1){
                $('li[type='+id+']').remove();
            }
        });
        layer.close(index);
    })

}
$('input[name=number]').change(function(){
   $.post("{{url('/cart/update')}}/"+$(this).attr('sno'),{'_token':"{{csrf_token()}}",'action':'number','value':$(this).val()},function(data){
       if(data.s==1){
           total(data.id,data.total);
           totalAll();
       }else{
           layer.msg('系统遇到问题了!!!',{icon:2});
       }
   })
});
$('.user-addresslist').click(function(){
    $('.buy-footer-address').find('.province').text($(this).find('.province').text());
    $('.buy-footer-address').find('.city').text($(this).find('.city').text());
    $('.buy-footer-address').find('.street').text($(this).find('.street').text());
    $('.buy-footer-address').find('.buy-user').text($(this).find('.buy-user').text());
    $('.buy-footer-address').find('.buy-phone').text($(this).find('.buy-phone').text());
    $('.buy-footer-address').find('.dist').text($(this).find('.dist').text());
})
function add(obj){
   //window.location.href="{{url('pay')}}/"+$('.selected').attr('type')+'/'+$('.defaultAddr').attr('type')+'/'+'{{$id}}';
   $('input[name=goods]').val("{{$id}}");
   $('input[name=address]').val($('.defaultAddr').attr('type'));
   $('input[name=pay]').val($('.selected').attr('type'));
   $('input[name=remake]').val($('input[name=remake]').val());
   $('input[name=postage]').val(10);
   $('#payAdd').submit();

};
</script>
</html>