/*Jquery学习笔记    By   N*/


		  
/*焦点图---*/  
$(function(){
var index01 = 0;
var ads;
var lens = $('.num li').length;
$('.num li').mouseover(function(){
								index01 = $('.num li').index(this)
								showImg(index01)
								}).eq(0).mouseover();
$('.focusimg').hover(function(){ clearInterval(ads); }
							 ,function(){
								  		ads = setInterval(function(){
										showImg(index01)
										index01++;
										if(index01==4){index01=0}
																   },3000);
								  }).trigger("mouseleave");

$('.title').css("opacity","0.7")  //透明显示图片属性
function showImg(i){
	$('.imgs div').eq(i).fadeIn("fast").siblings().hide();
	$('.num li').eq(i).addClass('on').siblings().removeClass('on')
	$('.title').html($('.imgs div img').eq(i).attr('alt'));  //显示图片属性
	}
		   })	
	

/*自定义焦点图*/
$(function(){
		   var xindex = 0;
		   var xuweiimg ;
		   var $xuwei = $('ul.xnav li')
		   $xuwei.css("opacity","0.5")
		   $xuwei.mouseover(function(){
											 xindex = $xuwei.index(this);
											 ximg(xindex);
											 //alert(xindex)
											}).eq(0).mouseover();
		   $('.xuwei').hover(function(){
									  clearInterval(xuweiimg)
									  }
									  ,function(){
										  xuweiimg = setInterval(function(){
										  ximg(xindex)
										  xindex++
										  if(xindex==4){xindex=0}
																			  },3000)
										  }).trigger("mouseleave");
		   function ximg(i){
			   
			    $('.ximg').stop(true,false).animate({top:-i*240},1000); //滚动展示方式   也可以淡入淡出
			  $xuwei.eq(i).addClass('on').siblings().removeClass('on');
			   }
		   
		   })