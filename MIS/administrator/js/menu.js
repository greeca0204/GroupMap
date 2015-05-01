//菜单缩进效果。
$(document).ready(function(){
	$(".main > a").click(function(){
		//找到主菜单项对应的子菜单项
		var ulNode = $(this).next("ul");
		ulNode.slideToggle();
		//changeIcon($(this));
	});
});