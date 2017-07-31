@extends('home.parent')
@section('content')

<!---头部结束-->
<script src='{{ asset("home/js/jquery-1.8.3.min.js") }}'></script>
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

    <div class="pbd m-mall-bg">
        <div class="m-mall-con">
            <div class="m-mall-con-order-header sprite" style="background-position:0 -127px;"></div>
            <div class="order-address" id="m_orderDetail">

                <div class="order-address-distribution " node-name="choice">
                    <form action="{{ url('/home/confirmorder') }}" name="myform" method="post">
                        {{ csrf_field() }}
                        <div class="title"><h2>选择地址</h2></div>
                        <div style="margin:10px;font-size:16px;">
                            收货人姓名：
                            <input type="text" name="myname">
                        </div>
                        <div style="margin:10px;font-size:16px;">
                            选&nbsp;择&nbsp;地&nbsp;址：
                            <select name="city" id="cid">
                                <option>---请选择---</option>
                            </select>
                        </div>
                        <div style="margin:10px;font-size:16px;">
                            详&nbsp;细&nbsp;地&nbsp;址：<br>
                            <textarea name="address" cols="80" rows="3"></textarea>
                        </div>
                        <div style="margin:10px;font-size:16px;">
                            手&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;机：
                            <input type="text" name="phone">
                        </div>
                       
                            <input type="text" name="uid" value="{{ session('user')->id }}" style="display:none;">
                            <input type="text" name="gid" value="{{ $list->gid }}" style="display:none;">
                            <input type="text" name="time" value="{{ time() }}" style="display:none;">
                            <input type="text" name="sendtime" value="" style="display:none;">
                            <input type="text" name="address" value="" style="display:none;">
                            <input type="text" name="mynumber" value="{{ $_GET['number'] }}" style="display:none;">
                    </form>
                </div>
                <div class="order-address-send" node-name="choice">
                    <div class="title"><h2>送货时间</h2></div>
                    <div id="sendTime">
                        <p sendtimeid="1" class="hover">
                            <samp>不限送货时间<br>
                                <span>周一到周日</span>
                            </samp>
                        </p>
                        <p sendtimeid="2">
                            <samp>工作日送货<br>
                                <span>周一到周五</span>
                            </samp>
                        </p>
                        <p sendtimeid="3">
                            <samp>双休日、节假日送货<br>
                                <span>非工作日时间</span>
                            </samp>
                        </p>
                    </div>
                    
                </div>
                <div class="order-address-shop">
                    <div class="title"><h2>确认商品及优惠</h2></div>
                    <table>
                        <thead>
                            <tr>
                                <th width="40%">商品信息</th>
                                <th width="20%">单价</th>
                                <th>数量</th>
                                <th>小计</th>
                            </tr>
                        </thead>
                        <tbody id="proDetailList">
                            <tr proid="126">
                                <td style="text-align: left;padding-left:10px;">
                                    <dl><dt><img src="{{ asset('admin/upload/goods/'.$list->gimage) }}" height="50" width="50" alt=""></dt><dd style="width:290px;word-wrap:break-word;">{{ $list->gname }}</dd></dl>
                                </td>
                                <td>¥{{ $list->price }}</td>
                                <td>{{ $_GET['number'] }}</td>
                                <td><p>¥{{ ($list->price)*($_GET['number']).'.00' }}</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="integral">
                        <h2>
                            <samp><i style="width:100px; display:inline-block;">共 <b id="proNum">{{ $_GET['number'] }}</b>件商品，</i><label style="width:150px; display:inline-block;">商品总价：￥<span id="proPrice">{{ ($list->price)*($_GET['number']).'.00' }}</span> </label>
                            </samp> 
                        </h2>
                           <h2 style="margin-top:10px;">
                            <samp><i style="width:100px; display:inline-block;">&nbsp;</i><label style="width:150px; display:inline-block;">商品运费：<span id="shipPrice">免运费</span> </label>
                            </samp> 
                        </h2>
                    </div>
                </div>
                <div class="contant-bottom">
                    <p><label style="display:inline-block;margin-top:6px;">您需支付:</label>
                        <span style="display:inline-block; margin-top:2px;">￥
                            <em id="payAllPrice">{{ ($list->price)*($_GET['number']).'.00' }}</em>
                        </span>
                        <em id="payAllPrice"><a href="javascript:doSub()" class="but" style="text-decoration:none; margin-top:-8px;">确认订单</a></em>
                    </p><em id="payAllPrice">
                </em></div><em id="payAllPrice">
            </em></div><em id="payAllPrice">
        </em></div><em id="payAllPrice">
    </em></div><em id="payAllPrice">
     <div id="background" class="background" style="display: none; "></div>
    <div id="progressBar" class="progressBar" style="display: none; ">数据加载中，请稍等...</div>

    <script type="text/javascript">
        require.config({
            baseUrl: "/resource/js/mall/src",
            urlArgs: "__ts=" + new Date().getTime()
        });

        require(["pages/orderDetail"], function (page) {
            page.init();
        });

    </script>

    <!-- 城市选择操作 -->
    <script>
   
        var url = "{{ url('/goodsorder/get') }}";
        $.ajax({
            url:url,
            type:'get',
            dataType:'json',
            async:false,
            data:{upid:0},
            success:function(data){
                //遍历从数据库查出来的数据，生成新的option选项追加到select里面
                for (var i = 0; i < data.length; i++) {
                    $('#cid').append("<option value="+data[i].id+">"+data[i].name+'</option>');
                }
                console.log(data);
            },
            error:function(){
                alert('ajax请求失败');
            }
        });

        //给所有的select标签绑定change事件
        $('select').live('change',function(){
            // 干掉当前你选择的select后面所有的select
            $(this).nextAll('select').remove();
            //获取用户选择的值
            var v = $(this).val();
            //判断是不是选择了---请选择---
            if(v != '---请选择---'){
                //因为在ajax的回调函数中需要使用当前对象，但是$(this)在ajax回调函数不能用，所以需要一个变量来中转
                var ob = $(this);
                var url = "{{ url('/goodsorder/post') }}";
                $.ajax({
                    url:url,
                    type:'post',
                    dataType:'json',
                    async:false,
                    data:{upid:v,'_token':"{{ csrf_token() }}"},
                    success:function(data){
                        //判断是不是最后一级城市，最后一级城市查询数据库的data.length == 0
                        if(data.length>0){
                            //生成一个新的select选项
                            var select = $("<select name='city'><option>---请选择---</option></select>");
                            //遍历从数据库查出来的数据，生成新的option选项追加到select里面
                            for (var i = 0; i < data.length; i++) {
                                $(select).append("<option value="+data[i].id+">"+data[i].name+'</option>');
                            }
                            //外部插入到前一个select选项后面
                            ob.after(select);
                        }
                        // alert(data);
                    },
                    error:function(){
                        alert('ajax请求失败');
                    }
                });
            }
        });

        // 选择送货时间
        $('#sendTime').find('p').click(function(){
            $('#sendTime').find('p').removeClass('hover');
            $(this).attr('class','hover');
            var str = $(this).find('span').html();
            $("input[name='sendtime']").val(str);
        })

        // 提交
        function doSub()
        {
            var str = '';
            $("option:selected").each(function() {
                str = str+$(this).html();
            })
            $("input[name='address']").val(str);
            var myform = document.myform;
            myform.submit();
        }


    </script>


  @endsection