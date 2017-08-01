<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
    <head id="Head1">
        <title>中影·国际影城官网|电影|在线预订电影票|电影票团购|中影·国际影城</title>
        <meta name="Keywords" content="" /> 
        <meta name="Description" content="" /> 
        <meta http-equiv="X-UA-Compatible" content="IE=9" />
        <link href=" {{ asset('home/css/reset-min.css') }}" rel="stylesheet" type="text/css" />
        <link href=" {{ asset('home/css/main.css') }}" rel="stylesheet" type="text/css" />
        <link href=" {{ asset('home/css/inside_pages.css') }}" rel="stylesheet" type="text/css" />
        <link href=" {{ asset('home/css/ui-lightness/jquery-ui-1.8.5.custom.css') }}" rel="stylesheet" type="text/css" />
        <link href=" {{ asset('home/css/style.css') }}" rel="stylesheet" />
        <link href=" {{ asset('home/css/my.css') }}" rel="stylesheet" />
        <link href=" {{ asset('home/css/screen.css') }}" rel="stylesheet" />
        <script type="text/javascript" src="{{ asset('home/js/jquery-1.8.3.min.js') }}"></script>
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
         
        <link href=" {{ asset('home/css/ticket.css') }}" rel="stylesheet" type="text/css" />
        <link href=" {{ asset('home/css/jquery.lightbox-0.5.css') }}" rel="stylesheet" type="text/css" />

        <script src="{{ asset('home/js/jquery.lightbox-0.5.js') }}" type="text/javascript"></script>
    </head>
    <body>
        <div class="aspNetHidden">
            <input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
            <input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
            <input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="" />
        </div>

        <script type="text/javascript">
            var theForm = document.forms['form1'];
            if (!theForm) {
                theForm = document.form1;
            }
            function __doPostBack(eventTarget, eventArgument) 
            {
                if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
                    theForm.__EVENTTARGET.value = eventTarget;
                    theForm.__EVENTARGUMENT.value = eventArgument;
                    theForm.submit();
                }
            }
        </script>
        <div id="zhezao" class="loading" style="display: none;">
            <div id="container"></div>
        </div>
        
        <!---头部开始-->

        <header class="index-header">
            <div class="header-con">
                <div class="logo">
                    <img src="{{ asset('home/images/web-v2/logo_03.png') }}" alt=""></div>

                <div class="address" onclick="changeCityClick()"><a href="javascript:void(0);" id="span_CityName"></a><span id="change"></span></div>

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

            function notify() {
                showAlert("商城正在维护升级中，预计于2016年7月18日16时完成，请稍候访问!");
            }
        </script>
        <input type="hidden" name="ctl00$ContentPlaceHolder1$hidFilmNo" id="ContentPlaceHolder1_hidFilmNo" value="10001312" />
        <input type="hidden" name="ctl00$ContentPlaceHolder1$hidFilmCommentCount" id="ContentPlaceHolder1_hidFilmCommentCount" value="0" />
        <input type="hidden" name="ctl00$ContentPlaceHolder1$hidMoreCommflag" id="ContentPlaceHolder1_hidMoreCommflag" value="1" />
        <div class="warpc">
            <div class="contCon"> <span class="ls"></span> <span class="rs"></span>
                <div class="det_top"> 
                    <div class="det_topTit">
                        <h4>{{ $movies[0]->title }}</h4><span class="grey"></span></div><div class="detPic mt15"><img src="{{ asset('admin/upload/movie/'.$movies[0]->poster) }}" width="958" height="365" /></div><div class="detText mt15">
                        <p>上映日期：<span>{{ $movies[0]->showtime }} </span></p>
                        <p> 导演：<span>{{ $movies[0]->director }}</span></p>
                        <div class="cf"><em class="fl"> 主演：</em><span class="fl" style=" display:inline-block; width:860px;" >{{ $movies[0]->star }}</span> </div>
                        <p>类型：<span>{{ $movies[0]->type }}</span> </p>
                        <p> 国家：<span>{{ $movies[0]->country }}</span> </p>
                        <p> 版本：<span>{{ $movies[0]->format }}</span> </p>
                        <p> 片长：<span>{{ $movies[0]->length }}</span> </p>
                        <a id="a_buy" name="a_buy" href="{{ url('/home/movie/get')}}" class="btnbuy" >立即购买</a>
                    </div>
                </div>

                <!--影片详情开始-->
                <div class="tit"><em></em>影片剧情</div>
 
                <div class="tdetCon tdetCext">
                    <p>{{ $movies[0]->des }}  </p>
                </div>
                <!--影片详情结束-->

                <!--影片剧照开始-->

                <div class="tit"><em></em>影片剧照</div>
                <div class="tdetCon">
                    <div class="picShow cf" id="div_FilmPicture">
                        <a href="{{ asset('admin/upload/movie/'.$movies[0]->images) }}">
                            <img src="{{ asset('admin/upload/movie/'.$movies[0]->images) }}" />
                        </a>
                    </div>
                </div>  
     
                <!--图片放大-->
                <div id="div_showbigimg"> 
                </div>

                <!--影片剧照结束-->    
                <!--影片评论开始-->
                <div class="tit cf"><a class="fr red bold" onclick="showComment()">我要发表</a><em></em>精彩影评</div>
                    <div id="div_errmsg" style="display:none;margin:20px;">
                        <label id="lblerrmsg" style="color:Red;"></label>
                    </div>  
                    <div class="commit" style="display:none;" id="commenttext"> 
                        <form method="post" action="{{ url('/home/movie/description') }}" id="form1">
                            {{ csrf_field() }}
                            <a href="javascript:void(0);" class="closeCmit" onclick="hideComment()"></a>
                            <input type="text" name="uid" style="display:none" value="{{ session('user') ? session('user')->id : '' }}"/>
                            <input type="text" name="mid" style="display:none" value="{{ $movies[0]->id }}"/>
                            <textarea name="content" id="ContentPlaceHolder1_txtComment" cols="28" rows="5" class="txtComment" placeholder="在此尽情抒发你的情感吧"></textarea>
                            <input type="text" name="ctime" style="display:none" value="{{ time() }}"/>
                            <input type="submit" class="submit" value="发表" />
                        </form>
                        <span id="uid" style="display:none;">{{ session('user') }}</span>
                    </div>
                      
                    <div class="tdetCon">
                        @foreach($comments as $com)
                        <div class="commitList">
                            <div class="comTop cf">
                                <span class="fl">
                                    <img src="{{ asset('admin/upload/photo/'.$com->photo) }}" width="42" height="43" />
                                </span>
                                <div class="userInfo">
                                    <p class="grey">{{ $com->name }}</p>
                                    <p class="grey">{{ date('Y-m-d H:i:d',$com->ctime) }}</p>
                                </div>
                            </div>
                            <div class="commtext mt10" style="word-break:break-all; overflow:hidden;">{{ $com->content }}</div>
                        </div>
                        @endforeach
                        
                        <!---分页开始--> 
                        {!! $comments->render() !!}                    
                        <!---分页结束--> 
                    </div>
                <!--影片评论结束-->  
                </div>
            </div>
            <script type="text/javascript">
                function showComment() {
                    var uid = $('#uid').html();
                    if(uid == ''){
                        window.location.href = "/login";
                    }else{
                        $(".commit").show();
                    }
                }
                function hideComment() {

                    $(".commit").hide();
                    $("#div_errmsg").hide();

                }

                function checkcomment() {
                    var chkbol = checkIsLogin();
                    if (chkbol) {
                        var commtxt = $(".txtComment").val();
                        if (commtxt == null || commtxt == "" || commtxt == "在此尽情抒发你的情感吧") {
                            $("#lblerrmsg").text("温馨提示：评论内容不能为空！");
                            $("#div_errmsg").show();
                            return false;
                        }
                        else if (commtxt.length > 140) {
                        $("#lblerrmsg").text("温馨提示：评论内容不能超过140个字！");
                        $("#div_errmsg").show();
                            return false;
                        }
                        else {
                            $("#div_errmsg").hide();
                            return true;
                        }
                    }        
                    return false;
                         
                }
            </script>
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
        <script type="text/javascript" src="{{ asset('home/js/mall/extra/require.min.js') }}"></script>
    </body>
</html>

