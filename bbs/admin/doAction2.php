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

    //实例化栏目
    $type = new Model('type');

switch ($_GET['b']){
        case 'insert':
//            var_dump($_POST);
            if($_POST['pid']==0){   //添加一级分类
                //准备数据，进行添加
                $data=array('name'=>$_POST['name'],'status'=>$_POST['status']);
                $res = $type->add($data);

                //判断是否成功
                if($res){
                    echo "<script>window.location.href='menu_list.php'</script>";
                }else{
                    echo "<script>alert('抱歉，父类添加失败！');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
                }
            }
            if($_POST['pid']==1){   //添加二级分类
//                var_dump($_FILES);
                if($_FILES['blogo']['name']==''){   //没有上传图片时 用默认图片
                    $picName='default.jpg';
                }else{
                    //==============================图片上传=====================================
                    //2. 调用上传函数文件（图片）
                    $path='./images/';
                    $upfile=$_FILES['blogo'];
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
//                imageResize($path,$picName,57,57,'s_');
                    //===========================================================================

                }
                $data=array(
                    'name'=>$_POST['name'],
                    'status'=>$_POST['status'],
                    'pid'=>$_POST['father'],
                    'path'=>'0-'.$_POST['father'],
                    'blogo'=>$picName
                );

                $res = $type->add($data);
//                var_dump($res);
                //判断是否成功
                if($res){
                    echo "<script>window.location.href='menu_list.php'</script>";
                }else{
                    echo "<script>alert('抱歉，子类添加失败！');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
                }
            }
            break;
        case 'delete':
            //查询点击那一条信息的pid,看是一级还是二级
            $line = $type->find($_GET['i']);
            if($line['pid']==0){
                //判断是否包含有二级主题
                $sql="select * from type where pid={$_GET['i']}";
                $res = $type->query($sql);

                if($res){  //包含二级分类

                    echo "<script>alert('此分类下有二级分类，不能删除');window.location.href='{$_SERVER['HTTP_REFERER']}';</script>";

                    //================如果包含二级分类别，就一起删除======================================
                    /*//删二级
                    $sql="delete from type where pid={$_GET['i']}";
                    $res2 = $type->query($sql);
                    if($res1!=false && $res2!=false){
                        echo "<script>window.location.href='menu_list.php';</script>";
                    }else{
                        echo "<script>alert('抱歉！删除失败');window.location.href='{$_SERVER['HTTP_REFERER']}';</script>";
                    }*/
                    //======================================================

                }else{
                    //不包含二级分类，仅仅删一级
                    $res1 = $type->del($_GET['i']);

                    if($res1!=false){
                        echo "<script>window.location.href='menu_list.php';</script>";
                    }else{
                        echo "<script>alert('抱歉！删除失败');window.location.href='{$_SERVER['HTTP_REFERER']}';</script>";
                    }
                }
            }else{
                //2. 删除二级主题
                $res = $type->del($_GET['i']);
                // 还需要删除对应的图片；

                if($res!=false){
                    echo "<script>window.location.href='menu_list.php';</script>";
                }else{
                    echo "<script>alert('抱歉！删除失败');window.location.href='{$_SERVER['HTTP_REFERER']}';</script>";
                }
            }

        break;
        case 'change':

            //一级
            if($_POST['apart']==0){
                $_POST['pid']=0;
            }

            //二级
            if($_POST['apart']==1){
                //==============================图片上传=====================================
                //2. 调用上传函数文件（图片）
                $path='./images/';
                $upfile=$_FILES['blogo'];
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
//                imageResize($path,$picName,57,57,'s_');

                //5. 将图片信息传添加到数组（图片）
//                $data['blogo']=$picName;
                //===========================================================================

                $_POST['blogo']=$picName;
                $_POST['path']='0-'.$_POST['pid'];
            }

            $res = $type->save($_POST);
            //判断
            if($res!=false){
                echo "<script>window.location.href='menu_list.php'</script>";
            }else{
                echo "<script>alert('抱歉2，修改失败！');window.location.href='{$_SERVER['HTTP_REFERER']}'</script>";
                die;
            }
            break;
        case 'copy':
            echo "copy";
            break;
    }