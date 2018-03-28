<?php
/**
 * Created by PhpStorm.
 * User: hxsd
 * Date: 2018/1/5
 * Time: 11:12
 */

    //引用文件
    require "./config.php";
    require "./Model.class.php";
    require "./my_functions.php";

    //实例化
    //管理员
    $user = new Model('user');
    //注册用户
    $userDetail = new Model('userDetail');


switch ($_GET['a']){
        case 'addAdmin':   //添加管理员
            //1.实例化
            //2.执行添加
            $res = $user->add($_POST);

            //3.判断
            if($res!=false){
                echo "<script>window.location.href='admin_list.php'</script>";
            }else{
                echo "<script>alert('抱歉，添加失败！');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
                die;
            }
            break;
        case 'deleteAdmin':   //删除管理员
            $res=$user->del($_GET['i']);

            if($res!=false){
                echo "<script>window.location.href='admin_list.php';</script>";
            }else{
                echo "<script>alert('抱歉！删除失败');window.location.href='{$_SERVER['HTTP_REFERER']}';</script>";
            }

            break;
        case 'changeAdmin':  //修改管理员
//            var_dump($_POST);
            $res = $user->save($_POST);

            //判断
            if($res!=false){
                echo "<script>window.location.href='admin_list.php'</script>";
            }else{
                echo "<script>alert('抱歉，修改失败！');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
                die;
            }
            break;

        case 'add_user':   //添加用户
//            var_dump($_FILES);
//            die;

            //1.将地址字段使用逗号拼装为字符串，并覆盖回去
            $address = implode(',',$_POST['address']);
            $_POST['address'] = $address;

            //2. 调用上传函数文件（图片）
            $path='../userPhoto/';
            $upfile=$_FILES['photo'];
            $allowType = array("image/jpeg","image/png","image/gif");
            $maxSize=1024*1024;
            $res =upload($path,$upfile,$allowType,$maxSize);

            //3. 判断是否调用失败（图片）
            if($res['error']==false){
                echo "<script>alert('{$res['info']}');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
                die;
            }

            //4. 调用缩放函数文件（图片）
            $picName=explode('：', $res['info'])[1];
            imageResize($path,$picName,100,100,'s_');

            //5. 将图片信息传添加到数组（图片）
            $_POST['photo']=$picName;

            //6.实例化
//            $userDetail = new Model('userDetail');

            //7.执行添加
            $res = $userDetail->add($_POST);

            //8.判断
            if($res!=false){
                echo "<script>window.location.href='user_list.php'</script>";
            }else{
                echo "<script>alert('抱歉，注册失败！');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
                die;
            }
            break;

        case 'delete':    //删除用户
//            $userDetail = new Model('userDetail');

            $res=$userDetail->del($_GET['i']);

            if($res!=false){
                echo "<script>window.location.href='user_list.php';</script>";
            }else{
                echo "<script>alert('抱歉！删除失败');window.location.href='{$_SERVER['HTTP_REFERER']}';</script>";
            }

            break;
        case 'change':   //修改用户

            //一、准备参数$data

            //1.将地址字段使用逗号拼装为字符串，并覆盖回去
            $address = implode(',',$_POST['address']);
            $_POST['address'] = $address;

            //2. 调用上传函数文件（图片）
            $path='../userPhoto/';
            $upfile=$_FILES['photo'];
            $allowType = array("image/jpeg","image/png","image/gif");
            $maxSize=1024*1024;
            $res =upload($path,$upfile,$allowType,$maxSize);

            //3. 判断是否调用失败（图片）
            if($res['error']==false){
                echo "<script>alert('{$res['info']}');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
                die;
            }

            //4. 调用缩放函数文件（图片）
            $picName=explode('：', $res['info'])[1];
            imageResize($path,$picName,100,100,'s_');

            //5. 将图片信息传添加到数组（图片）
            $_POST['photo']=$picName;

            //二、实例化，并调用save($data)
            $res = $userDetail->save($_POST);

            //判断
            if($res!=false){
                echo "<script>window.location.href='user_list.php'</script>";
            }else{
                echo "<script>alert('抱歉，修改失败！');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
                die;
            }
            break;
    }