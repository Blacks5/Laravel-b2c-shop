@extends('admin.layout')
@section('title')
    增加广告
@endsection
@section('body')
    <div class="container">
        <form class="panel panel-default" id="ad">
            {!! csrf_field() !!}
            <div class="row">
                <div class="input-field col s6">
                    <select id="position_id">
                        <option value="" disabled selected>请选择广告位</option>
                        @foreach($data as $d)
                        <option value="{{$d->id}}" type="{{$d->type}}">{{$d->name}}</option>
                        @endforeach
                    </select>
                    <label>请选择广告位</label>
                </div>
                <div class="input-field col s6">
                    <label for="name">广告名称:</label>
                    <input type="text" name="name" class="validate" id="name">
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <label for="link">链接:</label>
                    <input type="text" name="width" id="link" class="validate">
                </div>
                <div class="file-field input-field col s3 hide" id="img-btn">
                    <div class="btn">
                        <span>上传图片</span>
                        <input type="file" id="images" name="images">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="hidden">
                    </div>
                </div>
                <div class="input-field col s9">
                    <input type="text" name="height" id="code" class="validate" placeholder="内容">
                </div>

            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input placeholder="开始时间 不填默认永久" id="start_time">
                </div>
                <div class="input-field col s6">
                    <input placeholder="结束时间 不填默认永久" id="end_time">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s3">
                    <input type="checkbox" id="enable" checked="checked">
                    <label for="enable">是否显示</label>
                </div>
                <div class="input-field col s9 center">
                    <button type="button" class="btn btn-info" onclick="create()">增加</button>
                </div>
            </div>

        </form>
    </div>
@endsection

@section('js')
    <script>
        //var index = parent.layer.getFrameIndex(window.name);
        $('#position_id').material_select();
        layui.use('laydate',function(){
            var laydate=layui.laydate;
            var start = {
                min:laydate.now(),
                max:'2099-12-31 23:59:59',
                format: 'YYYY-MM-DD hh:mm:ss',
                istoday:false,
                choose:function(datas){
                    end.min = datas;
                    end.start = datas;
                }
            };
            var end =   {
                min:laydate.now(),
                max:'2099-12-31 23:59:59',
                format: 'YYYY-MM-DD hh:mm:ss',
                istoday:false,
                choose:function (datas) {
                    start.max = datas;
                }
            };
            document.getElementById('start_time').onclick=function () {
                start.elem = this;
                laydate(start);
            };
            document.getElementById('end_time').onclick=function () {
                end.elem = this;
                laydate(end);
            };

        });
        layui.use(['layer'],function(){var layer=layui.layer;});
        $('#position_id').change(function(){
            if($('#position_id').find('option:selected').attr('type')==1){
                $('#img-btn').removeClass('hide');
            }else{
                $('#img-btn').hide();
            }
        });
        $('#images').change(function () {
            var data= new FormData($('#ad')[0]);
            $.ajax({
                url:"{{url('file/upload')}}",
                type:"POST",
                data:data,
                contentType:false,
                processData:false,
                cache:false,
                success:function(data){
                    if(data.s==1){
                        $('#code').val(data.img);
                    }
                },
                error:function(){
                    layer.alert('系统发生未知错误',{icon:2})
                }

            })
        });
        function create(){
            if($('#position_id').val()==''){layer.msg('请选择广告类型',{icon:2});return false;}
            if($('#name').val()==""){layer.msg('请填写广告名称;',{icon:2});return false;}
            if($('#link').val()==""){layer.msg('请填写广告链接;',{icon:2});return false;}
            if($('#code').val()==""){layer.msg('请填写广告内容;',{icon:2});return false;}
            var postData={
                '_token':"{{csrf_token()}}",
                'name':$('#name').val(),
                'position_id':$('#position_id').val(),
                'link':$('#link').val(),
                'code':$('#code').val(),
                'start_time':$('#start_time').val(),
                'end_time':$('#end_time').val(),
                'enable':$('#enable').is(':checked')?1:0,
            }
            $.post("{{url('admin/ad')}}",postData,function(data){
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