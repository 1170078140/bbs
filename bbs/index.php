
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>首页</title>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" type="text/css" href="css/index.css"/>
	<script src="js/fn.js" type="text/javascript"></script>
	<script type="text/javascript">
		window.onload=function(){
            var user=document.getElementById('user');
            var loginBox=document.getElementById('loginBox');
			var showBtn=document.getElementsByClassName('show');
			var con=document.getElementsByClassName('con');
			var bool=true;
			for(var i=0;i<showBtn.length;i++){
				showBtn[i].index=i;
				showBtn[i].onclick=function(){
					if(bool){
						con[this.index].className+=" hide";
					}else{
						con[this.index].classList.remove('hide');
					}
					bool=!bool;
				}
			}
			
			silider();
			
			/*var selectBtn=document.getElementsByClassName('select')[0];
			var selectList=document.getElementsByClassName('selectList')[0];
			var aSelect=selectList.children;
			var nameBox=document.getElementsByClassName('name')[0];			
			selectBtn.onclick=function(){
				selectList.classList.remove('hide');
			}
			for(var i=0;i<aSelect.length;i++){
				aSelect[i].onclick=function(ev){
					switch(ev.target.innerHTML){
						case "用户名":
							nameBox.value="请输入用户名";
							selectList.className+=" hide";							
						break;
						case "UID":
							nameBox.value="请输入UID";
							selectList.className+=" hide";
						break;
						case "邮箱":
							nameBox.value="请输入邮箱";
							selectList.className+=" hide";
						break;
					}
				}
			}*/
		}
	</script>
</head>
<body>
	<?php
        require "./style.php";
    ?>
	<div class="banner inner clearfix">
		<div class="slider">
			<ul class="img_list">
		        <li class="img"><img src="images/20170729083208.jpg"/></li>
		        <li class="hide img"><img src="images/20170729083247.jpg" alt=""></li>
		        <li class="hide img"><img src="images/20171102023340.jpg" alt=""></li>
		        <li class="hide img"><img src="images/20170824010015.jpg" alt=""></li>
		        <li class="hide img"><img src="images/20171102023328.jpg" alt=""></li>
		    </ul>
		    <ol class="btn_list">
		        <li class="ac btn">1</li>
		        <li class="btn">2</li>
		        <li class="btn">3</li>
		        <li class="btn">4</li>
		        <li class="btn">5</li>
		    </ol>			
		</div>
		<div class="sPic">
			<div><img src="images/lampt_1_20140529.jpg"/></div>
			<div><img src="images/lampt_2_20140529.jpg"/></div>
		</div>
		<div class="sPic">
			<div><img src="images/lampt_3.png"/></div>
			<div><img src="images/lampt_4.png"/></div>
		</div>
	</div>
	<div class="news inner"><img src="images/news_03.jpg"/></div>
    <?php
        //1.引入配置文件
        require "./admin/config.php";

        //2.引入Model类文件
        require "./admin/Model.class.php";

        //3.取得所有数据
        $type = new Model('type');
        $res1 = $type->query("select * from type where pid=0 && status=1");
