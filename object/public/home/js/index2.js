$(function () {
    var isClick = false;//是否是点击滚动
    $('.nav p').eq(0).addClass('heightLight');
    $(window).scroll(function () {
        // 如果为点击滚动，退出当前事件
        if (isClick) {
            return;
        };
        var height = document.body.clientHeight;
        
        var scrollTop = $(this).scrollTop();
        console.log(height + ".." + scrollTop);
        if (scrollTop > 1000 && (height - scrollTop)>=1000) {
            $('#main .list').each(function (index, val) {
                if ((scrollTop >= $(this).offset().top - $(this).outerHeight() / 2)) {
                    $('.nav p').eq(index).addClass('heightLight').siblings().removeClass();
                    var _index = $(".heightLight").index();
                    if (_index == 0) {
                        $(".float-title").find("div").removeClass().addClass("icon-45");
                    }
                    else if (_index == 1) {
                        $(".float-title").find("div").removeClass().addClass("icon-41");
                    }
                    else if (_index == 2) {
                        $(".float-title").find("div").removeClass().addClass("icon-46");
                    }
                    else if (_index == 3) {
                        $(".float-title").find("div").removeClass().addClass("icon-47");
                    }
                    else if (_index == 4) {
                        $(".float-title").find("div").removeClass().addClass("icon-44");
                    }
                }
            })
            $("#main").find(".float").show();
        }
        else {
            $("#main").find(".float").hide();
        }

    });

    $('.nav p').on('click', function () {
        isClick = true;
        $(this).addClass('heightLight').siblings().removeClass();

        // 获取当前导航索引
        var index = $(this).index();

        // 计算需要滚动的距离
        var currentLouti = $('#main .list').eq(index);
        var currentScrollTop = currentLouti.offset().top;
        if (currentScrollTop < 0) {
            currentScrollTop = 0;
        }

        $('html,body').animate({ scrollTop: currentScrollTop }, function () {
            //动画执行完后，重置点击滚动变量
            isClick = false;
        });
    });

    // 如果点击“返回到顶部”
    $(".jumpTop").on("click", function () {
        $('html,body').animate({ scrollTop: 0 }, function () {
            //动画执行完后，重置点击滚动变量
            isClick = false;
        });
    });
});























