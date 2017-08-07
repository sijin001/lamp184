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

                <div class="address" onclick="changeCityClick()"><a href="javascript:void(0);" id="span_CityName"></a><span id="change"></span></div>
                

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
                            <a href="{{ url('home/gouwu/'.session('user')->id) }}">
                                <em class="sprite cart-carticon"></em>
                                <em class="sprite cart-nub">0</em>
                            </a>
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
        <div class="warpc">
            <div class="contCon">
                <span class="ls"></span><span class="rs"></span>
                <div class="ticsteps">
                    <img src="{{ asset('home/images/success.png') }}" alt="" />
                </div>
                <!--steps-->
                <div class="t_con cf">
                    <div class="t_tit cf">
                        <em></em>订单成功
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
                                取票手机号：<span id="spanMobile">{{ $list[0]->phone }}</span>
                            </p>
                        </div>
                        <div class="tinfo3">
                            <p>
                                您选择的座位：
                            </p>
                            <p>
                                <?php  
                                    $str = $list[0]->seat;
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
                            <p>
                                总票价：
                            </p>
                            <p>
                                ￥{{ $list[0]->allprice }}元
                            </p>
                        </div>
                    </div>
                    <div class="boxLayer" style="display: none">
                        <img src="{{ asset('home/images/18.gif') }}" width="32" height="32">
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
        <!-- </form> -->
        <a href="javascript:;" class="backToTop" title="返回顶部" style="display: inline; position: fixed; top: 503px; left: 1228.5px;">返回顶部</a>
    </body>
</html>