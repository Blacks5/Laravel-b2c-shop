@extends('admin.layout')
@section('title')
    增加权限
@endsection

@section('body')
    <div class="container">
        <form method="post">
            <div class="input-field col s12">
                <label for="name">权限:</label>
                <input type="text" name="name" class="validate" id="name" value="{{$data->name}}">
            </div>
            <div class="input-field col s12">
                <input type="text" name="display_name" class="validate" id="display_name" value="{{$data->display_name}}">
                <label for="display_name">权限名称:</label>
            </div>
            <div class="input-field col s12">
                <label for="description">详细描述:</label>
                <textarea class="materialize-textarea" name="description" id="description">{{$data->description}}</textarea>
            </div>
            <div class="input-field col s12">
                <input type="hidden" name="id" value="{{$data->id}}">
                <button type="button" class="btn btn-info" onclick="edit()">修改</button>
            </div>
        </form></div>
@endsection

@section('js')
    <script>
        layui.use(['layer'],function(){
            var layer = layui.layer;
        })
        function edit(){
            var index = parent.layer.getFrameIndex(window.name);
            if($('#name').val()==""){layer.msg('名称必须填写!',{icon:2});return false;}
            var postData={
                '_token':"{{csrf_token()}}",
                'id':$('input[name=id]').val(),
                'name':$('#name').val(),
                'display_name':$('#display_name').val(),
                'description':$('#description').val()
            };
            layer.load(0,{shade:false});
            $.post("{{url('admin/role/edit')}}/"+$('input[name=id]').val(),postData,function(data){
                layer.close(layer.load());
                if(data.s==0){
                    layer.msg(data.text,{icon:2});
                }else{
                    parent.layer.msg(data.text,{icon:1});
                    setTimeout('parent.location.reload()',3000);
                    parent.layer.close(index);
                }
            })
        }
    </script>
@endsection