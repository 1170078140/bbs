<?php
date_default_timezone_set('PRC');

//判断用户是否登录
if(isset($_COOKIE['id'])){
    echo "<script>alert('抱歉，您已登录，无需重复登录！');window.location.href='index.php'</script>";
    die;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理登录界面</title>
    <link href="css/alogin.css" rel="stylesheet" type="text/css" />
    <style>
        .code{width: 80px;}
        table{position: relative;margin-top: 30px;}
        .btn{position: absolute;left:45px;top:145px;}
        table img{vertical-align: -9px;}

    </style>
</head>
<body>
    <form id="form1" runat="server" action="doLogin.php" method="post">
    <div class="Main">
        <ul>
            <li class="top"></li>
            <li class="top2"></li>
            <li class="topA"></li>
            <li class="topB"><span></span></li>
            <li class="topC"></li>
            <li class="topD">
                    <table>
                        <input type="hidden" name="lastlogin" value="<?= date('Y/m/d H:i:s')?>">
                        <tr>
                            <td align="right">管理员：</td>
                            <td><input type="text" placeholder="请输入管理员账号" class="txt" name="userName" ></td>
                        </tr>
                        <tr>
                            <td align="right">密 码：</td>
                            <td><input type="password" placeholder="请输入管理员密码" class="txt" name="password" ></td>
                        </tr>
                        <tr>
                            <td align="right">验证码：</td>
                            <td>
                                <input type="text" placeholder="请输入验证码" class="txt code" name="code">
                                <img src='./code2.php' width="60" height="30" onclick="this.src='code2.php?id='+Math.random(0,1)" />
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2"><input type="submit" value="确定" class="btn" ></td>
                        </tr>
                    </table>
            </li>
            <li class="topE"></li>
            <li class="middle_A"></li>
            <li class="middle_B"></li>
            <li class="middle_C"></li>
            <li class="middle_D"></li>
            <li class="bottom_A"></li>
            <li class="bottom_B">网站后台管理系统&nbsp;&nbsp;www.php.com</li>
        </ul>
    </div>
    </form>
</body>
</html>