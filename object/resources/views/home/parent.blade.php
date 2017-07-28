<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <title>中影·国际影城官网|电影|在线预订电影票|电影票团购|中影·国际影城</title>
    <meta name="Keywords" content="" /> 
    <meta name="Description" content="" /> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('home/css/reset-min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('home/css/main.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('home/css/ui-lightness/jquery-ui-1.8.5.custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/css/my.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/css/shop-branch.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/css/shopping.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/css/screen.css') }}" rel="stylesheet" />

    <script type="text/javascript" src="{{ asset('home/js/jquery-1.8.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/js/plugins/jquery-ui-1.8.23.custom.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/js/comm/Dialog.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/js/comm/common.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/js/gotoTop.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/js/ad.js') }}"></script>
    
    <!--[if IE 6]><script src="{{ asset('home/js/IE6.js') }}" type="text/javascript"></script><![endif]-->
    
    <script type="text/javascript" src="{{ asset('home/js/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('home/js/sellStore.js') }}"></script>
    <link href="{{ asset('home/css/sellStore.css') }}" rel="stylesheet" type="text/css" />
<title>

</title>
</head>
<body>
     
<!---头部开始-->

<header class="index-header">
    <div class="header-con">
        <div class="logo">
            <img src="{{ asset('home/images/web-v2/logo_03.png') }}" alt="">
        </div>

        <div class="address" onclick="changeCityClick()"><a href="javascript:void(0);" id="span_CityName">北京</a><span class="icon-1" id="change"></span></div>
        
        <!---切换城市开始-->
        
        <!---选择城市结束-->

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

        <div class="land" style="">
            <ul>
                <li>
                    <a href="user/login.aspx"><span class="icon-3"></span>登录</a>
                </li>
                <li class="register">
                    <a href="user/reg.aspx">注册</a>
                </li>
            </ul>
        </div>
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

@yield('content')


<footer class="index-footer">
            <div class="pro-box">
                <img style=" margin-top: 50px;
            margin-right: 50px;float: left;display: block;" class="codePic" src="{{ asset('home/images/doubleCode.jpg') }}">
                <ul style="float: left;width: 840px;">
                    <li>
                        <h3>新手上路</h3>
                        <p><a href="help/helpreg.aspx#num1">注册登录问题</a></p>
                        <p><a href="help/helpreg.aspx#num2">用户绑定会员卡问题</a></p>
                        <p><a href="help/helpreg.aspx#num3">影票相关问题</a></p>
                        <p><a href="help/helpreg.aspx#num4">票价和支付问题</a></p>
                        <p><a href="help/helpreg.aspx#num5">取票凭证码问题</a></p>
                        <p><a href="help/helpcenter.aspx">服务中心</a></p>
                    </li>
                    <li>
                        <h3>购票指南</h3>
                        <p><a href="help/helpgoseat.aspx#num1">用户购票流程</a></p>
                        <p><a href="help/helpgoseat.aspx#num2">取票观影指南</a></p>
                        <p><a href="help/helpgoseat.aspx#num3">会员卡支付相关说明</a></p>
                        <p><a href="help/helpgoseat.aspx#num4">网银支付相关说明</a></p>
                    </li>
                    <li>
                        <h3>用户中心</h3>
                        <p><a href="help/helpcenter.aspx#num1">购物流程</a></p>
                        <p><a href="help/helpcenter.aspx#num2">常见问题</a></p>
                        <p><a href="help/helpcenter.aspx#num3">发票制度</a></p>
                        <p><a href="help/helpcenter.aspx#num4">支付方式 </a></p>
                        <p><a href="help/helpcenter.aspx#num5">配送方式 </a></p>
                        <p><a href="help/helpcenter.aspx#num6">售后服务 </a></p>
                        <p><a href="help/helpcenter.aspx#num7">退货政策 </a></p>
                        <p><a href="help/helpcenter.aspx#num8">联系我们 </a></p>
                    </li>
                    <li>
                        <h3>会员权益</h3>
                        <p><a href="help/helpmember.aspx#num1">会员订票权益</a></p>
                        <p><a href="help/helpmember.aspx#num2">会员积分权益</a></p>
                        <p><a href="help/helpmember.aspx#num3">入会资格</a></p>
                        <p><a href="help/helpmember.aspx#num4">会员卡折扣说明</a></p>
                    </li>
                    <li>
                        <h3>手机客户端</h3>
                        <p><a href="appclient/client.aspx">手机客户端介绍与下载</a></p>
                        <p><a href="#">影片信息查询</a></p>
                        <p><a href="#">手机自助购票</a></p>
                    </li>
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
        <script type="text/javascript" src="{{ asset('home/js/mall/extra/require.min.js') }}"></script>
        <script type="text/javascript">
            require.config({
                baseUrl: "js/mall/src",
                urlArgs: "__ts=" + new Date().getTime()
            });

            require(["pages/mall"], function (page) {
                page.init();
            });
        </script>
    </body>
</html>
