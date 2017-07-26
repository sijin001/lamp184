
//卖品加载信息
var typeid;
var selected;
var cinemaNo;
var sellShoppingCartList = new Array();


$(function () {
    typeid = $("#typeid").val();
    var cityName = $("#span_CityName").text();
    var cityNo = getCookie("_CityNo_");

    //设置卖品默认城市
    $('#MSelector_city').val(cityName).data('val', cityNo);
    var $sellCitySelector = $('#sellCitySelector');
    var $sellCinemaSelector = $('#sellCinemaSelector');

    $sellCitySelector.html($('.City_list').html());


    $.each($('a', $sellCitySelector), function (i, item) {
        $this = $(item);
        $this.data('val', $this.attr('id')).attr('id', 'sellCity' + $this.attr('id')).removeAttr('onclick');

    });
    $('a', $sellCitySelector).click(function () {
        $this = $(this);
        var cityNo = $this.data('val');
        $('#MSelector_city').val($this.text()).data('val', cityNo);
        $sellCitySelector.hide();
        getSellDefaultCinema(cityNo);
    });

    $sellCitySelector.mouseleave(function () {
       $sellCitySelector.hide();
    });

    

    $('#MSelector_city').click(function () {
        $sellCitySelector.show();
    });

    $('#MSelector_cinema').click(function (event) {
        $sellCitySelector.hide();
        var cityNo = $('#MSelector_city').data('val');
        $sellCinemaSelector.load('cinema/cinemaSelector.aspx@excludeThird=1&type=0&cityNo=' + cityNo, null, function () {
            $('.cinema-selector-close').hide();
            $sellCinemaSelector.show();
        });
    });

    $sellCinemaSelector.mouseleave(function () {
        $sellCinemaSelector.hide();
    });

    //影院选择器 影院点击事件
    $(".cinema-ci a").live("click", function () {
        $sellCinemaSelector.hide();
        var $this = $(this);
        var cinemaNo = $this.data('cinemano');
        var cinemaName = $this.text();
        $('#MSelector_cinema').val(cinemaName).data('val',cinemaNo)
        loadSellList();
    });

    var cinemaNo=QueryString('cinemaNo');
    if (cinemaNo) {
        
        $.ajax({
            type: "post",
            dataType: "json",
            url: "cinema/getCinemaData.ashx",
            data: "action=getCinemaDetail&cinemaNo=" + cinemaNo,
            async: false,
            cache: false,
            beforeSend: function () {
                $('#loading2').show();
            },
            success: function (data) {
                if (data && data.CinemaName) {
                    var cinema = data;
                    $('#MSelector_cinema').val(cinema.CinemaName).data('val', cinema.CinemaNo);
                    loadSellList();
                }
            }
        });

    } else {
        getSellDefaultCinema(cityNo);
    }
});

//获取卖品默认城市
function getSellDefaultCinema(cityNo) {
    $.ajax({
        type: "post",
        dataType: "json",
        url: "cinema/getCinemaData.ashx",
        data: "action=getDefaultCinema&excludeThird=1&cityNo=" + cityNo,
        async: true,
        cache: false,
        beforeSend: function () {
            $('#loading2').show();
        },
        success: function (data) {
            if (data && data.length == 1) {
                var cinema = data[0];
                $('#MSelector_cinema').val(cinema.CinemaName).data('val', cinema.CinemaNo);
                loadSellList();
            }
        }
    });
}

function getCityList() {
    selected = $("#selected").val();
    typeid = $("#typeid").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        async: false,
        url: "help/helpHandler.ashx",      //提交到一般处理程序请求数据
        data: "action=GetCityList&selected=" + selected,
        success: function (data) {
            var selector = new MCitySelector(data);
            selector.onMenuSelect = loadSellList;
            cinemaNo = data.selected;
            loadSellList();
        }
    });
}

