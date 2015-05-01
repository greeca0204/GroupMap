<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/common.css" rel="stylesheet" type="text/css" />
<title>广州运星科技有限公司后台管理系统</title>
</head>
<?php 
if($_SESSION['username'] == null)
{
	echo "<script>alert('请先登录！');location.href='index.php';</script>";
}
?>
<frameset id="frames" rows="*" cols="220,*" border="0" framespacing="0">
	<frame src="menu.php" frameborder="no" id="menuFrame" name="menuFrame" scrolling="No" noresize="noresize" />
	<frame src="about.html" frameborder="no" id="mainFrame" name="mainFrame" scrolling="Yes" />
</frameset>
<noframes><body>您的浏览器不支持frameset！</body></noframes>
</html>
