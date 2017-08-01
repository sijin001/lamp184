<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head id="Head1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
        
        <link href="{{ asset('home/css/foucs.css') }}" rel="stylesheet">
        <script type="text/javascript" src="{{ asset('home/js/jquery.foucs.js') }}"></script>
        <script type="text/javascript" src="{{ asset('home/js/GoogleMap.js') }}"></script>
        <script type="text/javascript">
            var cinemaNo = "";
            var cinemaName = "";
            $(function () {
                initMap();

                //input绑定事件
                $(".select_box input").click(function () {
                    var $cinemaSelector = $('#cinemaSelector').dialog({
                        autoOpen: false,
                        width: 630,
                        position: ['center', 210],
                        dialogClass: "cinema-selector-dialog",
                        modal: true
                    });
                    $cinemaSelector.load('cinemaSelector.aspx?type=1');
                    $cinemaSelector.dialog('open');
                });

                //影院选择器 影院点击事件
                $(".cinema-ci a").live("click", function () {
                    closeDialog();
                    var $this = $(this);
                    cinemaNo = $this.data('cinemano');
                    cinemaName = $this.text();
                    loadPageData({ cinemaNo: cinemaNo, cinemaName: cinemaName });

                });

                //加载页面数据
                $.getJSON('GetCinemaData.ashx?action=GetDefaultCinema&type=1', function (data) {
                    if (data != null && data.length > 0) {
                        var item = data[0];
                        loadPageData({ cinemaNo: item.CinemaNo, cinemaName: item.CinemaName });
                    }
                });
            });

            //加载页面数据
            function loadPageData(cinema) {
                $(".select_box input").val(cinema.cinemaName);
                $("#linkGoSchedule").attr("href", "javascript:goToSchedule();");
                $("#linkGoSchedule").text("去购票");
                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: "GetCinemaData.ashx", //提交到一般处理程序请求数据
                    data: "action=getCinemaDetail&cinemaNo=" + cinema.cinemaNo, //提交参数：pageIndex(页面索引)，pageSize(显示条数)
                    success: function (data) {
                        if (data != null) {
                            $("#litCinemaName").text(data.CinemaName);
                            $("#litCinemaAddress").html(data.Address);
                            $("#litCinemaPhone").html(data.PhoneNo);
                            $("#litCinemaBusLine").html(data.Traffic);
                            $("#litIsSupportIMax").text(data.IsSupportIMax);
                            $("#litParkMemo").text(data.ParkMemo);
                            $("#litRestMemo").html(data.RestMemo);
                            $("#hidLongitude").val(data.Longitude);
                            $("#hidLatitude").val(data.Latitude);
                            $("#litIntroduction").text(data.Introduction);

                            if (data.DeviceUrl != null && data.DeviceUrl != undefined && data.DeviceUrl != "") {
                                $("#DeviceImg").attr("src", data.DeviceUrl);
                                $("#div_DeviceImg").show();
                            }
                            else {
                                $("#div_DeviceImg").hide();
                            }
                            var latitude = $("#hidLatitude").val();
                            var longitude = $("#hidLongitude").val();
                            if (latitude != null && latitude != "0" && longitude != null && longitude != "0") {
                                addPoint(longitude, latitude);
                            }
                        }
                    }
                });
            }


            //投诉
            function showComplain() {
                if (checkIsLogin()) {
                    setTimeout(openComplain, 20);
                }
            }


            //弹出投诉
            function openComplain() {
                var url = "../user/complain.aspx";
                openDialog(url, 700, 450, "提意见");
            }

            //购票
            function goToSchedule() {
                var url = "../search/schedule.aspx";
                location.href = url;
            }
        </script>
        <title>
        </title>
    </head>
