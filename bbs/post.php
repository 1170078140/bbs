<?php  date_default_timezone_set('PRC')?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>主要内容区main</title>
    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <link href="admin/css/css.css" type="text/css" rel="stylesheet" />
    <link href="admin/css/main.css" type="text/css" rel="stylesheet" />
    <link rel="shortcut icon" href="images/main/favicon.ico" />
    <style>
       .main{background-color: #fff;padding-top: 10px;padding-bottom: 10px;}
       table{border-collapse: collapse;margin-left: 5px;}
        .title{border: 1px solid #ccc;height: 24px;line-height: 25px;padding: 0 10px;width: 300px;margin-left: 30px;}
        select{border: 1px solid #ccc;height: 24px;line-height: 24px;}
       textarea{width:950px;height:400px;line-height: 30px;font-size: 16px;padding:10px;resize:none;border-left: #aaa 1px solid;border-right:#dcdcdc 1px solid; border-bottom:#dcdcdc 1px solid;}
        .btn{width: 66px;height: 30px;border-radius: 2px;font-size: 14px;color: #fff;background-color: #f4a103;border:1px solid #bd742f;
            cursor: pointer;margin-left: 10px;}
       .btn2{width: 66px;height: 30px;border-radius: 2px;font-size: 14px;background-color: #f0f0f0;border:1px solid #aaa;
           cursor: pointer;}
    </style>
</head>
<body>
<?php
require "./style.php";
?>
<!--main_top-->
<div class="main inner">
    <form method="post" action="doAction.php?a=post">
    <table>
        <input type="hidden" name="ctime" value="<?= date('Y/m/d H:i:s')?>">
        <input type="hidden" name="uid" value="<?= $_SESSION['id']?>">
        <tr style="height: 50px;">
            <td style="width: 65px;text-align: center;color: #000;">选择分类</td>
            <td style="width: 200px;">
                <select name="tid" id="select">
                    <?php
                    require "./admin/config.php";
                    require "./admin/Model.class.php";

                    $type = new Model('type');
                    $res2 = $type->query('select * from type where pid!=0');
                    foreach($res2 as $k=>$v) {
                        ?>
                        <option value="<?=$v['id']?>" <?=$v['id']==$_GET['tid']?'selected=selected':''?>  >&nbsp;&nbsp;<?=$v['name']?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <td style="width: 65px;text-align: center;color: #000;">输入标题</td>
            <td><input type="text" name="title" class="title" placeholder="请输入标题"></td>
        </tr>
        <tr>
            <td colspan="4"><img src="./images/post_bg1_03.jpg" alt=""></td>
        </tr>
        <tr>
            <td colspan="4"><textarea name="content"></textarea></td>
        </tr>
        <tr style="height: 70px;">
            <td><input name="" type="submit" value="发布" class="btn"></td>
            <td><input name="" type="reset" value="重置" class="btn2" ></td>
        </tr>
    </table>
    </form>
</div>
</body>
</html>