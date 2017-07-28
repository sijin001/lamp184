<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0053)http://www.cfc.com.cn/mall/PayOrder.aspx?orderno=1255 -->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head id="Head1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>中影·国际影城官网|电影|在线预订电影票|电影票团购|中影·国际影城</title>
        <meta name="Keywords" content=""> 
        <meta name="Description" content=""> 
        <meta http-equiv="X-UA-Compatible" content="IE=9">
        <link href="{{ asset('home/css/reset-min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('home/css/main.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('home/css/jquery-ui-1.8.5.custom.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('home/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('home/css/my.css') }}" rel="stylesheet">
        <link href="{{ asset('home/css/shop-branch.css') }}" rel="stylesheet">
        <link href="{{ asset('home/css/shopping.css') }}" rel="stylesheet">
        <link href="{{ asset('home/css/screen.css') }}" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('home/js/require.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('home/js/jquery-1.8.3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('home/js/jquery-ui-1.8.23.custom.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('home/js/Dialog.js') }}"></script>
        <script type="text/javascript" src="{{ asset('home/js/common.js') }}"></script>
        <script type="text/javascript" src="{{ asset('home/js/gotoTop.js') }}"></script>
        <style type="text/css">
            .loading {
                position: fixed;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.1);
                left: 0px;
                top: 0px;
                z-index: 5;
            }
        </style>
    
        <title>

        </title>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="pages/payOrder" src="{{ asset('home/js/payOrder.js') }}"></script>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="lib/io/console" src="{{ asset('home/js/console.js') }}"></script>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="lib/comp/base" src="{{ asset('home/js/base.js') }}"></script>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="lib/dom/queryNode" src="{{ asset('home/js/queryNode.js') }}"></script>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="lib/evt/add" src="{{ asset('home/js/add.js') }}"></script>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="zymall/header" src="{{ asset('home/js/header.js') }}"></script>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="zymall/payOrder/pay" src="{{ asset('home/js/pay.js') }}"></script>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="lib/dom/sizzle" src="{{ asset('home/js/sizzle.js') }}"></script>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="lib/util/getType" src="{{ asset('home/js/getType.js') }}"></script>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="lib/util/each" src="{{ asset('home/js/each.js') }}"></script>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="lib/dom/parseNode" src="{{ asset('home/js/parseNode.js') }}"></script>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="lib/dom/className" src="{{ asset('home/js/className.js') }}"></script>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="lib/dom/getStyle" src="{{ asset('home/js/getStyle.js') }}"></script>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="lib/dom/isElement" src="{{ asset('home/js/isElement.js') }}"></script>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="lib/dom/isNode" src="{{ asset('home/js/isNode.js') }}"></script>
        <script type="text/javascript" charset="utf-8" async="" data-requirecontext="_" data-requiremodule="lib/str/trim" src="{{ asset('home/js/trim.js') }}"></script>
    </head>
    <body>
        <div id="background" class="background" style="display: none;"></div>
        <div id="progressBar" class="progressBar" style="display: none;">数据加载中，请稍等...</div>
        <div id="zhezao" class="loading" style="display: none;">
            <div id="container"></div>
        </div>
<!---头部开始-->

<header class="index-header">
    <div class="header-con">
        <div class="logo">
            <img src="{{ asset('home/images/web-v2/logo_03.png') }}" alt=""></div>

        <div class="address" onclick="changeCityClick()"><a href="javascript:void(0);" id="span_CityName">北京</a><span class="icon-1" id="change"></span></div>

        <!---菜单导航 start-->
        <nav class="index-nav">
            <ul>
                <li id="2"><a href="{{ url('/') }}" title="首页">首 页</a></li>
                <li id="3"><a href="cinema/cinema.aspx" title="购票通道">影 院</a></li>
                <li id="4"><a href="{{ url('/home/movie/get') }}" title="在线购票">在线购票</a></li>
                <li id="5"><a href="{{ url('/goods') }}" title="商城"><span class="icon-2"></span>商城</a></li>
              
                <li id="6"><a href="activity/ActList.aspx" title="优惠活动">优惠活动</a></li>
            </ul>
        </nav>
        <!---菜单导航 end-->

        <div class="land" style="display:none">
            <ul>
                <li>
                    <a href="http://www.cfc.com.cn/user/login.aspx"><span class="icon-3"></span>登录</a>
                </li>
                <li class="register">
                    <a href="http://www.cfc.com.cn/user/reg.aspx">注册</a>
                </li>
            </ul>
        </div>
        <div class="m-header section_r1" style="">
            <div class="m-header my">
                <div node-name="user" class="my-user">
                    <em class="sprite my-user-icon"></em>
                    1364926****<em class="sprite my-user-triangle"></em>
                    <div node-name="userEject" class="my-user-eject" style="display: none;">
                        <p class="" data-url="/user/userInfo.aspx">我的资料</p>

                        <p data-url="/user/ordersManager.aspx">我的订单</p>

                        <p data-url="/user/MemberCardList.aspx">我的卡券</p>

                        <p data-url="/user/pointsList.aspx">我的积分</p>

                        <p data-url="/user/complainList.aspx">我的意见</p>

                        <p data-url="/user/loginout.aspx" class="hover">退出</p>
                    </div>
                </div>

                <div node-name="cart" class="cart">
                    <em class="sprite cart-carticon"></em>
                    <em class="sprite cart-nub">1</em>

                    <div node-name="cartEject" class="my-cart-eject" style="display: none;">
                        <div class="cart-eject-top clearfix">
                            <div class="layout1"></div>
                            <div class="layout2"></div>
                        </div>
                        <div class="cart-eject-contant">
                            <dl><dt><img height="50" width="50" alt="" src="{{ asset('home/js/wKhkTFcg1vaAVHWdAAA62T6ksBA290.jpg"></dt><dd><input type="hidden" name="h_productId" value="116"><input type="hidden" name="h_qty" value="1"><input type="hidden" name="h_price" value="108.00"><p style="width:180px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">星球大战E7武士公仔</p><h3>¥108.00<br> 删除</h3></dd></dl><h2><span>共<i id="i_count">1</i>件商品<br>合计：<i id="i_totalPrice">¥108.00</i></span><samp><a class="cart-but" href="javascript:void(0)">去购物车结算</a></samp> </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


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
            <div class="m-mall-con-order-header sprite" style="background-position:0 -63px;"></div>
            <div class="order-con-submit" id="orderInfo">
                <h2>订单已提交成功，请在<span><em class="time sprite"></em><em id="paytimeoutShow">00:08:09</em></span>内完成支付，否则订单将自动取消。</h2>
                 
                <p><span>订单金额：<span><i>￥<?php echo ($list->price) * $num . '.00'; ?></i></span></span></p>

                <p><span>订单编号：</span><samp>1255</samp></p>

                <p><span>配送地址：</span><samp>郭颖妲， 13649267750，
                    <br>北京市北京市昌平区兄弟连育荣教育园，不限送货时间</samp></p>
            </div>
            <div class="order-con-order">
                <div node-name="payType">
          
                    <div class="title"><em class="checkbox sprite hover"></em>选择支付方式</div>
                </div>
                <div class="contant">
                    <div class="contant-top" node-name="payCard">
                        <ul>
                            
                            <li class="hover">第三方支付</li>
                        </ul>
                    </div>
                    <div class="contant-bottom">
                        <div class="business-con-top">
                              
                                             <span><input name="pay" type="radio" value="ALIPAY10" class="radio"><em class="bank-bg1 sprite"></em></span>
                                        
                                            <span><input name="pay" type="radio" value="WEIXIN" checked="checked" class="radio"><em class="bank-bg2 sprite"></em></span>
                                        
                                             <span><input name="pay" type="radio" value="CCB" class="radio"><em class="bank-bg3 sprite"></em></span>
                                                             
                        </div>
                        <p>您还需支付:<span>￥<?php echo ($list->price) * $num . '.00'; ?></span><a onclick="payorder()" class="but" style="text-decoration:none;cursor:pointer;">立即支付</a></p>
                    </div>
                </div>
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

        var paychenal = $('input:radio[name="pay"]:checked').val();
        if (paychenal == null || paychenal == undefined || paychenal=="")
        {
            showAlert("请选择支付方式！");
            return;
        }

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


        

<footer class="index-footer">
			<div class="pro-box">
                <img style=" margin-top: 50px;
            margin-right: 50px;float: left;display: block;" class="codePic" src="{{ asset('home/js/doubleCode.jpg">
				<ul style="float: left;width: 840px;">
					<li>
						<h3>新手上路</h3>
						<p><a href="http://www.cfc.com.cn/help/helpreg.aspx#num1">注册登录问题</a></p>
						<p><a href="http://www.cfc.com.cn/help/helpreg.aspx#num2">用户绑定会员卡问题</a></p>
						<p><a href="http://www.cfc.com.cn/help/helpreg.aspx#num3">影票相关问题</a></p>
						<p><a href="http://www.cfc.com.cn/help/helpreg.aspx#num4">票价和支付问题</a></p>
						<p><a href="http://www.cfc.com.cn/help/helpreg.aspx#num5">取票凭证码问题</a></p>
                        <p><a href="http://www.cfc.com.cn/help/helpcenter.aspx">服务中心</a></p>
					</li>
					<li>
						<h3>购票指南</h3>
                        <p><a href="http://www.cfc.com.cn/help/helpgoseat.aspx#num1">用户购票流程</a></p>
                        <p><a href="http://www.cfc.com.cn/help/helpgoseat.aspx#num2">取票观影指南</a></p>
                        <p><a href="http://www.cfc.com.cn/help/helpgoseat.aspx#num3">会员卡支付相关说明</a></p>
                        <p><a href="http://www.cfc.com.cn/help/helpgoseat.aspx#num4">网银支付相关说明</a></p>
					</li>
					<li>
						<h3>用户中心</h3>
						<p><a href="http://www.cfc.com.cn/help/helpcenter.aspx#num1">购物流程</a></p>
                        <p><a href="http://www.cfc.com.cn/help/helpcenter.aspx#num2">常见问题</a></p>
                        <p><a href="http://www.cfc.com.cn/help/helpcenter.aspx#num3">发票制度</a></p>
                        <p><a href="http://www.cfc.com.cn/help/helpcenter.aspx#num4">支付方式 </a></p>
                        <p><a href="http://www.cfc.com.cn/help/helpcenter.aspx#num5">配送方式 </a></p>
                        <p><a href="http://www.cfc.com.cn/help/helpcenter.aspx#num6">售后服务 </a></p>
                        <p><a href="http://www.cfc.com.cn/help/helpcenter.aspx#num7">退货政策 </a></p>
                        <p><a href="http://www.cfc.com.cn/help/helpcenter.aspx#num8">联系我们 </a></p>
					</li>
					<li>
						<h3>会员权益</h3>
						<p><a href="http://www.cfc.com.cn/help/helpmember.aspx#num1">会员订票权益</a></p>
                        <p><a href="http://www.cfc.com.cn/help/helpmember.aspx#num2">会员积分权益</a></p>
                        <p><a href="http://www.cfc.com.cn/help/helpmember.aspx#num3">入会资格</a></p>
                        <p><a href="http://www.cfc.com.cn/help/helpmember.aspx#num4">会员卡折扣说明</a></p>
					</li>
                    <li>
						<h3>手机客户端</h3>
						<p><a href="http://www.cfc.com.cn/appclient/client.aspx">手机客户端介绍与下载</a></p>
                        <p><a href="http://www.cfc.com.cn/#">影片信息查询</a></p>
                        <p><a href="http://www.cfc.com.cn/#">手机自助购票</a></p>
					</li>
				</ul>
                 <div class="clear" style="clear: both;"></div> 
			</div>

			<div class="links-box">
				<ul>
					<li><a href="http://www.cfc.com.cn/common/aboutus.aspx">关于中影</a></li>
					<li><a href="http://www.cfc.com.cn/common/contactus.aspx">联系方式</a></li>
					<li><a href="http://www.cfc.com.cn/common/addservice.aspx">服务协议 </a></li>
					<li><a href="http://www.cfc.com.cn/common/complaint.aspx">会员协议 </a></li>
					<li><a href="http://www.cfc.com.cn/common/hr.aspx">市场合作 </a></li>
                    <li><a href="http://www.cfc.com.cn/common/privacy.aspx">隐私条款 </a></li>
					<li style="border-right: 0;"><a href="http://www.cfc.com.cn/common/pre.aspx">免责声明</a></li>

				</ul>
			</div>
			<div class="copyright">
                Copyright © 2007 -
                2017
                ChinaFilm All rights reserved.<a href="http://www.miitbeian.gov.cn/state/outPortal/loginPortal.action">京ICP备15040734号-1 </a>中影影院投资有限公司 版权所有

                
                <script type="text/javascript">
                    var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
                    document.write(unescape("%3Cspan id='cnzz_stat_icon_1000542813'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s23.cnzz.com/z_stat.php%3Fid%3D1000542813%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));
                </script><span id="cnzz_stat_icon_1000542813"><a href="http://www.cnzz.com/stat/website.php?web_id=1000542813" target="_blank" title="站长统计"><img border="0" hspace="0" vspace="0" src="{{ asset('home/js/pic1.gif"></a></span><script src="{{ asset('home/js/z_stat.php" type="text/javascript"></script><script src="{{ asset('home/js/core.php" charset="utf-8" type="text/javascript"></script>
                </div>
		</footer>

        <script type="text/javascript">
            $(function () {
                $(".backToTop").goToTop();
                $(window).bind('scroll resize', function () {
                    $(".backToTop").goToTop({
                        pageWidth: 1210,
                        duration: 0
                    });
                });
            });

        </script>
    </form>




<a href="javascript:;" class="backToTop" title="返回顶部" style="display: none; position: fixed; top: 434px; left: 1366.5px;">返回顶部</a></body></html>