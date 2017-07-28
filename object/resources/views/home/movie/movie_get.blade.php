<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1">
    <title>中影·国际影城官网|电影|在线预订电影票|电影票团购|中影·国际影城</title>
    <meta name="Keywords" content="" /> 
    <meta name="Description" content="" /> 
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <link href="{{ asset('home/css/reset-min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('home/css/main.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('home/css/inside_pages.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('home/css/ui-lightness/jquery-ui-1.8.5.custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/css/my.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/css/screen.css') }}" rel="stylesheet" />
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
    
    <link href="{{ asset('home/css/js.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('home/js/comm/StringBuilder.js') }}" type="text/javascript"></script>
    <script src="{{ asset('home/js/plugins/jquery.mCustomScrollbar.concat.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('home/js/scroll.js') }}" type="text/javascript"></script>

    <style type="text/css">
        .shopping-icon03 { position: fixed; display: inline-block; width: 66px; height: 66px; background-image: url(../resource/images/shopping-icon_03.png); overflow: hidden; z-index: 9998; }
    </style>
    <script type="text/javascript">
        var showDate = ""; //放映日期
        var cinemaNo = QueryString("cno"); //影城编号
        var filmNo = ""; //影片编号
        var showTime = ""; //时间
        var showType = ""; //版本
        var timeNum = 0; //排期数量号
        var cmFlag = false; //是否有影院编号通过参数传递过来
        var fmFlag = false; //是否有影片编号通过参数传递过来
        var imgUrl = '../../img.cfc.com.cn_3A6600';
        var waitingTime = 1; //排期放映时间        
        var isJumpActivity=1;//是否启用临时活动跳转
        
        var curDateTime="";
        $(function() {
            /********************初始化选项开始*****************************/
            
            //临时活动跳转
            //            if(isJumpActivity==1)
            //            {
            //                if(cinemaNo!="" && cinemaNo !=null && cinemaNo!=undefined)
            //                {
            //                   getActivityUrl();
            //                }
            //            }
            curDateTime=document.getElementById('ContentPlaceHolder1_hidCurDate').value;
            if (cinemaNo != null) {
                cmFlag = true;
            } if (QueryString("fno") != null) {
                fmFlag = true;
            }
            //获取放映日期
            getShowDate();
            /********************初始化选项结束*****************************/


            /********************绑定选项事件开始*****************************/
            //放映日期点击绑定事件【选中第一个影城，选中影片"全部"】
            $("#ulShowTime li a").live("click", function() {
                showDate = $(this).attr("val");
                $("#ulShowTime li .meauSel").removeClass("meauSel");
                $(this).addClass("meauSel");
                getDefaultCinema(); //获取影城
            });

            //影城点击绑定事件【选中影片"全部"】
            $("#ulCinema li a").live("click", function() {
                cinemaNo = $(this).attr("val");
                
                /**临时活动影院 跳转指定活页页面 2014-10-24 21:01加**/
                //临时活动跳转
                if(isJumpActivity==1) {
                    if(cinemaNo!="" && cinemaNo !=null && cinemaNo!=undefined)
                    {
                        getActivityUrl();
                    }
                }
                /**临时活动影院 跳转指定活页页面  2014-10-24 21:01加结束**/
                  
                $("#ulCinema li .meauSel").removeClass("meauSel");
                $(this).addClass("meauSel");
                filmNo = ""; //因为选中影片"全部"，所以此处filmNo=''
                getHotFilms(); //获取影片
            });

            //影片点击绑定事件
            $("#ulFilm li a").live("click", function() {
                filmNo = $(this).attr("val");
                $("#ulFilm li .meauSel").removeClass("meauSel");
                $(this).addClass("meauSel");
                getShowTimes(); //获取排期
            });

            //时间点击绑定事件
            $("#ulTime li a").live("click", function() {
                showTime = $(this).attr("val");
                $("#ulTime li .meauSel").removeClass("meauSel");
                $(this).addClass("meauSel");
                getShowTimes(); //获取排期
            });

            //版本点击绑定事件
            $("#ulShowType li a").live("click", function() {
                showType = $(this).attr("val");
                $("#ulShowType li .meauSel").removeClass("meauSel");
                $(this).addClass("meauSel");
                getShowTimes(); //获取排期
            });


            //选择影院 事件
            $('.js-cinemSelector').click(function(){
                var $cinemaSelector = $('#cinemaSelector').dialog({
                    autoOpen: false,
                    width: 630,
                    position: ['center', 210],
                    dialogClass: "cinema-selector-dialog",
                    modal: true
                });
                $cinemaSelector.load('../cinema/cinemaSelector.aspx@type=1&showDate='+showDate);
                $cinemaSelector.dialog('open');
            });

            //影院选择器中的影院事件
            $(".cinema-ci a").live("click", function () {
                closeDialog();
                var $this = $(this);
                cinemaNo = $this.data('cinemano');
                cinemaName = $this.text();
				
                var $linkCinema=$('.js-linkCinema');
                $linkCinema.text(cinemaName).attr('val',cinemaNo);
                $linkCinema.parent().show();
                cinemaNo=cinemaNo;
                $linkCinema.click();
            });



            /********************绑定选项事件结束*****************************/
        });

        //获取放映日期选项
        function getShowDate() {
            $.ajax({
                type: "post",
                dataType: "json",
                url: "scheduleHandler.ashx",
                data: "action=getShowDate",
                async: true,
                cache: false,
                beforeSend: function() {
                    $('#loading1').show();
                },
                success: function(data) {
                    $('#loading1').hide();
                    if (data != null) {
                        $('#ulShowTime li').remove();
                        for (var i = 0; i < data.length; i++) {
                            var item = data[i]; //放映日期
                            //var itemFormt = new Date(item).format('M月dd日');
                            var itemFormt = new Date(Date.parse(item.replace(/-/g, "../default.htm"))).format('M月dd日');
                            var itemText = '';
                            // 下面修改为兼容Firefox // var date = new Date();
                            var s = curDateTime.split(" "); 
                            var s1 = s[0].split("-"); 
                            var s2 = s[1].split(":"); 
                            var date = new Date(s1[0],s1[1]-1,s1[2],s2[0],s2[1],s2[2]); 
                            var nowDate = date.format("yyyy-MM-dd"); //当前日期
                            var day = GetDateDiff(nowDate, item, "day"); //放映日期与当前日期的差值 
                            switch (day) {
                                case 0:
                                    itemText = "今日上映 " + itemFormt;
                                    break;
                                case 1:
                                    itemText = "明日上映 " + itemFormt;
                                    break;
                                default:
                                    itemText = "<i class='fl'></i><span class='hsz'>预售 " + itemFormt + "</span>";
                            }
                            var liHtml = "<li><a href='javascript:void(0);' val=" + item + ">" + itemText + "</a></li>";
                            //此处判断是由于滚动条的原因
                            if ($("#ulShowTime .mCSB_container").length > 0) {
                                $("#ulShowTime .mCSB_container").append(liHtml);
                            } else {
                                $("#ulShowTime").append(liHtml);
                            }
                        }
                        //                        //获取第一个放映日期,并选中
                        //                        if ($("#ulShowTime li").length > 0) {
                        //                            showDate = $("#ulShowTime li:eq(0) a").attr("val");
                        //                            $("#ulShowTime li .meauSel").removeClass("meauSel");
                        //                            $("#ulShowTime li:eq(0) a").addClass("meauSel");
                        //                            //获取影城
                        //                            getCinemas();
                        //                        }
                        //如果参数传递的电影不为空
                        var fno = QueryString("fno");
                        if (fno == null) {
                            showDate = $("#ulShowTime li:eq(0) a").attr("val");
                            $("#ulShowTime li .meauSel").removeClass("meauSel");
                            $("#ulShowTime li:eq(0) a").addClass("meauSel");
                            
                            //获取默认影城
                            getDefaultCinema();
                        } else {
                            $("#ulShowTime li").each(function() {
                                showDate = $(this).children().attr("val");
                                var thisDate = $(this).children();
                                //查找当前放映日期是否存在该影片
                                $.ajax({
                                    type: "post",
                                    dataType: "json",
                                    url: "scheduleHandler.ashx",
                                    data: "action=getExistFilm1&showDate=" + showDate + "&filmNo=" + fno,
                                    async: false,
                                    cache: false,
                                    success: function(rs) {
                                        if (rs) {
                                            $("#ulShowTime li .meauSel").removeClass("meauSel");
                                            thisDate.addClass("meauSel");
                                            
                                            //获取默认影城
                                            getDefaultCinema();
                                        }
                                    }
                                });
                                return false;
                            });
                            if ($("#ulShowTime li .meauSel").length == 0) {
                                showDate = $("#ulShowTime li:eq(0) a").attr("val");
                                $("#ulShowTime li .meauSel").removeClass("meauSel");
                                $("#ulShowTime li:eq(0) a").addClass("meauSel");
                                //获取影城
                                getDefaultCinema();
                            }
                        }
                    }
                }
            });
        }

        //获取影城选项
        function getCinemas() {
            return;
            $.ajax({
                type: "post",
                dataType: "json",
                url: "scheduleHandler.ashx",
                data: "action=getCinemas&showDate=" + showDate,
                async: true,
                cache: false,
                beforeSend: function() {
                    $('#loading2').show();
                },
                success: function(data) {
                    $('#loading2').hide();
                    if (data != null) {
                        $('#ulCinema li').remove();
                        for (var i = 0; i < data.length; i++) {
                            var item = data[i];
                            
                            /**临时活动影院 跳转指定活页页面 2014-10-24 21:01加**/
                            //临时活动跳转
                            if(isJumpActivity==1 && data.length==1) {
                                cinemaNo = item.CinemaNo;
                                if(cinemaNo!="" && cinemaNo !=null && cinemaNo!=undefined)
                                {
                                    getActivityUrl();
                                }
                            }
                            /**临时活动影院 跳转指定活页页面  2014-10-24 21:01加结束**/
                             
                            var liHtml = "<li><a href='javascript:void(0);' val=" + item.CinemaNo + " class='Hide'>" + item.CinemaName + "</a></li>";
                            //                            if(f_isActCinemaMap(item.CinemaNo,data.length)){
                            //                                liHtml = "<li><a href='javascript:void(0);' val=" + item.CinemaNo + " class='Hide' style='line-height:15px;'>" + item.CinemaName + "<br/><span style='color:red;'>（点击进入特价页面）</span></a></li>";
                            //                            }
                            //此处判断是由于滚动条的原因
                            if ($("#ulCinema .mCSB_container").length > 0) {
                                $("#ulCinema .mCSB_container").append(liHtml);
                            } else {
                                $("#ulCinema").append(liHtml);
                            }
                        }
                        if ($("#ulCinema li").length > 0) {
                            $("#ulCinema li .meauSel").removeClass("meauSel");
                            //选中通过参数传递的影城
                            if (cmFlag) {
                                $("#ulCinema li").each(function() {
                                    if ($(this).children().attr("val") == cinemaNo) {
                                        $(this).children().addClass("meauSel");
                                    }
                                });
                                //不包含该影城，则获取第一个影城,并选中
                                if ($("#ulCinema li .meauSel").length == 0) {
                                    cinemaNo = $("#ulCinema li:eq(0) a").attr("val");
                                    $("#ulCinema li:eq(0) a").addClass("meauSel Hide");
                                }
                                cmFlag = false;
                            } else {
                                //默认获取第一个影城,并选中
                                cinemaNo = $("#ulCinema li:eq(0) a").attr("val");
                                $("#ulCinema li:eq(0) a").addClass("meauSel Hide");
                            }
                            //获取影片
                            filmNo = ""; //因为选中影片"全部"，所以此处filmNo=''
                            getHotFilms();
                        }
                    }
                }
            });
        }

        //获取影片选项
        function getHotFilms() {
            $.ajax({
                type: "post",
                dataType: "json",
                url: "scheduleHandler.ashx",
                data: "action=getHotFilms&showDate=" + showDate + "&cinemaNo=" + cinemaNo + "&filmNo=" + filmNo,
                async: true,
                cache: false,
                beforeSend: function() {
                    $('#loading3').show();
                },
                success: function(data) {
                    $('#loading3').hide();
                    if (data != null) {
                        $('#ulFilm li').remove();
                        //此处判断是由于滚动条的原因
                        var liAll = "<li><a href='javascript:void(0);' val='' class='meauSel Hide'>全部</a></li>";
                        if ($("#ulFilm .mCSB_container").length > 0) {
                            $("#ulFilm .mCSB_container").append(liAll);
                        } else {
                            $("#ulFilm").append(liAll);
                        }
                        for (var i = 0; i < data.length; i++) {
                            var item = data[i];
                            var liHtml = "<li><a href='javascript:void(0);' val=" + item.FilmNo + " class='Hide'>" + item.CFilmName + "</a></li>";
                            if ($("#ulFilm .mCSB_container").length > 0) {
                                $("#ulFilm .mCSB_container").append(liHtml);
                            } else {
                                $("#ulFilm").append(liHtml);
                            }
                        }
                        if ($("#ulFilm li").length > 0) {
                            $("#ulFilm li .meauSel").removeClass("meauSel");
                            //选中通过参数传递的影片
                            if (fmFlag) {
                                var tempfno = QueryString("fno"); //参数传递的影片编号
                                $("#ulFilm li").each(function() {
                                    if ($(this).children().attr("val") == tempfno) {
                                        $(this).children().addClass("meauSel");
                                        filmNo = tempfno;
                                        fmFlag = false;
                                    }
                                });
                                if ($("#ulFilm li .meauSel").length == 0) {
                                    //遍历影城，若不包含该影片，则查找其他影院，并选中该影片。
                                    $("#ulCinema li").not($("#ulCinema li:eq(0)")).each(function() {
                                        cinemaNo = $(this).children().attr("val");
                                        var thisCinema = $(this).children();
                                        $.ajax({
                                            type: "post",
                                            dataType: "json",
                                            url: "scheduleHandler.ashx",
                                            data: "action=getExistFilm2&showDate=" + showDate + "&cinemaNo=" + cinemaNo + "&filmNo=" + tempfno,
                                            async: false,
                                            cache: false,
                                            success: function(rs) {
                                                if (rs != null) {//当前影院存在该电影
                                                    $("#ulCinema li .meauSel").removeClass("meauSel");
                                                    thisCinema.addClass("meauSel");
                                                    $.ajax({
                                                        type: "post",
                                                        dataType: "json",
                                                        url: "scheduleHandler.ashx",
                                                        data: "action=getHotFilms&showDate=" + showDate + "&cinemaNo=" + cinemaNo,
                                                        async: false,
                                                        cache: false,
                                                        success: function(da) {
                                                            $('#ulFilm li').remove();
                                                            liAll = "<li><a href='javascript:void(0);' val='' class='meauSel Hide'>全部</a></li>";
                                                            if ($("#ulFilm .mCSB_container").length > 0) {
                                                                $("#ulFilm .mCSB_container").append(liAll);
                                                            } else {
                                                                $("#ulFilm").append(liAll);
                                                            }
                                                            for (var j = 0; j < da.length; j++) {
                                                                item = da[j];
                                                                liHtml = "<li><a href='javascript:void(0);' val=" + item.FilmNo + " class='Hide'>" + item.CFilmName + "</a></li>";
                                                                if ($("#ulFilm .mCSB_container").length > 0) {
                                                                    $("#ulFilm .mCSB_container").append(liHtml);
                                                                } else {
                                                                    $("#ulFilm").append(liHtml);
                                                                }
                                                            }
                                                            $("#ulFilm li .meauSel").removeClass("meauSel");
                                                            $("#ulFilm li").each(function() {
                                                                if ($(this).children().attr("val") == tempfno) {
                                                                    $(this).children().addClass("meauSel");
                                                                    filmNo = tempfno;
                                                                    fmFlag = false;
                                                                }
                                                            });
                                                        }
                                                    });
                                                }
                                            }
                                        });
                                        return false;
                                    });
                                    if ($("#ulFilm li .meauSel").length == 0) {
                                        cinemaNo = $("#ulCinema li:eq(0) a").attr("val");
                                        $("#ulCinema li:eq(0) a").addClass("meauSel Hide");
                                        filmNo = $("#ulFilm li:eq(0) a").attr("val");
                                        $("#ulFilm li:eq(0) a").addClass("meauSel Hide");
                                    }
                                    //若不包含该影片，则获取第一个影片,并选中
                                    //filmNo = $("#ulFilm li:eq(0) a").attr("val");
                                    //$("#ulFilm li:eq(0) a").addClass("meauSel Hide");
                                }
                                fmFlag = false;
                            } else {
                                //获取第一个filmNo,并选中
                                filmNo = $("#ulFilm li:eq(0) a").attr("val");
                                $("#ulFilm li:eq(0) a").addClass("meauSel Hide");
                            }
                            getShowTimes(); //获取排期
                        }
                    }
                }
            });
        }

        //获取电影排期
        function getShowTimes() {
            $.ajax({
                type: "post",
                dataType: "json",
                url: "scheduleHandler.ashx",
                data: "action=getShowTimes&showDate=" + showDate + "&cinemaNo=" + cinemaNo + "&filmNo=" + filmNo + "&showTime=" + showTime + "&showType=" + showType,
                async: true,
                cache: false,
                beforeSend: function() {
                    $('#loading4').show();
                },
                success: function(data) {
                    $('#loading4').hide();
                    $("#labDataBind").html("");
                    if (data != null) {
                        bindFileGrid(data);
                    }
                }
            });
        }

        //构造电影列表及排期
        function bindFileGrid(data) {
            //var acttemptop = "<em style='font-size:12px;'>活动</em>";
            var acttemptop = "";
            var acttempprice = "&nbsp;&nbsp;&nbsp;&nbsp;<em class='f16'>活动价：</em><span class='ccsz f16' style='font-weight:bold;'>¥{0}<span class='f12'> 起</span></span>";
            var actfun = function(actNo,salePrice,temp,ismax){
                if(actNo) {
                    return  (ismax && ismax.toLowerCase().indexOf('max') > 0)
                                ? "" 
                                : temp.replace("{0}",salePrice); 
                }else return "";
            };
            var f_goSeat = function(actNo,seqNo){if(actNo) return "../activity/ActivitySeat.aspx@activityNo=" + actNo + "&seqno=" + seqNo; else return "../buy/goseat.aspx@seqno="+seqNo;};
            var sb = new StringBuilder();
            for (var i = 0; i < data.length; i++) {
                var film = data[i];
                sb.append("<dl class='fl'>");
                if (film.MessageTip) {
                    sb.append("<dt class='message-tip'>");
                    sb.append("<div class='icon-4'></div>");
                    sb.append("<span class='message-content'>" + film.MessageTip + "</span>");
                    sb.append("</dt>");
                }
                sb.append("<dt class='fl'>");
                sb.append("<div class='ListConPic'><img width='129' height='176' src='" + imgUrl + film.FrontImg + "'></div>");
                sb.append("<div class='ListBtnAll'><a class='ListBtn1' href='../movie/detail.aspx@fno=" + film.FilmNo + "' target='_blank'>影片介绍</a></div>");
                sb.append("</dt>");
                sb.append("<dd class='fr'>");
                sb.append("<div class='ListConTitle'>");
                sb.append("<div class='f20 fl mr_r hhsz'><a class='ListBtn2' href='../movie/detail.aspx@fno=" + film.FilmNo + "&viewType=tab_FilmPictrues' target='_blank'>" + film.CFilmName + "</a></div>");
                sb.append("<div class='fl f20 ccsz'>" + film.AverageDegree + "</div>");
                sb.append("<div class='fr f14'><a href='../movie/detail.aspx@fno=" + film.FilmNo + "' target='_blank'>【" + film.CommentCount + "】篇影评</a></div>");
                sb.append("<div class='fr f14 mr_r'>片长" + film.Duration + "分钟</div>");
                sb.append("<div class='clear'></div>");
                sb.append("</div>");
                sb.append("<div class='ScheduleTag'>");
                sb.append("<ul>");
                sb.append("<li class='fl'><a href='javascript:void(0);'><i class='fl TagLeft'></i><span class='fl'>全部</span><i class='fl TagRight'></i></a></li>");
                //                sb.append("<li class='fl'><a href='javascript:void(0);'><i class='fl TagLeft'></i><span class='fl'>" + film.Language + "</span><i class='fl TagRight'></i></a></li>");
                switch (film.ShowType) {
                    case "0":
                        film.ShowType = "2D";
                        break;
                    case "1":
                        film.ShowType = "3D";
                        break;
                    case "3":
                        film.ShowType = "IMAX2D";
                        break;
                    case "4":
                        film.ShowType = "4D";
                        break;
                    case "5":
                        film.ShowType = "IMAX3D";
                        break;
                    case "6":
                        film.ShowType = "巨幕2D";
                        break;
                    case "7":
                        film.ShowType = "巨幕3D";
                        break;
                    default:
                }
                //sb.append("<li class='fl'><a href='javascript:void(0);'><i class='fl TagLeft'></i><span class='fl'>" + film.ShowType + "</span><i class='fl TagRight'></i></a></li>");
                sb.append("</ul>");
                sb.append("</div>");
                sb.append("<div class='clear'></div>");
                sb.append("<div class='ScheduleLink'>");
                sb.append("<ul>");
                for (var n = 0; n < film.ShowTimes.length; n++) {
                    timeNum++;
                    var sTime = film.ShowTimes[n];
                    sb.append("<li class='fl'>");
                    //根据排期时间与当前时间的差值(分钟)，得到售票的状态
                    var timeDiff = getShowTimeDiff(sTime.ShowTime);
                    //网售价
                    var webPrice=(sTime.SettlementPrice + sTime.UnionCharge)<0?0:(sTime.SettlementPrice + sTime.UnionCharge).toFixed(2);                    
                    if (timeDiff > waitingTime) {//可售
                        sb.append("<a class='LinkUnsale f16' onmouseover='display(" + timeNum + ")' onmouseout='disappear(" + timeNum + ")' href='"+f_goSeat(sTime.ActivityNo,sTime.SeqNo)+"' target='_blank'>" + sTime.ShowTime + "<em class='f12'>¥" + (sTime.ActivityNo?sTime.ActSalePrice:webPrice) + "</em><em  class='f12'>"+sTime.ShowTypeName.replace(' ','')+"</em>"+actfun(sTime.ActivityNo,sTime.ActSalePrice,acttemptop,sTime.ShowTypeName)+"</a>");
                    } else if (timeDiff > 0 && timeDiff <= waitingTime) {//现场售
                        sb.append("<a class='Linkonline f14'  href='javascript:void(0);'>" + sTime.ShowTime + "<em class='f12'>¥" + (sTime.ActivityNo?sTime.ActSalePrice:webPrice) + "</em><em  class='f12'>"+sTime.ShowTypeName+"</em></a>");
                    } else if (timeDiff <= 0) {//不可售
                        sb.append("<a class='LinkSale f14' href='javascript:void(0);'>" + sTime.ShowTime + "<em class='f12'>¥" + (sTime.ActivityNo?sTime.ActSalePrice:webPrice) + "</em><em  class='f12'>"+sTime.ShowTypeName+"</em></a>");
                    }
                    sb.append("<div class='tagSale'></div>");
                    //隐藏层
                    sb.append("<div class='pop' id='div_" + timeNum + "' style='display: none;' onmouseover='display(" + timeNum + ")' onmouseout='disappear(" + timeNum + ")'>");
                    sb.append("<div class='popCon tl'>");
                    sb.append("<div>" + sTime.ShowTime + "，" + sTime.Language + "版，" + sTime.HallName + "，" + sTime.SeatNum + "个座位</div>");                    
                    sb.append("<div class='f14'>标准价：<span class='th'>¥" + sTime.CinemaPrice + "</span>&nbsp;&nbsp;&nbsp;网售价：<span class='hsz'>¥" + webPrice + "</span>"+actfun(sTime.ActivityNo,sTime.ActSalePrice,acttempprice)+"</div>");                    
                    
                    sb.append("<div class='f16'>中影通卡价：<b class='ccsz'>￥" +sTime.BenefitCardPrice.toFixed(2) + "</b></div>");
                    
                    sb.append("<div class='popBtn'><a href='"+f_goSeat(sTime.ActivityNo,sTime.SeqNo)+"' target='_blank'>选座购票</a></div>");
                    sb.append("</div>");
                    sb.append("</div>");
                    //隐藏层结束
                    sb.append("</li>");
                }
                sb.append("</ul>");
                sb.append("</div>");
                sb.append("</dd>");
                sb.append("</dl>");
            }
            $("#labDataBind").html(sb.toString());
        }

        //排期时间 - 当前时间，单位为：分钟
        function getShowTimeDiff(showTime) {
            showTime = showDate + " " + showTime+":00"; //排期时间
            var diffHour = GetDateDiff(curDateTime, showTime, "minute");
            return diffHour;
        }

        //显示排期详情
        function display(num) {
            document.getElementById("div_" + num).style.display = "block";
        }
        
        //隐藏排期详情
        function disappear(num) {
            document.getElementById("div_" + num).style.display = "none";
        }

        //获取临时活动跳转url
        function getActivityUrl() {
            $.ajax({
                type: "post",
                dataType: "text",
                url: "scheduleHandler.ashx",
                data: "action=GetJumpActivityUrl&cinemaNo=" + cinemaNo,
                async: true,
                cache: false,               
                success: function(data) {
                    if (data != null) {
                        if(data!=""){
                            window.location.href = data;
                        }
                    }
                }
            });
        }
        
        
        var actcinemamap ;
        function f_isActCinemaMap(cinemaNo,len)
        {
            var bol = false;
            if(actcinemamap){
                for(var i=0; i<actcinemamap.length; i++){
                    if(actcinemamap[i].CinemaNo == cinemaNo){
                        bol = true; 
                        if(bol && len == 1){window.location.href = actcinemamap[i].ActURL;}
                        break;
                    }
                }
            }
            return bol;
        }

        //获取默认影院
        function getDefaultCinema(){
            var $linkCinema=$('.js-linkCinema');
            $.ajax({
                type: "post",
                dataType: "json",
                url: "../cinema/GetCinemaData.ashx",
                data: "action=getDefaultCinema&type=1&showDate=" + showDate,
                async: true,
                cache: false,
                beforeSend: function() {
                    $('#loading2').show();
                    $linkCinema.parent().hide();
                },
                success: function(data) {
                    $('#loading2').hide();
                    if(data&&data.length>0){
                        var cinema=data[0];

                        /**临时活动影院 跳转指定活页页面 2014-10-24 21:01加**/
                        //临时活动跳转
                        if(isJumpActivity==1) {
                            cinemaNo = cinema.CinemaNo;
                            if(cinemaNo!="" && cinemaNo !=null && cinemaNo!=undefined)
                            {
                                getActivityUrl();
                            }
                        }


                        $linkCinema.text(cinema.CinemaName).attr('val',cinema.CinemaNo);
                        $linkCinema.parent().show();
                        cinemaNo=cinema.CinemaNo;
                        $linkCinema.click();

                    }else{

                    }

                }
            });
        }


    </script>

