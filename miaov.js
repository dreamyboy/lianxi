var g_iRightDistance=20;
var g_iBottomDistance=20;
var g_oTimer=null;

window.onload=function ()
{
	var bIsIe6=false;	//是否是万恶的IE6
	var oDiv=document.getElementById('to_top');
	
	if(-1!=window.navigator.userAgent.indexOf('MSIE 6.0'))
	{
		if(-1!=window.navigator.userAgent.indexOf('MSIE 7.0') || -1!=window.navigator.userAgent.indexOf('MSIE 8.0'))
		{
			bIsIe6=false;
		}
		else
		{
			bIsIe6=true;
		}
	}
	else
	{
		bIsIe6=false;
	}
	
	if(bIsIe6)
	{
		oDiv.style.position='absolute';
		adjustPositionAbsolute();
		
		window.onresize=adjustPositionAbsolute;
		window.onscroll=adjustPositionAbsolute;
	}
	else
	{
		oDiv.style.position='fixed';
		adjustPositionFixed();
		
		window.onresize=adjustPositionFixed;
		window.onscroll=adjustPositionFixed;
	}
	
	oDiv.onclick=startScrollToTop;
}

function adjustPositionFixed()
{
	var oDiv=document.getElementById('to_top');
	var scrollTop=document.body.scrollTop || document.documentElement.scrollTop;
	
	if(scrollTop==0)
	{
		oDiv.style.display='none';
	}
	else
	{
		oDiv.style.display='block';
		oDiv.style.top=document.documentElement.clientHeight-(oDiv.offsetHeight+g_iBottomDistance)+'px';
		oDiv.style.left=document.documentElement.clientWidth-(oDiv.offsetWidth+g_iRightDistance)+'px';
	}
}

function adjustPositionAbsolute()
{
	var oDiv=document.getElementById('to_top');
	var scrollTop=document.body.scrollTop || document.documentElement.scrollTop;
	
	if(scrollTop==0)
	{
		oDiv.style.display='none';
	}
	else
	{
		oDiv.style.display='block';
		oDiv.style.top=document.documentElement.clientHeight-(oDiv.offsetHeight+g_iBottomDistance)+scrollTop+'px';
		oDiv.style.left=document.documentElement.clientWidth-(oDiv.offsetWidth+g_iRightDistance)+'px';
	}
}

function startScrollToTop()
{
	if(!g_oTimer)
	{
		g_oTimer=setInterval("scrollToTopInner()", 30);
	}
}

function scrollToTopInner()
{
	var scrollTop=document.body.scrollTop || document.documentElement.scrollTop;
	var speed=scrollTop/10;
	
	if(speed<20)
	{
		speed=20;
	}
	
	if(document.body.scrollTop)
	{
		document.body.scrollTop-=speed;
	}
	else
	{
		document.documentElement.scrollTop-=speed;
	}
	
	scrollTop=document.body.scrollTop || document.documentElement.scrollTop
	
	if(scrollTop==0)
	{
		clearInterval(g_oTimer);
		g_oTimer=null;
	}
}