@extends('home.parent')
@section('content')
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
        <div id="detail" class="m-mall-con">
            <div class="m-mall-all-header" style="font-size: 14px; text-align: left;">
                <p id="productNav">
                    <a href="{{ url('/list') }}">全部商品</a>&gt;&gt;<a href="{{ url('/list/'.$res->tid) }}">{{ $res->tname }}</a>&gt;&gt;<b style="font-weight:900;">{{ $res->gname }}</b>
                </p>
            </div>
            <div class="m-mall-details">
                <div class="details-top">
                    <h2 node-name="group_title" style="margin-left: 70px;">{{ $res->gname }}</h2>
                    <h3 node-name="group_keyword" style="margin-left: 70px;">{{ $res->theme }}</h3>
                    <h4>
                        <em node-name="pre" class="left sprite"></em>
                        <div>
                            <ul node-name="bigPic">
                                <li><img src="{{ asset('/admin/upload/goods/'.$res->gimage) }}" /></li>
                            </ul>
                        </div>
                        <em node-name="nex" class="right sprite"></em>
                    </h4>
                    <p node-name="smallPic">
                    </p>
                </div>
                <div class="details-center">
                    <p><span><em class="share sprite"></em>分享</span>|<span><em class="collection sprite"></em>收藏</span>|<span><em class="erwei sprite"></em>二维码</span></p>

                    <div style="text-align: left; padding-left: 38%;">
                        <h2><span node-name="channel_price">￥{{ $res->price }}</span>
                            </h2>

                        <h3>
                            <samp>数量：</samp>
                            <span node-name="count">

                                <em class="jian" onclick="doAdd(this)">-</em>
                                <input type="text" id="mynum" class="text" value="1" style="height: 26px;padding:0px;">
                                <em class="jia" onclick="doAdd(this)">+</em>
                            </span>
                            <label node-name="numunlock" style="padding-left: 10px; display: none;"></label>
                        </h3>
                        <div node-name="pAttr"  >
                        </div>
                    </div>

                    <div node-name="buy" class="shoping">
                        <a class="but1" href="javascript:doCart({{ $res->gid }})" style="text-decoration: none;"><em class="shoppingc sprite" style="text-decoration: none;"></em>加入购物车</a>
                        <a class="but1" href="javascript:doBuy({{ $res->gid }})">立即购买</a>
                        <span id="ses" style="display:none">{{ session('user') }}</span>
                    </div>
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="m-mall-details" node-name="content">
                <ul id="nav">
                    <li class="hover">商品详情</li>
                </ul>
                <div id="d_detail">
                    @foreach($photo as $img)
                    <img src="{{ asset('/admin/upload/goods/'.$img->gimage) }}" alt="">
                    @endforeach
                </div>  
            </div>
        </div>
    </div>
    <script type="text/javascript">
        require.config({
            baseUrl: "../resource/js/mall/src",
            urlArgs: "__ts=" + new Date().getTime()
        });
        require(["pages/mallDetail"], function (page) {
            page.init();
        });
        
        // 加入购物车或提交订单的数量加减
        function doAdd(ob)
        {
            // alert(ob.innerHTML);
            $('#mynum').val(eval($('#mynum').val()+ob.innerHTML+1) <1 ? 1 : eval($('#mynum').val()+ob.innerHTML+1));
            // if(ob.innerHTML == '-'){
            //     var val = ob.nextSibling.nextSibling.value;
            //     val = parseInt(val) - 1;
            //     ob.nextSibling.nextSibling.value = val<0 ? 0:val;
            // }else{
            //     var val = ob.previousSibling.previousSibling.value;
            //     val = parseInt(val) + 1;
            //     // alert(val);
            //     ob.previousSibling.previousSibling.value=val;
            // }
        }
        // 立即购买
        function doBuy(id)
        {
            var ses = $('#ses').html();
            if( ses != '') {
                var num = $('#mynum').val();
                var url = "{{ url('/home/goodsorder') }}";
                $.ajax({
                    type:'get',
                    url:url,
                    // dataType:'json',
                    data:{id:id,num:num},
                    success:function(data){
                        window.location.href = data;
                    },
                    error:function(){
                        alert('ajax请求失败！！！');
                    }

                });
            }else{
                window.location.href = "{{ url('/login') }}";
            }
        }
        // 加入购物车
        function doCart(id)
        {
            var num = $('#mynum').val();
            var url = "{{ url('/home/goodsorder') }}";
            $.ajax({
                type:'post',
                url:url,
                dataType:'json',
                data:{id:id, num:num, '_token':"{{ csrf_token() }}"},
                success:function(data){
                    alert(data);
                    // window.location.href = data;
                },
                error:function(){
                    alert('ajax请求失败！！！');
                }

            });
        }
    </script>
@endsection


