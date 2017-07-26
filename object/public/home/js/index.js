var t = n = 0, count;
var showfilmcount = 8;
$(function () {
    getNotice();
    getAd();

    count = $("#banner_list a").length;
    $("#banner_list a:not(:first-child)").hide();
    $("#banner li").click(function () {
        var i = $(this).text() - 1; //获取Li元素内的值，即1，2，3，4 
        n = i;
        if (i >= count || count <= 1) return;
        $("#banner_list a").filter(":visible").fadeOut(0).parent().children().eq(i).fadeIn(1000);
        $(this).css({ "background": "#be2424", 'color': '#000' }).siblings().css({ "background": "#6f4f67", 'color': '#fff' });
    });
    t = setInterval("showAuto()", 4000);
    $("#banner").hover(function () { clearInterval(t); }, function () { t = setInterval("showAuto()", 4000); });
    initFilm();

    $(window).scroll(function () {
        if ($(window).scrollTop() == 0) {
            initFilm();

        }
    });
   
    
});
function initFilm()
{
    
    if ($("#hotFilmDiv li").length > showfilmcount) {
        $("#hotFilmDiv .drop-down").show();
        $("#hotFilmDiv li").each(function (index, item) {
            if (index >= showfilmcount) {
                $(item).hide();
            } else {
                $(item).show();
            }
        });
    }
    if ($("#comingFilmDiv li").length > showfilmcount) {
        $("#comingFilmDiv .drop-down").show();
        $("#comingFilmDiv li").each(function (index, item) {
            if (index >= showfilmcount) {
                $(item).hide();
            } else {
                $(item).show();
            }
        });
    }

}
function morefilm(type)
{
    if (type == 1) {
        $("#hotFilmDiv li").show();
        $("#hotFilmDiv .drop-down").hide();
    }
    else {        
        $("#comingFilmDiv li").show();
        $("#comingFilmDiv .drop-down").hide();
    }
}


function getNotice() {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "search/common.ashx@action=indexNotice",      //提交到一般处理程序请求数据
        success: function (data) {
            if (data != null && data.List.length > 0) {
                //$("#div_ntion").attr("style", "display:;");
                var spanHtml =data.List.length>0? "<div class=\"icon-4\"></div>":"";
                //for (var i = 0; i < data.List.length; i++) {
                //    if (i == 0) {
                //        spanHtml = "<li><a href='help/noticeDetail.aspx@id=" + data.List[0].id + "' class=\"red first\">" + data.List[0].title + "</a></li>";
                //    }
                //    else
                //        spanHtml += "<li><a href='help/noticeDetail.aspx@id=" + data.List[i].id + "'>" + data.List[i].title + "</a></li>";
                //}
                var leng = data.List.length >= 2 ? 2 : data.List.length;
                for (var i = 0; i < leng; i++) {
                    if (i == 0) {
                        spanHtml += "<p onclick=\"location.href='help/noticeDetail.aspx@id=" + data.List[0].id + "'\"><span>" + data.List[0].title + "</span></p>";
                    }
                    else
                        spanHtml += "<p onclick=\"location.href='help/noticeDetail.aspx@id=" + data.List[i].id + "'\">" + data.List[i].title + "</p>";
                }

                $("#span_Notice").html(spanHtml);
            }
            else {
                //$("#div_ntion").attr("style", "display:none;");
            }
        }
    });
}
function getAd() {
    $.ajax({
        type: "POST",
        dataType: "json",
        async: false,
        url: "search/common.ashx@action=footAd&postion=" + $("#hidPostion").val(),      //提交到一般处理程序请求数据
        success: function (data) {
            if (data != null && data.List.length > 0) {
                var spanLiHtml = "";
                var spanDivHtml = "";
                for (var i = 0; i < data.List.length; i++) {
                    spanLiHtml += "<li>" + (i + 1) + "</li>";                 
                    spanDivHtml += "<a href=\"" + data.List[i].AdLinkUrl + "\"><img src=\"" + data.List[i].AdPicUrl + "\" title=\"" + data.List[i].AdTitle + "\"   alt=\"" + data.List[i].AdTitle + "\" /></a>";
                }
                $("#span_footAdLi").html(spanLiHtml);
                $("#banner_list").html(spanDivHtml);
            }
        }
    });
}

function showAuto() {
    n = n >= (count - 1) ? 0 : ++n;
    $("#banner li").eq(n).trigger('click');
}

//首页 热映 即将上映切换
function changeFilm(num) {
    if (num == 1) {
        $("#hotFilmDiv").show();
        $("#comingFilmDiv").hide();
        $("#hotClickA").attr("class", "cur");
        $("#futureClickA").removeAttr("class");
    } else {
        $("#hotFilmDiv").hide();
        $("#comingFilmDiv").show();

        $("#hotClickA").removeAttr("class");
        $("#futureClickA").attr("class", "cur");
    }
}
//我的订单
function myOrder() {
    var url = "user/ordersManager.aspx";
    if (checkIsLogin(true, url)) {
        window.location = url;
    }
}
//中影会员卡
function userCard() {
    var url = "user/MemberCardList.aspx";
    if (checkIsLogin(true, url)) {
        window.location = url;
    }
}
//投诉建议
function complain() {
    var url = "user/complainList.aspx";
    if (checkIsLogin(true, url)) {
        window.location = url;
    }
}






