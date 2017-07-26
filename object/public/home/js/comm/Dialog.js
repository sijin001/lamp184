/*JqueryUI Dialog相关函数 Begin*/
var dialogObject = null;
/*alert弹出提示框
//隐藏右上角X关闭按钮，原因是当点击X关闭后，再次弹出时确定按钮样式会丢失
参数说明：
msg：内容
callback：回调函数
*/
function showAlert(msg, callback) {
    var maxAlertWidth = 600; var minAlertWidth = 400; msgFontSize = 16;
    var msgWidth = msg.length * msgFontSize + 64; //计算宽度
    msgWidth = (msgWidth < maxAlertWidth) ? msgWidth : maxAlertWidth;
    msgWidth = (msgWidth > minAlertWidth) ? msgWidth : minAlertWidth;
    var dialogContent = "<div style='padding:.5em 32px'><p style='margin:2px 0 40px 0;text-align:center; color:#000; font:" + msgFontSize + "px/24px \"微软雅黑\";'>" + msg + "</p></div>";
    dialogObject = $(dialogContent).dialog({
        width: msgWidth,
        height: "auto",
        position: 'center',
        modal: true,
        buttons: {
            '确 认': function() {
                if (callback === undefined) { } else {
                    if (typeof callback == "function")
                        callback();
                }
                dialogObject.dialog('destroy');
                dialogObject = null;
            }
        },
        title: "提示信息",
        //closeText: "X",
        open: function(event, ui) {
            //隐藏关闭按钮
            $(".ui-dialog-titlebar-close").hide();
            $('.ui-dialog .ui-dialog-buttonpane button').eq(0).children('span').addClass('set_attention_sub');
        }
    });
}

function showCinemaAlert(msg, callback) {
    var maxAlertWidth = 600; var minAlertWidth = 400; msgFontSize = 16;
    var msgWidth = msg.length * msgFontSize + 64; //计算宽度
    msgWidth = (msgWidth < maxAlertWidth) ? msgWidth : maxAlertWidth;
    msgWidth = (msgWidth > minAlertWidth) ? msgWidth : minAlertWidth;
    var dialogContent = "<div style='padding:.5em 32px'><p style='margin:2px 0 40px 0;text-align:left; color:#000; font:" + msgFontSize + "px/24px \"微软雅黑\";'>" + msg + "</p></div>";
    dialogObject = $(dialogContent).dialog({
        width: msgWidth,
        height: "auto",
        position: 'center',
        modal: true,
        buttons: {
            '确 认': function () {
                if (callback === undefined) { } else {
                    if (typeof callback == "function")
                        callback();
                }
                dialogObject.dialog('destroy');
                dialogObject = null;
            }
        },
        title: "提示信息",
        //closeText: "X",
        open: function (event, ui) {
            //隐藏关闭按钮
            $(".ui-dialog-titlebar-close").hide();
            $('.ui-dialog .ui-dialog-buttonpane button').eq(0).children('span').addClass('set_attention_sub');
        }
    });
}


/*无确认按钮的提示框
参数说明：
msg：内容
callback：回调函数
*/
function showAlertWithoutButton(msg, callback) {
    var maxAlertWidth = 600; var minAlertWidth = 400; msgFontSize = 16;
    var msgWidth = msg.length * msgFontSize + 64; //计算宽度
    msgWidth = (msgWidth < maxAlertWidth) ? msgWidth : maxAlertWidth;
    msgWidth = (msgWidth > minAlertWidth) ? msgWidth : minAlertWidth;
    var dialogContent = "<div style='padding:.5em 32px'><p style='margin:2px 0 40px 0;text-align:center; color:#000; font:" + msgFontSize + "px/24px \"微软雅黑\";'>" + msg + "</p></div>";
    dialogObject = $(dialogContent).dialog({
        width: msgWidth,
        height: "auto",
        position: 'center',
        modal: true,
        title: "提示信息",
        closeText: "X",
        open: function(event, ui) { $('.ui-dialog .ui-dialog-buttonpane button').eq(0).children('span').addClass('set_attention_sub'); },
        beforeclose: function(event, ui) { if (typeof callback == "function") callback(); }
    });
}
/*自定title*/
function showAlertWithoutButtonByTitle(msg, title) {
    var maxAlertWidth = 600; var minAlertWidth = 400; msgFontSize = 16;
    var msgWidth = msg.length * msgFontSize + 64; //计算宽度
    msgWidth = (msgWidth < maxAlertWidth) ? msgWidth : maxAlertWidth;
    msgWidth = (msgWidth > minAlertWidth) ? msgWidth : minAlertWidth;
    var dialogContent = "<div style='padding:.5em 32px'><p style='margin:2px 0 40px 0;text-align:left; color:#000; font:" + msgFontSize + "px/24px \"微软雅黑\";'>" + msg + "</p></div>";
    dialogObject = $(dialogContent).dialog({
        width: msgWidth,
        height: "auto",
        position: 'center',
        modal: true,
        title: title,
        closeText: "X",
        open: function (event, ui) { $('.ui-dialog .ui-dialog-buttonpane button').eq(0).children('span').addClass('set_attention_sub'); },
        //beforeclose: function (event, ui) { if (typeof callback == "function") callback(); }
    });
}

