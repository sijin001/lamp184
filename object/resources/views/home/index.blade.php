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
      
<link href="{{ asset('home/js/mF_YSlider/mF_YSlider.css') }}" rel="stylesheet" />
<script src="{{ asset('home/js/mF_YSlider/myfocus-2.0.1.min.js') }}"></script>
<script src="{{ asset('home/js/mF_YSlider/mF_YSlider.js') }}"></script>
<style type="text/css">
    #myFocus
    {
        width: 100%;
        height: 500px;
    }
    #myFocus ul img
    {
         width: 100%;
         height: 500px;
    }
</style>

<script type="text/javascript">
    //设置
    myFocus.set({
        id: 'myFocus', //ID
        pattern: 'mF_YSlider', //风格
        trigger:'mouseover'
    });
</script>

<div id="myFocus">
    <!--焦点图盒子-->
    <div class="loading">
        <img src="{{ asset('home/images/loading.gif') }}" alt="请稍候..." /></div>
    <!--载入画面(可删除)-->
    <div class="pic" style=" position:relative;width:100%;">
        <!--图片列表-->
        <ul id="slides">
                @foreach($res as $img)
                <li style='z-index:5; display: none; background: url("{{ asset('admin/upload/slides/'.$img->img) }}") 50% 0% no-repeat;' >
				<a href="/" target="_blank" ></a></li>
                @endforeach
            </ul>
    </div>
</div>  
<section class="movies-list">
		<div class="movies-list-con">
			<div class="layout1">
					<div class="title">
						<ul>
							<li onclick="changeFilm(1)"><a href="javascript:void(0)" id="hotClickA"  class="cur">正在热映</a></li>
							<li onclick="changeFilm(2)"><a href="javascript:void(0)" id="futureClickA" >即将上映</a></li>
						</ul>
						<div class="prompt" id="span_Notice"></div>
					</div>

					<div class="content" id="hotFilmDiv">
                        <ul>
                            @foreach($movies as $m)
                            <li style="margin-left: 6px;">                                   
								<div class="movies-box">
									<div width="221" height="321"><img src="{{ asset('admin/upload/movie/'.$m->title_pic ) }}" /></div>
									<div class="movies-box-eject">
										<div class="icon-box1"><a href="{{ url('/home/movie/description/'.$m->id ) }}"><div class="icon-5"></div></a><a href="{{ url('/home/movie/description/'.$m->id ) }}">影片详情</a></div>
										<div class="icon-box2"><a href="{{ url('/home/movie/get')}}"><div class="icon-6"></div></a><a href="{{ url('/home/movie/get')}}">选座购票</a></div>
									</div>
								</div>
								<div class="text-box">
									<p>{{ $m->title }}</p>
								</div>
							</li>
                            @endforeach
                        </ul>
                        <div class="drop-down" style="display:none;clear:both;">
							<div class="icon-8" onclick="morefilm(1)"><a href="javascript:void(0)" ></a></div>
						</div>

					</div>
                <div class="content" id="comingFilmDiv" style="display: none;">  
                    <ul>
                        @foreach($comovies as $co)
                        <li style="margin-left: 6px;">                                   
							<div class="movies-box">
								<div width="221" height="321"><img src="{{ asset('admin/upload/movie/'.$co->title_pic) }}"  alt=""/></div>
								<div class="movies-box-eject">
									<div class="icon-box1"><a href="movie/detail.aspx@fno=10001312"><div class="icon-5" style="margin-top:140px;"></div></a><a href="movie/detail.aspx@fno=10001312">影片详情</a></div>											
								</div>
							</div>
							<div class="text-box">
								<p>{{ $co->title }}
                                    <br/>
                                    <span class="fl grey f12" style="line-height: 20px;margin-top: -10px;">
                                    {{ $co->showtime}}                                             
                                    </span>
								</p>
							</div>
						</li>
                        @endforeach
                    </ul>                 
                 
                    <div class="drop-down" style="display:none;clear:both;">
						<div class="icon-8" onclick="morefilm(2)"><a href="javascript:void(0)" ></a></div>
					</div>
            </div>
		</div>
		<div class="layout2">
			
				@foreach($ads as $v)
                
					<a href="{{ $v->url }}" target="_blank">    
					<img src="{{ asset('admin/upload/ads/'.$v->picture) }} " width=200 height=196>
				    </a>
                <div class="process">
                    <div class="title" >
                            <div class="icon-40"></div><a href="{{ $v->url }}" target="_blank" style="{{ 'color:rgb('.rand(0,255).','.rand(0,255).','.rand(0,255).')' }}" >:{{ $v->content }}</a>
                    </div>  
                
                </div>
                
                @endforeach
		
			
		</div>
	</div>
</section>

