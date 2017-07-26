/**
 * Created by lenovo on 2016/1/13.
 */
/**
 * 通用头部功能
 */
define(function (require, exports, module) {

    //---------- require begin -------------
    var console = require("lib/io/console");
    var compBase = require("lib/comp/base");
    var parseNode = require("lib/dom/parseNode");
    var addEvent = require("lib/evt/add");
    var className = require("lib/dom/className");
    var sizzle = require("lib/dom/sizzle");
    //var $ = require("jquery");
    //---------- require end -------------

    return function (node, opts) {
        var that = compBase();

        //------------声明各种变量----------------
        var nodeList = null;
        var data = null;

        //---------------事件定义----------------
        var evtFuncs = {
            pshow: function (ev) {
                className.add(ev.target, "hover");
            },
            phide: function (ev) {
                className.remove(ev.target, "hover");
            },
            userShow: function (ev) {
                className.add(nodeList.user, "hover");
                nodeList.userEject.style.display = "block";
                addEvent(nodeList.userEject, "mouseover", evtFuncs.pshow);
                addEvent(sizzle("p", nodeList.userEject), "click", evtFuncs.jump);
            },
            jump: function (ev) {
                open($(ev.target).attr("data-url"));
            },
            cartJump: function (ev) {
                ev.stopPropagation();
                var pid = $(ev.target).closest("dd").find("input[name='h_productId']").val();
                if (ev.target.nodeName == "P"){
                    open("/mall/productDetail.aspx?id=" + pid, "_self");
                }
                    
                else if (ev.target.nodeName == "H3") {
                    showConfirm("确认要删除记录吗?", function () { custFuncs.cartRemoveItem(pid, nodeList, ev); }, function () {
                    })
                }
                else if (ev.target.nodeName == "A") {
                    if (className.has(ev.target, "cart-but")){}
                    {
                        ev.stopPropagation();
                        open("/mall/shoppingCart.aspx", "_self");
                    }
                }
            },
            settlementJump: function (ev) {
                //alert(ev.target.nodeName);
            },
            userHide: function () {
                className.remove(nodeList.user, "hover");
               
                nodeList.userEject.style.display = "none";
                addEvent(nodeList.userEject, "mouseout", evtFuncs.phide);
                $(nodeList.userEject).find("p").last().addClass("hover");
               
            },
            cartShow: function () {
                var length = $(nodeList.cartEject).find("dl").length;
                if (length == 0) return;
                className.add(nodeList.cart, "hover");
                nodeList.cartEject.style.display = "block";
            },
            cartHide: function () {
                className.remove(nodeList.cart, "hover");
                nodeList.cartEject.style.display = "none";
            },
            cartView: function (ev) {
                if (ev.target.nodeName == "EM") {
                    open("/mall/shoppingCart.aspx", "_self");
                }
            }
        }

        //---------------子模块定义---------------
        var modInit = function () {

        }

        //-----------------绑定事件---------------
        var bindEvents = function () {

            addEvent(nodeList.user, "mouseover", evtFuncs.userShow);
            addEvent(nodeList.user, "mouseout", evtFuncs.userHide);

            addEvent(nodeList.cart, "mouseover", evtFuncs.cartShow);
            addEvent(nodeList.cart, "mouseout", evtFuncs.cartHide);
            addEvent(nodeList.cart, "click", evtFuncs.cartView);
            addEvent(nodeList.cartEject, "click", evtFuncs.cartJump);

            //addEvent(sizzle(".cart-but", nodeList.cartEject), "click", evtFuncs.settlementJump);

        }

        //-----------------自定义函数-------------
        var custFuncs = {
            cartRemoveItem: function (pid, _nodeList, ev) {
                if (pid == "") return;
                var isSuccess = false;
                if (ev == null || ev == undefined) {
                    $(_nodeList.cartEject).find("input[name='h_productId']").each(function () {

                        if ($(this).val() == pid) {
                            $(this).closest("dl").remove();
                            isSuccess = true;
                            return false;
                        }
                    });
                }
                else {
                    $.ajax({
                        url: '/mall/ShoppingCartProcess.ashx?action=deleteRow&pid=' + pid,
                        async: false,
                        success: function (data) {
                            if (data == "1") {
                                $(ev.target).closest("dl").remove();
                                isSuccess = true;
                            }
                        }
                    });
                }

                if (!isSuccess) return;
                var totalPrice = 0;
                var totalQty = 0;
                $(_nodeList.cartEject).find("input[name='h_price']").each(function () {
                    totalPrice += parseFloat($(this).val()) * parseInt($(this).closest("dd").find("input[name='h_qty']").val());
                });
                $(_nodeList.cartEject).find("input[name='h_qty']").each(function () {
                    totalQty += parseInt($(this).val());
                });
                $(_nodeList.cartEject).find("#i_count").text(totalQty);
                $(_nodeList.cartEject).prev(".cart-nub").text(totalQty);
                $(_nodeList.cartEject).find("#i_totalPrice").text("¥" + totalPrice.toFixed(2));
            }
        }

        //-----------------初始化----------------
        var init = function (param, _data) {
            nodeList = parseNode(node);

            data = _data;

            modInit();
            bindEvents();
        }

        //-----------------暴露各种方法-----------
        that.init = init;
        that.cartRemoveItem = custFuncs.cartRemoveItem;
        return that;
    }
});