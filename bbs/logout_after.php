<span style="float: right;padding-top: 30px;" id="user">
    <span style="display: inline-block;width: 50px;height:50px;border-radius: 50%;border: 1px solid #fff;overflow: hidden;">
        <img src="userPhoto/<?=$_SESSION['photo']?>" alt="" style="height: 100%;">
    </span>
    <span style="vertical-align: 15px;font-weight: bolder;font-size: 14px;"><?=$_SESSION['nickName']?>  &nbsp;<a href="doAction.php?a=logout" style="color: blue;">退出</a> </span>
</span>