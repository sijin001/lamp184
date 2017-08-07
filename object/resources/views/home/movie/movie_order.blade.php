<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0060)http://www.cfc.com.cn/buy/buyinfo.aspx?orderno=ZY10014057657 -->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head id="Head1"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>中影·国际影城官网|电影|在线预订电影票|电影票团购|中影·国际影城</title>
        <meta name="Keywords" content=""> 
        <meta name="Description" content=""> 
        <meta http-equiv="X-UA-Compatible" content="IE=9">
        <link href="{{ asset('home/css/reset-min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('home/css/main.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('home/css/inside_pages.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('home/css/jquery-ui-1.8.5.custom.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('home/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('home/css/my.css') }}" rel="stylesheet">
        <link href="{{ asset('home/css/screen.css') }}" rel="stylesheet">
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
        
        <link href="{{ asset('home/css/ticket.css') }}" rel="stylesheet" type="text/css">

        <script type="text/javascript">
            // window.alert = function(msg) {
            //     showAlert(msg);
            // };
            //获取手机号
            function getMobile() {
                return '153****3355'
            }
        </script>

        <style type="text/css">
            .card_input input {
                padding: 7px 0 7px 30px;
            }

            .pay_disabled {
                background: #ccc !important;
            }

            .coupon_select {
                background: url(/resource/images/select.png);
                height: 24px;
                display: inline-block;
                width: 24px;
                margin-left: 12px;
                cursor: pointer;
            }

            .coupon_unselect {
                background: url(/resource/images/unselect.png);
                height: 24px;
                display: inline-block;
                width: 24px;
                margin-left: 12px;
                cursor: pointer;
            }

            #my_couponList li {
                padding-left: 10px;
            }
        </style>
    </head>
    <body>
        <!-- <form method="post" action="http://www.cfc.com.cn/buy/buyinfo.aspx?orderno=ZY10014057657" id="form1" target="_blank"> -->
            <div class="aspNetHidden">
                <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUJMjQ4MTc5MzkxZGQ=">
            </div>
            <div id="zhezao" class="loading" style="display: none;">
                <div id="container"></div>
            </div>
            <!---头部开始-->
            <header class="index-header">
                <div class="header-con">
                    <div class="logo">
                        <img src="{{ asset('admin/upload/config/'.session('config')->logo) }}" alt=""></div>

                    <div class="address" onclick="changeCityClick()"><a href="javascript:void(0);" id="span_CityName"></a><span class="" id="change"></span></div>
                    

                    <!---菜单导航 start-->
                    <nav class="index-nav">
                        <ul>
                            <li id="2"><a href="{{ url('/') }}" title="首页">首 页</a></li>
                            <li id="3"><a href="{{ url('/home/movieplace') }}" title="购票通道">影 院</a></li>
                            <li id="4"><a href="{{ url('/home/movie/get') }}" title="在线购票">在线购票</a></li>
                            <li id="5"><a href="{{ url('/goods') }}" title="商城"><span class="icon-2"></span>商城</a></li>
                          
                            <li id="6"><a href="{{ url('/') }}" title="优惠活动">优惠活动</a></li>
                        </ul>
                    </nav>
                    <!---菜单导航 end-->
                    @if(!session('user'))
                    <div class="land" style="">
                        <ul>
                            <li>
                                <a href="{{ url('/login') }}"><span class="icon-3"></span>登录</a>
                            </li>
                            <li class="register">
                                <a href="{{ url('/regist') }}">注册</a>
                            </li>
                        </ul>
                    </div>
                    @else    
                    <div class="m-header section_r1" >
                        <div class="m-header my">
                            <div node-name="user" class="my-user">
                               <em class="sprite my-user-icon"></em>
                                {{ session('user')->name }}
                                <span id="spano"><em class="sprite my-user-triangle"></em> </span>
                                <div node-name="userEject" class="my-user-eject" style="display: none;">
                                    <p><a href="{{ url('home/user')}}" style="font-size:14px">我的资料</a></p>
                                    <p><a href="{{ url('home/order') }}" style="font-size:14px"><p>我的订单</a></p>
                                    <!-- <p><a href="{{ url('home/score') }}" style="font-size:14px"><p>我的积分</a></p> -->
                                    <p><a href="{{ url('home/over') }}" style="font-size:14px">退出</a></p>
                                </div>  
                            </div>
                            <div node-name="cart" class="cart">
                                <a href="{{ url('home/gouwu/'.session('user')->id) }}"><em class="sprite cart-carticon"></em>
                                <em class="sprite cart-nub">0</em></a>
                                <div node-name="cartEject" class="my-cart-eject" style="display: none;">
                                    <div class="cart-eject-top clearfix">
                                        <div class="layout1"></div>
                                        <div class="layout2"></div>
                                    </div>
                                    <div class="cart-eject-contant">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </header>
            <!---头部结束-->
            <script type="text/javascript">
                $('#spano').bind('click',function(){
                    $('.my-user-eject').slideToggle();
                })
            </script>
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
            <div class="warpc">
                <div class="contCon">
                    <span class="ls"></span><span class="rs"></span>
                    <div class="ticsteps  tic3">
                    </div>
                    <!--steps-->
                    <div class="t_con cf">
                        <div class="t_tit cf">
                            <em></em>订单信息
                        </div>
                        <!--t_tit-->
                        <div class="t_detail cf ">
                            <div class="tinfo1">
                                <img src="{{ asset('admin/upload/movie/'.$list[0]->title_pic ) }}" width="95" height="133">
                                <h4>
                                    {{ $list[0]->title }}</h4>
                                <p>
                                    国家：{{ $list[0]->country }}
                                </p>
                                <p>
                                    类型： {{ $list[0]->format }}
                                </p>
                                <p>
                                    片长：{{ $list[0]->length }}
                                </p>
                            </div>
                            <!--tinfo1-->
                            <div class="tinfo2">
                                <p>
                                    影院：横店电影城(王府井店)
                                </p>
                                <p>
                                    场次：{{ $list[0]->date }} {{ $list[0]->time }}
                                </p>
                                <p>
                                    取票手机号：<span id="spanMobile">{{ $arr['input'] }}</span>
                                </p>
                            </div>
                            <div class="tinfo3">
                                <p>
                                    您选择的座位：
                                </p>
                                <p>
                                    <?php  
                                        $str = $arr['myseat'];
                                        $array = explode('_',"$str");
                                        array_pop($array);
                                        $st = '';
                                        $num = count($array);
                                        foreach($array as $val){
                                            $st = $st.$list[0]->rname.$val.' &nbsp&nbsp ';
                                        }
                                        echo $st;
                                     ?>
                                </p>
                                
                            </div>
                        </div>
                        <!--t_detail-->
                        <div class="cf">
                            <div class="ticketTips cf fr mt10">
                                <span class="iconTips"></span>
                                <p>
                                    取票短信可能会被手机软件拦截；
                                </p>
                                <p>
                                    请在10分钟内完成付款
                                </p>
                            </div>
                            <!--ticketTips-->
                        </div>
                        <div class="boxLayer" style="display: none">
                            <img src="{{ asset('home/images/18.gif') }}" width="32" height="32">
                        </div>
                        <div class="pay_con">
                            <div id="coupondiv">
                                <h5 class="psy_tit" style="cursor: default">
                                <div id="payCouponDetail" class="payDetail" style="display: none">
                                    
                                    <div>
                                        <p id="checkResult" class="ft14 mt10">
                                            
                                        </p>
                                        <input id="btnCoupon" type="button" class="kbtn" onclick="checkCoupon();" value="验证">
                                    </div>

                                </div>
                            </div>
                            <div id="payOtherDetail" class="payDetail">
                                <ul class="pay_tit cf mt20">
                                    <li onclick="otherPayChane(2)" class="current" style="cursor: pointer">第三方支付</li>
                                    
                                </ul>
                                <div class="payCon" id="payUnion" style="">
                                    <div class="input_area cf">
                                        
                                        <input id="rdoPayALIPAY10" name="radio1" type="radio" value="ALIPAY10" onclick="paychannelselect(&#39;ALIPAY10&#39;)"><label for="rdoPayALIPAY10"><span class="payzfb"></span></label>
                                                
                                        <input id="rdoPayWEIXIN" name="radio1" type="radio" value="WEIXIN" checked="checked" onclick="paychannelselect(&#39;WEIXIN&#39;)"><label for="rdoPayWEIXIN"><span class="paywx"></span></label>
                                                
                                        <input id="rdoPayCCB" name="radio1" type="radio" value="CCB" onclick="paychannelselect(&#39;CCB&#39;)"><label for="rdoPayCCB"><span class="payccb"></span></label>
                                                
                                    </div>
                                    <div class="pay_det cf">
                                        <div class="pay_detext" style="width: 100%">
                                            <p class="grey">
                                                票　价：<em class="red">￥</em><em class="red" id="orderprice">{{ $list[0]->price }}</em>元/张
                                            </p>
                                            <p class="grey">
                                                服务费：<em class="red">￥</em><em class="red" id="ordercharge">0.00</em>元/张  
                                            </p>
                                            <p class="grey">
                                                卖  品：<em class="red">￥</em><em class="red" id="sorderprice">0.00</em>元
                                            </p>
                                            <p class="grey">
                                                会员优惠：<em class="red">￥</em><em class="red nopay" name="m_price" id="memberDiscount">0.00</em>元
                                            </p>
                                            <p class="grey">
                                                实付款：<em class="red">￥</em><em class="red nopay" id="upoppay">{{ $arr['myprice'] }}</em>元
                                            </p>
                                            <em class="sid" style="display:none;">{{ $list[0]->id }}</em>
                                            <em class="myseat" style="display:none;">{{ $arr['myseat'] }}</em>
                                            <input type="button" class="kbtn" onclick="unionPay()" value="立即支付">
                                            <input type="button" class="kbtn" onclick="BreakOrCancelOrder(&#39;1&#39;)" value="返回重选">
                                            <input type="button" class="kbtn" onclick="BreakOrCancelOrder(&#39;2&#39;)" value="取消订单">
                                            <span id="uid" style="display:none;">{{ session('user')->id }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--payDetail-->
                        </div>
                    </div>
                </div>
            <!--contTet-->
            </div>
            <footer class="index-footer">
                <div class="pro-box">
                    <img style=" margin-top: 50px;
                margin-right: 50px;float: left;display: block;" class="codePic" src="{{ asset('home/images/doubleCode.jpg') }}">
                    <ul style="float: left;width: 840px;margin-top: 30px;">
                        <?php $link = session('link');?>
                        @foreach($link as $v)
                        <li style="margin-top:5px">
                            <p><a href="{{ $v->url }}" target="_blank">{{ $v->title }}</a></p>
                        </li>
                        @endforeach
                    </ul>
                    <div class="clear" style="clear: both;"></div> 
                </div>
                <div class="links-box">
                    <ul>
                        <li><a href="#">关于中影</a></li>
                        <li><a href="#">联系方式</a></li>
                        <li><a href="#">服务协议 </a></li>
                        <li><a href="#">会员协议 </a></li>
                        <li><a href="#">市场合作 </a></li>
                        <li><a href="#">隐私条款 </a></li>
                        <li style="border-right: 0;"><a  href="#">免责声明</a></li>
                    </ul>
                </div>
                <div class="copyright">
                    Copyright © 2007 -
                    2017
                    ChinaFilm All rights reserved.<a href="../www.miitbeian.gov.cn/state/outPortal/loginPortal.action">京ICP备15040734号-1 </a>中影影院投资有限公司 版权所有
                    
                    <script type="text/javascript">
                        var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
                        document.write(unescape("%3Cspan id='cnzz_stat_icon_1000542813'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s23.cnzz.com/z_stat.php%3Fid%3D1000542813%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));
                    </script>
                </div>
            </footer>
            <script type="text/javascript">

                function unionPay(paychannel, paymethod) {
                    var paychannel=$("input[name='radio1']:checked").val();
                    var paymethod=$("input[name='radio1']:checked").val();
                    // 获取总价
                    allprice=$("#upoppay").html();

                    //获取电影场次id
                    var sid = $('.sid').html();
                    var uid = $('#uid').html();
                    var seat = $('.myseat').html();
                    var phone = $('#spanMobile').html();
                    var myDate = new Date();
                    var number = myDate.getTime()+Math.floor(Math.random()*10).toString();
                     
                    var url = "{{ url('/home/movieajax') }}";
                    $.ajax({
                        type: "POST",
                        async: false,
                        cache: false,
                        url: url, //提交到一般处理程序请求数据
                        data:{number:number,uid:uid,sid:sid,seat:seat,phone:phone,allprice:allprice,'_token':"{{ csrf_token() }}"},
                        success: function(data) {
                            if(data == 'false'){
                                alert('订单失败,请重新选座!');
                                window.location.href = "/home/movie/get";
                            }else{
                                window.location.href = "/home/movieajax/"+data ;
                            }
                        },
                        error: function(msg, url, line) {
                            alert('对不起，支付失败,请稍后再试！');
                        }
                    });
                }
                
                //1返回重选 2取消订单
                function  BreakOrCancelOrder(value){      
                    
                    window.location.href = (value==1? "{{ url('/home/movie/seat/'.$list[0]->id)}}" : "{{ url('/home/movie/get')}}");
                                
                }

                //订单已经超过支付时间
                function SetTimeOut() {
                    SetOrderStatus(2);
                    $("#payCouponDetail").hide();
                    $("#payOtherDetail").hide();
                    $("#payOther").attr("class", "radioOff").attr("onclick", "");
                    $("#payCoupon").attr("class", "radioOff").attr("onclick", "");
                    $("#payCouponH5").attr("onclick", "");
                    $("#payOtherH5").attr("onclick", "");

                    $("#payStellarCouponDetail").hide()
                    $("#payStellarCoupon").attr("class", "radioOff").attr("onclick", "");
                    $("#payStellarCouponH5").attr("onclick", "");

                }
                var _goodsId="";
                function selectItem(obj){
                    var code= $(obj).parent().attr("data-id");
                    var goodsId= $(obj).parent().attr("goodsId");
                    if(_goodsId=="")
                        _goodsId= $(obj).parent().attr("goodsId");

                    if($(obj).hasClass("coupon_select")){
                        if(code!="" && code!="undefined"){
                            //如果是取消，则清除验证信息
                            var status= $(obj).prev().attr("data-status");
                            if(status!="3"){
                                $(obj).removeClass("coupon_select").addClass("coupon_unselect");
                                $(obj).prev().attr("data-status","");
                                $(obj).prev().html("[未验证]");
                                btnCouponChange(false);
                            }
                        }

                        //如果全部取消，则还原所有信息
                        var length= $("#my_couponList li span.coupon_select").length; 
                        if(length==0){
                            $("#my_couponList li").each(function(){
                                $(this).find("em:eq(3)").attr("data-status","");
                                $(this).find("em:eq(3)").html("[未验证]");
                            })
                        }
                    }
                    else{
                        $(obj).removeClass("coupon_unselect").addClass("coupon_select");
                        btnCouponChange(false);
                    }
                }
            </script>
            <script>
                $(function() {
                    $(".backToTop").goToTop();
                    $(window).bind('scroll resize', function() {
                        $(".backToTop").goToTop({
                            pageWidth: 1030,
                            duration: 0
                        });
                    });
                });
            </script>
        <!-- </form> -->
        <a href="javascript:;" class="backToTop" title="返回顶部" style="display: inline; position: fixed; top: 503px; left: 1228.5px;">返回顶部</a>
    </body>
</html>