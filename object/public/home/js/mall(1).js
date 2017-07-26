/**
 * Created by lenovo on 2016/1/13.
 */
/**
 * 商场首页
 */
define(function (require, exports, module) {
    //---------- require begin -------------
    var console = require("lib/io/console");
    var compBase = require("lib/comp/base");
    var parseNode = require("lib/dom/parseNode");
    var addEvent = require("lib/evt/add");
    var className = require("lib/dom/className");
    var contains = require("lib/dom/contains");
    var a = require("zymall/mall/jquery.easing.1.3");
    var b = require("zymall/mall/jquery.elastislide");
    //---------- require end -------------

    return function (node, opts) {
        var that = compBase();

        //------------声明各种变量----------------
        var nodeList = null;
        var data = null;

        //---------------事件定义----------------
        var evtFuncs = {
            findLi: function (node, cnode) {
                while (cnode.nodeName != "LI" && contains(node, cnode)) {
                    cnode = cnode.parentNode;
                }
                return cnode;
            },
            show: function (ev) {
                className.add(evtFuncs.findLi(nodeList.mallNav, ev.target), "hover");
                 
              
            },
            hide: function (ev) {
                className.remove(evtFuncs.findLi(nodeList.mallNav, ev.target), "hover");
            },
            mallNav: function (ev) {
                //var text = evtFuncs.findLi(nodeList.mallNav, ev.target).textContent;
                var id = "";

                if (ev.target.nodeName == "EM") {
                    id = $(ev.target).attr("data-id");
                }
                else if (ev.target.nodeName == "LI") {
                    id = $(ev.target).children("em").attr("data-id");
                   
                
               
                }
                    
                open("ProductList.aspx?cid=" + id, "_blank");
            },
            mallMenu: function (ev) {
                if (ev.target.nodeName == "LI") {
                    var _index = $(ev.target).index();
                    if (_index == 1) {
                        open("/index.aspx#sell_store", "_self");
                    }
                    else if (_index == 2 || _index == 3) {
                        open("/user/MemberCardList.aspx?action=mall", "_self");
                    }
                }
            },
            menuItems: function (ev) {
                if (ev.target.nodeName == "A") {
                    var data_url = $(ev.target).attr("data-url");
                    if (data_url != "") {
                        open(data_url, "_blank");
                    }
                }
            },
            carouselShow: function (ev) {
                if (ev.target.nodeName == "IMG") {
                    $(ev.target).css("opacity", "1");
                }
                
            },
            carouselHide: function (ev) {
                if (ev.target.nodeName == "IMG") {
                    $(ev.target).css("opacity", "0.5");
                }
            }
        }
        var now = 0;

        //---------------子模块定义---------------
        var modInit = function () { }

        //-----------------绑定事件---------------
        var bindEvents = function () {
            addEvent(nodeList.mallNav, "mouseover", evtFuncs.show);
            addEvent(nodeList.mallNav, "mouseout", evtFuncs.hide);
            addEvent(nodeList.mallNav, "click", evtFuncs.mallNav);
            addEvent(nodeList.mallMenu, "click", evtFuncs.mallMenu);
            addEvent(nodeList.menuItems, "click", evtFuncs.menuItems);
            addEvent(nodeList.carousel, "mouseover", evtFuncs.carouselShow);
            addEvent(nodeList.carousel, "mouseout", evtFuncs.carouselHide);

        }
        var categorySI;
        var scrollIndex = 0;
        var index = -1;
        //-----------------自定义函数-------------
        var custFuncs = {
            menuScroll: function (time) {

                var offsetLeft = $(".m-mall-con:eq(0)").offset().left;
                var rootWidth = ($(".m-mall-con:eq(0)").width() + 10);
                var rootLength = $(".m-mall-con").length;
                categorySI = setInterval(function () {
                    if (scrollIndex > 2) {
                        scrollIndex = 0;
                        $(".m-mall-con").css("left", "0");
                        $(".m-mall-menu ul li:eq(" + (scrollIndex) + ")").addClass("hover").siblings().removeClass("hover");
                        return;
                    }

                    $(".m-mall-menu ul li:eq(" + (scrollIndex + 1) + ")").addClass("hover").siblings().removeClass("hover");
                    for (var i = 0; i < rootLength; i++) {
                        if (i == scrollIndex) {
                            for (var j = 0; j <= i; j++) {
                                if (j == 0) {
                                    $(".m-mall-con:eq(" + j + ")").css("position", "relative");
                                    $(".m-mall-con:eq(" + j + ")").animate({ left: -((offsetLeft + rootWidth) * (i + 1) - (offsetLeft * j)) + "px" }, "fast");
                                }
                                $(".m-mall-con:eq(" + (j + 1) + ")").css("position", "relative");
                                $(".m-mall-con:eq(" + (j + 1) + ")").animate({ left: -((offsetLeft + rootWidth) * (i + 1) - (offsetLeft * (j + 1))) + "px" }, "slow");
                            }
                        }
                    }
                    scrollIndex++;
                }, 5000)
            },
            initMallMenu: function () {
              
                
                $("div.m-mall-con-content").hide();
                $("div.m-mall-con-content:eq(2)").show();
                $('#carousel1').elastislide({
                    imageW: 217,
                    border: 1,
                    minItems: 1,
                    current: 0
                   
                });
              
            
            }
        }

        //-----------------初始化----------------
        var init = function (_data) {
            nodeList = parseNode(node);
            data = _data;
            modInit();
            bindEvents();
            custFuncs.initMallMenu();
            if (nodeList.ysp != null) {
                //   new Marquee(
                //{
                //    MSClassID: "xinwen_l_gg2",
                //    ContentID: "xinwen_l_gg_img2",
                //    TabID: "xinwen_l_gg_a2",
                //    Direction: 2,
                //    Step: 0.5,
                //    Width: 1003,
                //    Height: 530,
                //    Timer: 20,
                //    DelayTime: 10000,
                //    WaitTime: 0,
                //    ScrollStep: 1003,
                //    SwitchType: 0,
                //    AutoStart: 1
                //})
            }
        }

        //-----------------暴露各种方法-----------
        that.init = init;

        return that;
    }
});