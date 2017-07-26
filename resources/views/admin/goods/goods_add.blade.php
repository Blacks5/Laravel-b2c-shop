@extends('admin.layout')
@section('title')增加商品@endsection
@section('css')
<style>
.imgs{margin-top: 5px;}
.imgs img{max-height:50px;max-width:50px; margin-left:5px;}
.imgs a{border:1px solid greenyellow;display: block;width:100px;float: left; margin-left:5px;}
</style>
@endsection
@section('body')
<div class="container">
    <form class="panel panel-default" id="goodsForm">
        {{csrf_field()}}
        <div class="row">
            <div class="input-field col s6">
                <label for="name">商品名称:</label>
                <input type="text" class="validate" id="name">
            </div>
        </div>
        <div class="row">
            <div class="chips chips-placeholder col s6" id="keywords"></div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <label for="description">描述</label>
                <textarea id="description" class="materialize-textarea"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s1">
                <label for="price">价格:</label>
                <input type="text" class="validate" id="price">
            </div>
            <div class="input-field col s1">
                <label for="sale">售价:</label>
                <input type="text" class="validate" id="sale">
            </div>
            <div class="input-field col s1">
                <label for="stock">库存:</label>
                <input type="text" class="validate" id="stock">
            </div>
            <div class="input-field col s1">
                <label for="saleNum">销量:</label>
                <input type="text" class="validate" id="saleNum">
            </div>
            <div class="input-field col s2" style="z-index: 50;">
                <select id="goodsType" >
                    @foreach($type as $key => $t)
                    @if($t->pid==0)
                    <OPTGROUP label="{{$t->name}}">
                    @foreach($t->childrenType as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                    </OPTGROUP>
                    @endif
                    @endforeach
                </select>
                <label>商品分类</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s2">
                <input type="checkbox" checked="checked" id="show">
                <label for="show">上架</label>
            </div>
            <div class="input-field col s2">
                <input type="checkbox" checked="checked" id="recommend">
                <label for="recommend">推荐</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field file-field col s2">
                <div class="btn">
                    <span>封面图片</span>
                    <input type="file" multiple id="images" name="images">
                </div>

            </div>
            <div class="imgs col s10" id="imgBody">
            </div>
        </div>
        <div class="row">
            @include('vendor.ueditor.assets')
            <script type="text/javascript">
                var ue = UE.getEditor('container');
                ue.ready(function() {
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                });
            </script>

            <!-- 编辑器容器 -->
            <script id="container" name="content" type="text/plain"></script>
        </div>
        <div class="input-field col s12">
            <button type="button" id="add" class="btn btn-info" onclick="addGoods()">增加</button>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
    //$('#')
$('#keywords').material_chip({
    placeholder: '输入回车后增加标签',
    secondaryPlaceholder: '+标签',
});
$('#goodsType').material_select();
layui.use('layer',function(){var layer=layui.layer;})

$('#images').change(function(){
   var data= new FormData($('#goodsForm')[0]);
   $.ajax({
       url:"{{url('file/upload')}}",
       type:"POST",
       data:data,
       contentType:false,
       processData:false,
       cache:false,
       success:function(data){
            if(data.s==1){
                $('#imgBody').append('<a href="javascript:;" onclick="delImg(this)" value="'+data.img+'"><img src="'+data.imgs+'"><i class="material-icons close">close</i> </a>')
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

 function addGoods(){
     $('#goodsType').material_select();
    var imgs='';
    var name=$('#name').val();
    var description=$('#description').val();
    var price=$('#price').val();
    var sale=$('#sale').val();
    var stock=$('#stock').val();
    var saleNum=$('#saleNum').val();
    //var goodsType=$('.select-dropdown').val();
    var goodsType=$('#goodsType').val();
    var show=$('#show').prop('checked')?1:0;
    var recommend=$('#recommend').prop('checked')?1:0;
    var content=ue.getContent();
    var keyword=$('#keywords').material_chip('data');
    var keywords='';
    $('#imgBody').children('a').each(function(){imgs+=$(this).attr('value')+',';});
    for(var i=0;i<keyword.length;i++){keywords+=keyword[i]['tag']+',';}
    if(name==""){layer.msg('商品名称还是要填的!!!',{icon:2});return false;}
    if(price==""){layer.msg('价格都莫有怎么卖!',{icon:2});return false;}
    if(sale==""){layer.msg('售价都莫有怎么卖!',{icon:2});return false;}
    if(stock==""){layer.msg('库存都莫有怎么卖!',{icon:2});return false;}
    if(imgs==""){layer.msg('商品图片都莫有怎么吸引人!',{icon:2});return false;}



    var postData={
        '_token':"{{csrf_token()}}",
        'name':name,
        'keywords':keywords.substring(0,keywords.length-1),
        'description':description,
        'price':price,
        'sale':sale,
        'stock':stock,
        'saleNum':saleNum,
        'type':goodsType,
        'show':show,
        'recommend':recommend,
        'content':content,
        'imgs':imgs.substring(0,imgs.length-1)
    };
    $.post("{{url('admin/goods/create')}}",postData,function (data) {
        layer.msg(data.text);
        if(data.s==1){
           parent.reload();
        }
    })
}
</script>
@endsection