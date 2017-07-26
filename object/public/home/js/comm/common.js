//检查当前用户是否登录,若没有登录，默认弹出登录层
/*isShowLogin：默认是弹出登录层，若不需要弹出登录层，则传入false
callbackUrl：回调url, 登录成功后，直接跳转到redirectUrl
*/

function checkIsLogin(isShowLogin, callbackUrl) {
    var result = false;
    var param = "action=checkIsLogin&id=" + Math.random();
    $.ajax({
        type: "GET",
        url: "user/userHandler.ashx",
        async: false, //同步加载,默认为异步
        cache: false,
        dataType: "html",
        data: param,
        success: function(data) {
            if (data == "0") {//没有登录
                if (isShowLogin == false) {
                    result = false;
                } else {
                    setTimeout(function() { showLogin(callbackUrl); }, 20);
                    result = false;
                }
            } else {//已登录
                result = true;
            }
        }
    });
    return result;
}

//弹出登录框
function showLogin(callbackUrl) {
    var url = "user/quicklogin.aspx";
    if (callbackUrl != undefined && callbackUrl != "" && callbackUrl != null) {
        url += "@callback=" + callbackUrl;
    }
    openDialog(url, "", "", "登录");
}


// 获取指定参数值
function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]); return null;
}


//评论中获取评论默认图片
function getPicturePath(path) {
    if ($.trim(path) != "" && $.trim(path) != "0") {
        return "resource/images/userface/" + path + ".jpg";
    } else {
        return "resource/images/userphoto.jpg";
    }
}

//评论中获取用户名
function getUserName(userName) {
    if ($.trim(userName) != "") {
        var reg = /^(13[0-9]|15[0-9]|18[0-9]|14[0-9])\d{8}$/;
        if (reg.test(userName)) { //判断是否手机号码
            return userName.substring(0, userName.length - 4) + "****";
        } else {
            return userName;
        }
    }
    return "";
}



//验证手机号
function CheckMobile(str) {
    var reg = /^1[3|4|5|7|8][0-9]\d{8}$/;
    if (reg.test(str) == false) {
        return false;
    }
    return true;
};

/*********************************************************************** 
* Title       : 包含其它 js 文件。 
* Description : 将其它 Js 文件引入本文件中。 
************************************************************************/
function include_js(path) {
    var headobj = document.getElementsByTagName('head')[0];
    $(headobj).append("<script src='resource/js/scroll.js' type='text/javascript'></script>");
}

//获取URL指定参数
function QueryStr(fieldName) {
    var qStr = QueryString(fieldName);
    if (qStr == null || qStr == "undefined" || qStr == "" || qStr == "null") {
        return "";
    }
    else {
        return qStr;
    }
}

function QueryString(fieldName) {
    var urlString = unescape(document.location.search);
    if (urlString != null) {
        var typeQu = fieldName + "=";
        var urlEnd = urlString.indexOf(typeQu);
        if (urlEnd != -1) {
            var paramsUrl = urlString.substring(urlEnd + typeQu.length);
            var isEnd = paramsUrl.indexOf('&');
            if (isEnd != -1) {
                return paramsUrl.substring(0, isEnd);
            }
            else {
                return paramsUrl;
            }
        }
        else
            return null;
    }
    else
        return null;
}


//将日期对象转换成 yyyy-MM-dd 格式的日期字符串
function GetDateString(date) {
    if (typeof (date) != "object") { date = parseInt(date); if (date) date = new Date(date); }
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    return year.toString() + "-" + (month > 9 ? month.toString() : "0" + month) + "-" + (day > 9 ? day.toString() : "0" + day);
}

//将日期对象转换成 yyyy-MM-dd HH:mm:ss 格式的日期字符串
function GetDateTimeString(date) {
    if (typeof (date) != "object") { date = parseInt(date); if (date) date = new Date(date); }
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var hour = date.getHours();
    var minute = date.getMinutes();
    var second = date.getSeconds();
    return year.toString()
        + "-" + (month > 9 ? month.toString() : "0" + month)
        + "-" + (day > 9 ? day.toString() : "0" + day)
        + " " + (hour > 9 ? hour.toString() : "0" + hour)
        + ":" + (minute > 9 ? minute.toString() : "0" + minute)
        + ":" + (second > 9 ? second.toString() : "0" + second);
};


