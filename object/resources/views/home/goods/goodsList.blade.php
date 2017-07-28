@extends('home.parent')
@section('content')

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
<style>
    #search{
        margin-top:10px;
        height: 31px;
        border: 1px solid #be125a;
        color: #909090;
        text-indent: 8px;
        line-height: 33px;
        width: 306px;
        font-family: 微软雅黑;
    }
    .fangda {
        width: 61px;
        height: 33px;
        background: #be125a;
        display: inline-block;
        text-align: center;
        line-height: 33px;
    }
    .fangda .fangdajing {
        width: 21px;
        height: 21px;
        margin-top: 6px;
        background-position: -512px -314px;
    }
    .sprite {
        display: inline-block;
        background: transparent url("{{ asset('home/images/sprite.png') }}") no-repeat center top;
        vertical-align: middle;
    }
</style>

    <div class="pbd m-mall-bg">
        <div id="m_category" class="m-mall-con clearfix">
            <div class="m-mall-all-header">
                

    <div class="col-md-12 inbox-grid1">
        <form action="{{ url('/list') }}">
           
          <div class="widget-main">
            <div class="row">
              <!-- 搜索 -->
              <div class="col-xs-12 col-sm-8">
                <div class="input-group">
                  <span style="margin-right:460px;"><a href="{{ url('/list') }}">全部商品 &gt;&gt; </a></span>
                  <span class="input-group-btn">
                    <input type="text" id="search" class="form-control search-query" name="gname" placeholder="商品名" />
                  </span>
                  <button class="fangda" type="submit" node-name="productSearch">
                    <em class="fangdajing  sprite"></em>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
            </div>
            <div class="m-mall-all-contant" style="margin-top:30px;">
                <ul node-name="categoryList" class="top">
                        <ul>
                            <li style="width:30px;"><p>分类</p></li>
                            @foreach($type as $t)
                            <li data-id=154 data-column=cid>{{ $t->tname }}</li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <div class="center" style="margin-top:50px;">
                    <div class="title" node-name="productSort" style="width:860px;float:left;">
                    <p style="line-height:50px;">商品列表</p>

                    </div>
                    <div class="title" node-name="top_page" style="width:89px;float:right; font-size:16px;"></div>

                    <ul node-name="productList" id="productList">
                        <!-- 遍历所有的商品列表 -->
                        @foreach($list as $v)
                        <li data-id="280">
                            <a href="{{ url('/goods').'/'.$v->gid }}">
                                <span>
                                    <img height="220" width="220" src="{{ asset('admin/upload/goods/'.$v->gimage) }}" alt="">
                                </span>
                                <samp>
                                    <?php echo $v->ghot == 0 ? '<em class="sell" style="background:#e16364">热销</em>' : ''?>
                                    <?php echo $v->gnew == 0 ? '<em class="new" style="background:#709fd5">新品</em>' : ''?>
                                </samp>
                                <p class="" style="bottom: -100.5px;">
                                    <span>{{ $v->gname }}</span><br>
                                    <b>￥{{ $v->price }}</b>
                                    <br>
                                    <b>100%</b> |  <br>
                                    <em class="goum"></em>
                                </p>
                            </a>
                        </li>
                        @endforeach

                    </ul>
                </div>

                <!---分页开始-->
                
                <div id="Pagination" class="jq_pagging" style="text-align: center">
                    {!! $list->appends($where)->render() !!}
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        require.config({
            baseUrl: "../resource/js/mall/src",
            urlArgs: "__ts=" + new Date().getTime()
        });

        require(["pages/mallAll"], function (page) {
            page.init();
        });
    </script>


@endsection


