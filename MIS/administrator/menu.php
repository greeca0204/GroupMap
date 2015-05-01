<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="zh-cn" />
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<script charset="utf-8" src="js/jquery.js"></script>
<script charset="utf-8" src="js/menu.js"></script>
</head>
<body>
<?php 
    if($_SESSION['username'] == null)
    	echo "<script>alert('请先登录！');location.href='index.php';</script>";
?>
        <div id="menu">
            <center>
                <?php
                $say = "您好！";
				date_default_timezone_set('PRC');
				//echo date('H:i:s');
                $time = intval(date('Hi'));				
                if ($time >= 1900 || $time < 300)
                    $say = "晚上好！";
                else if ($time <= 600)
                    $say = "凌晨好！";
                else if ($time >= 600 && $time < 1130)
                    $say = "早上好！";
                else if ($time >= 1130 && $time < 1230)
                    $say = "中午好！";
                else if ($time >= 1230 && $time < 1800)
                    $say = "下午好！";
                else
                    $say = "傍晚好！";
                echo $_SESSION['username'] . '，' . $say;
                ?>
            </center>
            <ul>
                <li class="main">
                    <a class="parent" href="javascript:void(0);" style="background:#069;">管理员信息管理</a>
                    <ul>
                    	<li><a href="admin.php?action=new" target="mainFrame">添加管理员信息</a></li>
                    	<li><a href="admin.php" target="mainFrame">管理员信息管理</a></li>              	
                    </ul>
                </li> 
				<li class="main">
                    <a class="parent" href="javascript:void(0);" style="background:#069;">用户信息管理</a>
                    <ul>
                    	<li><a href="userInfo.php?action=new" target="mainFrame">添加用户信息</a></li>
                    	<li><a href="userInfo.php" target="mainFrame">用户信息管理</a></li>              	
                    </ul>
                </li>				
                <li><a id="logout" href="index.php?action=loginout" style="background:#069;">退出系统</a></li>
            </ul>
        </div>
</body>
</html>