//加载卖品列表
function loadSellList() {
    cinemaNo = $("#MSelector_cinema").data("val");
    $.ajax({
        type: "post",
        dataType: "json",
        url: "help/helpHandler.ashx",
        data: "action=GetSellList&CinemaNo=" + cinemaNo,
        async: false, //同步加载,默认为异步
        cache: false,
        success: function (data) {
            if (data != null) {
                var pagetype = $("#pagetype") ? $("#pagetype").val() : 0;//判断是否首页  1首页
                var spanLiHtml = "";
                if (pagetype == 1) {//首页
                    for (var i = 0; i < data.length; i++) {
                        var lastflag = "";
                        if (i == 0)
                            spanLiHtml += "<ul>";
                        if (i % 4 == 0 && (i + 1) != data.length && i != 0) {
                            spanLiHtml += "</ul><ul>";
                        }
                        if ((i + 1) % 4 == 0) {

                            lastflag = " style='margin-right:0;' ";
                        }

                        var item = data[i];
                        //spanLiHtml += "<div proCode = '" + item.ProCode + "' class='list-item " + (i % 3 == 2 ? "list-item-right" : "") + "'><div class='list-item-con'><div class='shop-list-img'><img src='" + item.ImgUrl + "' width='227' height='230' /></div><h2>" + "【" + getInterceptedStr(item.ProName, 22) + "】" + "</h2><p title='" + item.Memo + "'>" + getInterceptedStr(item.Memo, 32) + "</p><div class='shop-list-jiage'><h3>网购价：<span>￥" + item.SettlePrice + "</span></h3><h4>门市价：<span>¥" + item.StdPrice + "</span></h4></div></div><div class='shop-list-jz'><a href=\"javascript:void(0);\" onclick=\"setSellShoppingCart('" + item.ProCode + "','" + item.ProName + "','" + item.Memo + "'," + item.SettlePrice + "," + item.StdPrice + ",2,1)\">+</a><p id=sellAmount" + item.ProCode + ">0</p><a href=\"javascript:void(0);\" onclick=\"setSellShoppingCart('" + item.ProCode + "','" + item.ProName + "','" + item.Memo + "'," + item.SettlePrice + "," + item.StdPrice + ",1,1)\">-</a><h2>数量:</h2></div></div>";
                        spanLiHtml += "<li proCode = '" + item.ProCode + "' " + lastflag + ">";
                        spanLiHtml += "<div class=\"shop-box-pic\">";
                        spanLiHtml += "<div style=\"width:218px;height:222px;\"><img width='218' height='222' src='" + item.ImgUrl + "' alt=\"\"></div>";
                        spanLiHtml += "<div class=\"shop-package\" style=\"font-size:14px;\">【" + getInterceptedStr(item.ProName, 22) + "】</div>";
                        spanLiHtml += "<div class=\"shop-name\" style=\"font-size:12px;\" title='" + item.Memo + "'> " + getInterceptedStr(item.Memo, 32) + "</div>";
                        spanLiHtml += "<div class=\"price-box\"><p>网购价<span>￥" + item.SettlePrice + "</span></p><div class=\"mendian\">门市价 ¥" + item.StdPrice + "</div></div>";
                        spanLiHtml += "</div>";
                        spanLiHtml += "<div class=\"number clearfix\"><div class=\"reduce icon-29\" onclick=\"setSellShoppingCart('" + item.ProCode + "','" + item.ProName + "','" + item.Memo + "'," + item.SettlePrice + "," + item.StdPrice + ",2,1)\"></div><p id=\"sellAmount" + item.ProCode + "\" class=\"text\">0</p>  <div class=\"add icon-30\" onclick=\"setSellShoppingCart('" + item.ProCode + "','" + item.ProName + "','" + item.Memo + "'," + item.SettlePrice + "," + item.StdPrice + ",1,1)\"></div></div>";
                        spanLiHtml += "</li>";


                        if ((i + 1) == data.length)
                            spanLiHtml += "</ul>";
                    }

                }
                else {
                    for (var i = 0; i < data.length; i++) {
                        var item = data[i];
                        spanLiHtml += "<div proCode = '" + item.ProCode + "' class='list-item " + (i % 3 == 2 ? "list-item-right" : "") + "'><div class='list-item-con'><div class='shop-list-img'><img src='" + item.ImgUrl + "' width='227' height='230' /></div><h2>" + "【" + getInterceptedStr(item.ProName, 22) + "】" + "</h2><p title='" + item.Memo + "'>" + getInterceptedStr(item.Memo, 32) + "</p><div class='shop-list-jiage'><h3>网购价：<span>￥" + item.SettlePrice + "</span></h3><h4>门市价：<span>¥" + item.StdPrice + "</span></h4></div></div><div class='shop-list-jz'><a href=\"javascript:void(0);\" onclick=\"setSellShoppingCart('" + item.ProCode + "','" + item.ProName + "','" + item.Memo + "'," + item.SettlePrice + "," + item.StdPrice + ",2,1)\">+</a><p id=sellAmount" + item.ProCode + ">0</p><a href=\"javascript:void(0);\" onclick=\"setSellShoppingCart('" + item.ProCode + "','" + item.ProName + "','" + item.Memo + "'," + item.SettlePrice + "," + item.StdPrice + ",1,1)\">-</a><h2>数量:</h2></div></div>";
                    }

                }
                $("#sellList").html(spanLiHtml);
            }
        }
    });
    if (getCookie("_sellShoppingCartList_") != null) {
        sellShoppingCartList = JSON.parse(getCookie("_sellShoppingCartList_"));
    }
    ShowSellShoppingCart();
}

