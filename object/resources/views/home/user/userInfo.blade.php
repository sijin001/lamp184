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

    function notify() {
        showAlert("商城正在维护升级中，预计于2016年7月18日16时完成，请稍候访问!");
    }
</script>


        

    <input name="ctl00$ContentPlaceHolder1$flag" type="hidden" id="ContentPlaceHolder1_flag" class="hidd" value="1" />
    <div class="pbd my-bg">
        <div class="con">
            <div class="y-bg-lty sprite"></div>
            <div class="y-bg-rty sprite"></div>
            
            <!---左边内容开始-->
            
<link href="css/reset-min.css" rel="stylesheet" type="text/css" />
<link href="css/user.css" rel="stylesheet" type="text/css" />
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/my.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
<script src="js/mall/extra/require.min.js"></script>


<div class="layout1" id="m_centerNav">
    <div class="title"><em class="titleicon1 sprite"></em>
        <br>
        <div>我的积分：{{ session('user')->score }}分</div>
    </div>
    <ul node-name="nav">
        <li>
            <h2>
                <em class="dataicon sprite"></em><a style="background: none;" href="{{ url('home/user')}}" id="m_1">我的资料</a>
            </h2>
        </li>
        <li>
            <h2>
                <em class="ordericon sprite"></em><a href="{{ url('home/order') }}">购票订单</a><em class="triangleicon sprite"></em>
            </h2>

            
        </li>
        
       
       
    </ul>
</div>



