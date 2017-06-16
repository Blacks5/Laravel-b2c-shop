<script src="//cdn.bootcss.com/jquery/2.1.0/jquery.min.js"></script>
<script src="http://static.geetest.com/static/tools/gt.js"></script>
<div id="geetest-captcha"></div>
<p id="wait" class="show">正在加载验证码...</p>
<script>
function geetest()
{
    var url='laravelchen/geetest'
    var handlerEmbed = function (captchaObj) {
        var validate = captchaObj.getValidate();
        captchaObj.appendTo("#geetest-captcha");
        captchaObj.onReady(function () {
            $("#wait")[0].remove();
        });
        if ('{{ $product }}' == 'popup') {
            captchaObj.bindOn($('#geetest-captcha').closest('form').find(':submit'));
            captchaObj.appendTo("#geetest-captcha");
        }
        $('input[name=action]').click(function(){
            if(!!check()){
                captchaObj.reset();
            }

        })
    };

    $.ajax({
        url: url + "?t=" + (new Date()).getTime(),
        type: "get",
        dataType: "json",
        success: function (data) {
            initGeetest({
                gt: data.gt,
                challenge: data.challenge,
                product: '{{ $product }}',
                offline: !data.success,
                new_captcha: '{{ Config::get('geetest.new_captcha') }}',
                lang: '{{ Config::get('geetest.lang') }}'
            }, handlerEmbed);
        }
    });
}
geetest()
</script>