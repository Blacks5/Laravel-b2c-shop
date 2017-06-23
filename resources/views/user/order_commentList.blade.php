@extends('user.layout')
@section('title')
    <title>评价商品</title>
@endsection

@section('css')
    <link href="{{asset('css/appstyle.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('body')
    <div class="main-wrap">

        <div class="user-comment">
            <!--标题 -->
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">发表评论</strong> / <small>Make&nbsp;Comments</small></div>
            </div>
            <hr/>

            <div class="comment-main">
                @foreach($goods as $key => $g)
                <div class="comment-list" id="goods{{$key}}">
                    <div class="item-pic">
                        <a href="{{url('goods',['id'=>$g->gid])}}" class="J_MakePoint">
                            <img src="{{asset($g->img)}}" class="itempic">
                        </a>
                    </div>

                    <div class="item-title">

                        <div class="item-name">
                            <a href="#">
                                <p class="item-basic-info">{{$g->name}}</p>
                            </a>
                        </div>
                        <div class="item-info">
                            <div class="info-little">
                                <span>{{$g->info}}</span>
                            </div>
                            <div class="item-price">
                                价格：<strong>{{$g->sale}}元</strong>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="item-comment">
                        <textarea placeholder="请写下对宝贝的感受吧，对他人帮助很大哦！" id="text{{$key}}"></textarea>
                    </div>
                    <div class="filePic">
                        <input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*" >
                        <span>晒照片(0/5)</span>
                        <img src="{{asset('images/image.jpg')}}" alt="">
                    </div>
                    <div class="item-opinion">
                        <li><i class="op1 active"></i>好评</li>
                        <li><i class="op2"></i>中评</li>
                        <li><i class="op3"></i>差评</li>
                    </div>
                </div>
                @endforeach
                <div class="info-btn">
                    <div class="am-btn am-btn-danger" onclick="addComment()">发表评论</div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".comment-list .item-opinion li").click(function() {
                            $(this).prevAll().children('i').removeClass("active");
                            $(this).nextAll().children('i').removeClass("active");
                            $(this).children('i').addClass("active");

                        });
                    })
                </script>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
layui.use('layer',function(){var layer=layui.layer;});
function addComment(){
    for(var i=0;i<$('.comment-list').length;i++){
        var score=$('#goods'+i).find('.active').parent('li').text();
        var text=$('#text'+i).val();
        alert(text)
    }
}
</script>
@endsection