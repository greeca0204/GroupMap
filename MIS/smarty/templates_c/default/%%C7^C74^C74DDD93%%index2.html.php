<?php /* Smarty version 2.6.18, created on 2014-08-28 07:49:03
         compiled from index2.html */ ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.4"></script>
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<title><?php echo $this->_tpl_vars['siteTitle']; ?>
</title>
<style type="text/css">
body, html{width: 100%;height: 100%;overflow: hidden;margin:0;}
#allmap {margin-right: 300px;height: 100%;overflow: hidden;}
#result {border-left:1px dotted #999;height:100%;width:295px;position:absolute;top:0px;right:0px;font-size:12px;}
dl,dt,dd,ul,li{
    margin:0;
    padding:0;
    list-style:none;
}
dt{
    font-size:14px;
    font-family:"微软雅黑";
    font-weight:bold;
    border-bottom:1px dotted #000;
    padding:5px 0 5px 5px;
    margin:5px 0;
}
dd{
    padding:5px 0 0 5px;
}
li{
    line-height:28px;
}
</style>
</head>
<body>
<div id="allmap" style="overflow:hidden;zoom:1;position:relative;">	
    <div id="map" style="height:100%;-webkit-transition: all 0.5s ease-in-out;transition: all 0.5s ease-in-out;"></div>
    <div id="showPanelBtn" style="position:absolute;font-size:14px;top:50%;margin-top:-95px;right:0px;width:20px;padding:10px 10px;color:#999;cursor:pointer;text-align:center;height:170px;background:rgba(255,255,255,0.9);-webkit-transition: all 0.5s ease-in-out;transition: all 0.5s ease-in-out;font-family:'微软雅黑';font-weight:bold;">显示检索结果面板<br/>&lt;</div>
    <div id="panelWrap" style="width:0px;position:absolute;top:0px;right:0px;height:100%;overflow:auto;-webkit-transition: all 0.5s ease-in-out;transition: all 0.5s ease-in-out;">
        <div style="width:20px;height:200px;margin:-100px 0 0 -10px;color:#999;position:absolute;opacity:0.5;top:50%;left:50%;">此处用于展示结果面板</div>
        <div id="panel" style="position:absolute;"></div>
    </div>
</div>

<div id="result">
    <dl>
    	<dt>基本操作</dt>
        <dd>
            <ul>
                <li>视野范围内最优视觉:<input type="radio" value="1" id="enableAutoPan" name="isAutoPan" checked="checked"/>开启<input type="radio"  id="disableAutoPan" value="0" name="isAutoPan">关闭</button>
                <li><button id="open">打开</button><button id="close">关闭</button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="show">显示</button><button id="hide">隐藏</button></li>
            </ul>
        </dd>
    	<dt>设置</dt>
        <dd>
            <ul>
                </li>
				<li>是否显示发送到手机：<input type="checkbox" id="enableSendToPhone" checked/></li>
                <li>位置：经度 <input type="text" id="lng" value="116.307852" style="width:80px;"/> 纬度 <input type="text" id="lat" value="40.057031" style="width:80px;"/></li>
                <li>标题：<input type="text" id="title" value="百度大厦" style="width:230px;"/></li>
                <li>内容：<input type="text" id="content" value='<div style="margin:0;line-height:20px;padding:2px;"><img src="../img/baidu.jpg" alt="" style="float:right;zoom:1;overflow:hidden;width:100px;height:100px;margin-left:3px;">地址：北京市海淀区上地十街10号<br>电话：(010)59928888<br>简介：百度大厦位于北京市海淀区西二旗地铁站附近，为百度公司综合研发及办公总部。</div>' style="width:230px;"/></li>
                <li><button id="setValue">设置</button></li>
            </ul>
        </dd>
    	<dt>获取信息窗口参数</dt>
        <dd>
            <ul>
                <li>位置：<button id="getPosition">getPosition</button></li>
                <li>标题：<button id="getTitle">getTitle</button></li>
                <li>内容：<button id="getContent">getContent</button></li>
            </ul>
        </dd>
    	<dt>选择样式</dt>
        <dd>
            <ul>
                <li>
                    <input type="button" value="默认样式" onclick="searchInfoWindow.open(marker);"/>
                    <input type="button" value="样式1" onclick="openInfoWindow1()"/>
                    <input type="button" value="样式2" onclick="openInfoWindow2()"/>
                    <input type="button" value="样式3" onclick="openInfoWindow3()"/>
                </li>
            </ul>
        </dd>
    </dl>

</div>

</body>
</html>

<script type="text/javascript">

