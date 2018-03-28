<?php
	session_start();
	
	//测试
	$type = 1;
	$length = 4;
	$code = getCode($type,$length);

	//将验证码扔到session中
    $_SESSION['code'] = $code;
    setcookie('code',$code,time()+60,'/');

	//1. 准备画布，画笔，颜料
	$im = imagecreatetruecolor(20*$length,30);

	//准备背景色
	$bg = imagecolorallocate($im, 240,240,240);

	//2. 开始绘画
	imagefill($im,0,0,$bg);

	//① 绘制文本
	for($i=0;$i<$length;$i++){
		$tc = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
		imagettftext($im, 20, rand(-30,30), 8+15*$i, 25, $tc, "./msyhbd.ttf", $code[$i]);
	}

	//② 绘制像素点
	for($j=0;$j<=100;$j++){
		$pc = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
		imagesetpixel($im, rand(0,28*$length), rand(0,50), $pc);
	}

	//③ 绘制线条
	for($z=0;$z<=10;$z++){
		$lc = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
		imageline($im, rand(0,28*$length), rand(0,50), rand(0,28*$length), rand(0,50), $lc);
	}

	//3. 输出图像
	header('Content-Type:image/png');
	imagepng($im);

	//4. 释放资源
	imagedestroy($im);

	//随机一个字符串出来
	// $str = "abcd";
	// $len = strlen($str);
	// echo $str[rand(0,$len-1)];
	

	// 生成验证码的程序
	/**
	 * [getCode 生成验证码的函数]
	 * @param  [int] $type   [您要选择的验证码类型：1：纯数字；2：数字+小写字母；3：数字+大小写字母]
	 * @param  [int] $length [您要选择的验证码长度：默认4位长度]
	 * @return [str]         [返回生成的验证码内容]
	 */
	function getCode($type=1, $length=4)
	{
		//1.定义字符源
		$str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

		//判断选择了那种类型的验证码
		if($type==1){
			$len = 9;
		}else if($type==2){
			$len = 35;
		}else if($type==3){
			$len = strlen($str)-1;
		}

		//3.随机4位长度的字符串出来
		$code = "";
		for($i=0;$i<$length;$i++){
			$code .= $str[rand(0,$len)];
		}

		//将生成的验证码字符串返回函数调用处
		return $code;
	}

