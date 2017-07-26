/**
 * Created by lenovo on 2016/1/13.
 */
/**
 * 商城首页
 */
define(function (require, exports, module) {
   
    //---------- require begin -------------
    var console = require("lib/io/console");
    var compBase = require("lib/comp/base");
    var queryNode = require("lib/dom/queryNode");
    var addEvent = require("lib/evt/add");
    var header = require("zymall/header");
    var mall = require("zymall/mall/mall");

    //---------- require end -------------

    var that = compBase();

    //------------声明各种变量----------------
    //var nodeList = null;
    var opts = null;
    var m_header = null;
    var m_mall = null;

    //---------------事件定义----------------
    var evtFuncs = {}

    //---------------子模块定义---------------
    var modInit = function() {
        m_header = header(nodeList.header, opts);
        m_header.init("hehe");
        
      
        m_mall = mall(nodeList.mall, opts);
        m_mall.init();
    }

    //-----------------绑定事件---------------
    var bindEvents = function() {}

    //-----------------自定义函数-------------
    var custFuncs = {}

    //-----------------初始化----------------
    var init = function(_opts) {
        opts = _opts;

        nodeList = {
            header: queryNode("#m_header"),
            mall: queryNode("m_mall")
        }

        modInit();
        bindEvents();
    }

    //-----------------暴露各种方法-----------
    that.init = init;

    return that;
});