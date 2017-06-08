<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Table</title>
    <link rel="stylesheet" href="{{asset('plugins/layui/css/layui.css')}}" media="all" />
    <link rel="stylesheet" href="{{asset('css/global.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/table.css')}}" />
</head>

<body>
<div class="admin-main">

    <blockquote class="layui-elem-quote">
        <a href="javascript:;" class="layui-btn layui-btn-small" id="add">
            <i class="layui-icon">&#xe608;</i> 增加权限
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
        <legend>权限列表</legend>
        <div class="layui-field-box layui-form">
            <table class="layui-table admin-table">
                <thead>
                <tr>
                    <th style="width: 30px;"><input type="checkbox" lay-filter="allselector" lay-skin="primary"></th>
                    <th>权限</th>
                    <th>权限名称</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="content">
                @foreach($data as $v)
                <tr id="{{$v->id}}">
                    <td><input type="checkbox" lay-skin="primary"></td>
                    <td>{{$v->name}}</td>
                    <td>{{$v->display_name}}</td>
                    <td>{{$v->created_at}}</td>
                    <td>
                        <a href="javascript:;" data-name="item.name" data-opt="edit" class="layui-btn layui-btn-mini" onclick="update('{{$v->id}}')">编辑</a>
                        <a href="javascript:;" data-id="1" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini" onclick="delect('{{$v->id}}')">删除</a>
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
<script type="text/javascript" src="{{asset('plugins/layui/layui.js')}}"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script>
layui.use(['layer'],function(){
    var layer=layui.layer,$ = layui.jquery;

    $('#add').click(function(){
        layer.open({
            type:2,
            area:['500px','400px;'],
            fixed:false,
            content:"{{url('admin/role/add')}}",
            shadeClose:true
        })
    })
});
function update(id){
    layer.open({
        type:2,
        area:['500px','400px'],
        fixed:false,
        shadeClose:true,
        content:"{{url('admin/role/edit')}}/"+ id
    });
}
function delect(id){
    layer.confirm('确定要删除么?',{btn:['确定','取消']},function(){
        $.post("{{url('admin/role/delete')}}/"+id,{'_token':"{{csrf_token()}}"},function(data){
            if(data.s==1){
                layer.msg(data.text,{icon:1});
                $('#'+id).hide();
            }else{
                layer.msg(data.text,{icon:2});
            }
        })
    })
}
</script>
</body>

</html>