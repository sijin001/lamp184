@extends('home.parent')
 @section('content')
<script type="text/javascript" language="javascript">
    //选择城市操作
    $("#change").click(function () {
        $(".City_list").show();
        var cityNo = getCookie("_CityNo_");
        if (cityNo != "") {
            $("#" + cityNo).attr("class", "sel");
        }
    });
    function changeCityClick() {
        $(".City_list").show();
        var cityNo = getCookie("_CityNo_");
        if (cityNo != "") {
            $("#" + cityNo).attr("class", "sel");
        }
    }
    $(".City_list").mouseleave(function () {
        $(".City_list").hide();
    });

    //切换城市
    function ChangCity(id) {
        var str = $("#" + id).html();
        if (str.length > 4) {
            str = str.substr(0, 4);
        }
        $("#span_CityName").html(str);
        setCookie("_CityName_", encodeURI(str));
        setCookie("_CityNo_", encodeURI(id));
        // window.location.href = '../index.aspx';
        var urls = window.location.href;
        if (urls != "" && urls.indexOf("movie.aspx") != -1 && urls.indexOf("?") == -1) {    //影片页面
            window.location.href = window.location.href;
        } else if (urls != "" && urls.indexOf("cinema.aspx") != -1 && urls.indexOf("?") == -1) {    //影院页面
            window.location.href = window.location.href;
        } else if (urls != "" && urls.indexOf("schedule.aspx") != -1) { //排期查询页面
            //window.location.href = window.location.href;
            window.location.href = "schedule.aspx";
        } else if (urls != "" && urls.indexOf("exticket_list.aspx") != -1) { //活动促销页面
            window.location.href = window.location.href;
        }
        else if (urls != "" && urls.indexOf("mall") != -1) { //商城页
            window.location.href = window.location.href;
        }
        else {
            window.location.href = '../index.aspx';
        }

    }

    //设置默认值
    if (getCookie("_CityName_") != null) {
        $("#span_CityName").html(getCookie("_CityName_"));

    } else {
        setCookie("_CityName_", encodeURI("北京"));
        setCookie("_CityNo_", encodeURI("110100"));
    }

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
                <h5>用户登录</h5>
                     <form method="post" action="{{ url('/login') }}" id="form1" onsubmit="return validate() ">
                     {{ csrf_field() }}
                            <div class="inputArea" style="margin: 10px 0 0 0;">
                                <div class="cf" style="padding-left: 65px">
                                                <!--判断之后带过来参数显示信息-->
                                                    <h2 style="color:red;">
                                                        @if(session('msg'))
                                                        {{ session('msg') }}
                                                        @endif
                                                    </h2>
                                    <span id="ContentPlaceHolder1_error_tip" class="onError"></span>
                                </div>
                                    <p>
                                        <span>用户名：</span>
                                        <input name="name" type="text" id="name" class="tex user"  style="color: #666" maxlength="11"  onafterpaste="value=value.replace(/\D/g,&#39;&#39;)" />
                                    </p>
                                    <p>
                                        <span>密 码：</span>
                                        <input name="pass" type="password" id="pass" class="tex pw wid195" />
                                        <a href="retrPwd.aspx" class="red">忘记密码?</a>
                                    </p>
                                    <p>
                                        <span>验证码：</span>
                                        <input name="checkcode" type="text" id="checkcode" class="tex user wid195" />
                                         <img src="{{ url('/capth/'.time()) }}" onclick="this.src='{{ url('/capth') }}/'+Math.random()">
                                    </p>
                                    <p>
                                        <span></span>
                                         
                                       <input  type="submit" id="login" class="kbtn" value="登录" />
                                       <a href="{{ url('/regist') }}" class="red">立即注册</a>
                                    </p>
                            </div>
                        </form>
            </div>
        </div>
    </div>
        <script type="text/javascript">
            // window.onload = function() {
            //     ChangCode();
            // };
            // function ChangCode() {
            //     document.getElementById("Image1").src = 'checkCode.aspx@id=' + Math.random();
            // }
            $('#ContentPlaceHolder1_txtName').focus(function() {
                if (this.value == "用户名/手机号")
                    this.value = "";
            });
            $('#ContentPlaceHolder1_txtName').blur(function() {
                if (this.value == "")
                    this.value = "用户名/手机号";
            });
        
        $(function() {
            //回车登陆
            $('#ContentPlaceHolder1_txtCheckCode').bind("onkeydown", function(event) {debugger 
                e = event ? event : (window.event ? window.event : null);
                if (e.keyCode == 13) {
                    $('#ContentPlaceHolder1_btnLogin').click();
                }
            });
        });
        function validate() { 
                        var uname = $('#name').val();
                        var password = $('#pass').val();
                        var code = $('#checkcode').val();
                        var errorTip = $('#ContentPlaceHolder1_error_tip');
                        // 用户名和密码都未输入
                        if ((uname == '手机号' || uname == '') && password == '') {
                            errorTip.html("请输入用户名、密码");
                            return false;
                        }
                        // 用户名输入、密码未输入
                        if ((uname != '手机号' || uname == '') && password == '') {
                            errorTip.html("登录信息与密码不匹配");
                            return false;
                        }
                        // 用户名未输入、密码输入
                        if ((uname == '手机号' || uname == '') && password != '') {
                            errorTip.html("登录信息与密码不匹配");
                            return false;
                        }
                        // 验证码不能为空
                        if (code == '') {
                            errorTip.html("请输入验证码");
                            return false;
                        }
                        errorTip.html('');
                        return true;
        }
    </script>


        
        

 @endsection