//        var_dump($res1);

        //4.遍历到表格
        foreach($res1 as $k=>$v) {
    ?>
    <div class="block inner">
        <div class="title">
            <i><img src="images/icon_07.jpg"/></i>
            <a href="#">:::. <?=$v['name']?> :::.</a>
            <i class="show"><img src="images/cate_fold.gif"/></i>
        </div>
        <div class="con ">
            <ul class="line clearfix">
                <?php
                    $res2 = $type->query("select * from type where pid={$v['id']} && status=1");
                    if($res2){
                        //4.遍历到表格
                        foreach($res2 as $key=>$value) {
                    ?>


                <li>
                    <div class="pic" style="width: 57px;overflow: hidden;"><img style="width: 100%;" src="./admin/images/<?=$value['blogo']?>"/></div>
                    <div class="text">
                        <p><a href="list.php?i=<?=$value['id']?>" class="subject"><?=$value['name']?></a></p>
                        <p>主题:<span>10675</span>帖子:<span>94376</span></p>
                        <p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
                    </div>
                </li>
                <?php
                        }
                    }else{
                        echo "暂无数据";
                    }
                ?>
            </ul>
        </div>

    </div>
    <?php
        }
    ?>
    <!--<div class="block inner">
        <div class="title">
            <i><img src="images/icon_07.jpg"/></i>
            <a href="#">:::. 技术交流 :::.</a>
            <i class="show"><img src="images/cate_fold.gif"/></i>
        </div>
        <div class="con ">
            <ul class="line clearfix">
                <li>
                    <div class="pic"><img src="images/127.png"/></div>
                    <div class="text">
                        <p><a href="list.php" class="subject">PHP技术</a><span class="today">(今日12)</span></p>
                        <p>主题:<span>10675</span>帖子:<span>94376</span></p>
                        <p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
                    </div>
                </li>
                <li>
                    <div class="pic"><img src="images/271.png"/></div>
                    <div class="text">
                        <p><a href="#" class="subject">Java/Android技术交流</a><span class="today hide">(今日12)</span></p>
                        <p>主题:<span>10675</span>帖子:<span>94376</span></p>
                        <p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
                    </div>
                </li>
                <li>
                    <div class="pic"><img src="images/126.png"/></div>
                    <div class="text">
                        <p><a href="#" class="subject">前端（HTML5）技术</a><span class="today">(今日12)</span></p>
                        <p>主题:<span>10675</span>帖子:<span>94376</span></p>
                        <p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
                    </div>
                </li>
            </ul>
            <ul class="clearfix">
                <li>
                    <div class="pic"><img src="images/128.png"/></div>
                    <div class="text">
                        <p><a href="#" class="subject">Linux</a><span class="today">(今日12)</span></p>
                        <p>主题:<span>10675</span>帖子:<span>94376</span></p>
                        <p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
                    </div>
                </li>
                <li>
                    <div class="pic"><img src="images/289.png"/></div>
                    <div class="text">
                        <p><a href="#" class="subject">SQL</a><span class="today hide">(今日12)</span></p>
                        <p>主题:<span>10675</span>帖子:<span>94376</span></p>
                        <p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
                    </div>
                </li>
                <li>
                    <div class="pic"><img src="images/162.png"/></div>
                    <div class="text">
                        <p><a href="#" class="subject">资源分享</a><span class="today">(今日12)</span></p>
                        <p>主题:<span>10675</span>帖子:<span>94376</span></p>
                        <p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
                    </div>
                </li>
            </ul>
        </div>

    </div>
	<div class="block inner">
		<div class="title">
			<i><img src="images/icon_07.jpg"/></i>
			<a href="#">:::. 兄弟连 :::.</a>
			<i class="show"><img src="images/cate_fold.gif"/></i>
		</div>
		<div class="con ">
			<ul class="line clearfix">
				<li>
					<div class="pic"><img src="images/101.png"/></div>
					<div class="text">
						<p><a href="#" class="subject">视频教程</a><span class="today">(今日12)</span></p>
						<p>主题:<span>10675</span>帖子:<span>94376</span></p>
						<p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
					</div>
				</li>
				<li>
					<div class="pic"><img src="images/175.png"/></div>
					<div class="text">
						<p><a href="#" class="subject">培训教程</a><span class="today hide">(今日12)</span></p>
						<p>主题:<span>10675</span>帖子:<span>94376</span></p>
						<p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
					</div>
				</li>
				<li>
					<div class="pic"><img src="images/285.png"/></div>
					<div class="text">
						<p><a href="#" class="subject">兄弟会</a><span class="today hide">(今日12)</span></p>
						<p>主题:<span>10675</span>帖子:<span>94376</span></p>
						<p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
					</div>
				</li>
			</ul>
			<ul class="clearfix">
				<li>
					<div class="pic"><img src="images/252.png"/></div>
					<div class="text">
						<p><a href="#" class="subject">战地日记</a><span class="today">(今日12)</span></p>
						<p>主题:<span>10675</span>帖子:<span>94376</span></p>
						<p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
					</div>
				</li>
				<li>
					<div class="pic"><img src="images/273.png"/></div>
					<div class="text">
						<p><a href="#" class="subject">兄弟连小电影</a><span class="today hide">(今日12)</span></p>
						<p>主题:<span>10675</span>帖子:<span>94376</span></p>
						<p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
					</div>
				</li>
				<li>
					<div class="pic"><img src="images/195.png"/></div>
					<div class="text">
						<p><a href="#" class="subject">《细说PHP》</a><span class="today">(今日12)</span></p>
						<p>主题:<span>10675</span>帖子:<span>94376</span></p>
						<p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
					</div>
				</li>
			</ul>
		</div>
		
	</div>
	<div class="block inner">
		<div class="title">
			<i><img src="images/icon_07.jpg"/></i>
			<a href="#">:::. 连队趣事 :::.</a>
			<i class="show"><img src="images/cate_fold.gif"/></i>
		</div>
		<div class="con ">
			<ul class="clearfix">
				<li>
					<div class="pic"><img src="images/185.png"/></div>
					<div class="text">
						<p><a href="#" class="subject">招聘求职</a><span class="today">(今日3)</span></p>
						<p>主题:<span>10675</span>帖子:<span>94376</span></p>
						<p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
					</div>
				</li>
				<li>
					<div class="pic"><img src="images/141.png"/></div>
					<div class="text">
						<p><a href="#" class="subject">吹水圣地</a><span class="today">(今日2)</span></p>
						<p>主题:<span>10675</span>帖子:<span>94376</span></p>
						<p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
					</div>
				</li>
			</ul>
		</div>
		
	</div>
	<div class="block inner">
		<div class="title">
			<i><img src="images/icon_07.jpg"/></i>
			<a href="#">:::. 议事厅 :::.</a>
			<i class="show"><img src="images/cate_fold.gif"/></i>
		</div>
		<div class="con ">
			<ul class="clearfix">
				<li>
					<div class="pic"><img src="images/83.png"/></div>
					<div class="text">
						<p><a href="#" class="subject">兄弟连建议</a><span class="today hide">(今日12)</span></p>
						<p>主题:<span>10675</span>帖子:<span>94376</span></p>
						<p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
					</div>
				</li>
				<li>
					<div class="pic"><img src="images/84.png"/></div>
					<div class="text">
						<p><a href="#" class="subject">版主会议室</a><span class="today hide">(今日12)</span></p>
						<p>主题:<span>10675</span>帖子:<span>94376</span></p>
						<p><a href="#" class="time">最后发帖: <span>2017-12-25 09:28</span></a></p>
					</div>
				</li>
			</ul>
		</div>
		
	</div>
	<div class="block inner connect">
		<div class="title">
			<i><img src="images/icon_07.jpg"/></i>
			<a href="#">友情链接</a>
			<i class="show"><img src="images/cate_fold.gif"/></i>
		</div>
		<div class="con ">
			<img src="images/logo.png"/>
			<div>
				<a href="#">PHP培训</a>
				<a href="#">Java培训</a>
				<a href="#">UI/UE培训</a>
				<a href="#">Pythond培训</a>
				<a href="#">云计算培训</a>
				<a href="#">出国留学</a>
				<a href="#">PHP教程教育加盟</a>
				<a href="#">PHP学院猿代码</a>
				<a href="#">HTML5培训</a>
				<a href="#">HTML5培训</a>
				<a href="#">HTML5培训</a>
				<a href="#">HTML5培训</a>
				<a href="#">HTML5培训</a>
				<a href="#">HTML5培训</a>
				<a href="#">HTML5培训</a>
				<a href="#">HTML5培训</a>
				<a href="#">HTML5培训</a>
				<a href="#">HTML5培训</a>
				<a href="#">HTML5培训</a>
				<a href="#">HTML5培训</a>
				<a href="#">HTML5培训</a>
				<a href="#">HTML5培训</a>
				<a href="#">HTML5培训</a>
			</div>
		</div>		
	</div>
	<div class="block inner online">
		<div class="title">
			<i><img src="images/icon_07.jpg"/></i>
			<a href="#" class="infor">在线用户 - 共 1333 人在线,29 位会员,1304 位访客,最多 4931 人发生在 2013-06-07 05:37</a>
			<i class="show"><img src="images/cate_fold.gif"/></i>
		</div>
		<div class="con ">
			<a href="#"><img src="images/3.gif"/><span>司令（管理员）</span></a>
			<a href="#"><img src="images/4.gif"/><span>连长（超版）</span></a>
			<a href="#"><img src="images/5.gif"/><span>排长（版主）</span></a>
			<a href="#"><img src="images/18.gif"/><span>教官</span></a>
			<a href="#"><img src="images/10.gif"/><span>新兵</span></a>
			<a href="#"><img src="images/6.gif"/><span>普通会员</span></a>
			<a href="#"><span class="open">[打开在线列表]</span></a>
		</div>		
	</div>-->
	<div class="footer inner">
		<ul>
			<li><a href="#">联系我们</a><span>|</span></li>
			<li><a href="#">无图版</a><span>|</span></li>
			<li><a href="#">手机浏览</a><span>|</span></li>
            <li><a href="#">清除Cookies</a><span>|</span></li>
            <li><a href="admin/" target="_blank">【网站后台】</a></li>
		</ul>
		<p>Powered by <span>phpwind v8.7</span> Copyright Time now is:12-25 17:18 </p>
		<p>Copyright 易第优（北京）教育咨询股份有限公司 2006 - 2017 Edu Inc. 京ICP备11018177号</p>
	</div>
</body>
</html>