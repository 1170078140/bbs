<?php
	
	/*//一些参数
	$path='./uploads/';
	$path=rtrim($path,'/').'/';                          //格式化路径
	$upfile=$_FILES['pic'];
	$allowType=['image/jpeg','image/png','image/gif'];   //允许的上传文件类型
	$maxSize=1024*1024;                                  //允许的上传文件大小
*/
	/**
	 * [upload 上传文件的函数]
	 * @param  [string]  $path      [上传文件存储的路径]
	 * @param  [array]   $upfile    [上传文件的一维数组格式信息]
	 * @param  [array]   $allowType [允许上传的文件类型列表 array('image/jpeg','image/png')]
	 * @param  [integer] $maxSize   [允许上传的文件大小，为0表示不限制大小，单位：字节]
	 * @return [array]   $res       [返回一个一维数组，包含了错误与成功的提示信息和布尔值]
	 *                              [例如：$res = array(
	 *                              					'info'=>'成功与否',
	 *                              					'error'=>布尔值true或false
	 *                              					);]
	 */
	function upload($path,$upfile,$allowType=array(),$maxSize=0){
		//返回值
		$res=array(
			"info"=>'',
			"error"=>false
		);

		//设置时区
		date_default_timezone_set('PRC');

	    //格式化路径信息
	    $path = rtrim($path,'/').'/';

		//1. 错误值
		$fileError=$upfile['error'];
		if($fileError>0){
			switch ($fileError) {
				case '1':
					$info='文件上传失败，原因：上传文件的大小超出了约定值。';
					break;
				case '2':
					$info='文件上传失败，原因：上传文件大小超出了HTML表单隐藏域属性的MAX＿FILE＿SIZE元素所指定的最大值';
					break;
				case '3':
					$info='文件上传失败，原因：文件只有部分被上传';
					break;
				case '4':
					$info='文件上传失败，原因：没有上传任何文件';
					break;
				case '6':
					$info='文件上传失败，原因：找不到临时文件夹';
					break;
				case '7':
					$info='文件上传失败，原因：文件写入失败';
					break;
			}
			$res['info']='文件上传未成功，原因是'.$info;
			return $res;
		}
		
		//2. 文件类型
		$upType=$upfile['type'];
		if(count($allowType)>0 && $allowType){
			if(!in_array($upType,$allowType)){
				$res['info']='文件上传失败，原因：文件类型不符合系统要求';
				return $res;
			}
		}else{
			$res['info']='文件上传失败，原因：系统未设定指定的上传类型';
			return $res;
		}


		//3. 文件大小
		$size=$upfile['size'];
		if($size>$maxSize && $maxSize>0){
			$res['info']='文件上传失败，原因：文件大小超出系统指定值';
			return $res;
		}

		//4. 随机生成文件名

		$ext=pathinfo($upfile['name'],PATHINFO_EXTENSION);
		// var_dump($ext);
		do{
			$newName=date('YmdHis').rand(100000000,2147483647).'.'.$ext;
		}while(file_exists($path.$newName));
		// var_dump($newName);


		//5. 上传文件
		if(is_uploaded_file($upfile['tmp_name'])){
			if(move_uploaded_file($upfile['tmp_name'],$path.$newName)){
				$res['info']="上传成功，文件名：".$newName;
				$res['error']=true;
				return $res;
			}else{
				$res['info']='文件上传失败，原因：文件移动时发生错误';
				return $res;
			}
		}else{
			$res['info']='文件上传失败，原因：未按照HTTP POST 方式上传';
			return $res;
		}
	}

	/**
	 * [imageResize 执行图像等比例缩放]
	 * @param  [string]  $path    [要执行等比例缩放的图像所在位置，以及缩放后小图的存放位置]
	 * @param  [string]  $picname [要执行缩放的图像名称]
	 * @param  [integer] $maxw    [缩放区域的宽度]
	 * @param  [integer] $maxh    [缩放区域的高度]
	 * @param  [string]  $pre     [缩放图像的前缀名]
	 */
	function imageResize($path,$picName,$maxw,$maxh,$pre){
		//2. 路径格式化 以及获取图片信息
		$path=rtrim($path,'/').'/';
		$info=getimagesize($path.$picName);
		//var_dump($info);

		//3. 根据不同的图片类型获取图片
		switch ($info[2]) {
			case '1':              //gif
				$oldImg=imagecreatefromgif($path.$picName);
				break;
			case '2':             //jpg
				$oldImg=imagecreatefromjpeg($path.$picName);
				break;
			case '3':            //png
				$oldImg=imagecreatefrompng($path.$picName);
				break;
		}
		// var_dump($oldImg);

		//4. 计算缩放后的宽和高
		$oldW=imagesx($oldImg);
		$oldH=imagesy($oldImg);

		$b=$oldW>$oldH?($oldW/$maxw):($oldH/$maxh);
		//var_dump($b);

		$newW=$oldW/$b;
		$newH=$oldH/$b;


		//5. 准备画布
		$newImg=imagecreatetruecolor($newW, $newH);
		//var_dump($newImg);

		//6. 缩放函数
		imagecopyresampled($newImg, $oldImg, 0, 0, 0, 0, $newW, $newH, $oldW, $oldH);

		//7. 输出 另存为
		// header("Content-Type:".$info['mime']);    //如果不需要显示在页面  就注释掉
		switch ($info[2]) {
			case '1':              //gif
				imagegif($newImg,$path.$pre.$picName);
				break;
			case '2':              //jpg
				imagejpeg($newImg,$path.$pre.$picName);
				break;
			case '3':             //png
				imagepng($newImg,$path.$pre.$picName);
				break;
		}

		//8. 销毁
		imagedestroy($oldImg);
	}

?>





