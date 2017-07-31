@extends('home.parent')
@section('content')

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


        
    <input name="ctl00$ContentPlaceHolder1$flag" type="hidden" id="ContentPlaceHolder1_flag" class="hiddflag" value="1" />
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
        <div id="lblMenuName"></div>
    </div>
    <ul node-name="nav">
        <li>
            <h2>
                <em class="dataicon sprite"></em><a style="background: none;" href="{{ url('home/user')}}" id="m_1">我的资料</a>
            </h2>
        </li>
        <li>
            <h2>
                <em class="ordericon sprite"></em>我的订单
            </h2>

            <p>
                <a id="m_2" href="../user/ordersManager.aspx">购票订单</a>
               
                <a id="m_6" href="../mall/MyProductOrder.aspx">购商品订单</a>
            </p>
        </li>
        
        <li>
            <h2>
                <em class="integralicon sprite"></em><a style="background: none;" id="m_10" href="{{ url('home/score') }}">我的积分</a>
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
        var menuname = '购票订单';
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
                
                <!--购票订单开始-->
                <div class="r_menuc" id="div_num1">
                    <div class="menu_con">
                        <div class="search_area cf">
                        <div class="orderSeach" >
                                  订单号：<input name="ctl00$ContentPlaceHolder1$orderNo" type="text" id="ContentPlaceHolder1_orderNo" maxlength="15" class="text2" /> 
                                  手机号： <input name="ctl00$ContentPlaceHolder1$mobile" type="text" id="ContentPlaceHolder1_mobile" maxlength="11" class="text2" style="width:93px;" /><em class="errtip"></em> 
                                  支付状态：<select name="ctl00$ContentPlaceHolder1$payStatus" id="ContentPlaceHolder1_payStatus" style="width:90px;">
	<option selected="selected" value="0">所有</option>
	<option value="1">未支付</option>
	<option value="3">已支付</option>
</select>
                                  </div>
                                  <div class="orderSeach">
                                  时　间：<input name="ctl00$ContentPlaceHolder1$startDate" type="text" id="ContentPlaceHolder1_startDate" onfocus="HS_setDate(this)" readonly="readonly" class="text2" />
                                            -
                                            <input name="ctl00$ContentPlaceHolder1$endDate" type="text" id="ContentPlaceHolder1_endDate" onfocus="HS_setDate(this)" readonly="readonly" class="text2" />  订单状态：<select name="ctl00$ContentPlaceHolder1$orderStatus" id="ContentPlaceHolder1_orderStatus" style="width:90px;">
	<option selected="selected" value="0">所有</option>
	<option value="1">交易成功</option>
	<option value="4">未处理</option>
	<option value="2">已超时</option>
	<option value="5">异常退款</option>
	<option value="6">正常退款</option>
</select>
                                                <input name="ctl00$ContentPlaceHolder1$find" type="submit" id="ContentPlaceHolder1_find" class="subc_btn" value="查 询" style=" margin-left:10px;" onclick="return checkfind();" />
                                  </div>
                            
                        </div>
                        <div>
                            <table width="745" border="0" cellpadding="0" cellspacing="0" class="t_head">
                                <tr>
                                    <td width="235" height="20" align="center">
                                        订单详情
                                    </td>
                                    <td height="20" align="center">
                                        单价/数量
                                    </td>
                                    <td height="20" align="center">
                                        实付款
                                    </td>
                                    
                                    <td width="120" height="20" align="center">
                                        状态
                                    </td>
                                    <td width="135" height="20" align="center">
                                        操作
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                        <!---分页开始-->
                        
                        <!---分页结束-->
                    </div>
                </div>
                <!--购票订单结束-->
                </div>
            </div>
        </div>
    </div>
    <div id="fullbg"></div> 
    <div id="dialog" class="dialog-dhm"></div> 
     
    <script type="text/javascript">
        
        function menuShowclass(value) {
            $("#m" + value).attr("class", "current");
        }
        function menuHideclass(value) {
            $(".r_menu li").attr("class", "");
            $("#m1").attr("class", "current");
        }

        function isDelete() {
            return confirm("你确定要撤销此订单?");
        }

        function jumpurl(url) {
            if (url != '')
                window.location.href = url;
        }
        function reloadpage() {
            window.location.href = 'ordersManager.aspx';
        }
        
        function couvertshow() {
            $(".couvert").show();
        }
        function hidelookBtn() {
            $(".lookBtn").hide();
        }
         
        function closeBg() {
            $("#fullbg,#dialog").hide();
        }

        function QRcodeClick(obj)
        {
            $.post('ordersManager.ashx?action=loadMyOrders&orderNo=' + obj + "&flg=0", function (data) {
                if (data != "") {
                   
                    $("#dialog").html(data);
                }
            });
            var bh = $("body").height();
            var bw = $("body").width();
            $("#fullbg").css({
                height: bh,
                width: bw,
                display: "block"
            });
            $("#dialog").show();
        }

        function checkfind() {
            var orderNo = $("#ContentPlaceHolder1_orderNo").val();
            var mobile = $("#ContentPlaceHolder1_mobile").val();
            if ($.trim(orderNo) != "") {
                if (!CheckNumberOrEn($.trim(orderNo)) || $.trim(orderNo).length > 15) {
                    $("#ContentPlaceHolder1_orderNo").parent().find("em").text("请输入正确的订单编号！").show();
                    return false;
                } else {
                    $("#ContentPlaceHolder1_orderNo").parent().find("em").hide();
                }
            }
            if ($.trim(mobile) != "")
            {
                if (!CheckMobile($.trim(mobile)) || $.trim(mobile).length > 12) {
                    $("#ContentPlaceHolder1_mobile").parent().find("em").text("请输入正确的手机号！").show();
                    return false;
                } else {
                    $("#ContentPlaceHolder1_mobile").parent().find("em").hide();
                }
            }
            return true;
        
        }
        

    </script>


@endsection