<script type="text/javascript">

    require.config({
        baseUrl: "../resource/js/mall/src/",
        urlArgs: "__ts=" + new Date().getTime()
    });

    require(["pages/myCenter"], function (page) {
        page.init();
    });

    $(function () {
        var menuname = '我的资料';
       $("#lblMenuName").html(menuname);
  
       var indexFlg;
       var pFlg = 1;
     
       switch (menuname) {
           case "我的资料":
               indexFlg = '1';
               pFlg = 0;


               break;
           case "购票订单":
               indexFlg = '2';
               break;
           case "购卡订单":
               indexFlg = '3';
               break;
           case "充值订单":
               indexFlg = '4';
               break;
           case "购卖品订单":
               indexFlg = '5';
               break;
           case "购商品订单":
               indexFlg = '6';
               break;
           case "中影通会员卡":
               indexFlg = '7';
               break;
           case "我的中影通会员卡":
               indexFlg = '7';
               break;
           case "影城会员卡":
               indexFlg = '8';
               break;
           case "我的电子券":
               indexFlg = '9';
               break;
           case "我的积分":
               indexFlg = '10';
               pFlg = 0;
               break;
           case "我的意见":
               indexFlg = '11';
               pFlg = 0;
               break;
           default:
               indexFlg = '1';
               pFlg = 0;
               break;

       }
       $('#m_centerNav li').attr("class", "");
       $('#m_centerNav li p').css("display", "none");
       $('#m_centerNav li a').attr("class", "");

       $('#m_' + indexFlg).attr("class", "hover");
       $('#m_' + indexFlg).parent().parent().attr("class", "hover");
       if (pFlg == 1)
           $('#m_' + indexFlg).parent().css("display", "block");

   });


    /*********** 以下为日期控件  *************/
    function HS_DateAdd(interval, number, date) {
        number = parseInt(number);
        if (typeof (date) == "string") { var date = new Date(date.split("-")[0], date.split("-")[1], date.split("-")[2]) }
        if (typeof (date) == "object") { var date = date }
        switch (interval) {
            case "y": return new Date(date.getFullYear() + number, date.getMonth(), date.getDate()); break;
            case "m": return new Date(date.getFullYear(), date.getMonth() + number, checkDate(date.getFullYear(), date.getMonth() + number, date.getDate())); break;
            case "d": return new Date(date.getFullYear(), date.getMonth(), date.getDate() + number); break;
            case "w": return new Date(date.getFullYear(), date.getMonth(), 7 * number + date.getDate()); break;
        }
    }
    function checkDate(year, month, date) {
        var enddate = ["31", "28", "31", "30", "31", "30", "31", "31", "30", "31", "30", "31"];
        var returnDate = "";
        if (year % 4 == 0) { enddate[1] = "29" }
        if (date > enddate[month]) { returnDate = enddate[month] } else { returnDate = date }
        return returnDate;
    }

    function WeekDay(date) {
        var theDate;
        if (typeof (date) == "string") { theDate = new Date(date.split("-")[0], date.split("-")[1], date.split("-")[2]); }
        if (typeof (date) == "object") { theDate = date }
        return theDate.getDay();
    }
    function HS_calender() {
        var lis = "";
        var style = "";
        style += "<style type='text/css'>";
        style += ".calender { width:200px; height:auto; font-size:12px; margin-right:14px; background:url(calenderbg.gif) no-repeat right center #fff; border:1px solid #397EAE; padding:1px}";
        style += ".calender ul {list-style-type:none; margin:0; padding:0;}";
        style += ".calender .day { background-color:#EDF5FF; height:20px;}";
        style += ".calender .day li,.calender .date li{ float:left; width:14%; height:20px; line-height:20px; text-align:center}";
        style += ".calender li a { text-decoration:none; font-family:Tahoma; font-size:11px; color:#333}";
        style += ".calender li a:hover { color:#f30; text-decoration:underline}";
        style += ".calender li a.hasArticle {font-weight:bold; color:#f60 !important}";
        style += ".lastMonthDate, .nextMonthDate {color:#bbb;font-size:11px}";
        style += ".selectThisYear a, .selectThisMonth a{text-decoration:none; margin:0 2px; color:#000; font-weight:bold}";
        style += ".calender .LastMonth, .calender .NextMonth{ text-decoration:none; color:#000; font-size:18px; font-weight:bold; line-height:16px;}";
        style += ".calender .LastMonth { float:left;}";
        style += ".calender .NextMonth { float:right;}";
        style += ".calenderBody {clear:both}";
        style += ".calenderTitle {text-align:center;height:20px; line-height:20px; clear:both}";
        style += ".today{ background-color:#ffffaa;border:1px solid #f60; padding:2px}";
        style += ".today a { color:#f30; }";
        style += ".calenderBottom {clear:both; border-top:1px solid #ddd; padding: 3px 0; text-align:left}";
        style += ".calenderBottom a {text-decoration:none; margin:2px !important; font-weight:bold; color:#000}";
        style += ".calenderBottom a.closeCalender{float:right}";
        style += ".closeCalenderBox {float:right; border:1px solid #000; background:#fff; font-size:9px; width:11px; height:11px; line-height:11px; text-align:center;overflow:hidden; font-weight:normal !important}";
        style += "</style>";

        var now;
        if (typeof (arguments[0]) == "string") {
            selectDate = arguments[0].split("-");
            var year = selectDate[0];
            var month = parseInt(selectDate[1]) - 1 + "";
            var date = selectDate[2];
            now = new Date(year, month, date);
        } else if (typeof (arguments[0]) == "object") {
            now = arguments[0];
        }
        var lastMonthEndDate = HS_DateAdd("d", "-1", now.getFullYear() + "-" + now.getMonth() + "-01").getDate();
        var lastMonthDate = WeekDay(now.getFullYear() + "-" + now.getMonth() + "-01");
        var thisMonthLastDate = HS_DateAdd("d", "-1", now.getFullYear() + "-" + (parseInt(now.getMonth()) + 1).toString() + "-01");
        var thisMonthEndDate = thisMonthLastDate.getDate();
        var thisMonthEndDay = thisMonthLastDate.getDay();
        var todayObj = new Date();
        today = todayObj.getFullYear() + "-" + todayObj.getMonth() + "-" + todayObj.getDate();

        for (i = 0; i < lastMonthDate; i++) {  // Last Month's Date
            lis = "<li class='lastMonthDate'>" + lastMonthEndDate + "</li>" + lis;
            lastMonthEndDate--;
        }
        for (i = 1; i <= thisMonthEndDate; i++) { // Current Month's Date

            if (today == now.getFullYear() + "-" + now.getMonth() + "-" + i) {
                var todayString = now.getFullYear() + "-" + (parseInt(now.getMonth()) + 1).toString() + "-" + i;
                lis += "<li><a href=javascript:void(0) class='today' onclick='_selectThisDay(this)' title='" + now.getFullYear() + "-" + (parseInt(now.getMonth()) + 1) + "-" + i + "'>" + i + "</a></li>";
            } else {
                lis += "<li><a href=javascript:void(0) onclick='_selectThisDay(this)' title='" + now.getFullYear() + "-" + (parseInt(now.getMonth()) + 1) + "-" + i + "'>" + i + "</a></li>";
            }

        }
        var j = 1;
        for (i = thisMonthEndDay; i < 6; i++) {  // Next Month's Date
            lis += "<li class='nextMonthDate'>" + j + "</li>";
            j++;
        }
        lis += style;

        var CalenderTitle = "<a href='javascript:void(0)' class='NextMonth' onclick=HS_calender(HS_DateAdd('m',1,'" + now.getFullYear() + "-" + now.getMonth() + "-" + now.getDate() + "'),this) title='Next Month'>&raquo;</a>";
        CalenderTitle += "<a href='javascript:void(0)' class='LastMonth' onclick=HS_calender(HS_DateAdd('m',-1,'" + now.getFullYear() + "-" + now.getMonth() + "-" + now.getDate() + "'),this) title='Previous Month'>&laquo;</a>";
        CalenderTitle += "<span class='selectThisYear'><a href='javascript:void(0)' onclick='CalenderselectYear(this)' title='Click here to select other year' >" + now.getFullYear() + "</a></span>年<span class='selectThisMonth'><a href='javascript:void(0)' onclick='CalenderselectMonth(this)' title='Click here to select other month'>" + (parseInt(now.getMonth()) + 1).toString() + "</a></span>月";

        if (arguments.length > 1) {
            arguments[1].parentNode.parentNode.getElementsByTagName("ul")[1].innerHTML = lis;
            arguments[1].parentNode.innerHTML = CalenderTitle;

        } else {
            var CalenderBox = style + "<div class='calender'><div class='calenderTitle'>" + CalenderTitle + "</div><div class='calenderBody'><ul class='day'><li>日</li><li>一</li><li>二</li><li>三</li><li>四</li><li>五</li><li>六</li></ul><ul class='date' id='thisMonthDate'>" + lis + "</ul></div><div class='calenderBottom'><a href='javascript:void(0)' class='closeCalender' onclick='closeCalender(this)'>关闭</a><span><span><a href=javascript:void(0) onclick='_selectThisDay(this)' title='" + todayString + "'>Today</a></span></span></div></div>";
            return CalenderBox;
        }
    }
    function _selectThisDay(d) {
        var boxObj = d.parentNode.parentNode.parentNode.parentNode.parentNode;
        boxObj.targetObj.value = d.title;
        boxObj.parentNode.removeChild(boxObj);
    }
    function closeCalender(d) {
        var boxObj = d.parentNode.parentNode.parentNode;
        boxObj.parentNode.removeChild(boxObj);
    }

    function CalenderselectYear(obj) {
        var opt = "";
        var thisYear = obj.innerHTML;
        for (i = 1970; i <= 2020; i++) {
            if (i == thisYear) {
                opt += "<option value=" + i + " selected>" + i + "</option>";
            } else {
                opt += "<option value=" + i + ">" + i + "</option>";
            }
        }
        opt = "<select onblur='selectThisYear(this)' onchange='selectThisYear(this)' style='font-size:11px'>" + opt + "</select>";
        obj.parentNode.innerHTML = opt;
    }

    function selectThisYear(obj) {
        HS_calender(obj.value + "-" + obj.parentNode.parentNode.getElementsByTagName("span")[1].getElementsByTagName("a")[0].innerHTML + "-1", obj.parentNode);
    }

    function CalenderselectMonth(obj) {
        var opt = "";
        var thisMonth = obj.innerHTML;
        for (i = 1; i <= 12; i++) {
            if (i == thisMonth) {
                opt += "<option value=" + i + " selected>" + i + "</option>";
            } else {
                opt += "<option value=" + i + ">" + i + "</option>";
            }
        }
        opt = "<select onblur='selectThisMonth(this)' onchange='selectThisMonth(this)' style='font-size:11px'>" + opt + "</select>";
        obj.parentNode.innerHTML = opt;
    }
    function selectThisMonth(obj) {
        HS_calender(obj.parentNode.parentNode.getElementsByTagName("span")[0].getElementsByTagName("a")[0].innerHTML + "-" + obj.value + "-1", obj.parentNode);
    }
    function HS_setDate(inputObj) {
        var calenderObj = document.createElement("span");
        calenderObj.innerHTML = HS_calender(new Date());
        calenderObj.style.position = "absolute";
        calenderObj.targetObj = inputObj;
        inputObj.parentNode.insertBefore(calenderObj, inputObj.nextSibling);
    }

