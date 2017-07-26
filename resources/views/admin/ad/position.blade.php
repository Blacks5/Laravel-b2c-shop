@extends('admin.layout')
@section('title')
    商品分类列表
@endsection

@section('body')
    <div class="admin-main">
        <blockquote class="layui-elem-quote">
            <a href="javascript:;" class="layui-btn layui-btn-small" id="add" onclick="add(0)">
                <i class="layui-icon">&#xe608;</i> 增加广告位
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
            <legend>商品分类列表</legend>
            <div class="layui-field-box layui-form">
                <table class="layui-table admin-table">
                    <thead>
                    <tr>
                        <th style="width: 30px;"><input type="checkbox" lay-filter="allselector" lay-skin="primary"></th>
                        <th>广告位名称</th>
                        <th>宽度</th>
                        <th>高度</th>
                        <th>类型</th>
                        <th>启用</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody id="content">
                    @foreach($data as $key => $v)
                        <tr id="{{$v->id}}">
                            <td><input type="checkbox" lay-skin="primary"></td>
                            <td >{{$v->name}}</td>
                            <td >{{$v->width}}</td>
                            <td >{{$v->height}}</td>
                            <td >{{$v->type}}</td>
                            <td><i class="layui-icon" value="{{$v->show}}">{{$v->enable==1?'&#xe618;':"&#x1007;" }}</i></td>
                            <td>
                                <a href="javascript:;" data-id="1" data-opt="edit" class="layui-btn layui-btn-info layui-btn-mini" onclick="edit({{$v->id}})">编辑</a>
                                <a href="javascript:;" data-id="2" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini" onclick="del({{$v->id}})">删除</a>
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
        layui.use(['layer'],function(){var layer=layui.layer});
        function add(){
            var url = "{{url('admin/ad/position/create')}}";
            openLayer(url);
        }

        function edit(id){
            var url = "{{url('admin/ad/position/edit')}}/"+id;
            openLayer(url);
        }

        function del(id){
            var url="{{url('admin/ad/position/destroy')}}/"+id;

            $.post(url,{'_token':"{{csrf_token()}}"},function(data){
                if(data.s==1){
                    Materialize.toast(data.text,2000);
                    $('#'+id).hide();
                }
            })
        }
        function openLayer(url){
            layer.open({
                type:2,
                area:['500px','500px'],
                fixed:false,
                shadeClose:true,
                content:url
            });
        }
        function reload(){
            setTimeout('window.location.reload()',2000);
        }
    </script>
@endsection