function setSellShoppingCart(proCode, proName, proMemo, settlePrice, stdPrice, setType, Amount) {
    var no = -1;
    if (sellShoppingCartList.length > 0) {
        for (i = 0; i < sellShoppingCartList.length; i++) {
            if (sellShoppingCartList[i].CinemaNo == cinemaNo && sellShoppingCartList[i].ProCode == proCode) {
                no = i;
                break;
            }
        }
    }
    if (no < 0) {
        if (setType == 1) {
            return;
        }
        var sellInfo = { CinemaNo: cinemaNo, ProCode: proCode, ProName: proName, ProMemo: proMemo, SettlePrice: settlePrice, StdPrice: stdPrice, Amount: 0 };
        no = sellShoppingCartList.push(sellInfo) - 1;
    }
    switch (setType) {
        case 1://减少
            sellShoppingCartList[no].Amount -= Amount;
            break;
        case 2://增加
            var amount = 0;
            for (j = 0; j < sellShoppingCartList.length; j++) {
                if (sellShoppingCartList[j].CinemaNo == cinemaNo) {
                    amount += sellShoppingCartList[j].Amount;
                }
            }
            if (amount >= 4) {
                showAlert("每单最多允许选择4套商品！");
                return;
            }
            sellShoppingCartList[no].Amount += Amount;
            break;
        case 3://清除
            sellShoppingCartList[no].Amount = 0;
            break;
        case 4://修改数量
            break;
    }
    ShowSellShoppingCart();

    if (sellShoppingCartList[no].Amount <= 0) {
        sellShoppingCartList.splice(no, 1);
    }
    setCookie("_sellShoppingCartList_", JSON.stringify(sellShoppingCartList));
}

