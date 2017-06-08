<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="{{asset('dist/amazeui.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('dist/amazeui.address.min.css')}}"/>
</head>
<body>
<form class="am-form am-padding-sm">
    <div class="am-form-group am-input-group" id="address">
        <span class="am-input-group-label">
            <span class="am-padding-horizontal-xs">请选择您的地址:</span>
        </span>
        <input readonly type="text" name="prov" class="am-form-field am-radius" placeholder="请选择省份" required="" value="四川省">
        <input readonly type="text" name="city" class="am-form-field am-radius" placeholder="请选择市区" required="" value="凉山彝族自治州">
        <input readonly type="text" name="district" class="am-form-field am-radius" placeholder="请选择地区" required="" value="西昌市">
    </div>
    <div class="am-form-group am-input-group">
        <span class="am-input-group-label">
            <span class="am-padding-horizontal-xs">请填写详细地址:</span>
        </span>
        <input type="text" name="info" class="am-form" placeholder="请填写详细地址" required="">
    </div>
    <div class="am-form-group am-input-group">
        <span class="am-input-group-label">
            <span class="am-padding-horizontal-xs">收货人:</span>
        </span>
        <input type="text" name="name" class="am-form" placeholder="请填写收货人" required="">
    </div>
    <div class="am-form-group am-input-group">
        <span class="am-input-group-label">
            <span class="am-padding-horizontal-xs">邮编:</span>
        </span>
        <input type="text" name="zipCode" class="am-form" placeholder="当地邮政编码" required="">
    </div>
    <div class="am-form-group am-input-group">
        <span class="am-input-group-label">
            <span class="am-padding-horizontal-xs">电话:</span>
        </span>
        <input type="text" name="phone" class="am-form" placeholder="收货手机" required="">
    </div>
    <div class="am-form-group am-input-group">
        <span class="am-input-group-label">
            <span class="am-padding-horizontal-xs">邮箱:</span>
        </span>
        <input type="text" name="email" class="am-form" placeholder="邮箱地址" required="">
    </div>
    <div class="am-form-group am-input-group">
        <button type="button" class="am-btn am-btn-success am-form" onclick="create()">提交</button>
    </div>

</form>
</body>
<script src="{{asset('dist/jquery.min.js')}}"></script>
<script src="{{asset('dist/amazeui.min.js')}}"></script>
<script src="{{asset('dist/iscroll.min.js')}}"></script>
<script src="{{asset('dist/address.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        document.addEventListener('touchmove', function (e) {
            e.preventDefault();
        }, false);
        //	自定义输出
        $("#address").address({
            prov: "四川省",
            city: "凉山彝族自治州",
            district: "西昌市",
            scrollToCenter: true,
            footer: true,
            selectEnd: function(json,address) {
                for(var key in json) {
                    $("#address").find("input[name='" + key + "']").val(json[key]);
                }
            }
            }).on("provTap",function(event,activeli){
                console.log(activeli.text());
            }).on("cityTap",function(event,activeli){
                console.log(activeli.text());
        });
    })
    function create(){
        var postData={
            '_token':"{{csrf_token()}}",
            'prov':$('input[name=prov]').val(),
            'city':$('input[name=city]').val(),
            'district':$('input[name=district]').val(),
            'info':$('input[name=info]').val(),
            'name':$('input[name=name]').val(),
            'zipCode':$('input[name=zipCode]').val(),
            'phone':$('input[name=phone]').val(),
            'email':$('input[name=email]').val()
        }
        $.post("{{url('user/address/create')}}",postData,function(data){
            if(data.s==1){
                parent.window.location.reload();
            }else{
                layer.msg(data.text);
            }
        })
    }
</script>
</html>