@extends('admin.layout')
@section('title')
    增加商品分类
@endsection
@section('body')
<div class="container">
    <form class="panel panel-default">
        <div class="input-field col s12">
            <label for="name">分类名称:</label>
            <input type="text" name="name" class="validate" id="name">
        </div>
        <div class="row">
            <div class="input-field col s6">
                <div class="switch">
                    <label>不显示<input type="checkbox" checked="checked" name="show"><span class="lever" ></span>显示</label>
                </div>
            </div>
            <div class="input-field col s6">
                <label for="name">排序:</label>
                <input type="number" name="short" class="validate" id="short" min="1">
            </div>
        </div>
        <div class="input-field center">
            <input type="hidden" name="pid" value="{{$pid}}">
            <button type="button" class="btn btn-info" onclick="create()">增加</button>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
var index = parent.layer.getFrameIndex(window.name);
layui.use(['layer'],function(){var layer=layui.layer;});
function create(){
    if($('#name').val()==""){layer.msg('请填写商品分类的名称;',{icon:2});return false;}
    var postData={
        '_token':"{{csrf_token()}}",
        'pid':$('input[name=pid]').val(),
        'name':$('#name').val(),
        'show':$('input[name=show]').is(':checked')?1:0,
        'short':$('#short').val()
    }
    $.post("{{url('admin/goods/type/create')}}",postData,function(data){
        layer.close(layer.load());
        if(data.s==0){
            layer.msg(data.text,{icon:2});
        }else{
            parent.layer.msg(data.text,{icon:1});
            parent.reload();
            parent.layer.close(index);
        }
    })
}
</script>
@endsection