//创建卖品 右侧/底部 购物车
function ShowSellShoppingCart() {

    var pagetype = $("#pagetype").val() ? $("#pagetype").val() : 0;//判断是否首页  1首页  
    if (pagetype == 1) {
        var spanLiHtml = "";
        var sumPrice = 0;
        var isCount = 0;
        if (typeid == 1) {//右侧购物车
            $("#area_info").show();
            $("#btnClose").hide();
        } else if (typeid == 2) {
            $("#area_info").hide();
            $("#btnClose").show();
        }
        if (sellShoppingCartList.length > 0) {
            spanLiHtml += "<div class='title'>影院：" + $("#MSelector_cinema").val() + "</div>";
            spanLiHtml += "<div class='shop-package-list-con'>";
            var flag = 1;
            for (i = 0; i < sellShoppingCartList.length; i++) {
                if (sellShoppingCartList[i].CinemaNo == cinemaNo) {
                    var item = sellShoppingCartList[i];
                    $("#sellAmount" + item.ProCode).html(item.Amount);
                    if (item.Amount > 0) {
                        //spanLiHtml += "<div class='shop-package-list-shop1'><h5 onclick=\"setSellShoppingCart('" + item.ProCode + "','" + item.ProName + "','" + item.ProMemo + "'," + item.SettlePrice + "," + item.StdPrice + ",3,0)\"></h5><h3><strong>" + "" + getInterceptedStr(item.ProName, 22) + "</strong><br/>" + getInterceptedStr(item.ProMemo, 27) + "</h3><div class='shopping-danj'>单价：￥" + item.SettlePrice + "</div><div class='shop-list-jz1'><h4>数量:</h4><a href=\"javascript:void(0);\" onclick=\"setSellShoppingCart('" + item.ProCode + "','" + item.ProName + "','" + item.ProMemo + "'," + item.SettlePrice + "," + item.StdPrice + ",1,1)\">-</a><p>" + item.Amount + "</p><a href=\"javascript:void(0);\" onclick=\"setSellShoppingCart('" + item.ProCode + "','" + item.ProName + "','" + item.ProMemo + "'," + item.SettlePrice + "," + item.StdPrice + ",2,1)\">+</a></div></div>";

                        spanLiHtml += "<div class='shop-package-list-shop1 bg" + flag + "'>";
                        spanLiHtml += "<h3>" + getInterceptedStr(item.ProName, 22) + "</h3>";
                        spanLiHtml += "<p>" + getInterceptedStr(item.ProMemo, 27) + "</p>";
                        spanLiHtml += "<p>单价：<span>￥" + item.SettlePrice + "</span></p>";
                        spanLiHtml += "<div class='number clearfix'><p>数量：</p><div class=\"reduce\" onclick=\"setSellShoppingCart('" + item.ProCode + "','" + item.ProName + "','" + item.ProMemo + "'," + item.SettlePrice + "," + item.StdPrice + ",1,1)\" ><a href=\"javascript:void(0);\">-</a></div><span class=\"text\">" + item.Amount + "</span><div class=\"add\" onclick=\"setSellShoppingCart('" + item.ProCode + "','" + item.ProName + "','" + item.ProMemo + "'," + item.SettlePrice + "," + item.StdPrice + ",2,1)\"><a href=\"javascript:void(0);\">+</a></div></div>";
                        spanLiHtml += "<div class='cancel icon-32' onclick=\"setSellShoppingCart('" + item.ProCode + "','" + item.ProName + "','" + item.ProMemo + "'," + item.SettlePrice + "," + item.StdPrice + ",3,0)\"><a href=\"javascript:void(0);\"></a></div>";
                        spanLiHtml += "</div>";
                        sumPrice += item.SettlePrice * item.Amount;
                        isCount++;
                        flag = flag == 1 ? 2 : 1;
                    }
                }
            }
        }
        if (isCount > 0) {

            $("#sellLeftShoppingCart").show();
        } else {
            $("#sellLeftShoppingCart").hide();
        }
        //spanLiHtml += "<div class='zhifubottom'><div class='shopping-hej'>合计：<span>￥" + (sumPrice).toFixed(2) + "</span></div><a href=\"javascript:void(0);\" onclick='GoSellOrder()' class='shopping-zhif'>去支付</a></div>";
        spanLiHtml += "<div class='shop-order'>";
        spanLiHtml += "<p>合计：<span>￥" + (sumPrice).toFixed(2) + "</span></p>";
        spanLiHtml += "<a href=\"javascript:void(0);\" onclick='GoSellOrder()'>去支付</a>";
        spanLiHtml += "</div>";
        spanLiHtml += "</div>";
        $("#sellLeftShoppingCart").html(spanLiHtml);
        $("#sellLeftShoppingCart").css("top", (window.location.href.indexOf('sanckStore.aspx') > 0 ? "60px" : "-100px"));
        return;


    }
    //sellBottomShoppingCart
    var spanLiHtml = "";
    var sumPrice = 0;
    var isCount = 0;
    if (typeid == 1) {//右侧购物车
        $("#area_info").show();
        $("#btnClose").hide();
    } else if (typeid == 2) {
        $("#area_info").hide();
        $("#btnClose").show();
    }
    if (sellShoppingCartList.length > 0) {
        spanLiHtml += "<h2>影院：" + $("#MSelector_cinema").val() + "</h2>";
        for (i = 0; i < sellShoppingCartList.length; i++) {
            if (sellShoppingCartList[i].CinemaNo == cinemaNo) {
                var item = sellShoppingCartList[i];
                $("#sellAmount" + item.ProCode).html(item.Amount);
                if (item.Amount > 0) {
                    spanLiHtml += "<div class='zhifucenter'><h5 onclick=\"setSellShoppingCart('" + item.ProCode + "','" + item.ProName + "','" + item.ProMemo + "'," + item.SettlePrice + "," + item.StdPrice + ",3,0)\"></h5><h3><strong>" + "" + getInterceptedStr(item.ProName, 22) + "</strong><br/>" + getInterceptedStr(item.ProMemo, 27) + "</h3><div class='shopping-danj'>单价：￥" + item.SettlePrice + "</div><div class='shop-list-jz1'><h4>数量:</h4><a href=\"javascript:void(0);\" onclick=\"setSellShoppingCart('" + item.ProCode + "','" + item.ProName + "','" + item.ProMemo + "'," + item.SettlePrice + "," + item.StdPrice + ",1,1)\">-</a><p>" + item.Amount + "</p><a href=\"javascript:void(0);\" onclick=\"setSellShoppingCart('" + item.ProCode + "','" + item.ProName + "','" + item.ProMemo + "'," + item.SettlePrice + "," + item.StdPrice + ",2,1)\">+</a></div></div>";
                    sumPrice += item.SettlePrice * item.Amount;
                    isCount++;
                }
            }
        }
    }
    if (isCount > 0) {

        $("#sellLeftShoppingCart").show();
    } else {
        $("#sellLeftShoppingCart").hide();
    }
    spanLiHtml += "<div class='zhifubottom'><div class='shopping-hej'>合计：<span>￥" + (sumPrice).toFixed(2) + "</span></div><a href=\"javascript:void(0);\" onclick='GoSellOrder()' class='shopping-zhif'>去支付</a></div>";
    $("#sellLeftShoppingCart").html(spanLiHtml);
    $("#sellLeftShoppingCart").css("top", (window.location.href.indexOf('sanckStore.aspx') > 0 ? "60px" : "-100px"));
}

