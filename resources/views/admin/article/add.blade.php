@extends('admin.layout')
@section('title')增加文章@endsection

@section('body')
    <div class="container">
        <form class="panel panel-default" id="articleForm">
            {{csrf_field()}}
            <div class="row">
                <div class="input-field col s6">
                    <label for="name">文章标题:</label>
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
                <div class="input-field col s2" style="z-index: 50;">
                    <select id="type" >
                        @foreach($type as $key => $t)
                            @if($t->pid==0)
                                <option value="{{$t->id}}">{{$t->name}}</option>
                                    @foreach($t->child as $c)
                                        <option value="{{$c->id}}">|--{{$c->name}}</option>
                                        @foreach($c->child as $s)
                                            <option value="{{$s->id}}">|----{{$s->name}}</option>
                                        @endforeach
                                    @endforeach
                            @endif
                        @endforeach
                    </select>
                    <label>商品分类</label>
                </div>
                <div class="input-field col s2">
                    <input type="checkbox" checked="checked" id="show">
                    <label for="show">显示</label>
                </div>
                <div class="input-field col s2">
                    <input type="checkbox" checked="checked" id="recommend">
                    <label for="recommend">推荐</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <label for="resource">来源:</label>
                    <input type="text" class="validate" id="resource">
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
            secondaryPlaceholder: '+关键词',
        });
        $('#type').material_select();
        layui.use('layer',function(){var layer=layui.layer;})

        function addGoods(){
            $('#type').material_select();
            var name=$('#name').val();
            var description=$('#description').val();
            var type=$('#type').val();
            var show=$('#show').prop('checked')?1:0;
            var recommend=$('#recommend').prop('checked')?1:0;
            var content=ue.getContent();
            var keyword=$('#keywords').material_chip('data');
            var keywords='';
            for(var i=0;i<keyword.length;i++){keywords+=keyword[i]['tag']+',';}
            if(name==""){layer.msg('名称还是要填的!!!',{icon:2});return false;}



            var postData={
                '_token':"{{csrf_token()}}",
                'title':name,
                'keywords':keywords.substring(0,keywords.length-1),
                'description':description,
                'tid':type,
                'show':show,
                'recommend':recommend,
                'content':content,
                'resource':$('#resource').val(),
                'url':' '
            };
            $.ajax({
                url:"{{url('admin/article')}}",
                type:"POST",
                dataType:"JSON",
                data:postData,
                success:function (data) {
                    layer.msg(data.text);
                    if(data.s==1){
                        parent.reload();
                    }
                }
            });
        }
    </script>
@endsection