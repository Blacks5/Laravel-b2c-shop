@extends('admin.layout')
@section('title')Article @endsection
@section('body')
    <div content="admin-main">
        <blockquote class="layui-elem-quote">
            <a href="javascript:;" class="layui-btn layui-btn-small" id="add" onclick="add()">
                <i class="layui-icon">&#xe608;</i> 增加分类
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
                        <th>分类名称</th>
                        <th>显示</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody id="content">
                    @foreach($data as $key => $v)
                        @if($v->pid==0)
                        <tr id="{{$v->id}}">
                            <td><input type="checkbox" lay-skin="primary"></td>
                            <TD>{{$v->id}}</TD>
                            <td ><a href="javascript:;" onclick="changeText(this,{{$v->id}})" value="name"><span>{{$v->name}}</span></a> </td>
                            <td>
                                <a href="javascript:;" onclick='changes(this,{{$v->id}},"show")'><i class="layui-icon" value="{{$v->show}}">{{$v->show==1?'&#xe618;':"&#x1007;" }}</i></a>
                            </td>
                            <td>
                                <a href="javascript:;" data-id="1" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini" onclick="del({{$v->id}})">删除</a>
                            </td>
                        </tr>
                        @foreach($v->child as $c)
                            <tr id="{{$c->id}}">
                                <td><input type="checkbox" lay-skin="primary"></td>
                                <TD>{{$c->id}}</TD>
                                <td ><a href="javascript:;" onclick="changeText(this,{{$c->id}})" value="name"><span>|--{{$c->name}}</span></a> </td>
                                <td>
                                    <a href="javascript:;" onclick='changes(this,{{$c->id}},"show")'><i class="layui-icon" value="{{$c->show}}">{{$c->show==1?'&#xe618;':"&#x1007;" }}</i></a>
                                </td>
                                <td>
                                    <a href="javascript:;" data-id="1" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini" onclick="del({{$c->id}})">删除</a>
                                </td>
                            </tr>
                            @endforeach
                        @foreach($c->child as $s)
                            <tr id="{{$s->id}}">
                                <td><input type="checkbox" lay-skin="primary"></td>
                                <TD>{{$s->id}}</TD>
                                <td ><a href="javascript:;" onclick="changeText(this,{{$s->id}})" value="name"><span>|----{{$s->name}}</span></a> </td>
                                <td>
                                    <a href="javascript:;" onclick='changes(this,{{$s->id}},"show")'><i class="layui-icon" value="{{$s->show}}">{{$s->show==1?'&#xe618;':"&#x1007;" }}</i></a>
                                </td>
                                <td>
                                    <a href="javascript:;" data-id="1" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini" onclick="del({{$s->id}})">删除</a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
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
            openUrl("{{url('admin/articleType/create')}}");
        }

        function addType(){
            openUrl("{{url('admin/articleType/create')}}");
        }

        function openUrl(url){
            layer.open({
                type:2,
                area:['300px','300px'],
                fixed:false,
                shadeClose:true,
                content:url,
            });
        }

        function changes(obj,id,action){
            var url="{{url('admin/articleType')}}/"+id;
            var value=$(obj).children('i').attr('value');
            //alert(value); return false;
            var postData={'_token':'{{csrf_token()}}','action':action,'value':value==1?0:1};
            $.ajax({
                url:url,
                type:"PUT",
                dataType:'json',
                data:postData,
                success:function (data) {
                    if(data.s==1){
                        Materialize.toast(data.text, 4000)
                        var text="&#x1007;",v=0;
                        if(postData.value==1){text='&#xe618;';v=1;}
                        $(obj).html('<i class="layui-icon" value="'+v+'">'+text+'</i>');
                    }
                }
            });
        }

        function changeText(obj,id){
            var text=$(obj).children('span').text(),type=$(obj).attr('value');
            $(obj).parent('td').append('<input type="text" name="'+type+'" class="validate" id="name" value="'+text+'" onblur="goChange(this,'+id+')" title="'+text+'">');
            $(obj).hide();
            $('input[name='+type+']').focus()

        }

        function goChange(obj,id){
            var url="{{url('admin/articleType')}}/"+id,type=$(obj).attr('name');
            var postData={'_token':"{{csrf_token()}}",'action':type,'value':$(obj).val()}
            if($(obj).val()==$(obj).attr('title')){
                $(obj).prev('a').show();
                $(obj).remove();
                return false;
            }
            if($(obj).val()==""){Materialize.toast('请输入内容!',3000);$(obj).focus();return false;}
            $.ajax({
                url:url,
                type:"PUT",
                dataType:'json',
                data:postData,
                success:function (data) {
                    if(data.s==1){
                        Materialize.toast(data.text, 3000);
                        $(obj).prev('a').children('span').text($(obj).val());
                        $(obj).prev('a').show();
                        $(obj).remove();
                    }
                }
            });

3        }

        function del(id){
            var url="{{url('admin/articleType')}}/"+id;

            layer.confirm('确定要删除么?',{btn:['确定','取消'],btn1:function(){
                $.ajax({
                    url:url,
                    type:"DELETE",
                    dataType:"json",
                    data:{'_token':"{{csrf_token()}}"},
                    success:function (data) {
                        if(data.s==1){
                            layer.msg(data.text,{icon:1});
                            $('#'+id).hide();
                        }else{
                            layer.msg(data.text,{icon:2});
                        }
                    },error:function () {
                        layer.msg('系统发生故障，请稍后重试',{icon:2});
                    }
                });
            }})

        }
        function reload(){
            setTimeout('window.location.reload()',2000);
        }
    </script>
@endsection