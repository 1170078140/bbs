<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>主要内容区main</title>
<link href="css/css.css" type="text/css" rel="stylesheet" />
<link href="css/main.css" type="text/css" rel="stylesheet" />
<link rel="shortcut icon" href="images/main/favicon.ico" />
<style>
body{overflow-x:hidden; background:#f2f0f5; padding:15px 0px 10px 5px;}
#searchmain{ font-size:12px;}
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF; float:left}
#search span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search select{height:24px; line-height:24px; width:100px; margin:8px 10px 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search input.text-but{height:24px; line-height:24px; width:55px; background:url(images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(images/main/add.jpg) no-repeat -3px 7px #548fc9; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF; float:right}
#search a:hover.add{ text-decoration:underline; color:#d2e9ff;}
#main-tab{ border:1px solid #eaeaea; background:#FFF; font-size:12px;}
#main-tab th{ font-size:12px; background:url(images/main/list_bg.jpg) repeat-x; height:32px; line-height:32px;}
#main-tab td{ font-size:12px; line-height:40px;}
#main-tab td a{ font-size:12px; color:#548fc9;}
#main-tab td a:hover{color:#565656; text-decoration:underline;}
.bordertop{ border-top:1px solid #ebebeb}
.borderright{ border-right:1px solid #ebebeb}
.borderbottom{ border-bottom:1px solid #ebebeb}
.borderleft{ border-left:1px solid #ebebeb}
.gray{ color:#dbdbdb;}
td.fenye{ padding:10px 0 0 0; text-align:right;}
.bggray{ background:#f9f9f9}
</style>
</head>
<!--main_top-->
<body>
<form action='post_list.php' method='get'>
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top">您的位置：帖子列表</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="search">
  		<tr>
   		 <td width="90%" align="left" valign="middle">
	         <span>二级分类：</span>
             <select name="tid" id="" style="float: left">
                 <option value="0" >全部</option>
                 <?php
                 require "./config.php";
                 require "./Model.class.php";

                 $type = new Model('type');
                 $res2 = $type->query('select * from type where pid!=0');
                 foreach($res2 as $k=>$v) {
                     ?>
                     <option value="<?=$v['id']?>" ><?=$v['name']?></option>
                     <?php
                 }
                 ?>
             </select>
             <span>内容：</span>
             <?php
//                var_dump($_GET);
                if(empty($_GET)){
                    $value='';
                }else{
                    if(!isset($_GET['text'])){
                        $value='';
                    }else{
                        $value=$_GET['text'];
                    }
                }
             ?>
	         <input type="text" name="text" value='<?=$value ?>' class="text-word" placeholder="请输入标题或者内容">

	         <input type="submit" value="查询" class="text-but">
         </td>
  		  <td width="10%" align="center" valign="middle" style="text-align:right; width:150px;"><a href="#" target="mainFrame" onFocus="this.blur()" class="add">新增帖子</a></td>
  		</tr>
	</table>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
      <tr>
        <th align="center" valign="middle" class="borderright" width="55">帖子ID</th>
          <th align="center" valign="middle" class="borderright" width="55">发帖人ID</th>
          <th align="center" valign="middle" class="borderright" width="55">类别id</th>
          <th align="center" valign="middle" class="borderright" width="150">类别</th>
        <th align="center" valign="middle" class="borderright">标题</th>
        <th align="center" valign="middle" class="borderright">内容</th>
          <th align="center" valign="middle" class="borderright">发帖时间</th>
          <th align="center" valign="middle" class="borderright">阅读量</th>
          <th align="center" valign="middle" class="borderright">是否精华</th>
          <th align="center" valign="middle" class="borderright">是否置顶</th>
          <th align="center" valign="middle" class="borderright">回收站</th>
        <th align="center" valign="middle">操作</th>
      </tr>
        <?php
        //1.引入配置文件
//        require "config.php";

        //2.引入Model类文件
//        require "./Model.class.php";

        //3.实例化
        $post = new Model('post');

        //======================封装搜索程序=============================

        //定义一个存储搜索信息的变量
        $whereList = array();
        $urlList=array();

        //判断用户是否提交了搜索内容的信息
        if(!empty($_GET['text'])){
            $whereList[] = " (title like '%{$_GET['text']}%' || content like '%{$_GET['text']}%')";
            $urlList[]="title={$_GET['text']}";
        }
        //判断用户是否提交了搜索分类的信息
        if(!empty($_GET['tid'])){
            $whereList[] = " tid={$_GET['tid']}";
            $urlList[]="tid={$_GET['tid']}";
        }

        //判断用户是否搜素了信息
        $where = '';
        $url ='';
        if(!empty($whereList)){
            //拼装搜索信息语句
            $where = ' where '.implode(' && ', $whereList);
            $url='&'.implode('&',$urlList);
        }
//        echo $where;
        //===============================================================
        //=====================封装分页程序的代码===================================

        //分页需要应用到的信息
        $maxRows = 0;	//总条数
        $pageSize = 10;	//每页条数
        $maxPage = 0;	//总页数
        $page = $_GET['p'] ?? 1;		//当前页

        //定义查询总条数的语句
        $maxRows = $post->query("select count(*) sum from post {$where}")[0]['sum'];

        //求得总页数
        $maxPage = ceil($maxRows / $pageSize);

        //拼装limit语句
        $limit = '';
        $limit = ' limit '.($page - 1) * $pageSize.','.$pageSize;

        //==========================================================================

        //4. 查询
        $sql="select * from post {$where}{$limit}";
        $res = $post->query($sql);
//        var_dump($sql);

        //5.遍历到表格
        if($res) {
            foreach ($res as $k => $v) {
                ?>
                <tr onMouseOut="this.style.backgroundColor='#ffffff'"
                    onMouseOver="this.style.backgroundColor='#edf5ff'">
                    <td align="center" valign="middle" class="borderright borderbottom"><?= $v['id'] ?></td>
                    <td align="center" valign="middle" class="borderright borderbottom"><?= $v['uid'] ?></td>
                    <td align="center" valign="middle" class="borderright borderbottom"><?= $v['tid'] ?></td>
                    <?php
                        $type=new Model('type');
                        $res_t=$type->find($v['tid']);
//                        var_dump($res_t);
                    ?>
                    <td align="center" valign="middle" class="borderright borderbottom"><?= $res_t['name'] ?></td>

                    <td align="left" valign="middle" class="borderright borderbottom"><?= $v['title'] ?></td>
                    <td align="left" valign="middle" class="borderright borderbottom"><?= $v['content'] ?></td>
                    <td align="center" valign="middle" class="borderright borderbottom"><?= $v['ctime'] ?></td>
                    <td align="center" valign="middle" class="borderright borderbottom"><?= $v['count'] ?></td>
                    <td align="center" valign="middle"
                        class="borderright borderbottom"  <?= $v['elite'] == 0 ? '' : 'style="color: red;"' ?> ><?= $v['elite'] == 0 ? '否' : '是' ?></td>
                    <td align="center" valign="middle"
                        class="borderright borderbottom"><?= $v['top'] == 0 ? '否' : '是' ?></td>
                    <td align="center" valign="middle"
                        class="borderright borderbottom"><?= $v['recycle'] == 0 ? '普通' : '回收站' ?></td>
                    <td align="center" valign="middle" class="borderbottom">
                        <a href="#" target="mainFrame" onFocus="this.blur()" class="add">编辑</a><span class="gray">&nbsp;|&nbsp;</span>
                        <a href="#" target="mainFrame" onFocus="this.blur()" class="add">删除</a>
                    </td>
                </tr>
                <?php
            }
        }else{
            ?>
            <tr onMouseOut="this.style.backgroundColor='#ffffff'"
                onMouseOver="this.style.backgroundColor='#edf5ff'">
                <td align="center" valign="middle" class="borderright borderbottom" colspan="11">暂无数据</td>
            </tr>
        <?php
        }
        ?>
    </table>
    </td>
    </tr>
  <tr>
    <td align="left" valign="top" class="fenye">
        <?=$maxRows?> 条数据 <?= $page ?>/<?= $maxPage ?> 页&nbsp;&nbsp;
        <a href="post_list.php?p=1<?=$url ?>" target="mainFrame" onFocus="this.blur()">首页</a>
        <a href="post_list.php?p=<?= $page-1<=1 ? 1 : $page-1; ?><?=$url ?>" target="mainFrame" onFocus="this.blur()">上一页</a>
        <a href="post_list.php?p=<?= $page+1>=$maxPage ? $maxPage : $page+1 ?><?=$url ?>" target="mainFrame" onFocus="this.blur()">下一页</a>
        <a href="post_list.php?p=<?= $maxPage ?><?=$url ?>" target="mainFrame" onFocus="this.blur()">尾页</a>
    </td>
  </tr>
</table>
</form>
</body>
</html>