</script>



            <!---左边内容结束-->
            
            <div class="layout2" id="m_address">
                <div class="data">
                    <div class="data-nav">
                        <ul>
                            <li onclick="showselect('1')" id="m1" >基本信息</li>
                           
                            <li onclick="showselect('2')" id="m2" >修改密码</li>
                            <li onclick="showselect('3')" id="m3" >我的地址</li>
                            <div class="line"></div>
                        </ul>
                    </div>
                     
                    <!---基本信息-->
                    <div id="num1" class="r_menuc">
                @if (session('msg'))
                        <script>
                        alert("{{ session('msg') }}");
                        </script>
                @endif
                        <div class="menu_con" id="">
                            <div class="base_info">
                            <form action="{{ url('home/user/'.session('user')->id) }}" method="post" enctype="multipart/form-data" >
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <div class="f_info">
                                                <span>昵　称：</span><input name="name" type="text" id="ContentPlaceHolder1_name" maxlength="10" class="wid300 text" value="{{ session('user')->name }}" /><em class="errtip"></em>
                                            </div>
                                            <!--f_info-->
                                            <div class="f_info">
                                                <span>性　别：</span><input value="0" name="sex" type="radio" id="ContentPlaceHolder1_boy" class="rboy" checked="checked" />
                                                男
                                        <input value="1" name="sex" type="radio" id="ContentPlaceHolder1_girl" class="rgirl" />
                                                女
                                            </div>
                                            <!--f_info-->
                                            <div class="f_info">
                                                <span>手机号：</span>
                                                <input name="phone" type="text" id="ContentPlaceHolder1_name" maxlength="10" class="wid300 text" value="{{ session('user')->phone }}" /><em class="errtip"></em>
                                            </div>
                                             <div class="f_info"><span>
                                                <img id="userface" class="cuserface" src="{{ asset('admin/upload/photo/'.session('user')->photo) }}" width="50" height="50" /></span>如果你还没有设置自己的头像，系统会显示为默认头像。
                                            </div>
                                             <div class="f_info" style="margin-left: 40px"><span>
                                                <input type="file" name='photo' /></span>
                                            </div>
                                        <!--f_info-->
                                        <div style="margin-top: 20px">
                                            <input  type="submit" id="ContentPlaceHolder1_baseSave" class="subc_btn ml100" value="保 存" />
                                        </div>
                            </form>
                            </div>
                        </div>
                        <div class="menu_con"></div>
                        <div class="menu_con"></div>
                    </div>
                    <!---基本信息 重设手机号-->
                    <div id="num11" class="r_menuc" style="display:none;">
                        <div class="menu_con">
                            <div class="base_info">
                                <div class="f_info">
                                    <span>手机号码：</span>
                                    <input name="ctl00$ContentPlaceHolder1$newMob" type="text" id="ContentPlaceHolder1_newMob" />
                                    <input type="submit" name="ctl00$ContentPlaceHolder1$get_code" value="获取动态码" id="ContentPlaceHolder1_get_code" />
                                </div>
                                <div class="f_info">
                                    <span>动 态 码：</span>
                                    <input name="ctl00$ContentPlaceHolder1$newMobCode" type="text" id="ContentPlaceHolder1_newMobCode" />
                                </div>
                                <div>
                                    <input onclick="__doPostBack('ctl00$ContentPlaceHolder1$setMob','')" name="ctl00$ContentPlaceHolder1$setMob" type="button" id="ContentPlaceHolder1_setMob" class="subc_btn" value="保 存" />
                                </div>
                                <div>
                                    <span id="ContentPlaceHolder1_info" style="color:Red;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <!---修改密码开始-->
                    <div class="r_menuc" id="num2" style="display:none">
                        <div class="menu_con">
                            <div class="base_info">
                            <form action="{{ url('home/user/'.session('user')->id)}}" method="post" enctype="multipart/form-data" >
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                <div class="f_info">
                                    <span>旧密码：</span><input  type="password" id="ContentPlaceHolder1_txtLPassWord" maxlength="20" class="text wid300" />
                                </div>
                                <!--f_info-->
                                <div class="f_info">
                                    <span>新密码：</span><input name="pass" type="password" id="ContentPlaceHolder1_txtNewPassWord" maxlength="20" class="text wid300" />
                                </div>
                                <!--f_info-->
                                <div class="f_info">
                                    <span>确认密码：</span><input  type="password" id="ContentPlaceHolder1_txtPassWord2" maxlength="20" class="text wid300" />
                                </div>
                                <!--f_info-->
                                <div class="f_info">
                                    <input  type="submit" class="subc_btn ml100" value="保 存" onclick="return checkpassword();" />
                                </div>
                            </form>
                                <div>
                                    <span id="ContentPlaceHolder1_passWordMsg" style="color:Red;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---修改密码结束-->
                    <!---我的地址开始-->
                    <div id="num3" style="display:none">
                    <form action="{{ url('home/user/'.session('user')->id) }}" method="post" enctype="multipart/form-data" >
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                        <div class="receipt"">
                           
                            <p>收货人地址管理<span></span></p>
                            <textarea style="width:500px;height:70px;" name="addr" placeholder="{{ session('user')->addr }}"></textarea>
                            <ul  id="usersendNode" node-name="usersendNode">
                            
                            <div style="margin-top: 20px">
                                <input  type="submit" id="ContentPlaceHolder1_baseSave" class="subc_btn ml100" value="修 改" />
                            </div>
                            </ul>
                        </div>
                    </form>

                        <div class="address" node-name="address"></div>
                    </div>
                <!---我的地址结束-->
                    
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        require.config({
            baseUrl: "../resource/js/mall/src/",
            urlArgs: "__ts=" + new Date().getTime()
        });

        require(["pages/userInfo"], function (page) {
            page.init();
        });
        var productsCinema;
        // $(function () {
        //     // 头像展示和选择
        //     for (var i = 1; i < 30; i++) {
        //         $(".image_con").append("<a><img id=" + i + " src=\"../resource/images/userface/" + i + ".jpg\" width=\"50\" height=\"50\"></a>");
        //     }
        //     for (var j = 204; j < 225; j++) {
        //         $(".image_con").append("<a><img id=" + j + " src=\"../resource/images/userface/" + j + ".jpg\" width=\"50\" height=\"50\"></a>");
        //     }
        //     $(".image_con img").click(function () {
        //         $(".cuserface").attr("src", this.src);
        //         $(".hdcface").attr("value", this.id);
        //     });
        //     if ($(".hdcface").attr("value") != '-1') {
        //         var src = "../resource/images/userface/" + $(".hdcface").attr("value") + ".jpg";
        //         $("#userface").attr("src", src);
        //     }

        //     showselect($(".hidd").attr("value"));

        // });



        this.showselect = function (value) {
            $("#num11").hide();
            $("#num2").hide();
            $("#num3").hide();
            $("#num1").hide();
            $("#num4").hide();

            //$(".r_menu li").attr("class", "");
            
            if (value == "11") {
                $("#num11").show();
                //$("#m1").attr("class", "current");
                $(".hidd").attr("value", "1");
            }
            else if (value == "2") {
                $("#num2").show();
                //$("#m2").attr("class", "current");
                $(".hidd").attr("value", "2");
            }
            else if (value == "3") {
                $("#num3").show();
                //$("#m3").attr("class", "current");
                $(".hidd").attr("value", "3");
            }
            else if (value == "4")
            {
                $("#num4").show();
                //$("#m3").attr("class", "current");
                $(".hidd").attr("value", "4");
            }
            else {
                $("#num1").show();
                //$("#m1").attr("class", "current");                
                $(".hidd").attr("value", "1");
            }
            $(".line").css("left", getLeft($(".hidd").attr("value")));
        }

        //验证码成功倒计时
        var msg = $("#ContentPlaceHolder1_info");
        var btn = $("#ContentPlaceHolder1_get_code");
        if (msg.text() == "" && btn.attr("value") == "发送成功") {
            updateTimeLabel(30);
        }
        function updateTimeLabel(time) {
            btn.val(time <= 0 ? "获取动态码" : ("" + (time) + "秒后可重发"));
            var hander = setInterval(function () {
                if (time <= 0) {
                    clearInterval(hander);
                    hander = null;
                    btn.val("获取动态码");
                    btn.attr("disabled", "");
                } else {
                    btn.attr("disabled", "disabled");
                    btn.val("" + (time--) + "秒后可重发");
                }
            }, 1000);
        }

        //function menuShowclass(value) {
        //    $(".line").css("left", getLeft(value));

        //    //$("#m" + value).attr("class", "current");
        //}
        function getLeft(value)
        {
            var left=0;
            switch(value)
            {
                case "1":
                    left = 0;
                    break;
                case "2":
                    left = 92;
                    break;
                case "3":
                    left = 185;
                    break;
                case "4":
                    left = 278;
                    break;

            }
            return left;

        }
        //function menuHideclass(value) {
        //    $(".line").css("left", getLeft($(".hidd").attr("value")));
        //    //$(".r_menu li").attr("class", "");
        //    //$("#m" + $(".hidd").attr("value")).attr("class", "current");
        //}

        //验证用户基本信息
        function checkInfo() {
            var nickname = $("#ContentPlaceHolder1_name").val();
            if ($.trim(nickname) == "") {
                $("#ContentPlaceHolder1_name").parent().find("em").text("昵称不能为空！").show();
                return false;
            } else {
                $("#ContentPlaceHolder1_name").parent().find("em").hide();
            }
            if ($.trim(nickname).length > 20) {
                $("#ContentPlaceHolder1_name").parent().find("em").text("昵称太长！").show();
                return false;
            } else {
                $("#ContentPlaceHolder1_name").parent().find("em").hide();
            }
            return true;
        }

        function checkpassword() {
            var password = $("#ContentPlaceHolder1_txtNewPassWord").val();
            var result = checkPassword(password);
            if (result != true) {
                $("#ContentPlaceHolder1_passWordMsg").text(result);
                return false;
            }
            return true;
        }


        //function sendtypeselect(val)
        //{
        //    $(".receipt li").attr("class", "");
        //    if (val == '1') {
        //        $(".receipt li").eq(0).attr("class", "hover");
        //        m_address.init();
        //    }
        //    else
        //    {
        //        $(".receipt li").eq(1).attr("class", "hover");
        //        m_address.init(null, '2');
        //    }
          
        //}

    </script>




        
        

@endsection