/*无关闭按钮的确认框
参数说明：
msg：内容
//解决bug：在一个dialog上弹出确认框，点击确认框的关闭按钮进行关闭后，再次弹出确认框时按钮样式会丢失
//微调了取消按钮的位置，使之与确认按钮对齐
callback1：回调函数1
callback2：回调函数2
*/
function showConfirm(msg, callback1, callback2) {
    var maxAlertWidth = 600; var minAlertWidth = 400; msgFontSize = 16;
    var msgWidth = msg.length * msgFontSize + 64; //计算宽度
    msgWidth = (msgWidth < maxAlertWidth) ? msgWidth : maxAlertWidth;
    msgWidth = (msgWidth > minAlertWidth) ? msgWidth : minAlertWidth;
    var dialogContent = "<div style='padding:.5em 32px'><p style='margin:2px 0 40px 0;text-align:center; color:#000; font:" + msgFontSize + "px/24px \"微软雅黑\";'>" + msg + "</p></div>";
    dialogObject = $(dialogContent).dialog({
        width: msgWidth,
        height: "auto",
        position: 'center',
        modal: true,
        title: "提示信息",
        //closeText : "X",
        buttons: {
            '确认': function() {
                callback1();
                //解决bug：如果确认框在一个已有的dialog上弹出，关闭后会导致该dialog的关闭按钮消失
                $(".ui-dialog-titlebar-close").show();
                dialogObject.dialog('destroy');
                dialogObject = null;
            },
            '取消': function() {
                //解决bug：如果确认框在一个已有的dialog上弹出，关闭后会导致该dialog的关闭按钮消失
                $(".ui-dialog-titlebar-close").show();
                if (typeof callback2 == "function")
                    callback2();
                dialogObject.dialog('destroy');
                dialogObject = null;
            }
        },
        open: function(event, ui) {
            //隐藏关闭按钮
            $(".ui-dialog-titlebar-close").hide();
            $('.ui-dialog .ui-dialog-buttonpane button').attr('style', 'margin:10;');
            $('.ui-dialog .ui-dialog-buttonpane button').eq(0).children('span').addClass('set_attention_sub');
            $('.ui-dialog .ui-dialog-buttonpane button').eq(1).children('span').addClass('set_attention_sub');
        }
    });
}


