<?php /* Smarty version 2.6.18, created on 2014-05-23 07:56:59
         compiled from login.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $this->_tpl_vars['siteTitle']; ?>
</title>
<link rel="stylesheet" href="css/login.css" type="text/css" media="screen" />
<script charset="utf-8" src="js/jquery.js"></script>
<script charset="utf-8" src="js/login.js"></script>
</head>
<body>
<div id="container">
<form name="loFrm" method="post" action="index.php?action=login">
<div id="layout">
<div id="header"><?php echo $this->_tpl_vars['siteTitle']; ?>
</div>
<div id="body">
<div class="body_content">
<div id="login_layout">
<div class="blank116" id="login_layout_space_top"></div>
<p class="login_title">管理员登录</p>
<div class="blank30"></div>
<div class="left_field">
<div class="blank10"></div>
<div class="input_field"><label>用户名:</label><input name="username" type="text" id="username" value="请输入用户名"></div>
<div class="blank10"></div>
<div class="input_field"><label>输密码:</label><input name="password" type="password" id="password" value="请输入密码">
      <input name="checked" type="hidden" id="checked" value="1"></div>
<div class="blank10"></div>
<div class="submit_div"><input type="submit" value="登录"></div>
</div>
<div class="right_field">

</div>
</div>
</div>
</div>
<div id="footer">
<div class="copyright">
<p>COPYRIGHT &copy; 2013   广州运星科技有限公司版权所有</p></div>
</div>
</form>
</div>
</body>
</html>