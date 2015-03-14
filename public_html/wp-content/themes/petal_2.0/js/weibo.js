// JavaScript Document

	function postToWb(){
		var _url = encodeURIComponent(document.location);
		var _assname = encodeURI("模板部落");//你注册的帐号，不是昵称
		var _appkey = encodeURI("801076192");//你从腾讯获得的appkey
		var _pic = encodeURI('');//（例如：var _pic='图片url1|图片url2|图片url3....）
		var _t = '';//标题和描述信息
		var metainfo = document.getElementsByTagName("meta");
		for(var metai = 0;metai < metainfo.length;metai++){
			if((new RegExp('description','gi')).test(metainfo[metai].getAttribute("name"))){
				_t = metainfo[metai].attributes["content"].value;
			}
		}
		_t =  document.title+_t;//请在这里添加你自定义的分享内容
		if(_t.length > 120){
			_t= _t.substr(0,117)+'...';
		}
		_t = encodeURI(_t);

		var _u = 'http://share.v.t.qq.com/index.php?c=share&a=index&url='+_url+'&appkey='+_appkey+'&pic='+_pic+'&assname='+_assname+'&title='+_t;
		window.open( _u,'', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no' );
	}
