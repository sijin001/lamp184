@extends('home.parent')
@section('content')

<!---头部结束-->

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
    <div class="pbd m-mall-bg">
        <div class="m-mall-con" id="m_pay">
            <div class="m-mall-con-order-header sprite" style="background-position:0 0px;"></div>
            <div class="order-con-submit" id="orderInfo">
                <h2>恭喜！ 订单已支付成功。</h2>  
            </div>
        </div>
    </div>
        
    <script type="text/javascript">
        require.config({
            baseUrl: "/resource/js/mall/src",
            urlArgs: "__ts=" + new Date().getTime()
        });

        require(["pages/payOrder"], function (page) {
            page.init();
        });

        var expirTime ='2017/7/27 20:47:55';
        var orderNo=1255;
        var paytimeout=598.8999206;    
        $(function(){
            funTime();

            $(".business-con-top span").bind("click",function(){
                var index=$(this).index();
                $(".business-con-top span input").attr("checked");
                $(".business-con-top span input:eq("+index+")").attr("checked",true);
                //  alert($(this).index());
            });
        });

        function funTime () {   
            paytimeout=paytimeout-1;
            if(paytimeout<=0)
            {
                setTimeOut();
                return;
            }
            $("#paytimeoutShow").html(formatTime(paytimeout));

            setTimeout(funTime, 1000);
        };

        function setTimeOut()
        {
            $("#orderInfo h2").html("订单已超时！");
            $(".order-con-order").html("");
        }

        function payorder()
        {
            var uid = $('#uid').html();
            $.ajax({
                type: "POST",
                dataType: "json",
                async: false,
                url: "/mall/PayOrder.ashx",      //提交到一般处理程序请求数据
                data: {action:'PayOrder',orderNo:orderNo,payChenal:paychenal},
                success: function (data) {
                    if (data != null) {

                        if (data.error == "1") { //判断订单状态
                            window.location.href = "/mall/PaySuccess.aspx?type=3&orderno="+orderNo;
                        } 
                        else if (data.error == "0") { //判断订单状态
                            if(paychenal!='WEIXIN')
                            {
                                openDialog("/buy/payresult.aspx?type=3&orderno="+orderNo, 555, 246, "温馨提示");
                                OpenUrl(data.PayUrl);
                            }else{
                             
                                openDialog(data.PayUrl,580, 483, "微信支付");
                            }
                        } 
                        else {
                            showAlert(data.msg);
                        }
                    }
                },
                error: function () { showAlert('支付异常，请稍后再试！');}
            
            });


        }
    </script>
@endsection