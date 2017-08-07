@extends('home.parent')
 @section('content')
	<script type="text/javascript" language="javascript">
	    
	    //JS Cookie操作
	    function getCookieVal(offset) {
	        var endstr = document.cookie.indexOf(";", offset);
	        if (endstr == -1) {
	            endstr = document.cookie.length;
	        }
	        return decodeURI(document.cookie.substring(offset, endstr));
	    }

	    function getCookie(name) {
	        var arg = name + "=";
	        var alen = arg.length;
	        var clen = document.cookie.length;
	        var i = 0;
	        var j = 0;
	        while (i < clen) {
	            j = i + alen;
	            if (document.cookie.substring(i, j) == arg)
	                return getCookieVal(j);
	            i = document.cookie.indexOf(" ", i) + 1;
	            if (i == 0)
	                break;
	        }
	        return null;
	    }

	    function deleteCookie(name) {
	        var exp = new Date();
	        var cval = getCookie(name);
	        exp.setTime(exp.getTime() - 1);
	        document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
	    }

	    function setCookie(name, value) {
	        var argv = setCookie.arguments;
	        var argc = setCookie.arguments.length;
	        var exp = (argc > 2) ? argv[2] : 1;
	        var path = (argc > 3) ? argv[3] : null;
	        var domain = (argc > 4) ? argv[4] : null;
	        var secure = (argc > 5) ? argv[5] : false;
	        var expires = new Date();
	        expires.setTime(expires.getTime() + (exp * 24 * 60 * 60 * 1000));
	        document.cookie = name + "=" + value + "; path=/; expires=" + expires.toGMTString();
	    }

	    //选项卡操作
	    //$(".mune_xia").hide();
	    var name = window.location.pathname;
	    var on = 1;
	    if (name.indexOf("index") != -1) {
	        on = 1;
	    } else if (name.indexOf("cinema") != -1) {
	        on = 2;
	    } else if (name.indexOf("schedule") != -1 || name.indexOf("search") != -1 || name.indexOf("/buy/") != -1) {
	        on = 3;
	    } else if (name.indexOf("client") != -1) {
	        on = 4;
	    } else if (name.indexOf("ActList") != -1 || name.indexOf("CinnemaActivity") != -1 || name.indexOf("ActivityMoreInfo") > 0) {
	        on = 6;
	    } else if (name.indexOf("mall") != -1) {
	        on = 5;
	    }
	    $(".mune ul li a").attr("class", "");
	    $("#" + on).children("a").attr("class", "hover");
	    //$("#content" + on).show();

	    //鼠标悬停事件
	    $(".mune ul li").hover(
	        function () {
	            var id = this.id;
	            var a = $(this).children("a");
	            var c = a.attr("class");
	            if (c != "sel") {
	                a.attr("class", "sel");
	            }
	            else
	                a.removeAttr("class");
	        },
	        function () {
	            $("div .mune_xia").hide();
	            $(".mune ul li a").removeAttr("class");
	            $("#" + on + " a").attr("class", "sel");
	            //$("#content" + on).show();
	        }
	    );

	    function notify() {
	        showAlert("商城正在维护升级中，预计于2016年7月18日16时完成，请稍候访问!");
	    }
	</script>
    
    <div class="uWarp ">
        <div class="uWcon cf">
            <div class="uWarpL">
                <span></span>
            </div>
            <div class="uWarpR">
                <h5>
                    用户注册</h5>
                <div class="inputArea" style="margin: 10px 0 0 0;">
                    <div class="cf" style="padding-left: 60px">
                        <span id="ContentPlaceHolder1_error_tip" class="onError"></span>
                    </div>
    				<form method="post" action="{{ url('/regist') }}"  onsubmit="return validate()">
            			{{ csrf_field() }}
                    
                   		@if (session('msg'))
                     		<script>
                        		alert("{{ session('msg') }}");
                     		</script>
                   		@endif
	                    <p>
	                        <span class="w75" style="width:85px;">登录名：</span>
	                        <input name="name" type="text" id=" dengluming" class="tex  yzm" maxlength="11" " />
	                    </p>
	                    <p>
	                        <span class="w75" style="width:85px;">密 码：</span>
	                        <input name="pass" type="password" id="password" maxlength="16" class="tex pw" /><span id='sp'></span>
	                        <ul class="mima">
	                        <li>弱</li>
	                        <li>中</li>
	                        <li>强</li>
	                        <li>变态</li>
	                        </ul>
	                    </p>
                    	<p>
                        	<span class="w75" style="width:85px;">确认密码：</span>
                        	<input type="password" maxlength="16" id="repass" name="repass" class="tex pw"/>
                        </p>
                     	<p>
                        	<span class="w75" style="width:85px;">手机号：</span>
                        	<input name="phone" type="text" id="Mobile" class="tex  yzm" maxlength="11" />
                    	</p>
                    	<p>
                        	<span class="w75" style="width:85px;">短信验证码：</span>
                        	<input name="msmcode" type="text" id="" class="tex" style="width:150px;" />
                        	<img id="codeloading" src="{{ asset('home/images/18.gif') }}" alt="加载中" style="margin-left: 30px;display: none" />
                        	<input type="button" id="Button_code" class="gainBtn" value="获取验证码" onclick="sendphone()" />
                    	</p>
                    	<p>
                        	<span class="w75"></span>
                        	<input type="checkbox" checked="checked" id="fuwuxieyi" name="chk_agree" />
                        	我已同意并看过<a href=" " target="_blank">《中影·国际影城服务协议》</a>
                    	</p>
                    	<p>
                        	<span class="w75"></span>
                        	<img id="rgloading" src="{{ asset('home/images/18.gif') }}" alt="加载中" style="margin-left: 30px;
                            display: none" />
                        	<input type="submit" id="zhuce" class="kbtn" value="注册" />
                    	</p>
                    </form>
                    <p>
                        <span></span>已经注册了，直接去<a href="{{ url('/login') }}" class="red">登录</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
            
        //密码判断
        $(':password:first').keyup(function(){
	        var arr = [];
	        // 获取输入的值
	        var val = $(this).val();
	        var preg1 = /[0-9]+/g;
	        var preg2 = /[a-z]+/g;
	        var preg3 = /[A-Z]+/g;
	        var preg4 = /[\W_]+/g;
	        if(preg1.test(val)){
	            arr.push('数字');
	        }
	        if(preg2.test(val)){
	            arr.push('小写字母');
	        }
	        if(preg3.test(val)){
	            arr.push('大写字母');
	        }
	        if(preg4.test(val)){
	            arr.push('特殊字符');
	        }

	        // 2.然后让指定的li标签变色
	        switch(arr.length){
	            case 1:
	                $('.mima li:eq(0)').css('background','#e63e56');
	                break;
	            case 2:
	                $('.mima li:eq(1)').css('background','#df8322');
	                break;
	            case 3:
	                $('.mima li:eq(2)').css('background','#d7967a');
	                break;
	            case 4:
	                $('.mima li:eq(3)').css('background','#9ed29a');
	                break;
	        }

    	})

        $(':password:first').blur(function(){
            // alert($(this).val());

            if($(this).val().length < 6){
                $('#sp').html('<font color="red">密码过短</font>');
            }

            if($(this).val().length > 18){
                $('#sp').html('<font color="red">密码过长</font>');
            }
        })
            
        function validate(){

            if($(':password:last').val() !==$(':password:first').val()){
                $('#ContentPlaceHolder1_error_tip').html('两次密码输入不一致');
                return false;
            }

            if($('#dengluming').val() == ''){
                $('#ContentPlaceHolder1_error_tip').html('用户名不能为空');
            }
                          
            if ($('#Mobile').val() == '') {
            $('#ContentPlaceHolder1_error_tip').html("手机号不能为空");
            return false;
            }
             if (!$('#fuwuxieyi').attr("checked")) {
            $('#ContentPlaceHolder1_error_tip').html("抱歉！不同意服务协议，不能注册");
            return false;
            }

            return ture;
        }
                
    </script>

    <script type="text/javascript">
        var mobile = document.getElementById('Mobile');
        var phone;
        function sendphone(){
            phone = mobile.value;

            //alert(phone);
            $.ajax({
                type:'get',
                url:"{{ url('/smsphone') }}",
                data:{ phone:phone },
                dataType:'json',
                success: function(data){
                    alert(data);
                }
            });

        }
	</script>
@endsection

