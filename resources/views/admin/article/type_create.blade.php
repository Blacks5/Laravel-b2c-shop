@extends('admin.layout')
@section('title')增加文章分类@endsection

@section('body')
    <div class="container">
        <form class="panel panel-default">
            {{csrf_field()}}
            <div class="input-field col s12">
                <label for="name">分类名称：</label>
                <input type="text" id="name" class="validate">
            </div>
            <div class="input-field col s12">
                <select id="pid">
                    <option value="0" selected>第一级分类</option>
                    @foreach($data as $key => $d)
                        @if($d->pid==0)
                        <option value="{{$d->id}}">{{$d->name}}</option>
                            @foreach($d->child as $c)
                                <option value="{{$c->id}}">|--{{$c->name}}</option>
                                @foreach($c->child as $s)
                                    <option value="{{$s->id}}" disabled="true">|----{{$s->name}}</option>
                                    @endforeach
                                @endforeach
                        @endif
                        @endforeach
                </select>
            </div>
            <div class="input-field col s12">
                <button type="button" class="btn btn-info" onclick="add()">增加</button>
            </div>
        </form>
    </div>
    @endsection

@section('js')
    <script>
        $('#pid').material_select();
        layui.use('layer',function () {
            var layer=layui.layer;
        })
        function add(){
            if($('#name').val()==""){layer.msg('请填写分类的名称',{icon:2});return false;}
            var postData    =   {
                '_token':"{{csrf_token()}}",
                'name':$('#name').val(),
                'pid':$('#pid').val()
            }
            $.post("{{url('admin/articleType')}}",postData,function (data) {
                if(data.s==1){
                    layer.msg(data.text,{icon:1});
                    parent.reload();
                }else {
                    layer.msg(data.text,{icon:2});
                }

            });
        }
    </script>
    @endsection