<script type="text/javascript">
    function mallselect(val)
    {
        $(".mall-list-con .mall-con").children("div").hide();
        $(".mall-list-con .mall-con").children("div").eq(val).show();

        $(".mall-index-nav li div").removeClass("hover");
        $(".mall-index-nav li div").eq(val).addClass("hover");

        $(".mall-index-nav li a").removeClass("hover");
        $(".mall-index-nav li a").eq(val).addClass("hover");

    }
</script>
<section class="mall-list">
	<div class="mall-list-con">
		<div class="mall-banner" onclick="javascript:window.location.href='mall/Index.aspx'" style="cursor:pointer;"></div>
		<nav class="mall-index-nav">
			<ul>
                <?php $i = 0; ?>
                @foreach($type as $t)
                <li onclick="mallselect({{ $i }})">
                    <a href="javascript:void(0)"><div class="icon-{{ $i+23 }} hover"></div>{{ $t->tname }}</a>
                </li>
                <?php $i++; ?>
                @endforeach 
            </ul>
		</nav>
		<div class="mall-con">
            <div>
                <ul>
               
                    @foreach($arr[$type[0]->tname] as $g)
                    <li><a  target="_blank" href="{{ url('/goods/'.$g->gid) }}"><img src="{{ asset('/admin/upload/goods/'.$g->gimage) }}" alt=""></a></li>
                    @endforeach 
                                        
                </ul>
            </div>
            <div style="display:none;">
                <ul>
                    @foreach($arr[$type[1]->tname] as $g)
                    <li><a  target="_blank" href="{{ url('/goods/'.$g->gid) }}"><img src="{{ asset('/admin/upload/goods/'.$g->gimage) }}" alt=""></a></li>
                    @endforeach
                  
                </ul>
            </div>
            <div  style="display:none;">
                <ul>
                    @foreach($arr[$type[2]->tname] as $g)
                    <li>
                        <a target="_blank" href="{{ url('/goods/'.$g->gid) }}"><img src="{{ asset('/admin/upload/goods/'.$g->gimage) }}" alt=""></a>
                    </li>
                    @endforeach

                </ul>
            </div>
            <div  style="display:none;">
                <ul>
                    @foreach($arr[$type[3]->tname] as $g)
                    <li>
                        <a target="_blank" href="{{ url('/goods/'.$g->gid) }}"><img src="{{ asset('/admin/upload/goods/'.$g->gimage) }}" alt=""></a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div  style="display:none;">
                <ul>
                    @foreach($arr[$type[4]->tname] as $g)
                    <li>
                        <a target="_blank" href="{{ url('/goods/'.$g->gid) }}"><img src="{{ asset('/admin/upload/goods/'.$g->gimage) }}" alt=""></a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
	</div>
</section>

    <!--衍生品模块 end-->


    <!--卖品模块 start-->
    <section class="shop-list">
			<div class="shop-list-con">				
                <div class="activity mt30">
                <!-- <input type="hidden" id="hidPostion" value="A002" /> -->
               <div id="banner">
				<img src="{{ asset('home/Upload/SellerAdvNewPic/Temp/imgYX_20160614202052.jpg') }}" alt="" title="" />
                    <div id="banner_bg">
                    </div>
                    <div id="banner_info">
                    </div>
                    <ul style="display: none;"  id="span_footAdLi">
                    </ul>
                    <div id="banner_list">
                    </div> 
                               
                </div>
                
            </div>

				<div class="layout1" id="sell_stores">
					<div class="title"><p>卖品列表</p></div>					
					<div id="area_info" class="shopping">
                        <p><span>城市：</span>
                            <input id="MSelector_city" type="text" class="sell-city-search-input" value="请选择城市" readonly="readonly" />
                        </p>
                        <p class="sell-cinema-search-p">
                            <span>影院：</span>
                            <input id="MSelector_cinema" type="text" class="sell-cinema-search-input" value="请选择影院" readonly="readonly" />
                        </p>
                        <div id="sellCitySelector" class="sell-city-selector" style="display:none;position:relative;left:20px;top:0px;"></div>
                        <div id="sellCinemaSelector" class="sell-cinema-selector" style="display:none;position:relative;"></div>
                    </div>

					<div class="shop-box"id ="sellList">						
					</div>	
				</div>
				<div class="layout2">
					<div class="shop-process">
						<div class="title"><div class="icon-33"></div>卖品选购流程</div>
						<dl>
							<dt><div class="icon-31"></div></dt>
							<dd><p>选择影院</p><p>选择套餐数量并确认订单</p><p>支付</p><p>影院自助打票取货</p></dd>
						</dl>
					</div>

                    <div id="sellLeftShoppingCart" class="shop-package-list" style="display:none"></div>

                    <div class="quxiao" id="btnClose" style="cursor: pointer;display:none;" onclick="btnclose()"></div>
                    <input id="selected" type="hidden" value="110100" />
                    <input id="typeid" type="hidden" value="1" />
                    <input id="pagetype" type="hidden" value="1" />
					
				</div>
			</div>
		</section>
    <!--卖品模块 end-->

@endsection