<title>

</title></head>
<body>
    <div id="zhezao" class="loading" style="display: none;">
        <div id="container"></div>
    </div>
<!---头部开始-->

<header class="index-header">
    <div class="header-con">
        <div class="logo">
            <img src="{{ asset('home/images/web-v2/logo_03.png') }}" alt=""></div>

        <div class="address" onclick="changeCityClick()"><a href="javascript:void(0);" id="span_CityName">北京</a><span class="icon-1" id="change"></span></div>
        <!---菜单导航 start-->
        <nav class="index-nav">
            <ul>
                <li id=""><a href="{{ url('/') }}" title="首页">首 页</a></li>
                <li id="2"><a href="../cinema/cinema.aspx" title="购票通道">影 院</a></li>
                <li id="3"><a href="{{ url('/home/movie/get') }}" title="在线购票" class="">在线购票</a></li>
                <li id="5"><a href="{{ url('/goods') }}" title="商城"><span class="icon-2"></span>商城</a></li>
                <li id="6"><a href="../activity/ActList.aspx" title="优惠活动">优惠活动</a></li>
            </ul>
        </nav>
        <!---菜单导航 end-->

        <div class="land" style="">
            <ul>
                <li>
                    <a href="../user/login.aspx"><span class="icon-3"></span>登录</a>
                </li>
                <li class="register">
                    <a href="../user/reg.aspx">注册</a>
                </li>
            </ul>
        </div>
        <div class="m-header section_r1" style="display:none">
            <div class="m-header my">
                <div node-name="user" class="my-user">
                    <em class="sprite my-user-icon"></em>
                    <em class="sprite my-user-triangle"></em>
                    <div node-name="userEject" class="my-user-eject" style="display: none;">
                        <p class="" data-url="/user/userInfo.aspx">我的资料</p>

                        <p data-url="/user/ordersManager.aspx">我的订单</p>

                        <p data-url="/user/MemberCardList.aspx">我的卡券</p>

                        <p data-url="/user/pointsList.aspx">我的积分</p>

                        <p data-url="/user/complainList.aspx">我的意见</p>

                        <p data-url="/user/loginout.aspx" class="hover">退出</p>
                    </div>
                </div>

                <div node-name="cart" class="cart">
                    <em class="sprite cart-carticon"></em>
                    <em class="sprite cart-nub">0</em>

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
    </div>
