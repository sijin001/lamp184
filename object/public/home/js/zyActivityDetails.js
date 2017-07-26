//页面加载完执行
var curTicketCount = 0;
$(function() {
    var activityNo = QueryString('activityNo');
    var cinemaNo = "";
    var showDay = "";
    $("#hidCurCinemaNo").val("");
    $("#hidLoadType").val("0");
    $("#hidCurShowDay").val(showDay)
    getShowFilm(activityNo, cinemaNo);
    $(".triggerSh mt15").eq(0).show();
    $(".triggerSh mt15").eq(1).hide();
    $(".times").hide();
    $(".actct ul li").click(function() {
        $(".actct ul li").each(function() {
            $(this).removeClass("cur");
            $(this).addClass("nor");
        });
        $(this).addClass("cur");
        if ($(this).index() == 0) {
            $(".triggerSh mt15").eq(0).show();
            $(".triggerSh mt15").eq(1).hide();
            $(".acInfor").show();
            $(".times").hide();

        } else {
            $(".triggerSh mt15").eq(1).show();
            $(".triggerSh mt15").eq(0).hide();
            $(".acInfor").hide();
            $(".times").show();
        }
    });
    // bind click
    $(".timesC a").live("click", function() {
        $(".timesC a").each(function(index, item) {
            $(this).removeClass("red");
        });
        $(this).addClass("red");
    });
    $("#cinemaList a").live("click", function() {
        $("#cinemaList a").each(function(index, item) {
            $(this).removeClass("red");
        });
        var temCinema = $(this).attr("id");
        $('#' + temCinema).addClass("red");
        fnQueryCinema('' + temCinema);
    });
    $("li:contains('活动影院')").click();
});
String.prototype.endWith = function(str) {
    if (str == null || str == "" || this.length == 0 || str.length > this.length)
        return false;
    if (this.substring(this.length - str.length) == str)
        return true;
    else
        return false;
    return true;
}
function getShowFilm(actNo,cino) {
    //绑定影院下拉列表
    $.ajax({
        type: "post",
        dataType: "text",
        url: "ActivityDetail.ashx",
        data: "action=load_zy_activitydetails&activityNo=" + actNo + "&cinemaNo=" + cino + "&showDate=" + $("#hidCurShowDay").val(),
        cache: false,
        success: function(data) {
            if (data != null && data != "") {
                //var dataObj = window.eval(data); // ActivityInfo  ShowSeqInfo
                //$('#activity_pic').removeAttr("src");
                //var titlePicture = value.TitlePicture.split('|');
                var dataObj = eval("(" + data + ")"); //转换为json对象
                var showDates = "";
                var cinemaList = ""; //影院名称列表
                var curFocusCinema = "";
                var curFocusDay = "";
                var actBeginTime = "";
                var actEndTime = "";
                var showSeqDaysHtml = "<span>放映日期</span> <span style='font-size:13px;color:#999999;'>暂无排期影片</span>";
                var showSeqDetailHtml = "";
                if (!$.isEmptyObject(dataObj)) {
                    $('#activity_pic').attr("src", dataObj.BannerPicture == "" ? "../resource/images/update/acad.jpg" : dataObj.BannerPicture);
                    $("#txtActName").text(dataObj.ActivityName);
                    $("#txtActCategory").text(dataObj.ActivityCategory == "2" ? "影城活动" : "网站活动"); // 活动类别
                    $("#hidCurActivityNo").val(dataObj.ActivityNo);
                    $("#txtActDate").text(dataObj.StartDate.substr(0, 10) + " 至 " + dataObj.EndDate.substr(0, 10)); //活动起止时间
                    //$("#txtActTag").text(""); // 活动类型 dataObj.UseBuyValue
                    actBeginTime = dataObj.StartTime;
                    actEndTime = dataObj.EndTime;
                    $("#txtActHour").text(actBeginTime + " — " + actEndTime);
                    $("#txtUserAmount").text(dataObj.PersonCount); // 活动参与人数
                    curTicketCount = (dataObj.AmountControlType == "1") ? 11 : parseInt(dataObj.ReadCount);
                    $("#txtTicketRemain").text(dataObj.ReadCount == '-1' ? "不限制" : dataObj.ReadCount); // 剩余票数
                    $("#txtActIntroduction").html(dataObj.Memo);
                    $(".acInfor").html("<p>" + dataObj.ActivityInfo + "</p>");
                    var curToday = dataObj.Today;
                    var curTomorrow = dataObj.Tomorrow;
                    var curDayAfterTomorrow = dataObj.DayAfterTomorrow;
                    if (!$.isEmptyObject(dataObj.SeqShowList)) {
                        var curFilmName = ""; //影城排期影片按片名归类
                        var curCinemaName = "";
                        var html = "";
                        showSeqDaysHtml = "<span>放映日期</span> ";
                        $.each(dataObj.SeqShowList, function(index, item) {
                            var tempDay = item.ShowDate.substr(0, 10);
                            if (curFocusCinema == "") {
                                curFocusCinema = item.CinemaNo;
                                if ($("#hidCurCinemaNo").val() == '') $("#hidCurCinemaNo").val(curFocusCinema);
                            }
                            if (curFocusDay == "") {
                                curFocusDay = tempDay;
                                $("#hidCurShowDay").val(curFocusDay);
                            }
                            if (showDates.indexOf(tempDay) < 0) {
                                showDates += tempDay;
                                if (tempDay == curToday) {
                                    showSeqDaysHtml += "<a href='javascript:void(0);' onclick='fnQueryDay(" + "\"" + tempDay + "\"" + ");'>今天 " + tempDay + "</a>";
                                } else if (tempDay == curTomorrow) {
                                    showSeqDaysHtml += "<a href='javascript:void(0);' onclick='fnQueryDay(" + "\"" + tempDay + "\"" + ");'>明天 " + tempDay + "</a>";
                                } else if (tempDay == curDayAfterTomorrow) {
                                    showSeqDaysHtml += "<a href='javascript:void(0);' onclick='fnQueryDay(" + "\"" + tempDay + "\"" + ");'>后天 " + tempDay + "</a>";
                                } else {
                                    showSeqDaysHtml += "<a href='javascript:void(0);' onclick='fnQueryDay(" + "\"" + tempDay + "\"" + ");'>" + tempDay + "</a>";
                                }
                            }
                            // $(".timesC").html("");
                            if (curCinemaName.indexOf(item.CinemaName) < 0) {
                                curCinemaName += item.CinemaName + ',';
                                if ($("#hidCurCinemaNo").val() == item.CinemaNo) {
                                    cinemaList += "<a id='" + item.CinemaNo + "' href='javascript:void(0);' class='red' >" + item.CinemaName + "</a> ";
                                } else {
                                    cinemaList += "<a id='" + item.CinemaNo + "' href='javascript:void(0);' >" + item.CinemaName + "</a> "; //影院名称列表
                                }
                            }
                            if (curFocusDay == tempDay) {
                                html = "<div class='filmDetail'> <div class='filmDetailT mt25'>"; //新建 div filmDetail
                                html += "<span class='arr arrUp' onclick='fnToggleShow(this);'></span>" + item.CFilmName + "</div><div class='filmDetailS'>"; // div class='filmDetail'
                                html += "<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
                                html += "<thead><tr><th align='center'>场次</th><th align='center'>语言/版本</th><th align='center'>影厅</th>";
                                html += "<th align='center'>标准价</th><th align='center'>通卡价</th><th align='center'>银联价</th><th align='center'>支付宝价</th><th align='center'>微信价</th><th align='center'>操作</th></tr></thead><tbody>";
                                if (item.CinemaNo == curFocusCinema) {
                                    if (index == 0) {
                                        curFilmName = item.CFilmName;
                                        html += "<tr><td align='center'>" + item.ShowTime + "</td><td align='center'>" + item.FilmLan + item.FilmTag + "</td>";
                                        html += "<td align='center'>" + item.HallName + "</td><td align='center'>" + item.CinemaPrice + "元</td>";
                                        html += "<td align='center' class='red'>" + fnGetPayChannelPrice(item.ZYMemberCardPirce) + "</td><td align='center' class='red'>" + fnGetPayChannelPrice(item.UnionPayPrice) + "</td>";
                                        //  html += "<td align='center'  class='red'>￥" + item.ZhiFubaoPirce + "</td><td align='center'><a href='javascript:void(0);' class='cbtna' onclick='fnGoSeat(" + "\"" + actNo + "\"" + ",\"" + item.SeqNo + "\"" + ");'>选座购票</a></td>";
                                        html += "<td align='center'  class='red'>" + fnGetPayChannelPrice(item.ZhiFubaoPirce) + "</td>";
                                        html += "<td align='center'  class='red'>" + fnGetPayChannelPrice(item.WeixinPirce) + "</td>";
                                        html += "<td align='center'>" + fnChangeSeqActionByTime(actNo, item.SeqNo, item.OnShowState, actBeginTime, actEndTime) + "</td>";

                                        html += "</tr>";
                                    } else {
                                        if (curFilmName != item.CFilmName) {
                                            curFilmName = item.CFilmName;
                                            html = "</tbody></table> </div></div>";
                                            showSeqDetailHtml += html;
                                            html = "<div class='filmDetail'> <div class='filmDetailT mt25'>"; //新建 div filmDetail
                                            html += "<span class='arr arrUp' onclick='fnToggleShow(this);'></span>" + item.CFilmName + "</div><div class='filmDetailS'>"; // div class='filmDetail'
                                            html += "<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
                                            html += "<thead><tr><th align='center'>场次</th><th align='center'>语言/版本</th><th align='center'>影厅</th>";
                                            html += "<th align='center'>标准价</th><th align='center'>通卡价</th><th align='center'>银联价</th><th align='center'>支付宝价</th><th align='center'>微信价</th><th align='center'>操作</th></tr></thead><tbody>";
                                            // table Row
                                            html += "<tr><td align='center'>" + item.ShowTime + "</td><td align='center'>" + item.FilmLan + item.FilmTag + "</td>";
                                            html += "<td align='center'>" + item.HallName + "</td><td align='center'>" + item.CinemaPrice + "元</td>";
                                            html += "<td align='center' class='red'>" + fnGetPayChannelPrice(item.ZYMemberCardPirce) + "</td><td align='center' class='red'>" + fnGetPayChannelPrice(item.UnionPayPrice) + "</td>";
                                            //html += "<td align='center'  class='red'>￥" + item.ZhiFubaoPirce + "</td><td align='center'><a href='javascript:void(0);' class='cbtna' onclick='fnGoSeat(" + "\"" + actNo + "\"" + ",\"" + item.SeqNo + "\"" + ");'>选座购票</a></td>";
                                            html += "<td align='center'  class='red'>" + fnGetPayChannelPrice(item.ZhiFubaoPirce) + "</td>";
                                            html += "<td align='center'  class='red'>" + fnGetPayChannelPrice(item.WeixinPirce) + "</td>";
                                            html += "<td align='center'>" + fnChangeSeqActionByTime(actNo, item.SeqNo, item.OnShowState, actBeginTime, actEndTime) + "</td>";
                                            html += "</tr>";
                                        } else {
                                            html = "<tr><td align='center'>" + item.ShowTime + "</td><td align='center'>" + item.FilmLan + item.FilmTag + "</td>";
                                            html += "<td align='center'>" + item.HallName + "</td><td align='center'>" + item.CinemaPrice + "元</td>";
                                            html += "<td align='center' class='red'>" + fnGetPayChannelPrice(item.ZYMemberCardPirce) + "</td><td align='center' class='red'>" + fnGetPayChannelPrice(item.UnionPayPrice) + "</td>";
                                            //html += "<td align='center'  class='red'>￥" + item.ZhiFubaoPirce + "</td><td align='center'><a href='javascript:void(0);' class='cbtna' onclick='fnGoSeat(" + "\"" + actNo + "\"" + ",\"" + item.SeqNo + "\"" + ");'>选座购票</a></td>";
                                            html += "<td align='center'  class='red'>" + fnGetPayChannelPrice(item.ZhiFubaoPirce) + "</td>";
                                            html += "<td align='center'  class='red'>" + fnGetPayChannelPrice(item.WeixinPirce) + "</td>";
                                            html += "<td align='center'>" + fnChangeSeqActionByTime(actNo, item.SeqNo, item.OnShowState, actBeginTime, actEndTime) + "</td>";
                                            html += "</tr>";
                                        }
                                    }
                                    showSeqDetailHtml += html;
                                }
                                // showSeqDetailHtml += html;
                            }
                        });
                    } else {
                        //showAlert("当前活动暂无排期影片！");
                    }
                } else {
                    showAlert("获取活动信息失败，请重新刷新页面！");
                }
                //    $(".times").append(showSeqDetailHtml);
                if (showSeqDetailHtml.endWith("</tr>")) showSeqDetailHtml += "</tbody></table> </div>";
                $("#ShowSeqArea").html(showSeqDetailHtml);
                $("#cinemaList").html(cinemaList);
                if ($("#hidLoadType").val() == "0") {
                    $("#cinemaList").html(cinemaList); //只加载一次活动影院
                    $("#hidLoadType").val("1"); $(".timesC").html(showSeqDaysHtml);
                    $(".timesC a").eq(0).addClass("red");
                    $("#cinemaList a").eq(0).addClass("red");
                }

            } else {
                $(".timesC a").each(function() {
                    $(this).removeAttr("href");
                });
                $("#cinemaList").html("");
                $(".acInfor").html("");
                $("#txtActIntroduction").text("");
                showAlert("未获取到活动信息：活动信息不存在或页面传入参数错误！");
            }
        },
        error: function() {
            showAlert("获取排期影片信息错误，请重新刷新页面！");
        }
    });
}
function getQueryShowFilm(actNo, cino) {
    //绑定影院下拉列表
    $.ajax({
        type: "post",
        dataType: "text",
        url: "ActivityDetail.ashx",
        data: "action=load_zy_activitydetails&activityNo=" + actNo + "&cinemaNo=" + cino + "&showDate=" + $("#hidCurShowDay").val(),
        cache: false,
        success: function(data) {
            if (data != null && data != "") {
                //var dataObj = window.eval(data); // ActivityInfo  ShowSeqInfo
                //$('#activity_pic').removeAttr("src");
                //var titlePicture = value.TitlePicture.split('|');
                //$('#activity_pic').attr("src", titlePicture[2] + titlePicture[1]);
                var dataObj = eval("(" + data + ")"); //转换为json对象
                var showDates = "";
                var cinemaList = ""; //影院名称列表
                var curFocusCinema = "";
                var curFocusDay = "";
                var actBeginTime = "";
                var actEndTime = "";
                var showSeqDaysHtml = "<span>放映日期</span> <span style='font-size:13px;color:#999999;'>暂无排期影片</span>";
                var showSeqDetailHtml = "";
                if (!$.isEmptyObject(dataObj)) {
                    $('#activity_pic').attr("src", dataObj.BannerPicture == "" ? "../resource/images/update/acad.jpg" : dataObj.BannerPicture);
                    $("#txtActName").text(dataObj.ActivityName);
                    $("#txtActCategory").text(dataObj.ActivityCategory == "2" ? "影城活动" : "网站活动"); // 活动类别
                    $("#hidCurActivityNo").val(dataObj.ActivityNo);
                    $("#txtActDate").text(dataObj.StartDate.substr(0, 10) + " 至 " + dataObj.EndDate.substr(0, 10)); //活动起止时间
                    $("#txtActTag").text(""); // 活动类型 dataObj.UseBuyValue
                    actBeginTime = dataObj.StartTime;
                    actEndTime = dataObj.EndTime;
                    $("#txtActHour").text(actBeginTime + " — " + actEndTime);
                    $("#txtUserAmount").text(dataObj.PersonCount); // 活动参与人数
                    curTicketCount = (dataObj.AmountControlType == "1") ? 11 : parseInt(dataObj.ReadCount);
                    $("#txtTicketRemain").text(dataObj.ReadCount == '-1' ? "不限制" : dataObj.ReadCount); // 剩余票数
                    $("#txtActIntroduction").text(dataObj.Memo);
                    $(".acInfor").html("<p>" + dataObj.ActivityInfo + "</p>");
                    var curToday = dataObj.Today;
                    var curTomorrow = dataObj.Tomorrow;
                    var curDayAfterTomorrow = dataObj.DayAfterTomorrow;
                    if (!$.isEmptyObject(dataObj.SeqShowList)) {
                        var curFilmName = ""; //影城排期影片按片名归类
                        var curCinemaName = "";
                        var html = "";
                        showSeqDaysHtml = "<span>放映日期</span> ";
                        $.each(dataObj.SeqShowList, function(index, item) {
                            var tempDay = item.ShowDate.substr(0, 10);
                            if (curFocusCinema == "") {
                                curFocusCinema = item.CinemaNo;
                                if ($("#hidCurCinemaNo").val() == '') $("#hidCurCinemaNo").val(curFocusCinema);
                            }
                            if (curFocusDay == "") {
                                curFocusDay = tempDay;
                                $("#hidCurShowDay").val(curFocusDay);
                            }
                            if (showDates.indexOf(tempDay) < 0) {
                                showDates += tempDay;
                                if (tempDay == curToday) {
                                    showSeqDaysHtml += "<a href='javascript:void(0);' onclick='fnQueryDay(" + "\"" + tempDay + "\"" + ");'>今天 " + tempDay + "</a>";
                                } else if (tempDay == curTomorrow) {
                                    showSeqDaysHtml += "<a href='javascript:void(0);' onclick='fnQueryDay(" + "\"" + tempDay + "\"" + ");'>明天 " + tempDay + "</a>";
                                } else if (tempDay == curDayAfterTomorrow) {
                                    showSeqDaysHtml += "<a href='javascript:void(0);' onclick='fnQueryDay(" + "\"" + tempDay + "\"" + ");'>后天 " + tempDay + "</a>";
                                } else {
                                    showSeqDaysHtml += "<a href='javascript:void(0);' onclick='fnQueryDay(" + "\"" + tempDay + "\"" + ");'>" + tempDay + "</a>";
                                }
                            }
                            // $(".timesC").html("");
                            if (curCinemaName.indexOf(item.CinemaName) < 0) {
                                curCinemaName += item.CinemaName + ',';
                                if ($("#hidCurCinemaNo").val() == item.CinemaNo) {
                                    cinemaList += "<a id='" + item.CinemaNo + "' href='javascript:void(0);' class='red' >" + item.CinemaName + "</a> ";
                                } else {
                                    cinemaList += "<a id='" + item.CinemaNo + "' href='javascript:void(0);' >" + item.CinemaName + "</a> "; //影院名称列表
                                }
                            }
                            if (curFocusDay == tempDay) {
                                html = "<div class='filmDetail'> <div class='filmDetailT mt25'>"; //新建 div filmDetail
                                html += "<span class='arr arrUp' onclick='fnToggleShow(this);'></span>" + item.CFilmName + "</div><div class='filmDetailS'>"; // div class='filmDetail'
                                html += "<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
                                html += "<thead><tr><th align='center'>场次</th><th align='center'>语言/版本</th><th align='center'>影厅</th>";
                                html += "<th align='center'>标准价</th><th align='center'>通卡价</th><th align='center'>银联价</th><th align='center'>支付宝价</th><th align='center'>微信价</th><th align='center'>操作</th></tr></thead><tbody>";
                                if (item.CinemaNo == curFocusCinema) {
                                    if (index == 0) {
                                        curFilmName = item.CFilmName;
                                        html += "<tr><td align='center'>" + item.ShowTime + "</td><td align='center'>" + item.FilmLan + item.FilmTag + "</td>";
                                        html += "<td align='center'>" + item.HallName + "</td><td align='center'>" + item.CinemaPrice + "元</td>";
                                        html += "<td align='center' class='red'>" + fnGetPayChannelPrice(item.ZYMemberCardPirce) + "</td><td align='center' class='red'>" + fnGetPayChannelPrice(item.UnionPayPrice) + "</td>";
                                        //  html += "<td align='center'  class='red'>￥" + item.ZhiFubaoPirce + "</td><td align='center'><a href='javascript:void(0);' class='cbtna' onclick='fnGoSeat(" + "\"" + actNo + "\"" + ",\"" + item.SeqNo + "\"" + ");'>选座购票</a></td>";
                                        html += "<td align='center'  class='red'>" + fnGetPayChannelPrice(item.ZhiFubaoPirce) + "</td>";
                                        html += "<td align='center'  class='red'>" + fnGetPayChannelPrice(item.WeixinPirce) + "</td>";
                                        html +="<td align='center'>" + fnChangeSeqActionByTime(actNo, item.SeqNo, item.OnShowState, actBeginTime, actEndTime) + "</td>";

                                        html += "</tr>";
                                    } else {
                                        if (curFilmName != item.CFilmName) {
                                            curFilmName = item.CFilmName;
                                            html = "</tbody></table> </div></div>";
                                            showSeqDetailHtml += html;
                                            html = "<div class='filmDetail'> <div class='filmDetailT mt25'>"; //新建 div filmDetail
                                            html += "<span class='arr arrUp' onclick='fnToggleShow(this);'></span>" + item.CFilmName + "</div><div class='filmDetailS'>"; // div class='filmDetail'
                                            html += "<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
                                            html += "<thead><tr><th align='center'>场次</th><th align='center'>语言/版本</th><th align='center'>影厅</th>";
                                            html += "<th align='center'>标准价</th><th align='center'>通卡价</th><th align='center'>银联价</th><th align='center'>支付宝价</th><th align='center'>微信价</th><th align='center'>操作</th></tr></thead><tbody>";
                                            // table Row
                                            html += "<tr><td align='center'>" + item.ShowTime + "</td><td align='center'>" + item.FilmLan + item.FilmTag + "</td>";
                                            html += "<td align='center'>" + item.HallName + "</td><td align='center'>" + item.CinemaPrice + "元</td>";
                                            html += "<td align='center' class='red'>" + fnGetPayChannelPrice(item.ZYMemberCardPirce) + "</td><td align='center' class='red'>" + fnGetPayChannelPrice(item.UnionPayPrice) + "</td>";
                                            //html += "<td align='center'  class='red'>￥" + item.ZhiFubaoPirce + "</td><td align='center'><a href='javascript:void(0);' class='cbtna' onclick='fnGoSeat(" + "\"" + actNo + "\"" + ",\"" + item.SeqNo + "\"" + ");'>选座购票</a></td>";
                                            html += "<td align='center'  class='red'>" + fnGetPayChannelPrice(item.ZhiFubaoPirce) + "</td>";
                                            html += "<td align='center'  class='red'>" + fnGetPayChannelPrice(item.WeixinPirce) + "</td>";
                                            html += "<td align='center'>" + fnChangeSeqActionByTime(actNo, item.SeqNo, item.OnShowState, actBeginTime, actEndTime) + "</td>";
                                            html += "</tr>";
                                        } else {
                                            html = "<tr><td align='center'>" + item.ShowTime + "</td><td align='center'>" + item.FilmLan + item.FilmTag + "</td>";
                                            html += "<td align='center'>" + item.HallName + "</td><td align='center'>" + item.CinemaPrice + "元</td>";
                                            html += "<td align='center' class='red'>" + fnGetPayChannelPrice(item.ZYMemberCardPirce) + "</td><td align='center' class='red'>" + fnGetPayChannelPrice(item.UnionPayPrice) + "</td>";
                                            //html += "<td align='center'  class='red'>￥" + item.ZhiFubaoPirce + "</td><td align='center'><a href='javascript:void(0);' class='cbtna' onclick='fnGoSeat(" + "\"" + actNo + "\"" + ",\"" + item.SeqNo + "\"" + ");'>选座购票</a></td>";
                                            html += "<td align='center'  class='red'>" + fnGetPayChannelPrice(item.ZhiFubaoPirce) + "</td>";
                                            html += "<td align='center'  class='red'>" + fnGetPayChannelPrice(item.WeixinPirce) + "</td>";
                                            html+="<td align='center'>" + fnChangeSeqActionByTime(actNo, item.SeqNo, item.OnShowState, actBeginTime, actEndTime) + "</td>";
                                            html += "</tr>";
                                        }
                                    }
                                    showSeqDetailHtml += html;
                                }
                                // showSeqDetailHtml += html;
                            }
                        });
                    } else {
                        //showAlert("当前活动暂无排期影片！");
                    }
                } else {
                    showAlert("获取活动信息失败，请重新刷新页面！");
                }
                //    $(".times").append(showSeqDetailHtml);
                if (showSeqDetailHtml.endWith("</tr>")) showSeqDetailHtml += "</tbody></table> </div>";
                $("#ShowSeqArea").html(showSeqDetailHtml);

            } else {
                $(".timesC a").each(function() {
                    $(this).removeAttr("href");
                });
                $("#cinemaList").html("");
                $(".acInfor").html("");
                $("#txtActIntroduction").text("");
                showAlert("未获取到活动信息：活动信息不存在或页面传入参数错误！");
            }
        },
        error: function() {
            showAlert("获取排期影片信息错误，请重新刷新页面！");
        }
    });
}
function fnQueryDay(objDay) {
    $("#hidCurShowDay").val(objDay);
    var goActivityNo = $("#hidCurActivityNo").val();
    var goCinemaNo = $("#hidCurCinemaNo").val();
    $(".timesC a").each(function(index, lnk) {
        $(this).removeClass("red");
    });
    getQueryShowFilm(goActivityNo, goCinemaNo);
}
function fnQueryCinema(objCinemaNo) {
    $("#hidCurCinemaNo").val(objCinemaNo);
    var goActivityNo = $("#hidCurActivityNo").val();
    getQueryShowFilm(goActivityNo, objCinemaNo);
}
function fnGetPayChannelPrice(price) {
    if (price == null || price == "0" || price == "-1") {
        return "--";
    }
    return "￥" + price + "元";
}
function fnGoSeat(actNo, seqNo) {
    window.location.href = "ActivitySeat.aspx@activityNo=" + actNo + "&seqno=" + seqNo;
}
function fnToggleShow(obj) {
    $(obj).parent().next().toggle();
    if (obj.className == "arr arrDown") {
        obj.className = "arr arrUp";
    } else {
        obj.className = "arr arrDown";
    }
}
function fnChangeSeqActionByTime(actNo, seqNo, ontimestate, begintime, entime) {
    if (ontimestate == -1) {
        return "<span class='cbtna'>" + begintime + "开始</span>";
    } else if (ontimestate == 1) {
        return "<span class='cbtna'>" + "已结束</span>";
    } else if (curTicketCount < 1) {
        return "<span class='cbtna'>" + "票已抢完</span>";
    } else if (curTicketCount > 0) {
        return "<a href='javascript:void(0);' class='cbtna' onclick='fnGoSeat(" + "\"" + actNo + "\"" + ",\"" + seqNo + "\"" + ");'>选座购票</a>";
    } else if (ontimestate == 4) {
        return "<span class='cbtna'>" + "票已抢完</span>";
    }
}
//选择场次日期事件
function clickDate(obj) {
    $(".trunStit ul li").each(function() {
        if ($(this).text() == $(obj).text()) {
            $(this).addClass("cur");
            $(this).removeClass("nor");
            $(".trunShow .trunCon").each(function() {
                if ($(this).attr("date") == $(obj).text()) {
                    $(this).css("display", "block");
                } else {
                    $(this).css("display", "none");
                }
            });
        } else {
            $(this).removeClass("cur");
            $(this).addClass("nor");
        }
    });
}