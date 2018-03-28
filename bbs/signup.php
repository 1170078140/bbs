<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>注册</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" type="text/css" href="css/signup.css"/>
</head>
<body>
	<div class="logo inner"><a href="index.php"><img src="images/logo.png"/></a></div>
	<div class="main inner clearfix">
		<h3>注册</h3>
		<form action="doAction.php?a=insert" method="post" enctype="multipart/form-data" >
			<p class="reminder">请添加能正常发邮箱的邮箱</p>
			<table border="" cellspacing="" cellpadding="">
				<tr>
					<td align="right">用户名<span>*</span></td>
					<td><input type="text" name="userName" required /></td>
					<td class="error"><span><i><img src="images/xx_03.jpg"/></i>用户名不能为空</span></td>
				</tr>
                <tr>
                    <td align="right">昵称<span></span></td>
                    <td><input type="text" name="nickName"/></td>
                    <td class="error"></td>
                </tr>
				<tr>
					<td align="right">密码<span>*</span></td>
					<td><input type="text" name="password" required /></td>
				</tr>
				<tr>
					<td align="right">确认密码<span>*</span></td>
					<td><input type="text" required /></td>
				</tr>
				<tr>
					<td align="right">电子邮箱<span>*</span></td>
					<td><input type="email" name="email" required /></td>
				</tr>
                <tr>
                    <td align="right">qq号码<span>*</span></td>
                    <td><input type="text" name="qq" required /></td>
                </tr>
                <tr>
                    <td align="right">性别<span>*</span></td>
                    <td>
                        <select name="sex" id="level">
                            <option value="女" >&nbsp;&nbsp;女</option>
                            <option value="男" >&nbsp;&nbsp;男</option>
                        </select>
                    </td>
                </tr>
				<tr>
					<td align="right">个人头像<span>*</span></td>
                    <td ><input type="file" name="photo" style="border:none;" required ></td>
				</tr>
				<tr>
					<td align="right">现居住地<span>*</span></td>
					<td>
						<select name="address[]" class="address">
							<option value="上海" >上海</option>
						</select>
						<select name="address[]" class="address">
							<option value="浦东" >浦东</option>
						</select>
						<select name="address[]" class="address">
							<option value="张江" >张江</option>
						</select>
					</td>
				</tr>
				<!--<tr>
					<td align="right">安全问题</td>
					<td>
						<select name="" class="question">
							<option value="">无安全问题</option>
							<option value="">问题一：</option>
							<option value="">问题二：</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">您的答案</td>
					<td><input type="text" name="" id="" value="" /></td>
				</tr>-->
				<tr>
					<td></td>
					<td><label><input type="checkbox" />我已阅读并完全同意<a href="#">条款内容</a></label></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="提交注册" class="signup" /></td>
				</tr>				
			</table>			
		</form>
		<div class="login">
			<p>已经拥有账号？</p>
			<a href="./index.php">马上登录</a>
		</div>
	</div>
	<div class="footer inner">
		<p>Powered by <span>phpwind v8.7</span> Copyright Time now is:12-25 17:18 </p>
		<p>Copyright 易第优（北京）教育咨询股份有限公司 2006 - 2017 Edu Inc. 京ICP备11018177号</p>
	</div>
</body>
</html>