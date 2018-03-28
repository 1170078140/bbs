<?php
/**
 * Created by PhpStorm.
 * User: hxsd
 * Date: 2018/1/5
 * Time: 13:56
 */
require "./admin/config.php";
require "./admin/Model.class.php";
require('./admin/my_functions.php');

switch ($_GET['a']) {
    case 'insert':     //注册
//        var_dump($_POST);
        //1.将地址字段使用逗号拼装为字符串，并覆盖回去
        $address = implode(',',$_POST['address']);
        $_POST['address'] = $address;

        //2. 调用上传函数文件（图片）
//        var_dump($_FILES);
        $path='./userPhoto/';
        $upfile=$_FILES['photo'];
        $allowType = array("image/jpeg","image/png","image/gif");
        $maxSize=1024*1024;
        $res =upload($path,$upfile,$allowType,$maxSize);

        //3. 判断是否调用失败（图片）
        if($res['error']==false){
            echo "<script>alert('{$res['info']}');window.location.href='index.php'</script>";
            die;
        }

        //4. 调用缩放函数文件（图片）
        $picName=explode('：', $res['info'])[1];
        imageResize($path,$picName,100,100,'s_');

        //5. 将图片信息传添加到数组（图片）
        $_POST['photo']=$picName;

        //6.实例化
        $user = new Model('userDetail');

        //7.执行添加
        $res = $user->add($_POST);

        //8.判断
        if($res!=false){
            echo "<script>alert('恭喜，注册成功！');window.location.href='signup.php'</script>";
        }else{
            echo "<script>alert('抱歉，注册失败！');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
            die;
        }
        break;

    case 'login':     //执行用户登录
        //开启session
        session_start();

        //1.获取用户登录的信息
        $userName = $_POST['userName'];
        $password = $_POST['password'];

        //2.验证当前用户是否存在
        $user = new Model('userDetail');
        $res = $user->query("select * from userDetail where userName='{$userName}' && password='{$password}'");
//        var_dump($res);

        //4.判断
        if($res!=false){
            //登录成功将用户指定信息存入session
            $_SESSION['id'] = $res[0]['id'];
            $_SESSION['name'] = $res[0]['userName'];
            $_SESSION['nickName'] = $res[0]['nickName'];
            $_SESSION['photo'] = $res[0]['photo'];
//            var_dump($_SESSION);
            echo "<script>window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
        }else{
            echo "<script>alert('抱歉，登录失败！用户名或密码错误！');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
        }

        break;
    case "logout":
        //1. 开启session
        session_start();

        //2. 清空信息
        session_destroy();

        //3. 弹框提示
        echo "<script>window.location.href='{$_SERVER['HTTP_REFERER']}';</script>";
        break;
    case "post":   //发帖
//        var_dump($_POST);
        if($_POST['title']=='' || $_POST['content']==''){
            echo "<script>alert('标题或者内容不能为空！');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
        }else {
            $post = new Model('post');
            $res = $post->add($_POST);
            $tid = $_POST['tid'];

            //判断是否成功
            if ($res) {
                echo "<script>window.location.href='list.php?i={$tid}'</script>";
            } else {
                echo "<script>alert('抱歉，添加失败！');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
            }
        }
        break;
    case "post2":
        var_dump($_POST);
        break;

}