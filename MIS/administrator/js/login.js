/*登录特效*/

//表单内初始化的文字特效
$(document).ready(function(){
	$("#username").focus(function(){
		var txt_value=$(this).val();
		if(txt_value=="请输入用户名")
			$(this).val("");
	})
	
	$("#username").blur(function(){
		var txt_value=$(this).val();
		if(txt_value=="")
			$(this).val("请输入用户名");
	})
	
	$("#password").focus(function(){
		var txt_value=$(this).val();
		if(txt_value=="请输入密码")
			$(this).val("");
	})
	
	$("#password").blur(function(){
		var txt_value=$(this).val();
		if(txt_value=="")
			$(this).val("请输入密码");
	})		
})

//点击表单元素时变色特效
$(function(){
	$("#username,#password").focus(function(){
		$(this).addClass("focus");
	}).blur(function(){
			$(this).removeClass("focus");
		});
});

//表单验证特效
$(document).submit(function(){
	if($("#username").val()==""||$("#username").val()=="请输入用户名")
	{
		alert("请输入用户名！");
		return false;
	}
	
	if($("#password").val()==""||$("#password").val()=="请输入密码")
	{
		alert("请输入密码！");
		return false;
	}	
})