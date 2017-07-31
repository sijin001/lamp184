@extends('home.parent')
@section('content')





<!---头部结束-->

<script type="text/javascript" language="javascript">
    //选择城市操作
    $("#change").click(function () {
        $(".City_list").show();
        var cityNo = getCookie("_CityNo_");
        if (cityNo != "") {
            $("#" + cityNo).attr("class", "sel");
        }
    });
    function changeCityClick() {
        $(".City_list").show();
        var cityNo = getCookie("_CityNo_");
        if (cityNo != "") {
            $("#" + cityNo).attr("class", "sel");
        }
    }
    $(".City_list").mouseleave(function () {
        $(".City_list").hide();
    });

    //切换城市
    function ChangCity(id) {
        var str = $("#" + id).html();
        if (str.length > 4) {
            str = str.substr(0, 4);
        }
        $("#span_CityName").html(str);
        setCookie("_CityName_", encodeURI(str));
        setCookie("_CityNo_", encodeURI(id));
        // window.location.href = '../index.aspx';
        var urls = window.location.href;
        if (urls != "" && urls.indexOf("movie.aspx") != -1 && urls.indexOf("?") == -1) {    //影片页面
            window.location.href = window.location.href;
        } else if (urls != "" && urls.indexOf("cinema.aspx") != -1 && urls.indexOf("?") == -1) {    //影院页面
            window.location.href = window.location.href;
        } else if (urls != "" && urls.indexOf("schedule.aspx") != -1) { //排期查询页面
            //window.location.href = window.location.href;
            window.location.href = "schedule.aspx";
        } else if (urls != "" && urls.indexOf("exticket_list.aspx") != -1) { //活动促销页面
            window.location.href = window.location.href;
        }
        else if (urls != "" && urls.indexOf("mall") != -1) { //商城页
            window.location.href = window.location.href;
        }
        else {
            window.location.href = '../index.aspx';
        }

    }

    //设置默认值
    if (getCookie("_CityName_") != null) {
        $("#span_CityName").html(getCookie("_CityName_"));

    } else {
        setCookie("_CityName_", encodeURI("北京"));
        setCookie("_CityNo_", encodeURI("110100"));
    }

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


        
    <div class="pbd m-mall-bg">
        <div class="m-mall-con">
            <div class="m-mall-con-order-header sprite" style="background-position:0px -189px;"></div>
            <div class="m-settlement" node-name="cartSmt">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 75px; text-align: left;"><em class="checkbox sprite"></em>全选</th>
                            <th style="text-align: left; width: 340px;">商品信息</th>
                            <th style="width: 140px;">单价</th>
                            <th>优惠</th>
                            <th>数量</th>
                            <th>小计</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($arr as $v)                        
                        <tr>
                            <td style="text-align: left;">
                                <input type="checkbox" name="{{ $v->id }}" value=" " style="width:25px;height:25px"  /></td>

                            <td style="text-align: left;"><dl><dt>
                                     <img height="50" width="50" alt="" src="{{asset('admin/upload/goods/'.$v->gimage)}}"></dt><dd><a href="http://www.cfc.com.cn/mall/ProductDetail.aspx?id=116"> {{ $v->gname }}</a></dd></dl>
                                </td>
                            <td>{{ $v->price }}</td>
                            <td>0.00</td>
                            <td><h4><em class="jian">-</em><input style="height:26px" type="text" class="text" value="2"><em class="jia">+</em></h4></td>
                            <td><span>¥216.00</span></td><td><em class="delete sprite"></em></td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="m-settlement-bottom">
                    <h2><button onclick="checkAll()" style="width:50px;height:30px" >全选</button>

                       <button onclick="del()" style="width:50px;height:30px" >删除</button>
                    </h2>
                    <h3>共<i id="i_count">2</i>件商品，商品总价：<b id="i_totalPrice">¥216.00</b>
                        <a class="m-settlement-but" href="http://www.cfc.com.cn/mall/shoppingCart.aspx#" id="btnSettlement" style="">去结算</a>
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        require.config({
            baseUrl: "/resource/js/mall/src",
            urlArgs: "__ts=" + new Date().getTime()
        });
        require(["pages/mallCart"], function (page) {
            page.init();
        });
    </script>
        


    <script>
        var el = document.getElementsByTagName('input'); 
        var len = el.length; 
       
        function checkAll(){
            for(var i = 0; i < len; i++) { 
            if(el[i].type == "checkbox"){ 
            el[i].checked = true; 
            }
        }
    }
         function del(){
            for(var i = 0; i < len; i++) { 
            if(el[i].type == "checkbox"){ 
            el[i].checked = false; 
            }
        }
    }

   



    </script>


        
        

        



@endsection