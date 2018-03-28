<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查看帖子详情</title>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" href="./css/list.css">
</head>
<body>
<?php
require "./style.php";
?>
<div class="bread inner">
    <p>LAMP兄弟连<i>></i>PHP技术交流</p>
    <ul class="fr">
        <li class="mr10"><a href="#">新帖</a></li>
        <li class="mr5"><a href="#">精华</a></li>
    </ul>
</div>
<div id="pw_content" class="mb10 inner">
    <div id="sidebar" class="f_tree cc">
        <div class="content_thread cc">
            <?php
                //1.引入配置文件
                require "./admin/config.php";

                //2.引入Model类文件
                require "./admin/Model.class.php";

                //3.取得所有数据
                $type = new Model('type');
                $tid=$_GET['i'];
                $res = $type->find($tid);
//                var_dump($res);

            ?>
            <div class="content_ie">
                <div class="hB mb10" style="padding-right:10px;font-size: 12px;">
                    <span class="fr">版主:  <a href=" #">吴擘君</a></span>
                    <h2 class="mr5 fl f14" style="font-size: 22px;"><?=$res['name']?></h2>
                </div>
                <div class="threadInfo mb10" style="overflow:hidden;">
                    <table width="100%">
                        <tbody>
                            <tr class="vt" style="font-size: 12px">
                                <td width="10">
                                    <img src="./images/<?=$res['blogo']?>" alt="" style="padding:0 10px;">
                                </td>
                                <td style="padding-right:10px;">
                                    <p class="mb5 s6 cc">
                                        今日:
                                        <span class="s2 mr10">0</span>
                                        <span class="gray2 mr10">|</span>
                                        主题:
                                        <span class="s2 mr10">10675</span>
                                        <span class="gray2 mr10">|</span>
                                        帖数:
                                        <span class="s2">2675</span>
                                    </p>
                                    <p class="s6" style="width: 100%;">PHP基础编程、疑难解答、学习和开发过程中的经验总结等。</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="c" style="font-size: 12px;">
                    <div class="sidePd10">
                        <div class="tabA">
                            <ul class="cc" id="lampnewtzdh">
                                <li class="current"><a href="#">全部</a></li>
                                <li id="thread_type_digest"><a href="#">精华</a></li>
                                <li><a href="#">投票</a></li>
                                <li><a href="#">悬赏</a></li>
                                <li><a href="#">商品</a></li>
                            </ul>
                        </div>
                        <div id="ajaxtable">
                            <div class="pw_ulA cc">
                                <ul class="cc" id="id_all">
                                    <li id="thread_type_all" class="current"><a href="#">全部</a></li>
                                    <li id="thread_type_1"><a href="#">已解决</a></li>
                                    <li id="thread_type_2"><a href="#">我要提问</a></li>
                                    <li id="thread_type_3"><a href="#">PHP</a></li>
                                    <li id="thread_type_5"><a href="#">其他</a></li>
                                    <li id="thread_type_6"><a href="#">经验技巧</a></li>
                                </ul>
                            </div>
                            <div class="threadCommon">
                                <table width="100%" style="table-layout:fixed;">
                                    <tbody>
                                        <tr class="tr2 thread_sort">
                                            <td style="padding-left:12px;">
                                                排序： &nbsp;
                                                <a href="#">最新发帖</a>
                                                <span class="gray">|</span>
                                                <a href="#" class="s6 current">最后回复</a>
                                            </td>
                                            <td class="author">作者</td>
                                            <td width="60">回复</td>
                                            <td class="author">最后发表</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table width="100%" style="table-layout:fixed;" class="z">
                                    <tbody id="threadlist">
                                        <!--<tr class="tr4">
                                            <td width="20"></td>
                                            <td style="padding-left:0;">普通主题</td>
                                            <td width="85"></td>
                                            <td width="60"></td>
                                            <td width="85"></td>
                                        </tr>-->
                                        <?php

                                        $post = new Model('post');

                                        //======================获取分页语句====================================
                                        //分页需要应用到的信息
                                        $maxRows = 0;	//总条数
                                        $pageSize = 5;	//每页条数
                                        $maxPage = 0;	//总页数
                                        $page = $_GET['p'] ?? 1;		//当前页

                                        //定义查询总条数的语句
                                        $sql1="select count(*) sum from post where tid={$tid}";
                                        $maxRows = $post->query($sql1)[0]['sum'];

                                        //求得总页数
                                        $maxPage = ceil($maxRows / $pageSize);

                                        //拼装limit语句
                                        $limit = '';
                                        $limit = ' limit '.($page - 1) * $pageSize.','.$pageSize;
                                        //=================================================================


                                        $sql="select * from post where tid={$res['id']}".$limit;
                                        $tiezi = $post->query($sql);

                                        if($tiezi){
                                            foreach($tiezi as $k=>$v) {
                                                $id=$v['uid'];
                                                $tid=$v['tid'];
                                        ?>
                                        <!-- 如果想要遍历数据，遍历tr3即可 -->
                                        <tr class="tr3">
                                            <td class="icon tar" width="30" >
                                                <a href="#"><img src="<?=$v['elite']==1?'./images/topichot.gif':''?>" alt=""></a>
                                            </td>
                                            <td class="subject" id="td_149463">
                                                <img class="fr" src="./images/digest_1.gif" style="margin-top:4px;" alt="">
                                                <a href="details.php?t=<?=$v['title']?>&c=<?=$v['content']?>&id=<?=$v['uid']?>" class="subject_t f14"><?=$v['title']?></a>&nbsp;
                                            </td>
                                            <td class="author" >
                                                <?php
                                                    $user=new Model('userDetail');
                                                    $res_p=$user->find($id);
//                                                    var_dump($res_p);

                                                ?>
<!--                                                发帖人-->
                                                <a href="#" class=" _cardshow"><?=$res_p['nickName']?></a>
                                                <p>2012-11-22</p>
                                            </td>
                                            <td class="num" width="70">
                                                <em>1116</em>/5319
                                            </td>
                                            <td class="author" >
<!--                                               最近回复的人 -->
                                                <a href="#" class=" _cardshow">fkdmuji</a>
                                                <p><a href="#">5小时前</a></p>
                                            </td>
                                        </tr>
                                        <?php
                                                }
                                            }else{
                                                echo "暂无数据";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="cc" style="padding:10px;" id="tabA">
<!--                     如果没有登录，需跳转到登录页面-->
                        <?php
//                            var_dump($_SESSION);
                            if(empty($_SESSION)){
//                                echo "<script>alert('对不起，您还未登陆');</script>";
                                ?>
                                <a href="#?"  class="post fr" id="td_post">发帖</a>
                                <a href="#?" style="float:right;color: red;display: inline-block;line-height: 30px;margin-right: 10px;">请登陆</a>
                        <?php
                            }else{
                                ?>
                                <a href="post.php?tid=<?=$_GET['i']?>" class="post fr" id="td_post">发帖</a>
                        <?php
                            }
                        ?>
                        <div style="padding-top:4px;">
                            <div class="pages">
                                <a href="list.php?p=1&i=<?=$_GET['i']?>">首页</a>
                                <a href="list.php?p=<?= $page-1<=1 ? 1 : $page-1; ?>&i=<?=$_GET['i']?>">上一页</a>
                                <a href="list.php?p=<?= $page+1>=$maxPage ? $maxPage : $page+1 ?>&i=<?=$_GET['i']?>" class="pages_next">下一页</a>
                                <a href="list.php?p=<?= $maxPage ?>&i=<?=$_GET['i']?>" class="pages_next">尾页</a>
                                <span>当前第<?= $page ?>页，共<?= $maxPage ?>页，共<?= $maxRows ?>条数据</span>
                            </div>
                            <!--<div class="pages">
                                <b>1</b>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#">5</a>
                                <a href="#">6</a>
                                <a href="#">..534</a>
                                <a href="#" class="pages_next">下一页</a>
                                <div class="fl">到第</div>
                                <input type="text" size="3" onkeydown="javascript: if(event.keyCode==13){var value = parseInt(this.value); var page=(value>534) ? 534 : value;  location='thread.php?fid=127&search=all&page='+page+''; return false;}">
                                <div class="fl">页</div>
                                <button onclick="javascript:var value = parseInt(this.previousSibling.previousSibling.value); var page=(value>534) ? 534 : value;  location='thread.php?fid=127&search=all&page='+page+''; return false;">确认</button>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>






<?php
/**
 * Created by PhpStorm.
 * User: hxsd
 * Date: 2017/12/26
 * Time: 10:18
 */