</header>

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


        
    <div id="cinemaSelector">
    </div>
    <div class="center cf noBottom">
        <div class="Schedule fl">
            <div class="ScheduleCon">
                <span class="ls"></span><span class="rs"></span>
                <div class="ScheduleMeau fl">
                    <section id="examples">
                        <div class="meauS fl">
                            <div class="meauTi fl meauTi1">放映日期</div>
                            <div></div>
                            
                            <ul id="ulShowTime" class="fl content demo-y">
                                <li><a href="{{ url('/home/movie/get/'.$id.'?date='.date('Y-m-d')) }}" class="js-linkCinema Hide meauSel" val="ZY10010518">今日上映 {{ date("m月d日") }}</a></li>
                                <li><a href="{{ url('/home/movie/get/'.$id.'?date='.date('Y-m-d',strtotime('+1 day'))) }}" class="js-linkCinema Hide meauSel" val="ZY10010518">明日上映 {{ date("m月d日",strtotime("+1 day")) }}</a></li>
                                <li><a href="{{ url('/home/movie/get/'.$id.'?date='.date('Y-m-d',strtotime('+2 day'))) }}" class="js-linkCinema Hide meauSel" val="ZY10010518"> {{ date("m月d日",strtotime("+2 day")) }}上映</a></li>
                            </ul>
                        </div>
                        
                        <div class="meauS fl tl">
                            <div class="meauTi fl meauTi2">影城</div>
                            <div></div>
                            <ul id="ulCinema" class="fl content demo-y">
                                <li><a href="javascript:void(0);" class="js-linkCinema Hide meauSel" val="ZY10010518">横店电影城</a></li>
                                
                            </ul>
                            
                        </div>
                        
                        <div class="meauS fl meauM tl">
                            <div class="meauTi fl meauTi3">影片</div>
                            <div></div>
                            <ul id="ulFilm" class="fl content demo-y">
                                <img id="loading3" src="{{ asset('home/images/18.gif') }}" alt="加载中" style="margin-left: 50px; display: none" />
                                <li><a href="{{ url('/home/movie/get/0?'.'date='.$date) }}" val="" class="meauSel">全部</a></li>
                                @foreach($movies as $m)
                                <li><a href="{{ url('/home/movie/get/'.$m->id.'?'.'date='.$date) }}" val="" class="meauSel">{{ $m->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        
                        
                        <div class="meauS fl tl">
                            <div class="meauTi fl meauTi4">时间</div>
                            <div></div>
                            <ul id="ulTime" class="fl">
                                <li><a href="{{ url('/home/movie/get') }}" val="" class="meauSel">全部</a></li>
                            </ul>
                        </div>
                        <div class="meauS fl tl">
                            <div class="meauTi fl meauTi3">版本</div>
                            <div>
                            </div>
                            <ul  id="ulShowType" class="fl content demo-y">
                                <li class="sta"><a href="javascript:void(0);" val="" class="meauSel">全部</a></li>
                                <li class="sta"><a href="javascript:void(0);" val="0">2D</a></li>
                                <li class="sta"><a href="javascript:void(0);" val="1">3D</a></li>
                                <li class="sta"><a href="javascript:void(0);" val="3">IMAX2D</a></li>
                                <li class="sta"><a href="javascript:void(0);" val="4">4D</a></li>
                                <li class="sta"><a href="javascript:void(0);" val="5">IMAX3D</a></li>
                                <li class="sta"><a href="javascript:void(0);" val="6">巨幕2D</a></li>
                                <li class="sta"><a href="javascript:void(0);" val="7">巨幕3D</a></li>
                            </ul>
                        </div>
                    </section>
                    <div class="clear">
                    </div>
                </div>
                <div class="ScheduleList fl">
                    <div class="ListTitle fr">
                        <ul>
                            <li class="fl ">不可售票场次</li>
                            <li class="fl scheduleTag2">现场售票场次</li>
                            <li class="fl scheduleTag1">在线售票场次</li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                    <div class="ScheduleList fl">
                        <div class="ListCon">
                        <span id="labDataBind">
                        <?php $i=0 ?>
                        @foreach($movie as $mo)
                        <dl class="fl">
                            <dt class="fl">
                                <div class="ListConPic">
                                    <img width="129" height="176" src="{{ asset('admin/upload/movie/'.$mo->title_pic) }}">
                                </div>
                                <div class="ListBtnAll"><a class="ListBtn1" href="" target="_blank">影片介绍</a>
                                </div>
                            </dt>
                            <dd class="fr">
                                <div class="ListConTitle">
                                    <div class="f20 fl mr_r hhsz"><a class="ListBtn2" href="" target="_blank">{{ $mo->title }}</a></div>
                                    <div class="fr f14"><a href="" target="_blank">【231】篇影评</a></div>
                                    <div class="fr f14 mr_r">片长{{ $mo->length }}</div>
                                    <div class="clear"></div>
                                </div>
                                <div class="ScheduleTag">
                                <ul>
                                    <li class="fl"><a href="javascript:void(0);"><i class="fl TagLeft"></i><span class="fl">全部</span><i class="fl TagRight"></i></a>
                                    </li>
                                </ul>
                                </div>
                                <div class="clear"></div>
                                @foreach( $arr[$mo->title] as $v)
                                <div class="ScheduleLink">
                                    <ul>
                                        <li class="fl">
                                            <a class="LinkUnsale f16" onmouseover="display({{ $i }})" onmouseout="disappear({{ $i }})" href="{{ url('/home/movie/seat/'.$v->id) }}" target="_blank">{{$v->time}}<em class="f12">¥{{ $v->price }}</em><em class="f12">{{ $v->format }}</em>
                                            </a>
                                            <div class="tagSale"></div>
                                            <div class="pop" id="div_{{ $i }}" style="display: none;" onmouseover="display({{ $i }})" onmouseout="disappear({{ $i }})">
                                                <div class="popCon tl">
                                                    <div>{{ $v->time.','.$v->rname.','.$v->number.'个座位' }}</div>
                                                    <div class="f14">标准价：<span class="th">¥{{$v->price}}</span>&nbsp;&nbsp;&nbsp;网售价：<span class="hsz">¥{{$v->price}}</span></div>
                                                    <div class="f16">VIP会员价：<b class="ccsz">￥{{($v->price)*0.9}}</b></div>
                                                    <div class="f16">钻石会员价：<b class="ccsz">￥{{($v->price)*0.85}}</b></div>
                                                    <div class="popBtn"><a href="{{ url('/home/movie/seat/'.$mo->id) }}" target="_blank">选座购票</a></div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <?php $i++ ?>
                                @endforeach
                            </dd>
                        </dl>
                        @endforeach
                        <div class="clear">
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="ctl00$ContentPlaceHolder1$hidCurDate" id="ContentPlaceHolder1_hidCurDate" value="2017-07-10 21:55:40" />

    <script type="text/javascript">        
        /**
 * 小图标初始化
 */
        var initShoppingIcon = function() {
            var that = {};
            var icon = $('<a href="javascript:void(0)" class="shopping-icon03"></a>');
            var dialog = null;
            icon.appendTo(document.body);

            var updatePosition = function() {
                var winWidth = $(window).width();
                var winHeight = $(window).height();
                var width = 1002 + (66 + 10) * 2;
                var right = winWidth > width ? (winWidth - width) / 2 : 10;
                var top = (winHeight - 66) > 0 ? (winHeight - 66) / 2 : 0;

                icon.css({
                    top: top + "px",
                    right: right + "px"
                });
            }

            updatePosition();

            $(window).bind("resize", updatePosition);

            icon.click(function() {
                dialog = shoppingDialog();
                dialog.show();
            });

            that.hide = function() {
                dialog && dialog.hide();
                dialog = null;
            }

            return that;
        }

        /**
         * 弹层
         */
        var shoppingDialog = function() {
            if(!cinemaNo) return;
            var that = {};
            var node = $('<div><iframe frameborder="0" src="sanckStore.aspx@cinemaNo='+cinemaNo+'" style="width: 100%; height: 100%;" ></iframe></div>');
            var mask = $('<div style="width: 100%; height: 100%; left: 0; top: 0; position: fixed; -ms-filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=30); filter: alpha(opacity=30); opacity: 0.3; background-color: black;z-index: 9999;"></div>');
    
            node.css({
                "position": "fixed",
                "z-index": 10000,
                "left": "0px",
                "top": "0px",
                "background-color": "white",
                "border": "1px solid #cdcdcd",
                "border-radius": "5px",
                "overflow": "hidden"
            });
    
            that.show = function() {
                mask.appendTo(document.body);
                node.appendTo(document.body);

                $(document.documentElement).css({
                    width: "100%",
                    height: "100%",
                    overflow: "hidden"
                });

                that.setMiddle();

                $(window).bind("resize", that.setMiddle);
                $(window).bind("scroll", that.setMiddle);
            }

            that.hide = function() {
                $(window).unbind("resize", that.setMiddle);
                $(window).unbind("scroll", that.setMiddle);
                node.remove();
                mask.remove();

                $(document.documentElement).css({
                    width: "auto",
                    height: "auto",
                    overflow: "auto"
                });
            }

            that.setMiddle = function() { 
                var winWidth = $(window).width();
                var winHeight = $(window).height();
                var nodeWidth = node[0].offsetWidth;
                var nodeHeight = node[0].offsetHeight;
                var left = Math.max((winWidth - nodeWidth) / 2, 0);
                var top = Math.max((winHeight - nodeHeight) / 2, 0);

                node.css({
                    left: "0",
                    top: "0",
                    width: winWidth + "px",
                    height: winHeight + "px"
                });

                mask.css({
                    width: winWidth,
                    height: winHeight
                });
            }

            return that;
        }

        $('#ulshowTime li a').live("click",function() {
            var url  ="{{ url('/home/movie/get') }}";
            $.ajax({
                url:url,
                type:"POST",
                dataType:'json',
                data:{},
                success:function(data) {

                },
                error:function() {
                    alert('请求失败');
                }
            });
        });
    </script>

<footer class="index-footer">
			<div class="pro-box">
                <img style=" margin-top: 50px;
            margin-right: 50px;float: left;display: block;" class="codePic" src="{{ asset('home/images/doubleCode.jpg') }}">
				<ul style="float: left;width: 840px;">
					<li>
						<h3>新手上路</h3>
						<p><a href="../help/helpreg.aspx#num1">注册登录问题</a></p>
						<p><a href="../help/helpreg.aspx#num2">用户绑定会员卡问题</a></p>
						<p><a href="../help/helpreg.aspx#num3">影票相关问题</a></p>
						<p><a href="../help/helpreg.aspx#num4">票价和支付问题</a></p>
						<p><a href="../help/helpreg.aspx#num5">取票凭证码问题</a></p>
                        <p><a href="../help/helpcenter.aspx">服务中心</a></p>
					</li>
					<li>
						<h3>购票指南</h3>
                        <p><a href="../help/helpgoseat.aspx#num1">用户购票流程</a></p>
                        <p><a href="../help/helpgoseat.aspx#num2">取票观影指南</a></p>
                        <p><a href="../help/helpgoseat.aspx#num3">会员卡支付相关说明</a></p>
                        <p><a href="../help/helpgoseat.aspx#num4">网银支付相关说明</a></p>
					</li>
					<li>
						<h3>用户中心</h3>
						<p><a href="../help/helpcenter.aspx#num1">购物流程</a></p>
                        <p><a href="../help/helpcenter.aspx#num2">常见问题</a></p>
                        <p><a href="../help/helpcenter.aspx#num3">发票制度</a></p>
                        <p><a href="../help/helpcenter.aspx#num4">支付方式 </a></p>
                        <p><a href="../help/helpcenter.aspx#num5">配送方式 </a></p>
                        <p><a href="../help/helpcenter.aspx#num6">售后服务 </a></p>
                        <p><a href="../help/helpcenter.aspx#num7">退货政策 </a></p>
                        <p><a href="../help/helpcenter.aspx#num8">联系我们 </a></p>
					</li>
					<li>
						<h3>会员权益</h3>
						<p><a href="../help/helpmember.aspx#num1">会员订票权益</a></p>
                        <p><a href="../help/helpmember.aspx#num2">会员积分权益</a></p>
                        <p><a href="../help/helpmember.aspx#num3">入会资格</a></p>
                        <p><a href="../help/helpmember.aspx#num4">会员卡折扣说明</a></p>
					</li>
                    <li>
						<h3>手机客户端</h3>
						<p><a href="../appclient/client.aspx">手机客户端介绍与下载</a></p>
                        <p><a href="../#">影片信息查询</a></p>
                        <p><a href="../#">手机自助购票</a></p>
					</li>
				</ul>
                 <div class="clear" style="clear: both;"></div> 
			</div>

			<div class="links-box">
				<ul>
					<li><a href="../common/aboutus.aspx">关于中影</a></li>
					<li><a href="../common/contactus.aspx">联系方式</a></li>
					<li><a href="../common/addservice.aspx">服务协议 </a></li>
					<li><a href="../common/complaint.aspx">会员协议 </a></li>
					<li><a href="../common/hr.aspx">市场合作 </a></li>
                    <li><a href="../common/privacy.aspx">隐私条款 </a></li>
					<li style="border-right: 0;"><a  href="../common/pre.aspx">免责声明</a></li>

				</ul>
			</div>
			<div class="copyright">
                Copyright © 2007 -
                2017
                ChinaFilm All rights reserved.<a href="../../www.miitbeian.gov.cn/state/outPortal/loginPortal.action">京ICP备15040734号-1 </a>中影影院投资有限公司 版权所有

                
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
        <script type="text/javascript">
            require.config({
                baseUrl: "../resource/js/mall/src",
                urlArgs: "__ts=" + new Date().getTime()
            });

            require(["pages/mall"], function (page) {
                page.init();
            });
        </script>
    

<script type="text/javascript">
//<![CDATA[
actcinemamap = []//]]>
</script>
</body>
</html>