<body>
    <form method="post" action="http://www.cfc.com.cn/cinema/cinema.aspx" id="form1">
        <div class="aspNetHidden">
            <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="">
        </div>
        <div id="zhezao" class="loading" style="display: none;">
            <div id="container"></div>
        </div>
        <!--logo-->
        <!---头部开始-->
        <header class="index-header">
            <div class="header-con">
                <div class="logo">
                    <img src="{{ asset('home/images/web-v2/logo_03.png') }}" alt=""></div>
                <div class="address" onclick="changeCityClick()"><a href="javascript:void(0);" id="span_CityName"></a><span
                 id="change"></span></div>
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
                            <span id="spano"><em class="sprite my-user-triangle"></em> </span>
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
                <div class="m-header section_r1" style="display:none">
                    <div class="m-header my">
                        <div node-name="user" class="my-user">
                            <em class="sprite my-user-icon"></em>
                            <em class="sprite my-user-triangle"></em>
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
                            <em class="sprite cart-nub">0</em>

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
            </div>
        </header>
        <!---头部结束-->
        <script type="text/javascript">
            $('#spano').bind('click',function(){
                $('.my-user-eject').slideToggle();
            })
        </script>
        <script type="text/javascript" language="javascript">
           
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
        <div id="cinemaSelector">
        </div>
        <div class="center cf noBottom">
            <div class="Schedule fl">
                <div class="ScheduleCon">
                    <span class="ls"></span><span class="rs"></span>
                    <div class="contain cf">
                        <div class="cinemaALL">
                            <div class="cinemaLeft fl">
                                <div class="cinimaTitle">
                                    <h3 class="fl">
                                        <label id="litCinemaName">
                                        横店电影城(王府井店)
                                        </label>
                                    </h3>
                                    <a href="{{ url('/home/movie/get') }}" class="fl" id="linkGoSchedule">去购票</a>
                                </div>
                                <div class="clear cinimaInfor">
                                    <dl class="clear">
                                        <dt class="fl wid50">地址：</dt>
                                        <dd class="fl wid450">
                                            <span id="litCinemaAddress">王府井大街251-253号8层</span>
                                        </dd>
                                    </dl>
                                    <dl class="clear">
                                        <dt class="fl wid50">电话：</dt>
                                        <dd class="fl wid450">
                                            <span id="litCinemaPhone">010-65231588</span>
                                        </dd>
                                    </dl>
                                    <dl class="clear">
                                        <dt class="fl wid80">交通路线：</dt>
                                        <dd class="fl wid430">
                                            <span id="litCinemaBusLine"></span>
                                        </dd>
                                    </dl>
                                    
                                    <dl class="clear" style="display: none;">
                                        <dt class="fl wid80">停车位置：</dt>
                                        <dd class="fl wid430">
                                            <label id="litParkMemo">
                                            </label>
                                        </dd>
                                    </dl>
                                </div>
                                <div class="clear">
                                </div>
                                <div class=" cinemaAc">
                                    <h3>影院简介</h3>
                                    <div>
                                        <label id="litIntroduction">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="cinemaRight fr">
                                <input type="hidden" value="0" id="hidLongitude">
                                <input type="hidden" value="0" id="hidLatitude">
                                <!--百度地图容器-->
                                <div style="width:444px;height:353px;border:#ccc solid 1px;font-size:12px;overflow: hidden; position: relative; z-index: 0; color: rgb(0, 0, 0); text-align: left; background-color: rgb(243, 241, 236);" id="map"></div>
                                <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=eYf9sA6yVTFHlh9ytU4a0EYY"></script>
                                <script type="text/javascript">
                                    //创建和初始化地图函数：
                                    function initMap(){
                                      createMap();//创建地图
                                      setMapEvent();//设置地图事件
                                      addMapControl();//向地图添加控件
                                      addMapOverlay();//向地图添加覆盖物
                                    }
                                    function createMap(){ 
                                      map = new BMap.Map("map"); 
                                      map.centerAndZoom(new BMap.Point(116.411307,39.912745),15);
                                    }
                                    function setMapEvent(){
                                      map.enableScrollWheelZoom();
                                      map.enableKeyboard();
                                      map.enableDragging();
                                      map.enableDoubleClickZoom()
                                    }
                                    function addClickHandler(target,window){
                                      target.addEventListener("click",function(){
                                        target.openInfoWindow(window);
                                      });
                                    }
                                    function addMapOverlay(){
                                      var markers = [
                                        {content:"电话：010-65231588",title:"地址：东城区长安街14号",imageOffset: {width:-46,height:-21},position:{lat:39.913963,lng:116.410876}},
                                      ];
                                      for(var index = 0; index < markers.length; index++ ){
                                        var point = new BMap.Point(markers[index].position.lng,markers[index].position.lat);
                                        var marker = new BMap.Marker(point,{icon:new BMap.Icon("http://api.map.baidu.com/lbsapi/createmap/images/icon.png",new BMap.Size(20,25),{
                                          imageOffset: new BMap.Size(markers[index].imageOffset.width,markers[index].imageOffset.height)
                                        })});
                                        var label = new BMap.Label(markers[index].title,{offset: new BMap.Size(25,5)});
                                        var opts = {
                                          width: 200,
                                          title: markers[index].title,
                                          enableMessage: false
                                        };
                                        var infoWindow = new BMap.InfoWindow(markers[index].content,opts);
                                        marker.setLabel(label);
                                        addClickHandler(marker,infoWindow);
                                        map.addOverlay(marker);
                                      };
                                    }
                                    //向地图添加控件
                                    function addMapControl(){
                                      var scaleControl = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
                                      scaleControl.setUnit(BMAP_UNIT_IMPERIAL);
                                      map.addControl(scaleControl);
                                      var navControl = new BMap.NavigationControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
                                      map.addControl(navControl);
                                      var overviewControl = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:true});
                                      map.addControl(overviewControl);
                                    }
                                    var map;
                                      initMap();
                                </script>
                                <script type="text/javascript" ></script><script type="text/javascript" ></script>

                                <div id="div_DeviceImg" style="margin-top: 20px; display: none;">
                                    <img id="DeviceImg" src="http://www.cfc.com.cn/cinema/cinema.aspx" width="444" height="353">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        <script type="text/javascript" src="{{ asset('home/js/require.min.js') }}"></script>
        <script type="text/javascript">
            require.config({
                baseUrl: "/resource/js/mall/src",
                urlArgs: "__ts=" + new Date().getTime()
            });

            require(["pages/mall"], function (page) {
                page.init();
            });
        </script>
    </form>
<a href="javascript:;" class="backToTop" title="返回顶部" style="display: none; position: fixed; top: 503px; left: 1228.5px;">返回顶部</a></body></html>