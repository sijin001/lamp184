var ret_lon = 39.9493;
var ret_lat = 116.3975;
//function initialize(lon_value, lat_value) {

//    ret_lon = lon_value; ret_lat = lat_value;
//    var latlng = new google.maps.LatLng(ret_lat, ret_lon);

//    var myOptions = {
//        zoom: 15,
//        center: latlng,
//        mapTypeId: google.maps.MapTypeId.ROADMAP
//    };
//    var map = new google.maps.Map(document.getElementById("map_canvas"),
//			myOptions);
//    map.setCenter(latlng);
//    var marker = new google.maps.Marker({
//        map: map,
//        position: latlng,
//        title: '目标地址'
//    });
//}

var map; //地图对象
//初始化地图对象
function initMap() {
    map = new BMap.Map("map_canvas");
    var point = new BMap.Point(ret_lon, ret_lat);
    map.centerAndZoom(point, 16);
    // 地图加载完成后隐藏百度 Logo
    map.addEventListener("tilesloaded", function() { $("img[src='../../api.map.baidu.com/images/copyright_logo.png']").hide(); $(".BMap_cpyCtrl.BMap_noprint").hide(); });
    map.enableScrollWheelZoom();    //启用滚轮放大缩小，默认禁用
    map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用
    map.setDraggingCursor("url('bird2.cur')"); //鼠标拖拽时图标
    //local.disableAutoViewport();
    //添加默认缩放平移控件
    map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件

}


function addPoint(lon, lat) {
    var point = new BMap.Point(lon, lat);
    map.centerAndZoom(point, 16);
    map.clearOverlays();
    // 创建地理编码实例    
    var myGeo = new BMap.Geocoder();
    // 根据坐标得到地址描述
    myGeo.getLocation(point, function(result) {
        if (result) {
            var marker = new BMap.Marker(point),
		    opts = {
		        width: 250,     // 信息窗口宽度
		        height: 100,     // 信息窗口高度
		        title: cinemaName  // 信息窗口标题
		    },
			infoWindow = new BMap.InfoWindow("<p><span>地址：</span>" + result.address + "</p><p><span>电话：</span>" + $.trim($("#litCinemaPhone").text()) + "</p>", opts);  // 创建信息窗口对象
            map.addOverlay(marker);

            marker.addEventListener("click", function() {
                this.openInfoWindow(infoWindow, point); //开启信息窗口
            });

        }
    });
}


////百度地图使用方法
//function initialize2(lon, lat) { 
//    var map = new BMap.Map("map_canvas");
//    var point = new BMap.Point(lon, lat);
//    map.centerAndZoom(point, 16);
//    // 创建地理编码实例    
//    var myGeo = new BMap.Geocoder();
//    // 根据坐标得到地址描述
//    myGeo.getLocation(point, function(result) {
//        if (result) {
//            var marker = new BMap.Marker(point),
//		    opts = {
//		        width: 250,     // 信息窗口宽度
//		        height: 100,     // 信息窗口高度
//		        title: cinemaName  // 信息窗口标题
//		    },
//			infoWindow = new BMap.InfoWindow("<p><span>地址：</span>" + result.address + "</p><p><span>电话：</span>" + $.trim($("#litCinemaPhone").text()) + "</p>", opts);  // 创建信息窗口对象
//            map.addOverlay(marker);

//            marker.addEventListener("click", function() {
//                this.openInfoWindow(infoWindow, point); //开启信息窗口
//            });
//            
//        }
//    });
//    // 地图加载完成后隐藏百度 Logo
//    map.addEventListener("tilesloaded", function() { $("img[src='../../api.map.baidu.com/images/copyright_logo.png']").hide(); $(".BMap_cpyCtrl.BMap_noprint").hide(); });

//    map.enableScrollWheelZoom();    //启用滚轮放大缩小，默认禁用
//    map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用
//    map.setDraggingCursor("url('bird2.cur')"); //鼠标拖拽时图标
//    //local.disableAutoViewport();
//    //添加默认缩放平移控件
//    map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
//}