// 对Date的扩展，将 Date 转化为指定格式的String   
// 月(M)、日(d)、小时(h)、分(m)、秒(s)、季度(q) 可以用 1-2 个占位符，   
// 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字)   
// 例子：   
// (new Date()).Format("yyyy-MM-dd hh:mm:ss.S") ==> 2006-07-02 08:09:04.423   
// (new Date()).Format("yyyy-M-d h:m:s.S")      ==> 2006-7-2 8:9:4.18   
Date.prototype.format = function (fmt) {
    var o = {
        "M+": this.getMonth() + 1,                 //月份   
        "d+": this.getDate(),                    //日   
        "h+": this.getHours(),                   //小时   
        "m+": this.getMinutes(),                 //分   
        "s+": this.getSeconds(),                 //秒   
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度   
        "S": this.getMilliseconds()             //毫秒   
    };
    if (/(y+)/.test(fmt))
        fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
        if (new RegExp("(" + k + ")").test(fmt))
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
};

/**       
 * 对Date的扩展，将 Date 转化为指定格式的String       
 * 月(M)、日(d)、12小时(h)、24小时(H)、分(m)、秒(s)、周(E)、季度(q) 可以用 1-2 个占位符       
 * 年(y)可以用 1-4 个占位符，毫秒(S)只能用 1 个占位符(是 1-3 位的数字)       
 * eg:       
 * (new Date()).pattern("yyyy-MM-dd hh:mm:ss.S") ==> 2006-07-02 08:09:04.423       
 * (new Date()).pattern("yyyy-MM-dd E HH:mm:ss") ==> 2009-03-10 二 20:09:04       
 * (new Date()).pattern("yyyy-MM-dd EE hh:mm:ss") ==> 2009-03-10 周二 08:09:04       
 * (new Date()).pattern("yyyy-MM-dd EEE hh:mm:ss") ==> 2009-03-10 星期二 08:09:04       
 * (new Date()).pattern("yyyy-M-d h:m:s.S") ==> 2006-7-2 8:9:4.18       
 */
Date.prototype.pattern = function (fmt) {
    var o = {
        "M+": this.getMonth() + 1, //月份           
        "d+": this.getDate(), //日           
        "h+": this.getHours() % 12 == 0 ? 12 : this.getHours() % 12, //小时           
        "H+": this.getHours(), //小时           
        "m+": this.getMinutes(), //分           
        "s+": this.getSeconds(), //秒           
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度           
        "S": this.getMilliseconds() //毫秒           
    };
    var week = {
        "0": "u65e5",
        "1": "u4e00",
        "2": "u4e8c",
        "3": "u4e09",
        "4": "u56db",
        "5": "u4e94",
        "6": "u516d"
    };
    if (/(y+)/.test(fmt)) {
        fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    }
    if (/(E+)/.test(fmt)) {
        fmt = fmt.replace(RegExp.$1, ((RegExp.$1.length > 1) ? (RegExp.$1.length > 2 ? "u661f/u671f" : "u5468") : "") + week[this.getDay() + ""]);
    }
    for (var k in o) {
        if (new RegExp("(" + k + ")").test(fmt)) {
            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        }
    }
    return fmt;
}

/*
函数：把字符串转换为日期对象
参数：yyyy-mm-dd或yyyy/mm/dd形式的字符串
返回：Date对象
注：IE下不支持直接实例化日期对象，如new Date("2011-04-06")
*/
function convertDate(date) {
    var flag = true;

    var dateArray = date.split("-");
    if (dateArray.length != 3) {
        dateArray = date.split("/");
        if (dateArray.length != 3) {
            return null;
        }
        // flag = false;
    }
    var newDate = new Date();
    if (flag) {
        // month从0开始
        newDate.setFullYear(dateArray[0], dateArray[1] - 1, dateArray[2]);
    }
    else {
        newDate.setFullYear(dateArray[2], dateArray[1] - 1, dateArray[0]);
    }
    newDate.setHours(0, 0, 0);
    return newDate;
};

/*
函数：计算两个日期之间的差值
参数：date是日期对象
flag：ms-毫秒，s-秒，m-分，h-小时，d-天，M-月，y-年
返回：当前日期和date两个日期相差的毫秒/秒/分/小时/天
*/
Date.prototype.dateDiff = function (date, flag) {
    var msCount = 24 * 60 * 60 * 1000;
    this.setHours(0, 0, 0, 0);
    date.setHours(0, 0, 0, 0);
    var diff = this.getTime() - date.getTime();
    return Math.floor(diff / msCount);

    switch (flag) {
        case "ms":
            msCount = 1;
            break;
        case "s":
            msCount = 1000;
            break;
        case "m":
            msCount = 60 * 1000;
            break;
        case "h":
            msCount = 60 * 60 * 1000;
            break;
        case "d":
            msCount = 24 * 60 * 60 * 1000;
            break;
    }
    return Math.floor(diff / msCount);
};

