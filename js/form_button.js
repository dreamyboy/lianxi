function Imad_Show()
{
	var oimadform=document.getElementById('imadform');
	oimadform.style.display='block';
}
function Imad_Hide()
{
	var oimadform=document.getElementById('imadform');
	oimadform.style.display='none';
}
document.write("<table align=center><tr><td><button style='background:#7DC4C6;color: #FFFFFF;cursor: pointer;border:0;font-size: 14px;height: 30px;text-align: center;width: 90px;' type=button onclick=Imad_Show() onfocus=this.blur()>µã»÷</button></td></tr></table>");
document.write("<div  id='imadform' style='font-size:12px;background:#fff;position:relative;height:auto;z-index:900;display:none;width:530px;margin:0 auto;text-align:center;overflow:visible'><span class='yd-icon' style='color:#000;font-weight:bold;display: inline-block;position:absolute;right:30px;top:0;width: 26px; overflow: hidden;height: 36px;cursor:pointer;line-height:36px;z-index:120' onclick=Imad_Hide()>¹Ø±Õ</span><iframe style='position:absolute;left:0;top:0;border:0px;' src='web.htm' width='100%' frameborder='0' scrolling='no' name='hj' id='hj'></iframe></div>");