//创建卖品订单 去支付
function GoSellOrder() {
    if (!checkIsLogin()) {
        return;
    }
    var mag = "您选择的卖品套餐只能在<br/><strong>影院:【" + $("#MSelector_cinema").val() + "】</strong><br/>兑换，请确认无误后支付。";
    showConfirm(mag, CreateSellOrder, ShowSellShoppingCart)
}
//创建卖品订单 去支付
function CreateSellOrder() {
    if (sellShoppingCartList.length > 0) {
        var proCode = "";
        var proNum = "";
        for (i = 0; i < sellShoppingCartList.length; i++) {
            if (sellShoppingCartList[i].CinemaNo == cinemaNo) {
                var item = sellShoppingCartList[i];
                proCode += item.ProCode + "|";
                proNum += item.Amount + "|";
            }
        }

        $.ajax({
            type: "post",
            dataType: "json",
            url: "buy/HandlerGoSeat.ashx",
            data: "action=CreateSellOrder&CinemaNo=" + cinemaNo + "&proCode=" + proCode + "&proNum=" + proNum,
            async: false, //同步加载,默认为异步
            cache: false,
            success: function (data) {
                //先清空,再删除
                sellShoppingCartList.splice(0, sellShoppingCartList.length);
                setCookie("_sellShoppingCartList_", JSON.stringify(sellShoppingCartList));
                deleteCookie("_sellShoppingCartList_");
                top.location.href = "buy/sanckbuyinfo.aspx@orderno=" + data.OrderNo;

            }
        });
    }

}


