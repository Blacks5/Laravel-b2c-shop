@extends('user.layout')
@section('title')
<title>收货地址管理</title>
@endsection
@section('css')
    <link href="{{asset('css/addstyle.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('body')
    <div class="main-wrap">

        <div class="user-address">
            <!--标题 -->
            <div class="am-cf am-padding">
                <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
            </div>
            <hr/>
            <div class="am-cf am-padding">
                <button type="button" class="am-btn am-btn-success" onclick="createAdr()">增加新地址</button>
            </div>
            <ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">
                @foreach($adr as $a)
                <li class="user-addresslist {{$a->type==1?'defaultAddr':''}}" type="{{$a->id}}">
                    <span class="new-option-r" onclick="defaultAdr(this,{{$a->id}})" value="{{$a->type==1?'default':''}}"><i class="am-icon-check-circle"></i>默认地址</span>
                    <p class="new-tit new-p-re">
                        <span class="new-txt">{{$a->name}}</span>
                        <span class="new-txt-rd2">{{$a->phone}}</span>
                    </p>
                    <div class="new-mu_l2a new-p-re">
                        <p class="new-mu_l2cw">
                            <span class="title">地址：</span>
                            <span class="province">{{$a->prov}}</span>省
                            <span class="city">{{$a->city}}</span>市
                            <span class="dist">{{$a->district}}</span>区
                            <span class="street">{{$a->info}}</span></p>
                    </div>
                    <div class="new-addr-btn">
                        <a href="javascript:;" onclick="updateAdr({{$a->id}})"><i class="am-icon-edit"></i>编辑</a>
                        <span class="new-addr-bar">|</span>
                        <a href="javascript:void(0);" onclick="deleteAdr({{$a->id}});"><i class="am-icon-trash"></i>删除</a>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="clear"></div>
        </div>



        <div class="clear"></div>

    </div>
@endsection

@section('js')
<script type="text/javascript">
layui.use('layer',function(){var layer=layui.layer});
$(document).ready(function() {
    $(".new-option-r").click(function() {
        $(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
    });

    var $ww = $(window).width();
    if($ww>640) {
        $("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
    }

})
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
function defaultAdr(obj,id){
    if($(obj).parent('.user-addresslist').hasClass("defaultAddr")){return false;}
    $.post("{{url('/user/address/default')}}/"+id,{'_token':"{{csrf_token()}}"},function(data){
        if(data.s==1){
            $(obj).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
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
</script>
@endsection