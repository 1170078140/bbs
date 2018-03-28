<form action="doAction.php?a=login" method="post" id="loginBox">
    <table border="" cellspacing="" cellpadding="">
        <tr>
            <td class="inputBox">
                <input type="text" placeholder="输入用户名" class="name" name="userName" />
                <!--<i class="select"></i>
                <ul class="hide selectList">
                    <li>用户名</li>
                    <li>UID</li>
                    <li>邮箱</li>
                </ul>-->
            </td>
            <td><label><input type="checkbox" />记住登录</label></td>
            <td><a href="#">找回密码</a></td>
        </tr>
        <tr>
            <td><input type="password" placeholder="输入密码" class="pass" name="password" /></td>
            <td><input type="submit" class="btn login" value="登录"></td>
            <td><a href="signup.php" class="btn signup">注册</a></td>
        </tr>
    </table>
</form>