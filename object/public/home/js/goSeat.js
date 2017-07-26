
//页面加载完执行
$(function () {
    //getShowFilm();
    //ChangCode();
    //getSeatsList();
    initSeats();
});


var myprice;
var myuserid = 1;
var myseat='';

var SalePrice = 0;
var CinemaNo;
var seqNo = QueryString("seqno");
var SeatCharge;
var Sign;
var FilmNo;
var width;

//选单击座位
function clickSeat(obj) {
    var status = $(obj).parent().attr("Status");
    if (status == 0) {
        var seatSum = $(".seatWarpR .seatSe p").eq(1).find("span").length;
        if (seatSum >= 4) {
            showAlert("最多允许选择四个座位！");
            return;
        }
        var type = $(obj).attr("SeatType");
        if (type == 5 || type == 6) {
            if (seatSum >= 3) {
                showAlert("最多允许选择四个座位！");
                return;
            }
        }
        pitchOnSeat(obj);
    } else if (status == 4) {
        cancelSeat(obj);
    }
    setallmoney();
    //获取当前选中的票数
    var num = $(".seatWarpR .seatSe").find("span").length;
    //获取当前票的价格
    var pri = $("#myprice").html();
    //返回当前总价并显示
    myprice = num*pri;
    $(".mt10 .red").html("￥"+myprice);
}
//选中座位
function pitchOnSeat(obj) {
    var type = $(obj).attr("SeatType");
    var sectionId = $(obj).parent().parent().parent().attr("SectionId");
    var row = $(obj).parent().parent().parent().find("dd").eq(0).find("em").text();
    if (row == "") row = 0;
    var columnNo = $(obj).parent().attr("ColumnNo");
    var seatNo = $(obj).parent().attr("SeatNo");
    var html = "";
    if (type == 5 || type == 6) { //情侣座
        $(obj).attr("src", "/home/images/seat4.jpg");
        $(obj).parent().attr("Status", "4");
        html = "<span seatNo='" + seatNo + "' seatName='" + sectionId + "_" + row + "_" + columnNo + "'> " + row + "排" + columnNo + "座</span>";
        if (type == 5) {
            $(obj).parent().parent().next().find("span img").attr("src", "/home/images/seat4.jpg");
            $(obj).parent().parent().next().find("span").attr("Status", "4");
            columnNo = $(obj).parent().parent().next().find("span").attr("ColumnNo");
            seatNo = $(obj).parent().parent().next().find("span").attr("SeatNo");
        } else {
            $(obj).parent().parent().prev().find("span img").attr("src", "/home/images/seat4.jpg");
            $(obj).parent().parent().prev().find("span").attr("Status", "4");
            columnNo = $(obj).parent().parent().prev().find("span").attr("ColumnNo");
            seatNo = $(obj).parent().parent().prev().find("span").attr("SeatNo");
        }
        html += "<span seatNo='" + seatNo + "' seatName='" + sectionId + "_" + row + "_" + columnNo + "'> " + row + "排" + columnNo + "座</span>";
        $(".seatWarpR .seatSe p").eq(0).hide();
        $(".seatWarpR .seatSe p").eq(1).append(html);
    } else {
        var prevSeat = $(obj).parent().parent().prev(); //上一个座位
        var nextSeat = $(obj).parent().parent().next(); //下一个座位

        if ($(prevSeat).find("img").length == 0) { //走廊座位
            if (isNextSeat(nextSeat)) {
                $(obj).attr("src", "/home/images/seat4.jpg");
                $(obj).parent().attr("Status", "4");
                html = "<span seatNo='" + seatNo + "' seatName='" + sectionId + "_" + row + "_" + columnNo + "'> " + row + "排" + columnNo + "座</span>";
                $(".seatWarpR .seatSe p").eq(0).hide();
                $(".seatWarpR .seatSe p").eq(1).append(html);
                return;
            }
        }
        if ($(nextSeat).find("img").length == 0) { //走廊座位
            if (isPrevSeat(prevSeat)) {
                $(obj).attr("src", "/home/images/seat4.jpg");
                $(obj).parent().attr("Status", "4");
                html = "<span seatNo='" + seatNo + "' seatName='" + sectionId + "_" + row + "_" + columnNo + "'> " + row + "排" + columnNo + "座</span>";
                $(".seatWarpR .seatSe p").eq(0).hide();
                $(".seatWarpR .seatSe p").eq(1).append(html);
                return;
            }
        }
        if (isNextSeat(nextSeat, prevSeat)) {
            $(obj).attr("src", "/home/images/seat4.jpg");
            $(obj).parent().attr("Status", "4");
            html = "<span seatNo='" + seatNo + "' seatName='" + sectionId + "_" + row + "_" + columnNo + "'> " + row + "排" + columnNo + "座</span>";
            $(".seatWarpR .seatSe p").eq(0).hide();
            $(".seatWarpR .seatSe p").eq(1).append(html);
            return;
        }
        showAlert("请连续选择座位，不要留下单个的空闲座位！");
        return;
    }
}
//判断右边座位是否可锁定
function isPrevSeat(prevSeat) {
    if ($(prevSeat).find("img").length == 0) return true;
    var prevStatus = $(prevSeat).find("span").attr("Status"); //上个座位状态
    if (prevStatus == 0) {
        var prevSeat2 = $(prevSeat).prev();
        if ($(prevSeat2).find("img").length == 1) {
            var prevSeat2Status = $(prevSeat2).find("span").attr("Status");
            if (prevSeat2Status == 4) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    } else if (prevStatus == 4) {
        return true;
    } else {
        return true;
    }
}
//判断左边座位是否可锁定
function isNextSeat(nextSeat) {
    if ($(nextSeat).find("img").length == 0) return true;
    var nextStatus = $(nextSeat).find("span").attr("Status"); //下个座位状态
    if (nextStatus == 0) {
        var nextSeat2 = $(nextSeat).next();
        if ($(nextSeat2).find("img").length == 1) {
            var nextSeat2Status = $(nextSeat2).find("span").attr("Status");
            if (nextSeat2Status == 4) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    } else if (nextStatus == 4) {
        return true;
    } else {
        return true;
    }
}
//判断左右边座位是否可锁定
function isNextSeat(nextSeat, prevSeat) {
    var nextStatus = $(nextSeat).find("span").attr("Status"); //下个座位状态
    var prevStatus = $(prevSeat).find("span").attr("Status"); //上个座位状态
    var prevSeat2 = $(prevSeat).prev(); //左边第二个座位
    var nextSeat2 = $(nextSeat).next(); // 右边第二个座位
    if (nextStatus == 0 && prevStatus == 0) {
        if ($(nextSeat2).find("img").length == 1) {
            if ($(nextSeat2).find("span").attr("Status") == 4) {
                return false;
            } else {
                if ($(prevSeat2).find("img").length == 1) {
                    if ($(nextSeat2).find("span").attr("Status") == 0 && $(prevSeat2).find("span").attr("Status") == 0) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
    else if (nextStatus == 0 && prevStatus == 4) {
        if ($(nextSeat2).find("img").length == 1) {
            if ($(nextSeat2).find("span").attr("Status") == 4) {
                return false;
            }

        }
    }
    else if ((nextStatus == 4 && prevStatus == 0)) {
        if ($(prevSeat2).find("img").length == 1) {
            if ($(prevSeat2).find("span").attr("Status") == 4)
            { return false; }
        }
    }
    return true;
}
//取消座位
function cancelSeat(obj) {
    var type = $(obj).attr("SeatType");
    var seatNo = $(obj).parent().attr("SeatNo");
    if (type == 5 || type == 6) { //情侣座
        $(obj).attr("src", "../resource/images/seat3.jpg");
        $(obj).parent().attr("Status", "0");
        delSeat(seatNo);
        if (type == 5) {
            $(obj).parent().parent().next().find("span img").attr("src", "../resource/images/seat3.jpg");
            $(obj).parent().parent().next().find("span").attr("Status", "0");
            seatNo = $(obj).parent().parent().next().find("span").attr("SeatNo");
        } else {
            $(obj).parent().parent().prev().find("span img").attr("src", "../resource/images/seat3.jpg");
            $(obj).parent().parent().prev().find("span").attr("Status", "0");
            seatNo = $(obj).parent().parent().prev().find("span").attr("SeatNo");
        }
        delSeat(seatNo);
    } else {
        var prevSeat = $(obj).parent().parent().prev(); //上一个座位
        var nextSeat = $(obj).parent().parent().next(); //下一个座位

        if ($(prevSeat).find("img").length == 0) { //走廊座位
            cancelNextSeat(obj, nextSeat);
            return;
        }
        if ($(nextSeat).find("img").length == 0) { //走廊座位
            cancelPrevSeat(obj, prevSeat);
            return;
        }
        cancelMiddleSeat(obj, prevSeat, nextSeat);
    }
}
//取消左边座位
function cancelPrevSeat(obj, prevSeat) {
    var seatNo = $(obj).parent().attr("SeatNo");
    $(obj).attr("src", "/home/images/seat1.jpg");
    $(obj).parent().attr("Status", "0");
    delSeat(seatNo);
    if ($(prevSeat).find("img").length == 1 && $(prevSeat).find("span").attr("Status") == 4) {
        $(prevSeat).find("span img").attr("src", "/home/images/seat1.jpg");
        $(prevSeat).find("span").attr("Status", "0");
        seatNo = $(prevSeat).find("span").attr("SeatNo");
        delSeat(seatNo);
    }
}
//取消右边座位
function cancelNextSeat(obj, nextSeat) {
    var seatNo = $(obj).parent().attr("SeatNo");
    $(obj).attr("src", "/home/images/seat1.jpg");
    $(obj).parent().attr("Status", "0");
    delSeat(seatNo);
    if ($(nextSeat).find("img").length == 1 && $(nextSeat).find("span").attr("Status") == 4) {
        $(nextSeat).find("span img").attr("src", "/home/images/seat1.jpg");
        $(nextSeat).find("span").attr("Status", "0");
        seatNo = $(nextSeat).find("span").attr("SeatNo");
        delSeat(seatNo);
    }
}
//取消中间座位
function cancelMiddleSeat(obj, prevSeat, nextSeat) {
    var seatNo = $(obj).parent().attr("SeatNo");
    delSeat(seatNo);
    var nextStatus = $(nextSeat).find("span").attr("Status"); //下个座位状态
    var prevStatus = $(prevSeat).find("span").attr("Status"); //上个座位状态
    var prevSeat2 = $(prevSeat).prev(); //左边第二个座位
    var nextSeat2 = $(nextSeat).next(); // 右边第二个座位
    if (nextStatus == 4 && prevStatus != 4) {
        if ($(nextSeat2).find("img").length == 0) {
            $(nextSeat).find("span img").attr("src", "/home/images/seat1.jpg");
            $(nextSeat).find("span").attr("Status", "0");
            seatNo = $(nextSeat).find("span").attr("SeatNo");
            delSeat(seatNo);
        }
    } else if (nextStatus != 4 && prevStatus == 4) {
        if ($(prevSeat2).find("img").length == 0) {
            $(prevSeat).find("span img").attr("src", "/home/images/seat1.jpg");
            $(prevSeat).find("span").attr("Status", "0");
            seatNo = $(prevSeat).find("span").attr("SeatNo");
            delSeat(seatNo);
        }
    } else if (nextStatus == 4 && prevStatus == 4) {
        if ($(prevSeat2).find("img").length == 0 && $(nextSeat2).find("img").length == 0) {
            $(prevSeat).find("span img").attr("src", "/home/images/seat1.jpg");
            $(prevSeat).find("span").attr("Status", "0");
            seatNo = $(prevSeat).find("span").attr("SeatNo");
            delSeat(seatNo);
        } else if ($(prevSeat2).find("img").length == 1 && $(nextSeat2).find("img").length == 0) {
            $(nextSeat).find("span img").attr("src", "/home/images/seat1.jpg");
            $(nextSeat).find("span").attr("Status", "0");
            seatNo = $(nextSeat).find("span").attr("SeatNo");
            delSeat(seatNo);
        } else if ($(prevSeat2).find("img").length == 0 && $(nextSeat2).find("img").length == 1) {
            $(prevSeat).find("span img").attr("src", "/home/images/seat1.jpg");
            $(prevSeat).find("span").attr("Status", "0");
            seatNo = $(prevSeat).find("span").attr("SeatNo");
            delSeat(seatNo);
        } else {
            if ($(prevSeat2).find("span").attr("Status") == 1 && $(nextSeat2).find("span").attr("Status") == 0) {
                $(nextSeat).find("span img").attr("src", "/home/images/seat1.jpg");
                $(nextSeat).find("span").attr("Status", "0");
                seatNo = $(nextSeat).find("span").attr("SeatNo");
                delSeat(seatNo);
            } else {
                $(prevSeat).find("span img").attr("src", "/home/images/seat1.jpg");
                $(prevSeat).find("span").attr("Status", "0");
                seatNo = $(prevSeat).find("span").attr("SeatNo");
                delSeat(seatNo);
            }
        }
    }
    $(obj).attr("src", "/home/images/seat1.jpg");
    $(obj).parent().attr("Status", "0");
}
//删除座位
function delSeat(seatNo) {
    $(".seatWarpR .seatSe p span").each(function () {
        if ($(this).attr("seatNo") == seatNo) {
            $(this).remove();
        }
    });
    if ($(".seatWarpR .seatSe p span").length == 0) {
        $(".seatWarpR .seatSe p").eq(0).show();
    }
}

//是否可以提交
function isCheack() {
    // if ($.trim(CinemaNo) == "" || $.trim(seqNo) == "" || $.trim(SalePrice) == "") {
    //     showAlert("页面加载异常，请重新刷新页面在选座！");
    //     return "false";
    // }
    var mobileNo = $("#mobileNo").val();
    if ($.trim(mobileNo) == "") {
        showAlert("请输入接受电子票的手机号码！");
        return "false";
    }
    if (!CheckMobile(mobileNo)) {
        showAlert("请输入正确的手机号码！");
        return "false";
    }
    var seatNo = "";
    var seatName = "";
    var proCode = "";
    var proNum = "";
    if ($(".seatWarpR").find('spn[seatno]').length > 4) {
        showAlert("同一个场次座位数不可以超过4个，请取消多余座位！");
        return "false";
    }
    $(".seatWarpR .seatSe p").eq(1).find("span").each(function () {
        seatNo += $(this).attr("seatNo") + "|";
        seatName += $(this).attr("seatName") + "|";
    });
    if ($.trim(seatNo) == "" || $.trim(seatName) == "") {
        showAlert("请选择座位！");
        return "false";
    }
    $(".seatWarpR .seatSe p").eq(2).find("span").each(function () {
        proCode += $(this).attr("procode") + "|";
        proNum += $(this).attr("pronum") + "|";
    });

    var code = $("#verifyCode").val();
    if ($.trim(code) == "") {
        showAlert("请输入验证码！");
        return "false";
    }
    seatNo = seatNo.substring(0, seatNo.length - 1);
    seatName = seatName.substring(0, seatName.length - 1);
    if (proCode != "")
        proCode = proCode.substring(0, proCode.length - 1);
    if (proNum != "")
        proNum = proNum.substring(0, proNum.length - 1);
    var str = "&cinemaNo=" + CinemaNo + "&seatNo=" + seatNo + "&proCode=" + proCode + "&proNum=" + proNum + "&sealPrice=" + SalePrice + "&seatName=" + seatName + "&mobileNo=" + mobileNo + "&seatCharge=" + SeatCharge + "&sign=" + Sign + "&verifyCode=" + code;
    return str;
}

//创建选座订单
function createOrder() {
    var myseat = $(".seatWarpR .seatSe p").eq(1).find("span");

    $.each(myseat,function(){
        myseat = myseat + $(this).html()+'_';
    })
    var myshowid = $('#myshowid').html();
    var myDate = new Date();
    // var str = isCheack();
    var url = "{{ url('/movieorder') }}";
    var myphone = '15383503355';
    var number = myDate.getTime()+Math.floor(Math.random()*10).toString();
    // alert(myprice);
    // alert(number);
    // alert(myuserid);
    // alert(myshowid);
    // alert(myseat);
    // alert(myphone);
    // if (str == "false") {
    //     return;
    // }
    $.ajax({
        type: "post",
        dataType: "json",
        url:url,
        data: {'_token':"{{ csrf_token() }}"},
        // cache: false,
        // beforeSend: function () { //请求前触发
        //     window.Processing();
        // },
        success: function (data) {
            alert(data);
            // if (data != null && data != "") {
            //     var json = window.eval(data);
            //     if (json.errorCode == "0") {
            //         window.location.href = "buyinfo.aspx?orderno=" + json.errMsg;
            //     } else {
            //         showAlert(json.errMsg);
            //     }
            // } else {
            //     showAlert("创建订单失败，请重新刷新页面！");
            // }
        },
        // complete: function () { //请求完成后触发
        //     window.Complete();
        // },
        error: function () {
            alert("创建订单请求失败，请重新刷新页面！");
        }
    });
}
function enterSumbit() {
    var event = arguments.callee.caller.arguments[0] || window.event; //消除浏览器差异
    if (event.keyCode == 13) {
        createOrder();
    }
}
//更换场次
function changeTheNumber() {
    $.ajax({
        type: "post",
        dataType: "json",
        url: "HandlerGoSeat.ashx",
        data: "action=GetShowDateTimeByFilmAndCinemaNo&cinemaNo=" + CinemaNo + "&filmNo=" + FilmNo,
        cache: true,
        beforeSend: function () { //请求前触发
            $("#showBox").show();
        },
        success: function (data) {
            if (data != null && data != "") {
                $(".chaneTurn").css("background-color", "#572349");
                var list = window.eval(data);
                binNumber(list);
                $(".trunShow").show();
            } else {
                showAlert("获取不到其它场次信息！");
            }
        },
        complete: function () { //请求完成后触发
            $("#showBox").hide();
        },
        error: function () {
            showAlert("获取场次出错，请重新刷新页面！");
        }
    });
}
//绑定场次
function binNumber(obj) {
    var date = new window.Date(window.Date.parse(obj[0].ShowDate.replace(/-/g, "/"))).format('yyyy-MM-dd');
    var dateHtml = "<li class='cur' onclick='clickDate(this)'>" + date + "</li>";
    var timeHtml = "<div class='trunCon' date='" + date + "'>";
    for (var i = 0; i < obj.length; i++) {
        var showDate = new window.Date(window.Date.parse(obj[i].ShowDate.replace(/-/g, "/"))).format('yyyy-MM-dd');
        if (date != showDate) {
            date = showDate;
            dateHtml += "<li class='nor' onclick='clickDate(this)'>" + date + "</li>";
            timeHtml += "</div><div class='trunCon' style='display: none;' date='" + date + "'>";
        }
        if (seqNo == obj[i].SeqNo)
            timeHtml += "<a class='curti'>" + obj[i].ShowTime + "</a>";
        else
            timeHtml += "<a href='../buy/GoSeat.aspx?seqno=" + obj[i].SeqNo + "'>" + obj[i].ShowTime + "</a>";
    }
    timeHtml += "</div>";
    $(".trunStit ul").html(dateHtml);
    $(".trunShow .trunCon").remove();
    $(".trunShow").append(timeHtml);
}
//选择场次日期事件
// function clickDate(obj) {
//     $(".trunStit ul li").each(function () {
//         if ($(this).text() == $(obj).text()) {
//             $(this).addClass("cur");
//             $(this).removeClass("nor");
//             $(".trunShow .trunCon").each(function () {
//                 if ($(this).attr("date") == $(obj).text()) {
//                     $(this).css("display", "block");
//                 } else {
//                     $(this).css("display", "none");
//                 }
//             });
//         } else {
//             $(this).removeClass("cur");
//             $(this).addClass("nor");
//         }
//     });
// }
// function over() {
//     $(".chaneTurn").css("background-color", "");
//     $(".trunShow").hide();
// }
// function out() {
//     $(".chaneTurn").css("background-color", "#572349");
//     $(".trunShow").show();
// }
// //获得验证码
// function ChangCode() {
//     document.getElementById("Image1").src = '../user/checkCode.aspx?id=' + window.Math.random();
// }

function pronum(opt, code, proname, price) {
    var sellpro = $("#sellpro" + code);
    if (sellpro == null || sellpro == undefined || sellpro == "") return;
    var num = sellpro.val() == "" ? 0 : sellpro.val();

    $(".seatWarpR .seatSe p").eq(2).find("span").each(function () {
        if ($(this).attr("procode") == code) {
            $(this).remove();
        }
    });

    if (opt == 'add') {
        if (num < 999)
            sellpro.val(parseInt(num) + 1);

    }
    else {
        if (num <= 1) {
            sellpro.val('0');
            setallmoney();
            return;
        }
        sellpro.val(parseInt(num) - 1);

    }
    var html = "<span procode='" + code + "' pronum='" + sellpro.val() + "' price='" + "{{ $show[0]->price }}" + "'> " + proname +" /"+ sellpro.val() + "份</span>";
    $(".seatWarpR .seatSe p").eq(2).append(html);

    setallmoney();
}

function setallmoney() {
    var sellproPrice = 0;
    $(".seatWarpR .seatSe p").eq(2).find("span").each(function () {
        sellproPrice = sellproPrice + $(this).attr("pronum") * $(this).attr("price");
    });
    $(".mt10 .red").html("￥" + window.parseFloat($(".seatWarpR .seatSe p").eq(1).find("span").length * sellproPrice).toFixed(2));
}

function changeNum(code, proname, price) {
    var sellpro = $("#sellpro" + code);
    if (sellpro == null || sellpro == undefined || sellpro == "") return;
    var num = sellpro.val() == "" ? 0 : sellpro.val();
    $(".seatWarpR .seatSe p").eq(2).find("span").each(function () {
        if ($(this).attr("procode") == code) {
            $(this).remove();
        }
    });
    if (num <= 0) {
        sellpro.val('0');
        setallmoney();
        return;
    }
    var html = "<span procode='" + code + "' pronum='" + num + "' price='" + price + "'> " + proname +" /"+ num + "份</span>";
    $(".seatWarpR .seatSe p").eq(2).append(html);

    setallmoney();
}

function initSeats() {
    var seats = GetQueryString("seatNo");
    if (seats) {
        var seatNo = seats.split("|");
        $.each(seatNo, function(i, e) {
            $("span[seatno='" + e + "']>img").click();
        });
    }
}