// 百度地图API功能




	var map = new BMap.Map("map");
	var geolocation = new BMap.Geolocation();
	geolocation.getCurrentPosition(function(r){
		if(this.getStatus() == BMAP_STATUS_SUCCESS){
			var mk = new BMap.Marker(r.point);
			map.addOverlay(mk);
			map.panTo(r.point);
			var poi = new BMap.Point(r.point.lng,r.point.lat);
			map.centerAndZoom(poi,16);
		}
		else {
			alert('failed'+this.getStatus());
		}        
	},{enableHighAccuracy: true})

	
	
	
	
	var spoi1 = new BMap.Point(113.280967,23.113285);    // 起点1
	var spoi2 = new BMap.Point(113.280967,23.123285);    // 起点2
	var epoi  = new BMap.Point(113.224374,23.114668);    // 终点
	var myIcon = new BMap.Icon("Mario.png", new BMap.Size(32, 70), {imageOffset: new BMap.Size(0, 0)});
	
	function initLine(){
		bounds = new Array();
		linesPoints = new Array();
		map.clearOverlays();                                                    // 清空覆盖物
		var driving3 = new BMap.DrivingRoute(map,{onSearchComplete:drawLine});  // 驾车实例,并设置回调
		driving3.search(spoi1, epoi);                                       	// 搜索一条线路
		var driving4 = new BMap.DrivingRoute(map,{onSearchComplete:drawLine});  // 驾车实例,并设置回调
		driving4.search(spoi2, epoi);                                       	// 搜索一条线路
	}

	function run(){
		for(var m = 0;m < linesPoints.length; m++){
			var pts = linesPoints[m];
			var len = pts.length;
			var carMk = new BMap.Marker(pts[0],{icon:myIcon});
			map.addOverlay(carMk);
			resetMkPoint(1,len,pts,carMk)
		}
		
		function resetMkPoint(i,len,pts,carMk){
			carMk.setPosition(pts[i]);
			if(i < len){
				setTimeout(function(){
					i++;
					resetMkPoint(i,len,pts,carMk);
				},100);
			}
		}
		
	}

	function drawLine(results){
		var opacity = 0.45;
		var planObj = results.getPlan(0);
		var b = new Array();
		var addMarkerFun = function(point,imgType,index,title){
			var url;
			var width;
			var height
			var myIcon;
			// imgType:1的场合，为起点和终点的图；2的场合为车的图形
			if(imgType == 1){
				url = "dest_markers.png";
				width = 42;
				height = 34;
				myIcon = new BMap.Icon(url,new BMap.Size(width, height),{offset: new BMap.Size(14, 32),imageOffset: new BMap.Size(0, 0 - index * height)});
			}else{
				url = "trans_icons.png";
				width = 22;
				height = 25;
				var d = 25;
				var cha = 0;
				var jia = 0
				if(index == 2){
					d = 21;
					cha = 5;
					jia = 1;
				}
				myIcon = new BMap.Icon(url,new BMap.Size(width, d),{offset: new BMap.Size(10, (11 + jia)),imageOffset: new BMap.Size(0, 0 - index * height - cha)});
			}
			
			var marker = new BMap.Marker(point, {icon: myIcon});
			if(title != null && title != ""){
				marker.setTitle(title);
			}
			// 起点和终点放在最上面
			if(imgType == 1){
				marker.setTop(true);
			}
			map.addOverlay(marker);
		}
		var addPoints = function(points){
			for(var i = 0; i < points.length; i++){
				bounds.push(points[i]);
				b.push(points[i]);
			}
		}
		
		// 绘制驾车步行线路
		for (var i = 0; i < planObj.getNumRoutes(); i ++){
			var route = planObj.getRoute(i);
			if (route.getDistance(false) <= 0){continue;}
			addPoints(route.getPath());
			// 驾车线路
			if(route.getRouteType() == BMAP_ROUTE_TYPE_DRIVING){
				map.addOverlay(new BMap.Polyline(route.getPath(), {strokeColor: "#0030ff",strokeOpacity:opacity,strokeWeight:6,enableMassClear:true}));
			}else{
			// 步行线路有可能为0
				map.addOverlay(new BMap.Polyline(route.getPath(), {strokeColor: "#30a208",strokeOpacity:0.75,strokeWeight:4,enableMassClear:true}));
			}
		}
		
		map.setViewport(bounds);
		
		// 终点
		addMarkerFun(results.getEnd().point,1,1);
		// 开始点
		addMarkerFun(results.getStart().point,1,0);
		linesPoints[linesPoints.length] = b;
	}

	initLine();

	setTimeout(function(){
		run();
	},3000);
	
	
	
	
	
	
	
	
	

    //var map = new BMap.Map('map');
    //var poi = new BMap.Point(116.307852,40.057031);
    //map.centerAndZoom(poi, 16);
    map.enableScrollWheelZoom();

    var content = '<div style="margin:0;line-height:20px;padding:2px;">' +
                    '<img src="../img/baidu.jpg" alt="" style="float:right;zoom:1;overflow:hidden;width:100px;height:100px;margin-left:3px;"/>' +
                    '地址：北京市海淀区上地十街10号<br/>电话：(010)59928888<br/>简介：百度大厦位于北京市海淀区西二旗地铁站附近，为百度公司综合研发及办公总部。' +
                  '</div>';

    //创建检索信息窗口对象
    var searchInfoWindow = null;
	searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
			title  : "百度大厦",      //标题
			width  : 290,             //宽度
			height : 105,              //高度
			panel  : "panel",         //检索结果面板
			enableAutoPan : true,     //自动平移
			searchTypes   :[
				BMAPLIB_TAB_SEARCH,   //周边检索
				BMAPLIB_TAB_TO_HERE,  //到这里去
				BMAPLIB_TAB_FROM_HERE //从这里出发
			]
		});
    var marker = new BMap.Marker(poi); //创建marker对象
    marker.enableDragging(); //marker可拖拽
    marker.addEventListener("click", function(e){
	    searchInfoWindow.open(marker);
    })
    map.addOverlay(marker); //在地图中添加marker
    searchInfoWindow.open(marker); //在marker上打开检索信息串口
    $("close").onclick = function(){
        searchInfoWindow.close();
    }
    $("open").onclick = function(){
		var enableSendToPhone = false;
        if ($("enableSendToPhone").checked) {
            enableSendToPhone = true;
        }
		searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
			title  : "百度大厦",      //标题
			width  : 290,             //宽度
			height : 105,              //高度
			panel  : "panel",         //检索结果面板
			enableAutoPan : true,     //自动平移
			enableSendToPhone: enableSendToPhone, //是否启用发送到手机
			searchTypes   :[
				BMAPLIB_TAB_SEARCH,   //周边检索
				BMAPLIB_TAB_TO_HERE,  //到这里去
				BMAPLIB_TAB_FROM_HERE //从这里出发
			]
		});
        if ($("enableAutoPan").checked) {
            searchInfoWindow.enableAutoPan();
        } else {
            searchInfoWindow.disableAutoPan();
        };
        searchInfoWindow.open(marker);
    }
    $("show").onclick = function(){
        searchInfoWindow.show();
    }
    $("hide").onclick = function(){
        searchInfoWindow.hide();
    }
    $(".getPosition").onclick = function(){
		alert("123");
        var position = searchInfoWindow.getPosition();
        alert("经度：" + position.lng + "；纬度：" + position.lat);
    }
    $("setValue").onclick = function(){
        searchInfoWindow.setPosition(new BMap.Point($("lng").value, $("lat").value));
        searchInfoWindow.setTitle($("title").value);
        searchInfoWindow.setContent($("content").value);
    }
    $("getContent").onclick = function(){
        alert(searchInfoWindow.getContent());
    }
    $("getTitle").onclick = function(){
        alert(searchInfoWindow.getTitle());
    }
    function $(id){
        return document.getElementById(id);
    }

