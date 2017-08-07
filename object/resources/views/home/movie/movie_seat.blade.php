<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0056)http://www.cfc.com.cn/buy/goseat.aspx?seqno=171028184883 -->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head id="Head1"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>中影·国际影城官网|电影|在线预订电影票|电影票团购|中影·国际影城</title>
        <meta name="Keywords" content=""> 
        <meta name="Description" content=""> 
        <meta http-equiv="X-UA-Compatible" content="IE=9">
        <link href="{{ asset('home/css/reset-min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('home/css/main.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('home/css/inside_pages.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('home/css/ui-lightness/jquery-ui-1.8.5.custom.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('home/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('home/css/my.css') }}" rel="stylesheet">
        <link href="{{ asset('home/css/screen.css') }}" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('home/js/jquery-1.8.3.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('home/js/plugins/jquery-ui-1.8.23.custom.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('home/js/comm/common.js') }}"></script>
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
        <link href="{{ asset('home/css/js.css') }}" rel="stylesheet" type="text/css">

        <script src="{{ asset('home/js/comm/StringBuilder.js') }}" type="text/javascript"></script>

        <script src="{{ asset('home/js/plugins/jquery.mCustomScrollbar.js') }}" type="text/javascript"></script>
    </head>
    <body>
        <div class="aspNetHidden">
        <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="">
        </div>
        <div id="zhezao" class="loading" style="display: none;">
            <div id="container"></div>
        </div>
        <!---头部开始-->

        <header class="index-header">
            <div class="header-con">
                <div class="logo">
                    <img src="{{ asset('admin/upload/config/'.session('config')->logo) }}" alt="">
                </div>

                <div class="address" onclick="changeCityClick()"><a href="javascript:void(0);" ></a><span id="change"></span></div>
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
                            <span id="spano">
                                <em class="sprite my-user-triangle"></em>
                            </span>
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
                                <div id="myseats">{{ $arrStr }}</div>
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
            $(document).ready(function() {
                var str = $('#myseats').html();
                var arr = JSON.parse(str);
                for (var x in arr) {
                    $('.number').each(function() {
                        if(parseInt($(this).html()) == x) {
                            for (var i = 0; i < arr[x].length; i++) {
                                $(this).parent().siblings().each(function() {
                                    if($(this).find('span').attr('columnno') == arr[x][i]) {
                                        var str = `<img width="20" height="20" alt="" src="{{ asset('home/images/seat2.jpg') }}">`;
                                        $(this).find('span').remove('img');
                                        $(this).find('span').html(str);
                                    }
                                });
                            }
                        }
                    });
                }
            });
            

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
        </script>
        <div class="warpc">
            <div class="contCon">
                <span class="ls"></span><span class="rs"></span>
                <div class="ticsteps tic2">
                </div>
                <!--steps-->
                <div class="seatWarp cf">
                    <div class="seatWarpL">
                        <div class="seatinfo mt20">
                            <span class="seat1">可选座位 </span><span class="seat2">已售座位</span><span class="seat3">
                                情侣座</span><span class="seat4"> 您选择的座位</span><span class="seat5"> 正在维修</span>
                        </div>
                        <div class="scr_tit mt15">
                            <h4>请连续选座位，不要留下单独空闲座位
                            </h4>
                            <h5 class="f18 align_c mt10">银幕</h5>
                        </div>
                        <div class="seatAreacon">
                            <!-- <div class="boxLayer" style="">
                                <img src="{{ asset('home/images/18.gif') }}" width="32" height="32">
                            </div> -->
                            <div id="examples">
                                <div class="meauS ">
                                    <div class="seatArea  demo-x" style="text-align: center">
                                        <div class="seatCon" style="width: 450px;"><div data-sectionid="1">
                                            <div class="js-section-name" style="margin: 20px 0px 10px 40px; text-align: left;"></div>
                                            <dl class="cf" sectionid="1"> 
                                                <dd><em class="number">1</em></dd>
                                                <dd><span status="0" columnno="12" seatno="1MY1MY12MY844"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="11" seatno="1MY1MY11MY845"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="10" seatno="1MY1MY10MY846"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="9" seatno="1MY1MY9MY847"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="8" seatno="1MY1MY8MY848"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="7" seatno="1MY1MY7MY849"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="6" seatno="1MY1MY6MY850"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="5" seatno="1MY1MY5MY851"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="4" seatno="1MY1MY4MY852"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="3" seatno="1MY1MY3MY853"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="2" seatno="1MY1MY2MY854"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="1" seatno="1MY1MY1MY855"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span></span></dd>
                                                <dd><span></span></dd>
                                            </dl>
                                            <dl class="cf" sectionid="1"> 
                                                <dd><em class="number">2</em></dd>
                                                <dd><span status="0" columnno="12" seatno="1MY2MY12MY858"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="11" seatno="1MY2MY11MY859"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="10" seatno="1MY2MY10MY860"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="9" seatno="1MY2MY9MY861"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="8" seatno="1MY2MY8MY862"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="7" seatno="1MY2MY7MY863"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="6" seatno="1MY2MY6MY864"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="5" seatno="1MY2MY5MY865"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="4" seatno="1MY2MY4MY866"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="3" seatno="1MY2MY3MY867"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="2" seatno="1MY2MY2MY868"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="1" seatno="1MY2MY1MY869"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span></span></dd>
                                                <dd><span></span></dd>
                                            </dl>
                                            <dl class="cf" sectionid="1"> 
                                                <dd><em class="number">3</em></dd>
                                                <dd><span status="0" columnno="12" seatno="1MY3MY12MY872"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="11" seatno="1MY3MY11MY873"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="10" seatno="1MY3MY10MY874"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="9" seatno="1MY3MY9MY875"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="8" seatno="1MY3MY8MY876"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="7" seatno="1MY3MY7MY877"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="6" seatno="1MY3MY6MY878"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="5" seatno="1MY3MY5MY879"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="4" seatno="1MY3MY4MY880"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="3" seatno="1MY3MY3MY881"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="2" seatno="1MY3MY2MY882"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="1" seatno="1MY3MY1MY883"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span></span></dd>
                                                <dd><span></span></dd>
                                            </dl>
                                            <dl class="cf" sectionid="1"> 
                                                <dd><em class="number">4</em></dd>
                                                <dd><span status="0" columnno="12" seatno="1MY4MY12MY886"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="11" seatno="1MY4MY11MY887"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="10" seatno="1MY4MY10MY888"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="9" seatno="1MY4MY9MY889"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="8" seatno="1MY4MY8MY890"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="7" seatno="1MY4MY7MY891"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="6" seatno="1MY4MY6MY892"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="5" seatno="1MY4MY5MY893"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="4" seatno="1MY4MY4MY894"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="3" seatno="1MY4MY3MY895"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="2" seatno="1MY4MY2MY896"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="1" seatno="1MY4MY1MY897"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span></span></dd>
                                                <dd><span></span></dd>
                                            </dl>
                                            <dl class="cf" sectionid="1"> 
                                                <dd><em class="number">5</em></dd>
                                                <dd><span status="0" columnno="12" seatno="1MY5MY12MY900"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="11" seatno="1MY5MY11MY901"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="10" seatno="1MY5MY10MY902"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="9" seatno="1MY5MY9MY903"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="8" seatno="1MY5MY8MY904"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="7" seatno="1MY5MY7MY905"><img width="20" height="20" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}" onclick="clickSeat(this)"></span></dd>
                                                <dd><span status="0" columnno="6" seatno="1MY5MY6MY906"><img width="20" height="20" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}" onclick="clickSeat(this)"></span></dd>
                                                <dd><span status="0" columnno="5" seatno="1MY5MY5MY907"><img width="20" height="20" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}" onclick="clickSeat(this)"></span></dd>
                                                <dd><span status="0" columnno="4" seatno="1MY5MY4MY908"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="3" seatno="1MY5MY3MY909"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="2" seatno="1MY5MY2MY910"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="1" seatno="1MY5MY1MY911"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span></span></dd>
                                                <dd><span></span></dd>
                                            </dl>
                                            <dl class="cf" sectionid="1"> 
                                                <dd><em class="number">6</em></dd>
                                                <dd><span status="0" columnno="12" seatno="1MY6MY12MY914"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="11" seatno="1MY6MY11MY915"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="10" seatno="1MY6MY10MY916"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="9" seatno="1MY6MY9MY917"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="8" seatno="1MY6MY8MY918"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="7" seatno="1MY6MY7MY919"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="6" seatno="1MY6MY6MY920"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="5" seatno="1MY6MY5MY921"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="4" seatno="1MY6MY4MY922"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="3" seatno="1MY6MY3MY923"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="2" seatno="1MY6MY2MY924"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="1" seatno="1MY6MY1MY925"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span></span></dd>
                                                <dd><span></span></dd>
                                            </dl>
                                            <dl class="cf" sectionid="1"> 
                                                <dd><em class="number">7</em></dd>
                                                <dd><span status="0" columnno="12" seatno="1MY7MY12MY928"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="11" seatno="1MY7MY11MY929"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="10" seatno="1MY7MY10MY930"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="9" seatno="1MY7MY9MY931"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="8" seatno="1MY7MY8MY932"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="7" seatno="1MY7MY7MY933"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="6" seatno="1MY7MY6MY934"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="5" seatno="1MY7MY5MY935"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="4" seatno="1MY7MY4MY936"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="3" seatno="1MY7MY3MY937"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="2" seatno="1MY7MY2MY938"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="1" seatno="1MY7MY1MY939"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span></span></dd>
                                                <dd><span></span></dd>
                                            </dl>
                                            <dl class="cf" sectionid="1"> 
                                                <dd><em class="number">8</em></dd>
                                                <dd><span status="0" columnno="12" seatno="1MY8MY12MY942"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="11" seatno="1MY8MY11MY943"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="10" seatno="1MY8MY10MY944"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="9" seatno="1MY8MY9MY945"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="8" seatno="1MY8MY8MY946"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="7" seatno="1MY8MY7MY947"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="6" seatno="1MY8MY6MY948"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="5" seatno="1MY8MY5MY949"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="4" seatno="1MY8MY4MY950"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="3" seatno="1MY8MY3MY951"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="2" seatno="1MY8MY2MY952"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="1" seatno="1MY8MY1MY953"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span></span></dd>
                                                <dd><span></span></dd>
                                            </dl>
                                            <dl class="cf" sectionid="1"> 
                                                <dd><em class="number">9</em></dd>
                                                <dd><span status="0" columnno="12" seatno="1MY9MY12MY958"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="11" seatno="1MY9MY11MY959"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="10" seatno="1MY9MY10MY960"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="9" seatno="1MY9MY9MY961"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="8" seatno="1MY9MY8MY962"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="7" seatno="1MY9MY7MY963"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="6" seatno="1MY9MY6MY964"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="5" seatno="1MY9MY5MY965"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="4" seatno="1MY9MY4MY966"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="3" seatno="1MY9MY3MY967"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="2" seatno="1MY9MY2MY968"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                                <dd><span status="0" columnno="1" seatno="1MY9MY1MY969"><img width="20" height="20" onclick="clickSeat(this)" seattype="1" alt="" src="{{ asset('home/images/seat1.jpg') }}"></span></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            <!--seatArea-->
                            </div>
                        </div>
                    <!--examples-->
                    </div>
                    <!--卖品-->
                    <div class="choseProduct">
                        <h2>选择卖品：</h2>
                        <div class=" productMenu " id="productDetails">
                            <ul>

                                
                            </ul>

                        </div>

                    </div>
                    <!--卖品-->
                    <div class="payHelp mt30">
                        <h5>使用说明：</h5>
                        <p class="mt15">
                            • 每笔订单最多可选购4张电影票；情侣座不单卖；
                        </p>
                        <p>
                            • 选座时，请尽量选择相邻座位，请不要留下单个座位；
                        </p>
                        <p>
                            • 部分影院3D眼镜需要押金，请观影前准备好现金；
                        </p>
                        <p>
                            • 完成座位选择后，请在10分钟内完成支付，否则票务系统将自动释放已选座位，订单将过期失效；
                        </p>
                        <p>
                            • 请认真核对订单信息，电影票及优惠套餐售出后，因票务系统限制，无法进行退换操作。
                        </p>
                        <p>
                            • 支付中如遇到问题请致电：400-998-8022
                        </p>
                    </div>
                </div>
                    @if(session('msg'))
                        <script>alert(session('msg'))</script>
                    @endif
                    <!--seatWarpL-->
                    <div class="seatWarpR">
                        <div class="movbInfo cf">
                            <div class="movbpic">
                                <img id="FrontImg" src="{{ asset('admin/upload/movie/'.$show[0]->title_pic) }}" width="73" height="97" onerror="">
                            </div>
                            <div class="movbtext">
                                <h5 class="Hide" id="FilmName">{{ $show[0]->title }}</h5>
                                <p>
                                    国家：<span id="Language">{{ $show[0]->country }}</span>
                                </p>
                                <p>
                                    类型：<span id="ShowType">{{ $show[0]->format }}</span>
                                </p>
                                <p>
                                    片长：<span id="Duration">{{ $show[0]->length }}</span>
                                </p>
                            </div>
                        </div>
                        <!--movbInfo-->
                        <div class="mt20" style="position: relative;">
                            <div id="showBox" style="position: absolute; z-index: 999; display: none; height: 100px; width: 260px; text-align: right;">
                                <img src="{{ asset('home/images/18.gif') }}" width="32" height="32" style="margin-top: 50px; margin-right: 60px;">
                            </div>
                            <p>
                                影院：<em class="bold"><span id="CinemaName">横店电影城(王府井店)</span></em>
                            </p>
                            <p>
                                影厅：<em class="bold"><span id="HallName">{{ $show[0]->rname }}</span></em>
                            </p>

                            <div class="cf">
                                <div class="fr red" style="position: relative;">
                                    <span class="chaneTurn" ><a href="{{ url('/home/movie/get') }}">[更换场次]</a></span>
                                    <div id="trunShow" class="trunShow" onmouseout="over()" onmouseover="out()">
                                        <div class="trunStit cf">
                                            <ul class="cf">
                                                
                                            </ul>
                                        </div>
                                        <div class="trunCon">
                                        </div>
                                    </div>
                                    <!--trunShow-->
                                </div>
                                场次：<em class="bold red"><span id="ShowDate">{{ $show[0]->date.' '.' '.$show[0]->time }}</span></em>

                            </div>
                        </div>
                        <div class="seatSe mt20 cf">
                            <p>
                                <em class="red1 " style="">还未选择座位。</em>
                            </p>
                            <p>
                            </p>
                            <p>
                            </p>
                            <p>
                                点击<em class="red">座位图</em>选择座位，再次单击取消。
                            </p>
                        </div>
                        <p class="mt10">
                            <em id="myprice" style="display:none;">{{ $show[0]->price }}</em>
                            共计：<em class="red bold">￥0</em>
                        </p>
                        <div class="orderMinfo">
                            <p>
                                请输入接收电子电影票的手机号码：
                            </p>
                            <p>
                                <form action="{{ url('/home/movieorder') }}" method="post" name="myform" >
                                    {{ csrf_field() }}
                                    <input type="text" name="myshowid" style="display:none;" value="{{ $show[0]->id }}" />
                                    <input type="text" name="myprice" style="display:none;" value="" />
                                    <input type="text" name="myseat" style="display:none;" value="" />
                                    
                                    <span>手机号：</span><input name="input" id="mobileNo" type="text" maxlength="11" class="text wid160" onkeyup="this.value=this.value.replace(/\D/g,&#39;&#39;)" onafterpaste="this.value=this.value.replace(/\D/g,&#39;&#39;)">
                                </form>
                            </p>
                            <p>
                                <span>验证码：</span><input name="input" id="verifyCode" type="text" maxlength="5" class="text wid80" ><img style="height: 31px; margin-left: 5px; margin-top: -2px; width: 70px; border: 1px;" src="{{ url('/home/movie/seat/capth/'.time()) }}" onclick="this.src='{{ url('/home/movie/seat/capth') }}/'+Math.random()" id="Image1" alt="">
                            </p>
                            <p class="align_c">
                                <input type="button" onclick="createOrder()" class="kbtn" value="下一步">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="contCon" style="display: none;">
                <span class="ls"></span><span class="rs"></span>
                <div class="seatWarp cf">
                    <div class="nosession">
                        <div class="nspic">
                        </div>
                        <div class="nstext">
                            <h3 class="f20">排期场次不存在!</h3>
                            <p class="mt42">
                                <a href="http://www.cfc.com.cn/index.aspx" class="red">返回首页</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var myprice = '';
            //选单击座位
            function clickSeat(obj)
             {
                var status = $(obj).parent().attr("Status");
                if (status == 0) {
                    var seatSum = $(".seatWarpR .seatSe p").eq(1).find("span").length;
                    if (seatSum >= 4) {
                        alert("最多允许选择四个座位！");
                        return;
                    }
                    var type = $(obj).attr("SeatType");
                    if (type == 5 || type == 6) {
                        if (seatSum >= 3) {
                            alert("最多允许选择四个座位！");
                            return;
                        }
                    }
                    pitchOnSeat(obj);
                } else if (status == 4) {
                    cancelSeat(obj);
                }
                setallmoney();
                //获取当前选中的票数
                var num = $(".seatWarpR .seatSe").find("span").length;
                //获取当前票的价格
                var pri = $("#myprice").html();
                //返回当前总价并显示
                myprice = num*pri;
                $(".mt10 .red").html("￥"+myprice);
            }
            //选中座位
            function pitchOnSeat(obj)
             {
                var type = $(obj).attr("SeatType");
                var sectionId = $(obj).parent().parent().parent().attr("SectionId");
                var row = $(obj).parent().parent().parent().find("dd").eq(0).find("em").text();
                if (row == "") row = 0;
                var columnNo = $(obj).parent().attr("ColumnNo");
                var seatNo = $(obj).parent().attr("SeatNo");
                var html = "";
                if (type == 5 || type == 6) { //情侣座
                    $(obj).attr("src", "{{ asset('/home/images/seat4.jpg') }}");
                    $(obj).parent().attr("Status", "4");
                    html = "<span seatNo='" + seatNo + "' seatName='" + sectionId + "_" + row + "_" + columnNo + "'> " + row + "排" + columnNo + "座</span>";
                    if (type == 5) {
                        $(obj).parent().parent().next().find("span img").attr("src", "{{ asset('/home/images/seat4.jpg') }}");
                        $(obj).parent().parent().next().find("span").attr("Status", "4");
                        columnNo = $(obj).parent().parent().next().find("span").attr("ColumnNo");
                        seatNo = $(obj).parent().parent().next().find("span").attr("SeatNo");
                    } else {
                        $(obj).parent().parent().prev().find("span img").attr("src", "{{ asset('/home/images/seat4.jpg') }}");
                        $(obj).parent().parent().prev().find("span").attr("Status", "4");
                        columnNo = $(obj).parent().parent().prev().find("span").attr("ColumnNo");
                        seatNo = $(obj).parent().parent().prev().find("span").attr("SeatNo");
                    }
                    html += "<span seatNo='" + seatNo + "' seatName='" + sectionId + "_" + row + "_" + columnNo + "'> " + row + "排" + columnNo + "座</span>";
                    $(".seatWarpR .seatSe p").eq(0).hide();
                    $(".seatWarpR .seatSe p").eq(1).append(html);
                } else {
                    var prevSeat = $(obj).parent().parent().prev(); //上一个座位
                    var nextSeat = $(obj).parent().parent().next(); //下一个座位

                    if ($(prevSeat).find("img").length == 0) { //走廊座位
                        if (isNextSeat(nextSeat)) {
                            $(obj).attr("src", "{{ asset('/home/images/seat4.jpg') }}");
                            $(obj).parent().attr("Status", "4");
                            html = "<span seatNo='" + seatNo + "' seatName='" + sectionId + "_" + row + "_" + columnNo + "'> " + row + "排" + columnNo + "座</span>";
                            $(".seatWarpR .seatSe p").eq(0).hide();
                            $(".seatWarpR .seatSe p").eq(1).append(html);
                            return;
                        }
                    }
                    if ($(nextSeat).find("img").length == 0) { //走廊座位
                        if (isPrevSeat(prevSeat)) {
                            $(obj).attr("src", "{{ asset('/home/images/seat4.jpg') }}");
                            $(obj).parent().attr("Status", "4");
                            html = "<span seatNo='" + seatNo + "' seatName='" + sectionId + "_" + row + "_" + columnNo + "'> " + row + "排" + columnNo + "座</span>";
                            $(".seatWarpR .seatSe p").eq(0).hide();
                            $(".seatWarpR .seatSe p").eq(1).append(html);
                            return;
                        }
                    }
                    if (isNextSeat(nextSeat, prevSeat)) {
                        $(obj).attr("src", "{{ asset('/home/images/seat4.jpg') }}");
                        $(obj).parent().attr("Status", "4");
                        html = "<span seatNo='" + seatNo + "' seatName='" + sectionId + "_" + row + "_" + columnNo + "'> " + row + "排" + columnNo + "座</span>";
                        $(".seatWarpR .seatSe p").eq(0).hide();
                        $(".seatWarpR .seatSe p").eq(1).append(html);
                        return;
                    }
                    alert("请连续选择座位，不要留下单个的空闲座位！");
                    return;
                }
            }
            //判断右边座位是否可锁定
            function isPrevSeat(prevSeat)
             {
                if ($(prevSeat).find("img").length == 0) return true;
                var prevStatus = $(prevSeat).find("span").attr("Status"); //上个座位状态
                if (prevStatus == 0) {
                    var prevSeat2 = $(prevSeat).prev();
                    if ($(prevSeat2).find("img").length == 1) {
                        var prevSeat2Status = $(prevSeat2).find("span").attr("Status");
                        if (prevSeat2Status == 4) {
                            return false;
                        } else {
                            return true;
                        }
                    } else {
                        return true;
                    }
                } else if (prevStatus == 4) {
                    return true;
                } else {
                    return true;
                }
            }
            //判断左边座位是否可锁定
            function isNextSeat(nextSeat) 
            {
                if ($(nextSeat).find("img").length == 0) return true;
                var nextStatus = $(nextSeat).find("span").attr("Status"); //下个座位状态
                if (nextStatus == 0) {
                    var nextSeat2 = $(nextSeat).next();
                    if ($(nextSeat2).find("img").length == 1) {
                        var nextSeat2Status = $(nextSeat2).find("span").attr("Status");
                        if (nextSeat2Status == 4) {
                            return false;
                        } else {
                            return true;
                        }
                    } else {
                        return true;
                    }
                } else if (nextStatus == 4) {
                    return true;
                } else {
                    return true;
                }
            }
            //判断左右边座位是否可锁定
            function isNextSeat(nextSeat, prevSeat)
             {
                var nextStatus = $(nextSeat).find("span").attr("Status"); //下个座位状态
                var prevStatus = $(prevSeat).find("span").attr("Status"); //上个座位状态
                var prevSeat2 = $(prevSeat).prev(); //左边第二个座位
                var nextSeat2 = $(nextSeat).next(); // 右边第二个座位
                if (nextStatus == 0 && prevStatus == 0) {
                    if ($(nextSeat2).find("img").length == 1) {
                        if ($(nextSeat2).find("span").attr("Status") == 4) {
                            return false;
                        } else {
                            if ($(prevSeat2).find("img").length == 1) {
                                if ($(nextSeat2).find("span").attr("Status") == 0 && $(prevSeat2).find("span").attr("Status") == 0) {
                                    return true;
                                } else {
                                    return false;
                                }
                            } else {
                                return false;
                            }
                        }
                    } else {
                        return false;
                    }
                }
                else if (nextStatus == 0 && prevStatus == 4) {
                    if ($(nextSeat2).find("img").length == 1) {
                        if ($(nextSeat2).find("span").attr("Status") == 4) {
                            return false;
                        }

                    }
                }
                else if ((nextStatus == 4 && prevStatus == 0)) {
                    if ($(prevSeat2).find("img").length == 1) {
                        if ($(prevSeat2).find("span").attr("Status") == 4)
                        { return false; }
                    }
                }
                return true;
            }
            //取消座位
            function cancelSeat(obj)
             {
                var type = $(obj).attr("SeatType");
                var seatNo = $(obj).parent().attr("SeatNo");
                if (type == 5 || type == 6) { //情侣座
                    $(obj).attr("src",  "{{ asset('/home/images/seat3.jpg') }}");
                    $(obj).parent().attr("Status", "0");
                    delSeat(seatNo);
                    if (type == 5) {
                        $(obj).parent().parent().next().find("span img").attr("src",  "{{ asset('/home/images/seat3.jpg') }}");
                        $(obj).parent().parent().next().find("span").attr("Status", "0");
                        seatNo = $(obj).parent().parent().next().find("span").attr("SeatNo");
                    } else {
                        $(obj).parent().parent().prev().find("span img").attr("src",  "{{ asset('/home/images/seat3.jpg') }}");
                        $(obj).parent().parent().prev().find("span").attr("Status", "0");
                        seatNo = $(obj).parent().parent().prev().find("span").attr("SeatNo");
                    }
                    delSeat(seatNo);
                } else {
                    var prevSeat = $(obj).parent().parent().prev(); //上一个座位
                    var nextSeat = $(obj).parent().parent().next(); //下一个座位

                    if ($(prevSeat).find("img").length == 0) { //走廊座位
                        cancelNextSeat(obj, nextSeat);
                        return;
                    }
                    if ($(nextSeat).find("img").length == 0) { //走廊座位
                        cancelPrevSeat(obj, prevSeat);
                        return;
                    }
                    cancelMiddleSeat(obj, prevSeat, nextSeat);
                }
            }
            //取消左边座位
            function cancelPrevSeat(obj, prevSeat)
             {
                var seatNo = $(obj).parent().attr("SeatNo");
                $(obj).attr("src",  "{{ asset('/home/images/seat1.jpg') }}");
                $(obj).parent().attr("Status", "0");
                delSeat(seatNo);
                if ($(prevSeat).find("img").length == 1 && $(prevSeat).find("span").attr("Status") == 4) {
                    $(prevSeat).find("span img").attr("src",  "{{ asset('/home/images/seat1.jpg') }}");
                    $(prevSeat).find("span").attr("Status", "0");
                    seatNo = $(prevSeat).find("span").attr("SeatNo");
                    delSeat(seatNo);
                }
            }
            //取消右边座位
            function cancelNextSeat(obj, nextSeat)
             {
                var seatNo = $(obj).parent().attr("SeatNo");
                $(obj).attr("src",  "{{ asset('/home/images/seat1.jpg') }}");
                $(obj).parent().attr("Status", "0");
                delSeat(seatNo);
                if ($(nextSeat).find("img").length == 1 && $(nextSeat).find("span").attr("Status") == 4) {
                    $(nextSeat).find("span img").attr("src",  "{{ asset('/home/images/seat1.jpg') }}");
                    $(nextSeat).find("span").attr("Status", "0");
                    seatNo = $(nextSeat).find("span").attr("SeatNo");
                    delSeat(seatNo);
                }
            }
            //取消中间座位
            function cancelMiddleSeat(obj, prevSeat, nextSeat)
             {
                var seatNo = $(obj).parent().attr("SeatNo");
                delSeat(seatNo);
                var nextStatus = $(nextSeat).find("span").attr("Status"); //下个座位状态
                var prevStatus = $(prevSeat).find("span").attr("Status"); //上个座位状态
                var prevSeat2 = $(prevSeat).prev(); //左边第二个座位
                var nextSeat2 = $(nextSeat).next(); // 右边第二个座位
                if (nextStatus == 4 && prevStatus != 4) {
                    if ($(nextSeat2).find("img").length == 0) {
                        $(nextSeat).find("span img").attr("src",  "{{ asset('/home/images/seat1.jpg') }}");
                        $(nextSeat).find("span").attr("Status", "0");
                        seatNo = $(nextSeat).find("span").attr("SeatNo");
                        delSeat(seatNo);
                    }
                } else if (nextStatus != 4 && prevStatus == 4) {
                    if ($(prevSeat2).find("img").length == 0) {
                        $(prevSeat).find("span img").attr("src",  "{{ asset('/home/images/seat1.jpg') }}");
                        $(prevSeat).find("span").attr("Status", "0");
                        seatNo = $(prevSeat).find("span").attr("SeatNo");
                        delSeat(seatNo);
                    }
                } else if (nextStatus == 4 && prevStatus == 4) {
                    if ($(prevSeat2).find("img").length == 0 && $(nextSeat2).find("img").length == 0) {
                        $(prevSeat).find("span img").attr("src",  "{{ asset('/home/images/seat1.jpg') }}");
                        $(prevSeat).find("span").attr("Status", "0");
                        seatNo = $(prevSeat).find("span").attr("SeatNo");
                        delSeat(seatNo);
                    } else if ($(prevSeat2).find("img").length == 1 && $(nextSeat2).find("img").length == 0) {
                        $(nextSeat).find("span img").attr("src",  "{{ asset('/home/images/seat1.jpg') }}");
                        $(nextSeat).find("span").attr("Status", "0");
                        seatNo = $(nextSeat).find("span").attr("SeatNo");
                        delSeat(seatNo);
                    } else if ($(prevSeat2).find("img").length == 0 && $(nextSeat2).find("img").length == 1) {
                        $(prevSeat).find("span img").attr("src",  "{{ asset('/home/images/seat1.jpg') }}");
                        $(prevSeat).find("span").attr("Status", "0");
                        seatNo = $(prevSeat).find("span").attr("SeatNo");
                        delSeat(seatNo);
                    } else {
                        if ($(prevSeat2).find("span").attr("Status") == 1 && $(nextSeat2).find("span").attr("Status") == 0) {
                            $(nextSeat).find("span img").attr("src",  "{{ asset('/home/images/seat1.jpg') }}");
                            $(nextSeat).find("span").attr("Status", "0");
                            seatNo = $(nextSeat).find("span").attr("SeatNo");
                            delSeat(seatNo);
                        } else {
                            $(prevSeat).find("span img").attr("src",  "{{ asset('/home/images/seat1.jpg') }}");
                            $(prevSeat).find("span").attr("Status", "0");
                            seatNo = $(prevSeat).find("span").attr("SeatNo");
                            delSeat(seatNo);
                        }
                    }
                }
                $(obj).attr("src",  "{{ asset('/home/images/seat1.jpg') }}");
                $(obj).parent().attr("Status", "0");
            }
            //删除座位
            function delSeat(seatNo)
             {
                $(".seatWarpR .seatSe p span").each(function () {
                    if ($(this).attr("seatNo") == seatNo) {
                        $(this).remove();
                    }
                });
                if ($(".seatWarpR .seatSe p span").length == 0) {
                    $(".seatWarpR .seatSe p").eq(0).show();
                }
            }
            //创建选座订单
            function createOrder() 
            {
                var str = isCheack();
                if (str == "false") {
                    return;
                }
                var seat = '';
                var myseat = $(".seatWarpR .seatSe p").eq(1).find("span");

                $.each(myseat,function(){
                    seat = seat + $(this).html()+'_';
                })
                var sid = $('#myshowid').html();
                var myDate = new Date();
                // var number = myDate.getTime()+Math.floor(Math.random()*10).toString();
                var phone = $('#mobileNo').val();
                var mycode = $('#verifyCode').val();

                $("input[name='myseat']").val(seat);
                $("input[name='myprice']").val(myprice);

                $("form[name='myform']").submit();
            }

            //是否可以提交
            function isCheack() 
            {
                var code = $("#verifyCode").val();
                $.ajax({
                    type:"GET",
                    url:"{{ url('/home/moviecapth') }}",
                    async: false,
                    data:{code:code},
                    success:function(data) {
                        if(data == 'true') {
                            $('#mycapth').html(2);
                        }
                       
                    },
                    error:function() {

                    }
                });

                var mobileNo = $("#mobileNo").val();
                if ($.trim(mobileNo) == "") {
                    alert("请输入接受电子票的手机号码！");
                    return "false";
                }
                if (!CheckMobile(mobileNo)) {
                    alert("请输入正确的手机号码！");
                    return "false";
                }
                var seatNo = "";
                var seatName = "";
                var proCode = "";
                var proNum = "";
                if ($(".seatWarpR").find('spn[seatno]').length > 4) {
                    alert("同一个场次座位数不可以超过4个，请取消多余座位！");
                    return "false";
                }
                $(".seatWarpR .seatSe p").eq(1).find("span").each(function () {
                    seatNo += $(this).attr("seatNo") + "|";
                    seatName += $(this).attr("seatName") + "|";
                });
                if ($.trim(seatNo) == "" || $.trim(seatName) == "") {
                    alert("请选择座位！");
                    return "false";
                }

                var code = $("#verifyCode").val(); 
                if ($.trim(code) == "") {
                    alert("请输入验证码！");
                    return "false";
                }    proNum = proNum.substring(0, proNum.length - 1);

                var sta = $('#mycapth').html();
                if(sta == 2) {
                    $('#mycapth').html(1);
                    alert("验证码输入不一致！");
                    return "false";
                }
            }

            // 获取总票价
            function setallmoney() 
            {
                var sellproPrice = 0;
                $(".seatWarpR .seatSe p").eq(2).find("span").each(function () {
                    sellproPrice = sellproPrice + $(this).attr("pronum") * $(this).attr("price");
                });
                $(".mt10 .red").html("￥" + window.parseFloat($(".seatWarpR .seatSe p").eq(1).find("span").length * sellproPrice).toFixed(2));
            }
        </script>
        <!--contTet-->
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
        <script type="text/javascript" src="{{ asset('home/js/mall/extra/require.min.js') }}"></script>
        <script type="text/javascript">
            require.config({
                baseUrl: "/resource/js/mall/src",
                urlArgs: "__ts=" + new Date().getTime()
            });

            require(["pages/mall"], function (page) {
                page.init();
            });
        </script>

    <a href="javascript:;" class="backToTop" title="返回顶部" style="display: none; position: fixed; top: 503px; left: 1228.5px;">返回顶部</a></body></html>