/*无关闭按钮的确认框
参数说明：
msg：内容
//解决bug：在一个dialog上弹出确认框，点击确认框的关闭按钮进行关闭后，再次弹出确认框时按钮样式会丢失
//微调了取消按钮的位置，使之与确认按钮对齐
callback1：回调函数1
callback2：回调函数2
*/
function showConfirm2(msg, callback1, callback2) {
    var maxAlertWidth = 600; var minAlertWidth = 400; msgFontSize = 16;
    var msgWidth = msg.length * msgFontSize + 64; //计算宽度
    msgWidth = (msgWidth < maxAlertWidth) ? msgWidth : maxAlertWidth;
    msgWidth = (msgWidth > minAlertWidth) ? msgWidth : minAlertWidth;
    var dialogContent = "<div style='padding:.5em 32px'><p style='margin:2px 0 40px 0;text-align:center; color:#000; font:" + msgFontSize + "px/24px \"微软雅黑\";'>" + msg + "</p></div>";
    dialogObject = $(dialogContent).dialog({
        width: msgWidth,
        height: "auto",
        position: 'center',
        modal: true,
        title: "提示信息",
        //closeText : "X",
        buttons: {
            '确认': function () {
                callback1();
                //解决bug：如果确认框在一个已有的dialog上弹出，关闭后会导致该dialog的关闭按钮消失
                $(".ui-dialog-titlebar-close").show();
                dialogObject.dialog('destroy');
                dialogObject = null;
            },
            '返回': function () {
                //解决bug：如果确认框在一个已有的dialog上弹出，关闭后会导致该dialog的关闭按钮消失
                $(".ui-dialog-titlebar-close").show();
                if (typeof callback2 == "function")
                    callback2();
                dialogObject.dialog('destroy');
                dialogObject = null;
            }
        },
        open: function (event, ui) {
            //隐藏关闭按钮
            $(".ui-dialog-titlebar-close").hide();
            $('.ui-dialog .ui-dialog-buttonpane button').attr('style', 'margin:10;');
            $('.ui-dialog .ui-dialog-buttonpane button').eq(0).children('span').addClass('set_attention_sub');
            $('.ui-dialog .ui-dialog-buttonpane button').eq(1).children('span').addClass('set_attention_sub');
        }
    });
}
function showParmsConfirm(msg, callback1, callback2,parms1,parms2) {
    var maxAlertWidth = 600; var minAlertWidth = 400; msgFontSize = 16;
    var msgWidth = msg.length * msgFontSize + 64; //计算宽度
    msgWidth = (msgWidth < maxAlertWidth) ? msgWidth : maxAlertWidth;
    msgWidth = (msgWidth > minAlertWidth) ? msgWidth : minAlertWidth;
    var dialogContent = "<div style='padding:.5em 32px'><p style='margin:2px 0 40px 0;text-align:center; color:#000; font:" + msgFontSize + "px/24px \"微软雅黑\";'>" + msg + "</p></div>";
    dialogObject = $(dialogContent).dialog({
        width: msgWidth,
        height: "auto",
        position: 'center',
        modal: true,
        title: "提示信息",
        //closeText : "X",
        buttons: {
            '确认': function () {
                if (parms1 != null && parms1 != undefined) {
                    callback1(parms1);
                }
                else {
                    callback1();
                }
                //解决bug：如果确认框在一个已有的dialog上弹出，关闭后会导致该dialog的关闭按钮消失
                $(".ui-dialog-titlebar-close").show();
                dialogObject.dialog('destroy');
                dialogObject = null;
            },
            '取消': function () {
                //解决bug：如果确认框在一个已有的dialog上弹出，关闭后会导致该dialog的关闭按钮消失
                $(".ui-dialog-titlebar-close").show();
                if (typeof callback2 == "function") {
                    if (parms2 != null && parms2 != undefined) {
                        callback2(parms2);
                    }
                    else {
                        callback2();
                    }
                }                   
                dialogObject.dialog('destroy');
                dialogObject = null;
            }
        },
        open: function (event, ui) {
            //隐藏关闭按钮
            $(".ui-dialog-titlebar-close").hide();
            $('.ui-dialog .ui-dialog-buttonpane button').attr('style', 'margin:10;');
            $('.ui-dialog .ui-dialog-buttonpane button').eq(0).children('span').addClass('set_attention_sub');
            $('.ui-dialog .ui-dialog-buttonpane button').eq(1).children('span').addClass('set_attention_sub');
        }
    });
}

/*
弹出iframe窗口
参数说明：
url :窗体的url,格式："http://www.baidu.com/"
pWidth : 宽度
pHeight ：高度
pTitle :标题
*/
function openDialog(url, width, height, title) {
    if (width == undefined || width == "")
        width = 650;
    if (height == undefined || height == "")
        height = 400;
    if (title == undefined)
        title = "";
    dialogObject = $("<div></div>").append($("<iframe width='100%' height='100%' frameBorder='0' style='border: 0;' id='Preview' src='" + url + "' scrolling='auto'></iframe>")).dialog({
        autoOpen: true,
        modal: true,
        position: 'center',
        height: height,
        width: width,
        resizable: false,
        title: title,
        closeText: "X",
        open: function(event, ui) {
            $("span").each(function(i) {
                if (this.innerHTML == "close") {
                    this.style.display = "none";
                }
            });
            $('.ui-dialog .ui-dialog-buttonpane button').eq(0).children('span').addClass('set_attention_sub');
        },
        close: function(event, ui) {
            $(this).dialog("destroy"); // 关闭时销毁
            dialogObject = null;
        }
    });
}

