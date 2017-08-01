<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head id="Head1">
        <title>中影·国际影城官网|电影|在线预订电影票|电影票团购|中影·国际影城</title>
        <meta name="Keywords" content="" /> 
        <meta name="Description" content="" /> 
        <meta http-equiv="X-UA-Compatible" content="IE=9" />
        <link href="{{ asset('home/css/reset-min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('home/css/main.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('home/css/inside_pages.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('home/css/ui-lightness/jquery-ui-1.8.5.custom.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
        <link href="{{ asset('home/css/my.css') }}" rel="stylesheet" /><link href="{{ asset('home/css/screen.css') }}" rel="stylesheet" />
        <script type="text/javascript" src="{{ asset('home/js/jquery-1.8.3.min.js') }}">
            
        </script>
        <script type="text/javascript" src="{{ asset('home/js/plugins/jquery-ui-1.8.23.custom.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('home/js/comm/Dialog.js') }}"></script>
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
        
        <link href="{{ asset('home/css/js.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('home/js/comm/StringBuilder.js') }}" type="text/javascript"></script>
        <script src="{{ asset('home/js/plugins/jquery.mCustomScrollbar.concat.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('home/js/scroll.js') }}" type="text/javascript"></script>

        <style type="text/css">
            .shopping-icon03 { position: fixed; display: inline-block; width: 66px; height: 66px; background-image: url(../resource/images/shopping-icon_03.png); overflow: hidden; z-index: 9998; }
        </style>
    </head>
    <body>
        <form method="post" action="schedule.aspx" id="form1">
            <div class="aspNetHidden">
                <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="" />
            </div>

            <div class="aspNetHidden">

                <input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWAgKv0ZTRCwKku77lDMfG3v2UA72u/7jxfg4AYS54erhB" />
            </div>

            <div id="zhezao" class="loading" style="display: none;">
                <div id="container"></div>
            </div>
            
            <!---头部开始-->

            <header class="index-header">
                <div class="header-con">
                    <div class="logo">
                        <img src="{{ asset('home/images/web-v2/logo_03.png') }}" alt=""></div>

                    <div class="address" onclick="changeCityClick()"><a href="javascript:void(0);" id="span_CityName"></a><span  id="change"></span></div>
                    <!---菜单导航 start-->
                    <nav class="index-nav">
                        <ul>
                            <li id="2"><a href="{{ url('/') }}" title="首页">首 页</a></li>
                            <li id="3"><a href="{{ url('/home/movieplace') }}" title="购票通道">影 院</a></li>
                            <li id="4"><a href="{{ url('/home/movie/get') }}" title="在线购票">在线购票</a></li>
                            <li id="5"><a href="{{ url('/goods') }}" title="商城"><span class="icon-2"></span>商城</a></li>
                          
                            <li id="6"><a href="activity/ActList.aspx" title="优惠活动">优惠活动</a></li>
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
                                    <p><a href="{{ url('home/score') }}" style="font-size:14px"><p>我的积分</a></p>
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

                 //显示排期详情
                function display(num) {
                    document.getElementById("div_" + num).style.display = "block";
                }
        
                //隐藏排期详情
                function disappear(num) {
                    document.getElementById("div_" + num).style.display = "none";
                }

                function notify() {
                    showAlert("商城正在维护升级中，预计于2016年7月18日16时完成，请稍候访问!");
                }
            </script>
            <div id="cinemaSelector">
            </div>
            <div class="center cf noBottom">
                <div class="Schedule fl">
                    <div class="ScheduleCon">
                        <span class="ls"></span><span class="rs"></span>
                        <div class="ScheduleMeau fl">
                            <section id="examples">
                                <div class="meauS fl">
                                    <div class="meauTi fl meauTi1">放映日期</div>
                                    <div></div>
                                    
                                    <ul id="ulShowTime" class="fl content demo-y">
                                        <li><a href="{{ url('/home/movie/get/'.$id.'?date='.date('Y-m-d').'&format='.$format) }}" class="js-linkCinema Hide meauSel" val="ZY10010518">今日上映 {{ date("m月d日") }}</a></li>
                                        <li><a href="{{ url('/home/movie/get/'.$id.'?date='.date('Y-m-d',strtotime('+1 day')).'&format='.$format) }}" class="js-linkCinema Hide meauSel" val="ZY10010518">明日上映 {{ date("m月d日",strtotime("+1 day")) }}</a></li>
                                        <li><a href="{{ url('/home/movie/get/'.$id.'?date='.date('Y-m-d',strtotime('+2 day')).'&format='.$format) }}" class="js-linkCinema Hide meauSel" val="ZY10010518"> {{ date("m月d日",strtotime("+2 day")) }}上映</a></li>
                                    </ul>
                                </div>
                                
                                <div class="meauS fl tl">
                                    <div class="meauTi fl meauTi2">影城</div>
                                    <div></div>
                                    <ul id="ulCinema" class="fl content demo-y">
                                        <li><a href="javascript:void(0);" class="js-linkCinema Hide meauSel" val="ZY10010518">横店电影城</a></li>
                                        
                                    </ul>
                                    
                                </div>
                                
                                <div class="meauS fl meauM tl">
                                    <div class="meauTi fl meauTi3">影片</div>
                                    <div></div>
                                    <ul id="ulFilm" class="fl content demo-y">
                                        <img id="loading3" src="{{ asset('home/images/18.gif') }}" alt="加载中" style="margin-left: 50px; display: none" />
                                        <li><a href="{{ url('/home/movie/get/0?date='.$date.'&format=0') }}" val="" class="meauSel">全部</a></li>
                                        @foreach($movies as $m)
                                        <li><a href="{{ url('/home/movie/get/'.$m->id.'?'.'date='.$date.'&format=0') }}" val="" class="meauSel">{{ $m->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <div class="meauS fl tl">
                                    <div class="meauTi fl meauTi4">时间</div>
                                    <div></div>
                                    <ul id="ulTime" class="fl">
                                        <li><a href="{{ url('/home/movie/get') }}" val="" class="meauSel">全部</a></li>
                                    </ul>
                                </div>
                                <div class="meauS fl tl">
                                    <div class="meauTi fl meauTi3">版本</div>
                                    <div>
                                    </div>
                                    <ul  id="ulShowType" class="fl content demo-y">
                                        <li class="sta"><a href="{{ url('/home/movie/get/0?'.'date='.$date.'&format=0') }}" val="" class="meauSel">全部</a></li>
                                        <li class="sta"><a href="{{ url('/home/movie/get/0?'.'date='.$date.'&format=2D') }}" val="0">2D</a></li>
                                        <li class="sta"><a href="{{ url('/home/movie/get/0?'.'date='.$date.'&format=3D') }}" val="1">3D</a></li>
                                        <li class="sta"><a href="{{ url('/home/movie/get/0?'.'date='.$date.'&format=IMAX2D') }}" val="3">IMAX2D</a></li>
                                        <li class="sta"><a href="{{ url('/home/movie/get/0?'.'date='.$date.'&format=4D') }}" val="4">4D</a></li>
                                        <li class="sta"><a href="{{ url('/home/movie/get/0?'.'date='.$date.'&format=IMAX3D') }}" val="5">IMAX3D</a></li>
                                        <li class="sta"><a href="{{ url('/home/movie/get/0?'.'date='.$date.'&format=巨幕2D') }}" val="6">巨幕2D</a></li>
                                        <li class="sta"><a href="{{ url('/home/movie/get/0?'.'date='.$date.'&format=巨幕3D') }}" val="7">巨幕3D</a></li>
                                    </ul>
                                </div>
                            </section>
                            <div class="clear">
                            </div>
                        </div>
                        <div class="ScheduleList fl">
                            
                            <div class="clear"></div>
                            <div class="ScheduleList fl">
                                <div class="ListCon">
                                <span id="labDataBind">
                                <?php $i=0 ?>
                                @foreach($movie as $mo)
                                <dl class="fl">
                                    <dt class="fl">
                                        <div class="ListConPic">
                                            <img width="129" height="176" src="{{ asset('admin/upload/movie/'.$mo->title_pic) }}">
                                        </div>
                                        <div class="ListBtnAll"><a class="ListBtn1" href="" target="_blank">影片介绍</a>
                                        </div>
                                    </dt>
                                    <dd class="fr">
                                        <div class="ListConTitle">
                                            <div class="f20 fl mr_r hhsz"><a class="ListBtn2" href="" target="_blank">{{ $mo->title }}</a></div>
                                            <div class="fr f14"><a href="" target="_blank">【{{ $mo->Num }}】篇影评</a></div>
                                            <div class="fr f14 mr_r">片长{{ $mo->length }}</div>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="ScheduleTag">
                                        <ul>
                                            <li class="fl"><a href="javascript:void(0);"><i class="fl TagLeft"></i><span class="fl">全部</span><i class="fl TagRight"></i></a>
                                            </li>
                                        </ul>
                                        </div>
                                        <div class="clear"></div>
                                        @foreach( $arr[$mo->title] as $v)
                                        <div class="ScheduleLink">
                                            <ul>
                                                <li class="fl">
                                                    <a class="LinkUnsale f16" onmouseover="display({{ $i }})" onmouseout="disappear({{ $i }})" href="{{ url('/home/movie/seat/'.$v->id) }}" target="_blank">{{$v->time}}<em class="f12">¥{{ $v->price }}</em><em class="f12">{{ $v->format }}</em>
                                                    </a>
                                                    <div class="tagSale"></div>
                                                    <div class="pop" id="div_{{ $i }}" style="display: none;" onmouseover="display({{ $i }})" onmouseout="disappear({{ $i }})">
                                                        <div class="popCon tl">
                                                            <div>{{ $v->time.','.$v->rname.','.$v->number.'个座位' }}</div>
                                                            <div class="f14">标准价：<span class="th">¥{{$v->price}}</span>&nbsp;&nbsp;&nbsp;网售价：<span class="hsz">¥{{$v->price}}</span></div>
                                                            <div class="f16">VIP会员价：<b class="ccsz">￥{{($v->price)*0.9}}</b></div>
                                                            <div class="f16">钻石会员价：<b class="ccsz">￥{{($v->price)*0.85}}</b></div>
                                                            <div class="popBtn"><a href="{{ url('/home/movie/seat/'.$mo->id) }}" target="_blank">选座购票</a></div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php $i++ ?>
                                        @endforeach
                                    </dd>
                                </dl>
                                @endforeach
                                <div class="clear">
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="ctl00$ContentPlaceHolder1$hidCurDate" id="ContentPlaceHolder1_hidCurDate" value="2017-07-10 21:55:40" />

            <script type="text/javascript">        
                var initShoppingIcon = function() 
                {
                    var that = {};
                    var icon = $('<a href="javascript:void(0)" class="shopping-icon03"></a>');
                    var dialog = null;
                    icon.appendTo(document.body);

                    var updatePosition = function() 
                    {
                        var winWidth = $(window).width();
                        var winHeight = $(window).height();
                        var width = 1002 + (66 + 10) * 2;
                        var right = winWidth > width ? (winWidth - width) / 2 : 10;
                        var top = (winHeight - 66) > 0 ? (winHeight - 66) / 2 : 0;

                        icon.css({
                            top: top + "px",
                            right: right + "px"
                        });
                    }

                    updatePosition();

                    $(window).bind("resize", updatePosition);

                    icon.click(function() 
                    {
                        dialog = shoppingDialog();
                        dialog.show();
                    });

                    that.hide = function() 
                    {
                        dialog && dialog.hide();
                        dialog = null;
                    }

                    return that;
                }

                /**
                 * 弹层
                 */
                var shoppingDialog = function() 
                {
                    if(!cinemaNo) return;
                    var that = {};
                    var node = $('<div><iframe frameborder="0" src="sanckStore.aspx@cinemaNo='+cinemaNo+'" style="width: 100%; height: 100%;" ></iframe></div>');
                    var mask = $('<div style="width: 100%; height: 100%; left: 0; top: 0; position: fixed; -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=30); filter: alpha(opacity=30); opacity: 0.3; background-color: black;z-index: 9999;"></div>');
            
                    node.css({
                        "position": "fixed",
                        "z-index": 10000,
                        "left": "0px",
                        "top": "0px",
                        "background-color": "white",
                        "border": "1px solid #cdcdcd",
                        "border-radius": "5px",
                        "overflow": "hidden"
                    });
            
                    that.show = function() 
                    {
                        mask.appendTo(document.body);
                        node.appendTo(document.body);

                        $(document.documentElement).css({
                            width: "100%",
                            height: "100%",
                            overflow: "hidden"
                        });

                        that.setMiddle();

                        $(window).bind("resize", that.setMiddle);
                        $(window).bind("scroll", that.setMiddle);
                    }

                    that.hide = function() {
                        $(window).unbind("resize", that.setMiddle);
                        $(window).unbind("scroll", that.setMiddle);
                        node.remove();
                        mask.remove();

                        $(document.documentElement).css({
                            width: "auto",
                            height: "auto",
                            overflow: "auto"
                        });
                    }

                    that.setMiddle = function() 
                    { 
                        var winWidth = $(window).width();
                        var winHeight = $(window).height();
                        var nodeWidth = node[0].offsetWidth;
                        var nodeHeight = node[0].offsetHeight;
                        var left = Math.max((winWidth - nodeWidth) / 2, 0);
                        var top = Math.max((winHeight - nodeHeight) / 2, 0);

                        node.css({
                            left: "0",
                            top: "0",
                            width: winWidth + "px",
                            height: winHeight + "px"
                        });

                        mask.css({
                            width: winWidth,
                            height: winHeight
                        });
                    }

                    return that;
                }
                $('#ulshowTime li a').live("click",function() 
                {
                    var url  ="{{ url('/home/movie/get') }}";
                    $.ajax({
                        url:url,
                        type:"POST",
                        dataType:'json',
                        data:{},
                        success:function(data) {

                        },
                        error:function() {
                            alert('请求失败');
                        }
                    });
                });
            </script>
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
                        <li><a href="common/aboutus.aspx">关于中影</a></li>
                        <li><a href="common/contactus.aspx">联系方式</a></li>
                        <li><a href="common/addservice.aspx">服务协议 </a></li>
                        <li><a href="common/complaint.aspx">会员协议 </a></li>
                        <li><a href="common/hr.aspx">市场合作 </a></li>
                        <li><a href="common/privacy.aspx">隐私条款 </a></li>
                        <li style="border-right: 0;"><a  href="common/pre.aspx">免责声明</a></li>

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
                $(function() 
                {
                    $(".backToTop").goToTop();
                    $(window).bind('scroll resize', function() 
                    {
                        $(".backToTop").goToTop({
                            pageWidth: 1030,
                            duration: 0
                        });
                    });
                });
            </script>
            <script type="text/javascript">
            //<![CDATA[actcinemamap = []//]]>
            </script>
        </form>
    </body>
</html>
