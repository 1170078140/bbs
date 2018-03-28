<div class="top">
    <ul class="inner clearfix top_nav">
        <li class="left"><a href="#">设为首页</a></li>
        <li class="left"><a href="#">收藏LAMP兄弟连</a></li>
        <li><a href="#">帮助</a></li>
        <li><a href="#">推广链接</a></li>
        <li><a href="#">社区应用</a></li>
        <li><a href="#">最新帖子</a></li>
        <li><a href="#">精华区</a></li>
        <li><a href="#">社区服务</a></li>
        <li><a href="#">会员列表</a></li>
        <li><a href="#">统计排行</a></li>
        <li><a href="#">搜索</a></li>
    </ul>
</div>
<div class="header inner">
    <a href="index.php" class="logo"><img src="images/logo.png"/></a>
    <?php
    /*            session_start();
                //判断用户是否登录
                if(isset($_SESSION['id'])){     //登录成功，登录框隐藏，个人信息显示
                    echo "<script>
                            var user=document.getElementById('user');
                            var loginBox=document.getElementById('loginBox');
                            user.className='';
                            loginBox.className='hide';
                        </script>";
                }else{
                    echo "<script>
                            var user=document.getElementById('user');
                            var loginBox=document.getElementById('loginBox');
                            loginBox.className='';
                            user.className='hide';
                        </script>";
                }
            */?>

    <?php
    session_start();
//    var_dump($_SESSION);
    if(isset($_SESSION['id'])){
        $uid=$_SESSION['id'];
        require "./logout_after.php";
    }else{
        require "./login_before.php";
    }
    ?>
    <!--<span style="float: right;padding-top: 30px;" id="user" class="hide">
            <img src="userPhoto/<?/*=$_SESSION['photo']*/?>" alt="" style="width: 60px;">
            <span style="vertical-align: 15px;font-weight: bolder;"><?/*=$_SESSION['nickName']*/?>  &nbsp;<a href="doLogout.php" style="color: blue;">退出</a> </span>
        </span>


		<form action="doAction.php?a=login" method="post" id="loginBox" class="hide">
			<table border="" cellspacing="" cellpadding="">
				<tr>
					<td class="inputBox">
						<input type="text" placeholder="输入用户名" class="name" name="userName" />
						<i class="select"></i>
						<ul class="hide selectList">
							<li>用户名</li>
							<li>UID</li>
							<li>邮箱</li>
						</ul>
					</td>
					<td><label><input type="checkbox" />记住登录</label></td>
					<td><a href="#">找回密码</a></td>
				</tr>
				<tr>
					<td><input type="text" placeholder="输入密码" class="pass" name="password" /></td>
                    <td><input type="submit" class="btn login" value="登录"></td>
					<td><a href="signup.php" class="btn signup">注册</a></td>
				</tr>
			</table>
		</form>-->
</div>
<div class="nav">
    <div class="inner">
        <ul>
            <li><a href="#">培训课程</a></li>
            <li><a href="#">论坛</a></li>
            <li><a href="#">兄弟连云课堂</a></li>
            <li><a href="#">PHP视屏</a></li>
            <li><a href="#">Linux视频</a></li>
            <li><a href="#">战地日记</a></li>
        </ul>
        <button type="button">快捷通道</button>
    </div>
</div>
<div class="search inner">
    <form action="" method="post">
        <input type="text" name="" id="" placeholder="让学习成为一种习惯！" class="serBox"/>
        <select name="">
            <option value="">帖子</option>
            <option value="">用户</option>
            <option value="">板块</option>
        </select>
        <input type="submit" value="搜索" class="btn"/>
        <ul class="tags clearfix">
            <li>热搜：</li>
            <li><a href="#">PHP</a></li>
            <li><a href="#">明哥</a></li>
            <li><a href="#">Java</a></li>
            <li><a href="#">大数据</a></li>
            <li><a href="#">Python</a></li>
        </ul>
    </form>
</div>