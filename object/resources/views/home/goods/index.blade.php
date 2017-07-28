@extends('home.parent')
@section('content')

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
<div id="mall" class="pbd m-mall">
        
    <link href="{{ asset('home/js/mF_YSlider/mF_YSlider.css') }}" rel="stylesheet" />
    <script src="{{ asset('home/js/mF_YSlider/myfocus-2.0.1.min.js') }}"></script>
    <script src="{{ asset('home/js/mF_YSlider/mF_YSlider.js') }}"></script>
    <style type="text/css">
        .mF_YSlider_wrap{
            z-index:1 !important;
        }

        #myFocus {
            width: 100%;
            /*height: 336px;*/
            height: 499px;
            z-index:1;
        }

        #myFocus ul img {
            width: 100%;
            /*height: 336px;*/
            height: 499px;
        }
    </style>

    <script type="text/javascript">
        //设置
        myFocus.set({
            id: 'myFocus', //ID
            pattern: 'mF_YSlider', //风格
            trigger: 'mouseover'
        });
    </script>

    <div id="myFocus">
        <!--焦点图盒子-->
        <div class="loading">
            <img src="{{ asset('home/images/loading.gif') }}" alt="请稍候..." />
        </div>
        <!--载入画面(可删除)-->
        <div class="pic" style="position: relative; width: 100%;">
            <!--图片列表-->
            <ul id="slides">
                @foreach($res as $img)
                <li style="z-index:5; display: none;" title=主题一><a href="/" target="_blank" ><img src="{{ asset('admin/upload/slides/'.$img->img) }}" /></a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
    
<link href="{{ asset('home/css/screen.css') }}" media="screen, projection" rel="stylesheet" />

<script src="{{ asset('home/js/index2.js') }}"></script>
<section class="mall-index-center">
    <div class="mall-index-center-con" id="main">
        <?php $i=0; ?>
        <!-- 遍历所有分类 -->
        @foreach($arr as $v)  
        <div class="mall-index-center-con{{ $i+1 }} list">
            <div class="title">
                <div class="icon-{{ $i+36 }}"></div>
                {{ $type[$i]->tname }}
                <p><a href="{{ url('/list/'.$type[$i]->id) }}" class="mall-link">查看全部</a></p>
            </div>
            
            <ul>
                <!-- 遍历商品 -->
                @foreach($arr[$type[$i]->tname] as $g)   
                <li><a target="_blank" href="{{ url('/goods/'.$g->gid) }}">
                    <img src="{{ asset('/admin/upload/goods/'.$g->gimage) }}" alt=""></a></li>
                @endforeach

            </ul>   
           
        </div>
        <?php $i++; ?>
        @endforeach

        <div class="float">
            <div class="float-title">
                <div class="icon-41"></div>
            </div>
            <div class="float-box nav">
                <p style="cursor: pointer">玩具模型</p>
                <p style="cursor: pointer">服饰箱包</p>
                <p style="cursor: pointer">数码周边</p>
                <p style="cursor: pointer">居家生活</p>
                <p style="cursor: pointer">糖果系列</p>
            </div>
            <div class="float-bttom jumpTop"><a href="#">
                <div class="icon-42"></div>
                <br>
                回到顶部</a></div>
        </div>
    </div>
</section>

  
    <script type="text/javascript">

        require.config({
            baseUrl: "../resource/js/mall/src",
            urlArgs: "__ts=" + new Date().getTime()
        });
        require(["pages/mall"], function (page) {
            page.init();
        });

    </script>

      

 @endsection