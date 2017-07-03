var koa = require('koa');
var app = new koa();
var router = require('koa-router');
app.use(
	router(app)


	);

// app.use(function *(){
//     var path = this.path;
//     this.body = path;
//     console.log(this);
// });

	app.get('/detail/:id', function *(next) {
	    //我是详情页面
	    //:id 是路由通配规则，示例请求 /detail/123 就会进入该 generator function 逻辑
	    var id = this.params.id; //123
	    if(id==123){
	    	console.log(id)
	    }else{
	    	console.log(111)
	    }
	    
	});


app.listen(3000);