/* 
* 获得时间差,时间格式为 年-月-日 小时:分钟:秒 或者 年/月/日 小时：分钟：秒 
* 其中，年月日为全格式，例如 ： 2010-10-12 01:00:00 
* 返回精度为：秒，分，小时，天
*/
function GetDateDiff(startTime, endTime, diffType) {
    //将xxxx-xx-xx的时间格式，转换为 xxxx/xx/xx的格式 
    startTime = startTime.replace(/\-/g, "default.htm");
    endTime = endTime.replace(/\-/g, "default.htm");
    //将计算间隔类性字符转换为小写
    diffType = diffType.toLowerCase();
    var sTime = new Date(startTime);      //开始时间
    var eTime = new Date(endTime);  //结束时间
    //作为除数的数字
    var divNum = 1;
    switch (diffType) {
        case "second":
            divNum = 1000;
            break;
        case "minute":
            divNum = 1000 * 60;
            break;
        case "hour":
            divNum = 1000 * 3600;
            break;
        case "day":
            divNum = 1000 * 3600 * 24;
            break;
        default:
            break;
    }
    return parseInt((eTime.getTime() - sTime.getTime()) / parseInt(divNum));
}
/* 
* 秒数转换成 时：分：秒 格式
*/
function formatTime(second) {
    if (parseInt(second) <= 0)  
        return '00:00:00';
    return [parseInt(second / 60 / 60), parseInt(second / 60) % 60, parseInt(second) % 60].join(":")
        .replace(/\b(\d)\b/g, "0$1");
}


/*js字符串中特殊字符的转义处理函数/
/*防止string转json时报错*/
function stringFilter(s) {
    var newstr = "";
    for (var i = 0; i < s.length; i++) {
        c = s.charAt(i);
        switch (c) {
            case '\"':
                newstr += "\\\"";
                break;
            case '\\':
                newstr += "\\\\";
                break;
            case 'default.htm':
                newstr += "\\/";
                break;
            case '\b':
                newstr += "\\b";
                break;
            case '\f':
                newstr += "\\f";
                break;
            case '\n':
                newstr += "\\n";
                break;
            case '\r':
                newstr += "\\r";
                break;
            case '\t':
                newstr += "\\t";
                break;
            default:
                newstr += c;
        }
    }
    return newstr;
}


//验证是否为英文或数字
function CheckNumberOrEn(str) {
    var reg = /^[A-Za-z0-9_-]+$/;
    if (reg.test(str) == false) {
        return false;
    }
    return true;
};

function checkPassword(v) {
    var numasc = 0;
    var charasc = 0;
    var otherasc = 0;
    if (0 == v.length) {
        return "密码不能为空";
    } else if (v.length < 6 || v.length > 16) {
        return "密码必须由6~16个字母、數字组成";
    } else {
        for (var i = 0; i < v.length; i++) {
            var asciiNumber = v.substr(i, 1).charCodeAt();
            if (asciiNumber >= 48 && asciiNumber <= 57) {
                numasc += 1;
            }
            if ((asciiNumber >= 65 && asciiNumber <= 90) || (asciiNumber >= 97 && asciiNumber <= 122)) {
                charasc += 1;
            }
            /*if ((asciiNumber >= 33 && asciiNumber <= 47) || (asciiNumber >= 58 && asciiNumber <= 64) || (asciiNumber >= 91 && asciiNumber <= 96) || (asciiNumber >= 123 && asciiNumber <= 126)) {
            otherasc += 1;
            }*/
        }
        if (0 == numasc || 0 == charasc) {
            return "密码必须包含字母,数字";
        }
        /*else if (0 == charasc) {
        return "密码必须包含有字母";
        } else if (0 == otherasc) {
        return "密码必须包含有特殊字符";
        } */
        else {
            return true;
        }
    }
    //                if (!/^.*?[\d]+.*$/.test(password) || !/^.*?[A-Za-z].*$/.test(password) || !/^.{6,16}$/.test(password)) {
    //                    $('#error_tip').html("密码必须为字母加数字组成");
    //                    return false;
    //                }
};

function getJSONwithLoading(url, fn) {
    $.ajax({
        url: url,
        cache: false,
        dataType: "json",
        beforeSend: function() {
            Processing();
        },
        complete: function() {
            Complete();
        },
        error: function() {
            alert('请求失败,请稍后再试！');
        },
        success: fn
    });
}