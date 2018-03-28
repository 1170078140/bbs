<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dettails</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>

    <style type="text/css">
        *{margin: 0;padding: 0;}
        a{text-decoration: none;}
        ul{list-style: none;}
        .inner{width: 960px;margin: 0 auto;}
        .clearfix:after{
            content: '.';
            clear: both;
            visibility: hidden;
            height: 0;
            display: block;
        }
        body{background-color: #f1f2f6;}
    </style>
    <link rel="stylesheet" href="css/details.css" type="text/css">
</head>
<body>
<?php
require "./style.php";
?>
    <div class="main inner">
        <div class="backtol"><a href="<?=$_SERVER['HTTP_REFERER']?>">返回列表</a></div>
        <div class="middleBox">
            <form action="" >


                <div class="readTop"><?=$_GET['t']?></div>
                <table>
                    <tr>
                        <td class="left">
                            <div class="posT">
                                <?php
                                    require "./admin/config.php";
                                    require "./admin/Model.class.php";

                                    $user=new Model('userDetail');
                                    $res_p=$user->find($_GET['id']);
                                ?>
                                <div class="fatie">
                                    <span></span>
                                    <a href="#"><?=$res_p['nickName']?></a>
                                </div>
                                <div class="pic">
                                    <img style="width: 120px;" src="userPhoto/<?=$res_p['photo']?>">
                                </div>
                                <div class="icons">
                                    <a href="#">斑竹</a>
                                </div>
                            </div>
                        </td>
                        <td class="right">
                            <div class="text">
                                <div class="topTitle">楼主</div>
                                <div><?=$_GET['c']?></div>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: hxsd
 * Date: 2017/12/27
 * Time: 17:43
 */