//样式1
var searchInfoWindow1 = new BMapLib.SearchInfoWindow(map, "信息框1内容", {
    title: "信息框1", //标题
    panel : "panel", //检索结果面板
    enableAutoPan : true, //自动平移
    searchTypes :[
        BMAPLIB_TAB_FROM_HERE, //从这里出发
        BMAPLIB_TAB_SEARCH   //周边检索
    ]
});
function openInfoWindow1() {
    searchInfoWindow1.open(new BMap.Point(116.319852,40.057031));
}

//样式2
var searchInfoWindow2 = new BMapLib.SearchInfoWindow(map, "信息框2内容", {
    title: "信息框2", //标题
    panel : "panel", //检索结果面板
    enableAutoPan : true, //自动平移
    searchTypes :[
        BMAPLIB_TAB_SEARCH   //周边检索
    ]
});
function openInfoWindow2() {
    searchInfoWindow2.open(new BMap.Point(116.324852,40.057031));
}

//样式3
var searchInfoWindow3 = new BMapLib.SearchInfoWindow(map, "信息框3内容", {
    title: "信息框3", //标题
    width: 290, //宽度
    height: 40, //高度
    panel : "panel", //检索结果面板
    enableAutoPan : true, //自动平移
    searchTypes :[
    ]
});
function openInfoWindow3() {
    searchInfoWindow3.open(new BMap.Point(116.328852,40.057031)); 
}


    var isPanelShow = false;
    //显示结果面板动作
    $("showPanelBtn").onclick = function(){
        if (isPanelShow == false) {
            isPanelShow = true;
            $("showPanelBtn").style.right = "300px";
            $("panelWrap").style.width = "300px";
            $("map").style.marginRight = "300px";
            $("showPanelBtn").innerHTML = "隐藏检索结果面板<br/>>";
        } else {
            isPanelShow = false;
            $("showPanelBtn").style.right = "0px";
            $("panelWrap").style.width = "0px";
            $("map").style.marginRight = "0px";
            $("showPanelBtn").innerHTML = "显示检索结果面板<br/><";
        }
    }
</script>