//手动关闭Dialog，通常用法：window.parent.closeDialog()
function closeDialog() {
    if (dialogObject == null) {
        return;
    } else {
        dialogObject.dialog('destroy');
        dialogObject = null;
    }
}
/*JqueryUI Dialog相关函数 End*/

function OpenUrl(url) {
    var a = document.createElement("a");
    a.setAttribute("href", url);
    a.setAttribute("target", "_blank");
    a.setAttribute("id", "ticket_openwin");
    document.body.appendChild(a);
    if (a.click) a.click();  //判断是否支持click() 事件
    else if (a.fireEvent) a.fireEvent('onclick');  //触发click() 事件
    else if (document.createEvent) {
        var evt = document.createEvent("MouseEvents");  //创建click() 事件
        evt.initEvent("click", true, true);   //初始化click() 事件
        a.dispatchEvent(evt);  //分发click() 事件
    }
}

//显示正在处理
function Processing() {
    //$(".boxLayer").show();
    $("#zhezao").show();

    if (document.getElementById("loading")) {
        DeleteDiv();
    }

    var div_box = document.createElement("DIV");
    var bodySize = getBodySize();
    div_box.id = "loading";
    div_box.style.position = "absolute";
    div_box.className = "loading";

    var i = 0;
    div_box.style.left = (bodySize[0] - i * i * 4 - 170) / 2 + "px";
    div_box.style.top = (bodySize[1] / 2 - i * i) + "px";
    div_box.style.width = i * i * 4 + "px";
    div_box.style.height = i * i * 1.5 + "px";

    div_box.style.background = "#FFFFFF";
    div_box.style.visibility = "visible";

    div_box.innerHTML = "<table align='center'width='150'  height='30px' style='background:#FFFFFF'><tr><td rowspan='3' style='width: 30px'><img src='resource/images/18.gif' width='32' height='32'/></td><td colspan='2'></td></tr><tr><td colspan='2' >&nbsp;&nbsp;处理中请稍等...</td></tr><tr><td colspan='2'></td></tr></table>";
    document.getElementById("container").appendChild(div_box);
    //document.getElementById("container").style.background = "#000033";
}

//处理完成
function Complete() {
    //$(".boxLayer").hide();
    $("#zhezao").hide();
    var div = document.getElementById("loading");
    if(div != null)
        div.parentNode.removeChild(div);
    //document.getElementById("container").style.background = "#FFFFFF";
}

//取得页面的高宽
function getBodySize() {
    var bodySize = [];
    with (document.documentElement) {
        //如果滚动条的宽度大于页面的宽度，取得滚动条的宽度，否则取页面宽度
        bodySize[0] = clientWidth;
        //bodySize[0] = (scrollWidth > clientWidth) ? scrollWidth : clientWidth;
        //如果滚动条的高度大于页面的高度，取得滚动条的高度，否则取高度
        bodySize[1] = clientHeight;
        //bodySize[1] = (scrollHeight > clientHeight) ? scrollHeight : clientHeight;
    }
    return bodySize;
}

function DeleteDiv() {
    var div = document.getElementById('loading');
    div.parentNode.removeChild(div);
}



function ForceWindow() {
//    this.r = document.documentElement;
//    this.f = document.createElement("FORM");
//    this.f.target = "_blank";
//    this.f.method = "post";
//    this.r.insertBefore(this.f, this.r.childNodes[0]);

    this.f = document.forms[0];
    this.f.target = "_blank";
    this.f.method = "post";
}

ForceWindow.prototype.open = function(sUrl) {
    this.f.action = sUrl;
    this.f.submit();
}

function OpenUrl1(url) {
    var _windows = document.forms[0];
    _windows.action = url;
    _windows.submit();
}

function showBank(url) {
    $("body").append(url);
    $("#gobank").submit();
    $("#gobank").remove();
}