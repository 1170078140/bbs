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
#search{ font-size:12px; background:#548fc9; margin:10px 10px 0 0; display:inline; width:100%; color:#FFF}
#search form span{height:40px; line-height:40px; padding:0 0px 0 10px; float:left;}
#search form input.text-word{height:24px; line-height:24px; width:180px; margin:8px 0 6px 0; padding:0 0px 0 10px; float:left; border:1px solid #FFF;}
#search form input.text-but{height:24px; line-height:24px; width:55px; background:url(images/main/list_input.jpg) no-repeat left top; border:none; cursor:pointer; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#666; float:left; margin:8px 0 0 6px; display:inline;}
#search a.add{ background:url(images/main/add.jpg) no-repeat 0px 6px; padding:0 10px 0 26px; height:40px; line-height:40px; font-size:14px; font-weight:bold; color:#FFF}
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
#addinfo{ padding:0 0 10px 0;}
input.text-word{ width:50px; height:24px; line-height:20px; border:#ebebeb 1px solid; background:#FFF; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; text-align:center; color:#666}
.tda{width:100px;}
.tdb{ padding-left:20px;}
td#xiugai{ padding:10px 0 0 0;}
td#xiugai input{ width:100px; height:40px; line-height:30px; border:none; border:1px solid #cdcdcd; background:#e6e6e6; font-family:"Microsoft YaHei","Tahoma","Arial",'宋体'; color:#969696; float:left; margin:0 10px 0 0; display:inline; cursor:pointer; font-size:14px; font-weight:bold;}
</style>
</head>
<body>
<!--main_top-->
<form method="post" action="">
<table width="99%" border="0" cellspacing="0" cellpadding="0" id="searchmain">
  <tr>
    <td width="99%" align="left" valign="top" id="addinfo">您的位置：栏目管理</td>
  </tr>
  <tr>
    <td align="left" valign="top">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" id="main-tab">
          <tr>
<!--            <th align="center" valign="middle" class="borderright tda">顺序</th>-->
            <th align="center" valign="middle" class="borderright tda">分类树</th>
            <th align="center" valign="middle" class="borderright tda">ID</th>
              <th align="center" valign="middle" class="borderright">栏目名</th>
              <th align="center" valign="middle" class="borderright">图片</th>
              <th align="center" valign="middle" class="borderright">权限</th>
            <th align="center" valign="middle">栏目管理</th>
          </tr>
            <?php
                //1.引入配置文件
                require "config.php";

                //2.引入Model类文件
                require "./Model.class.php";

                //3.取得所有数据
                $type = new Model('type');
                $res = $type->query('select *,concat(path,"-",id) npath from type order by npath');

                //4.遍历到表格
                foreach($res as $k=>$v) {
                  //  'echo "<img width="57px" src=\'./images/$v["blogo\']\'>"'
            ?>
          <tr class="bggray">
<!--            <td align="center" valign="middle" class="borderright borderbottom"><input type="text" name="" class="text-word" value="1"></td>-->
            <td align="left" valign="middle" class="borderright borderbottom tdb"><img src="images/main/<?=$v['pid']==0?'dirfirst.gif':'dirsecond.gif'?>" ></td>
            <td align="center" valign="middle" class="borderright borderbottom"><?=$v['id']?></td>
              <td align="left" valign="middle" class="borderright borderbottom tdb"><?=$v['name']?></td>
              <?php
                if($v['pid']==0){
                    ?>
                    <td align="left" valign="middle" class="borderright borderbottom tdb">-</td>
                    <?php
                }else{
                    ?>
                    <td align="left" valign="middle" class="borderright borderbottom tdb"><img width="57px;" src="./images/<?=$v['blogo']?>" alt=""></td>
                    <?php
                }
              ?>
              <td align="center" valign="middle" class="borderright borderbottom tdb"><?=$v['status']==1?'开启':'禁用'?></td>
              <td align="center" valign="middle" class="borderbottom">
                <a href="menu_add.php?i=<?=$v['id']?>" target="mainFrame" onFocus="this.blur()" class="add">增加</a><span class="gray">&nbsp;|&nbsp;</span>
                <a href="menu_edit.php?i=<?=$v['id']?>" target="mainFrame" onFocus="this.blur()" class="add">修改</a><span class="gray">&nbsp;|&nbsp;</span>
<!--                <a href="doAction2.php?b=copy&i=--><?//=$v['id']?><!--" target="mainFrame" onFocus="this.blur()" class="add">复制</a><span class="gray">&nbsp;|&nbsp;</span>-->
                <a href="doAction2.php?b=delete&i=<?=$v['id']?>" target="mainFrame" onFocus="this.blur()" class="add">删除</a></td>
          </tr>
            <?php
                }
            ?>
        </table>
    </td>
    </tr>
    <tr>
        <td align="left" valign="top" class="fenye"><?=$type->count() ?> 条数据 1/1 页&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">首页</a>&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">上一页</a>&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">下一页</a>&nbsp;&nbsp;<a href="#" target="mainFrame" onFocus="this.blur()">尾页</a></td>
    </tr>
</table>
</form>
</body>
</html>