$(function(){

	$('.gotoTop').bind('click',function(){
		$('body,html').stop(true,true).animate({scrollTop:0},250);
	})

	$(document).scroll(function(){
		$('.gotoTop').css('fontSize','16px');
	})

	$('button').click(function(){
		alert($('body,html').scrollTop());
	})


	//点击radio,弹出当前value值

	function getSelectValue(rname){
		var radios=document.getElementsByName(rname);
		for (var i = 0; i < radios.length; i++) {
			if(radios[i].checked ==true) return radios[i].value;
		}
		return "";
	}

   $('#mform').on('change',function(){
   		var radiovalue = getSelectValue("r1");
   		alert(radiovalue);
   })


	var canvas=document.getElementById('myCanvas');
	var ctx=canvas.getContext('2d');
	ctx.fillStyle='green';
	ctx.fillRect(30,50,80,100);



})