//区域选择三级联动
var MCitySelector = function (opts) {
    var that = this;
    var nodeList = $("#MSelector_city,#MSelector_district,#MSelector_cinema");
    var pArray = [];
    var idArray = [];
    var values = [];
    var hideCurrentMenu = null;

    // 将原始数据转化成查询起来更加高效的数据
    for (var i = 0; i < opts.data.length; i++) {
        if (pArray[opts.data[i].parent] == null) {
            pArray[opts.data[i].parent] = [opts.data[i]];
        } else {
            pArray[opts.data[i].parent].push(opts.data[i]);
        }

        idArray[opts.data[i].id] = opts.data[i];
    }

    /**
     * 对HTML代码做转义处理
     * @param  {string} str 需要转义的字符串
     * @return {string}     转义后的结果
     */
    var encodeHTML = function (str) {
        return str.replace(/\&/g, '&amp;').
          replace(/"/g, '&quot;').
          replace(/\</g, '&lt;').
          replace(/\>/g, '&gt;').
          replace(/\'/g, '&#39;').
          replace(/\u00A0/g, '&nbsp;').
          replace(/(\u0020|\u000B|\u2028|\u2029|\f)/g, '&#32;');
    }

    // 交互、事件处理
    nodeList.css("cursor", "pointer");

    $.each(nodeList, function (key, item) {
        $(item).attr("index", key);
    });

    nodeList.click(function (ev) {
        var target = $(this);
        var menu = $("<div class='m-selector-menu'></div>");
        var offset = target.offset();
        var itemId = target.attr("data-id");
        var hash = pArray[idArray[itemId].parent];
        var html = [];

        hideCurrentMenu && hideCurrentMenu();
        hideCurrentMenu = null;

        var hideMenu = function (ev) {
            for (var key in ev) {
                if (/^jQuery\d+$/.test(key)) {
                    return;
                }
            }

            menu.unbind('click');
            menu.remove();
            $(document).unbind('click', hideMenu);
        }

        ev.stopPropagation && ev.stopPropagation();
        $.each(hash, function (key, item) {
            html.push('<a href="javascript:void(0)" onclick="return false;" data-id="' + item.id + '">' + encodeHTML(item.name) + '</a>')
        });

        menu.html(html.join(''));

        menu.css({
            "left": offset.left + 2,
            "top": offset.top + this.offsetHeight - 2,
            "width": this.offsetWidth + 5
        });

        menu.click(function (ev) {
            var link = ev.target || ev.srcElement;
            ev.stopPropagation && ev.stopPropagation();
            hideMenu();

            if (link.tagName.toLowerCase() != "a") {
                return;
            }

            link = $(link);

            var itemId = link.attr('data-id');
            that.select(itemId);
        });

        menu.appendTo(document.body);
        $(document).click(hideMenu);
        hideCurrentMenu = hideMenu;
    });

    /**
     * 智能选择
     * @param  {number} id 允许是城市、城区或者影院的id，未限制的部份将自动填充
     * @return {[type]}    [description]
     */
    that.select = function (id) {
        var selectedIndexs = [0, 0, 0];
        var item = null;

        if (id == 0) {
            // 取opts.data中的第一条记录，如果没有记录。。。应该不会吧
            id = opts.data.length ? opts.data[0].id : 0;
        }

        // 处理selectedIndexs
        while (item = idArray[id]) {
            selectedIndexs = [item.id].concat(selectedIndexs);
            id = item.parent;
        }

        selectedIndexs.length = 3;

        if (selectedIndexs[0]) {
            for (var i = 1; i < 3; i++) {
                if (selectedIndexs[i] == 0) {
                    selectedIndexs[i] = pArray[selectedIndexs[i - 1]] != null ? pArray[selectedIndexs[i - 1]][0].id : 0;
                }
            }
        }

        for (var i = 0; i < 3; i++) {
            nodeList.eq(i).text(selectedIndexs[i] == 0 ? "暂无数据" : idArray[selectedIndexs[i]].name);
            nodeList.eq(i).attr("data-id", selectedIndexs[i]);
        }

        values = selectedIndexs.slice(0);
        that.onMenuSelect && that.onMenuSelect();
    }

    that.getValues = function () {
        return values.slice(0);
    }

    that.select(opts.selected);
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
    exp.setTime(exp.getTime() - 1000);
    if (cval != null)
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
    expires.setTime(expires.getTime() + (2 * 60 * 60 * 1000));
    document.cookie = name + "=" + value + "; path=/; expires=" + expires.toGMTString();
}

function btnclose() {
    try {
        parent.shoppingIcon.hide();
    } catch (ex) { }
}


// 截取固定长度子字符串 sSource为字符串iLen为长度  
function getInterceptedStr(sSource, iLen) {
    if (sSource.replace(/[^x00-xff]/g, "xx").length <= iLen) {
        return sSource;
    }
    var str = "";
    var l = 0;
    var schar;
    for (var i = 0; schar = sSource.charAt(i) ; i++) {
        str += schar;
        l += (schar.match(/[^x00-xff]/) != null ? 2 : 1);
        if (l >= iLen) {
            break;
        }
    }
    return str;
}