window.onscroll=function(){
	
	var duilian=document.getElementById('duilian');
	var scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
	duilian.style.top=scrollTop+100+'px';
	}
//function Imad_Show()
//{
//	var oimadform=document.getElementById('imadform');
//
//	oimadform.style.display='block';
//	
//	
//	}
//	
//function Imad_Hide()
//{
//	var oimadform=document.getElementById('imadform');
//
//	oimadform.style.display='none';
//
//	}
//将上述代码简化

function Imad_Set(c)
{
	var oimadform=document.getElementById('imadform');

	oimadform.style.display=c;

	}	
	
var url='web.htm';
document.write("<div id='duilian' style='top:200px;position:absolute; overflow:hidden;right:6px;'><button style='background:#7DC4C6;color: #FFFFFF;cursor: pointer;border:0;font-size: 14px;height: 30px;text-align: center;width: 90px;' type=button onclick=Imad_Set('block') onfocus=this.blur()>点击</button>")
document.write("  </div>");
document.write("<div  id='imadform' style='font-size:12px;background:#fff;position:relative;height:auto;z-index:900;display:none;width:530px;margin:0 auto;text-align:center;overflow:visible'><span class='yd-icon' style='color:#fff;font-weight:bold;display: inline-block;position:absolute;right:30px;top:0;width: 26px; overflow: hidden;height: 36px;cursor:pointer;line-height:36px;z-index:120' onclick=Imad_Set('none')>关闭</span><iframe style='position:absolute;left:0;top:0;border:0px;' src='"+url+"' width='100%' frameborder='0' scrolling='no' name='hj' id='hj'></iframe></div>");
  













