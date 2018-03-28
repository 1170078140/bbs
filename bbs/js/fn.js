function silider(){	
	var oBtn_list=document.getElementsByClassName("btn_list")[0];
	var aBtn=oBtn_list.children;
	var oImg=document.getElementsByClassName("img_list")[0];
	var aImg=oImg.children;
	var oDiv=document.getElementsByTagName('div')[0];
	
	//自动轮播
	var num=0;
	function scroll( ) {
	    //出图片
//	    console.log(num);
	    for (var m = 0; m < aImg.length; m++) {
	        aImg[m].className = " hide";
	    }
	    aImg[num].className = " ";
	    //出按钮
	    for (var n = 0; n < aBtn.length; n++) {
	        aBtn[n].className = "";
	    }
	    aBtn[num].className += " ac";
	    num++;
	    if (num == 5) {
	        num = 0;
	    }
	
	}
	var timer=setInterval(scroll,1000);
	//鼠标离开，继续播放
	oImg.onmouseleave=function(){
	    timer=setInterval(scroll,1000);
	};
	//鼠标进入，关闭计时器
	oImg.onmouseenter = function(){
	    clearInterval(timer);
	    // console.log(num);
	};
	//点击出现对应的图片
	for(var i=0;i<aBtn.length;i++){
	    aBtn[i].index=i;
	    aBtn[i].onclick=function(){
	         //先去掉所有btn上的 ac
	         for(var j=0;j<aBtn.length;j++){
	             aBtn[j].className="";
	         }
	         //再给当前btn,添加 ac
	         this.className=" ac";
	         //所有图片隐藏
	         for(var s=0;s<aImg.length;s++){
	             aImg[s].className=" hide";
	         }
	         //与当前btn编号一致的图片显示
	        aImg[this.index].className=" ";       
	         num=this.index;
	         clearInterval(timer);
	     };
	 }
}