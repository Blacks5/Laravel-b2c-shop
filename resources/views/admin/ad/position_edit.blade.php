@extends('admin.layout')
@section('title')
    修改广告位
@endsection
@section('body')
    <div class="container">
        <form class="panel panel-default">
            <div class="input-field col s12">
                <label for="name">广告位名称:</label>
                <input type="text" name="name" class="validate" id="name" value="{{$data->name}}">
            </div>
            <div class="row">
                <div class="input-field col s3">
                    <label for="width">宽度:</label>
                    <input type="number" name="width" id="width" class="validate" min="1" value="{{$data->width}}">
                </div>
                <div class="input-field col s3">
                    <label for="height">高度:</label>
                    <input type="number" name="height" id="height" class="validate" min="1" value="{{$data->height}}">
                </div>
                <div class="input-field col s6">
                    <select id="type">
                        <option value="1" {{$data->type==1?'selected':''}}>图片</option>
                        <option value="2" {{$data->type==2?'selected':''}}>flash</option>
                        <option value="3" {{$data->type==3?'selected':''}}>代码</option>
                        <option value="4" {{$data->type==4?'selected':''}}>文字</option>
                    </select>
                    <label>请选择广告类型</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <label for="desc">描述:</label>
                    <textarea class="materialize-textarea" id="desc">{{$data->desc}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s3">
                    <input type="checkbox" id="enable" {{$data->enable==1?'checked':''}}>
                    <label for="enable">是否显示</label>
                </div>
                <div class="input-field col s9 center">
                    <input type="hidden" id="id" value="{{$data->id}}">
                    <button type="button" class="btn btn-info" onclick="create()">修改</button>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('js')
    <script>
        var index = parent.layer.getFrameIndex(window.name);
        $('#type').material_select();
        layui.use(['layer'],function(){var layer=layui.layer;});
        function create(){
            if($('#name').val()==""){layer.msg('请填写广告位名称;',{icon:2});return false;}
            if($('#width').val()==""){layer.msg('请填写广告位高度;',{icon:2});return false;}
            if($('#height').val()==""){layer.msg('请填写广告位宽度;',{icon:2});return false;}
            var postData={
                '_token':"{{csrf_token()}}",
                'id':$('#id').val(),
                'name':$('#name').val(),
                'width':$('#width').val(),
                'height':$('#height').val(),
                'type':$('#type').val(),
                'enable':$('#enable').is(':checked')?1:0,
                'desc':$('#desc').val()
            }
            $.post("{{url('admin/ad/position/update')}}",postData,function(data){
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