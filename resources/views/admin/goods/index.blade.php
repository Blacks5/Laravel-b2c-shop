@extends('admin.layout')
@section('title')商品列表@endsection
@section('body')
<div content="admin-main">
    <blockquote class="layui-elem-quote">
        <a href="javascript:;" class="layui-btn layui-btn-small" id="add" onclick="add()">
            <i class="layui-icon">&#xe608;</i> 增加商品
        </a>
        <a href="#" class="layui-btn layui-btn-small" id="import">
            <i class="layui-icon">&#xe608;</i> 导入信息
        </a>
        <a href="#" class="layui-btn layui-btn-small">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> 导出信息
        </a>
        <a href="#" class="layui-btn layui-btn-small" id="getSelected">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> 获取全选信息
        </a>
        <a href="javascript:;" class="layui-btn layui-btn-small" id="search">
            <i class="layui-icon">&#xe615;</i> 搜索
        </a>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>商品列表</legend>
        <div class="layui-field-box layui-form">
            <table class="layui-table admin-table">
                <thead>
                <tr>
                    <th style="width: 30px;"><input type="checkbox" lay-filter="allselector" lay-skin="primary"></th>
                    <th>ID</th>
                    <th>商品名称</th>
                    <th>显示/推荐</th>
                    <th>售价</th>
                    <th>库存</th>
                    <th>增加时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="content">
                @foreach($data as $key => $v)
                        <tr id="{{$v->id}}">
                            <td><input type="checkbox" lay-skin="primary"></td>
                            <TD>{{$v->id}}</TD>
                            <td ><a href="javascript:;" onclick="changeText(this,{{$v->id}})" value="name"><span>{{$v->name}}</span></a> </td>
                            <td>
                                <a href="javascript:;" onclick='changes(this,{{$v->id}},"show")'><i class="layui-icon" value="{{$v->show}}">{{$v->show==1?'&#xe618;':"&#x1007;" }}</i></a>
                                <a href="javascript:;" onclick='changes(this,{{$v->id}},"recommend")'><i class="layui-icon" value="{{$v->recommend}}">{{$v->show==1?'&#xe618;':"&#x1007;" }}</i></a>
                            </td>
                            <td><a href="javascript:;" onclick="changeText(this,{{$v->id}})" value="price"><span>{{$v->price}}</span></a></td>
                            <td><a href="javascript:;" onclick="changeText(this,{{$v->id}})" value="stock"><span>{{$v->stock}}</span></a></td>
                            <td>{{$v->updated_at}}</td>
                            <td>
                                <a href="javascript:;" data-name="item.name" data-opt="edit" class="layui-btn layui-btn-mini" onclick="add('{{$v->id}}')">增加子分类</a>
                                <a href="javascript:;" data-id="1" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini" onclick="del({{$v->id}})">删除</a>
                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </fieldset>
    <div class="admin-table-page">
        <div id="paged" class="page">
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
layui.use('layer',function(){var layer=layui.layer;});

function add(){

        layer.open({
            type:2,
            area:['1000px','700px'],
            fixed:false,
            shadeClose:true,
            content:"{{url('admin/goods/add')}}",
        });
}

function changes(obj,id,action){
    var url="{{url('admin/goods/update')}}/"+id;
    var value=$(obj).children('i').attr('value');
    //alert(value); return false;
    var postData={'_token':'{{csrf_token()}}','action':action,'value':value==1?0:1}
    $.post(url,postData,function(data){
        if(data.s==1){
            Materialize.toast(data.text, 4000)
            var text="&#x1007;",v=0;
            if(postData.value==1){text='&#xe618;';v=1;}
            $(obj).html('<i class="layui-icon" value="'+v+'">'+text+'</i>');
        }
    })

}

function changeText(obj,id){
    var text=$(obj).children('span').text(),type=$(obj).attr('value');
    $(obj).parent('td').append('<input type="text" name="'+type+'" class="validate" id="name" value="'+text+'" onblur="goChange(this,'+id+')" title="'+text+'">');
    $(obj).hide();
    $('input[name='+type+']').focus()

}

function goChange(obj,id){
    var url="{{url('admin/goods/update')}}/"+id,type=$(obj).attr('name');
    var postData={'_token':"{{csrf_token()}}",'action':type,'value':$(obj).val()}
    if($(obj).val()==$(obj).attr('title')){
        $(obj).prev('a').show();
        $(obj).remove();
        return false;
    }
    if($(obj).val()==""){Materialize.toast('请输入内容!',3000);$(obj).focus();return false;}
    $.post(url,postData,function(data){
        if(data.s==1){
            Materialize.toast(data.text, 3000);
            $(obj).prev('a').children('span').text($(obj).val());
            $(obj).prev('a').show();
            $(obj).remove();
        }
    })
}

function del(id){
    var url="{{url('admin/goods/destroy')}}/"+id;

    layer.confirm('确定要删除么?',{btn:['确定','取消'],btn1:function(){
        $.post(url,{'_token':"{{csrf_token()}}"},function(data){
            if(data.s==1){
                layer.msg(data.text,{icon:2});
                $('#'+id).hide();
            }
        })
    }})

}
function reload(){
    setTimeout('window.location.reload()',2000);
}
</script>
@endsection