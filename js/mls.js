//题目:
//我在向美女Mary索要QQ号时，她告诉我这样的规则：
//首先将第1个数删除，紧接着将第2个数放到这串数的末尾，
//再将第3个数删除并将第4个数放到这串数的末尾，
//再将第5个数删除，一直到最后一个数，将最后的一个数也删除。
//按照刚才删除的顺序，把这些删除的数按顺序串连起来就是Mary的QQ号。
//比如这个qq号是：123456 删除后连起来的数是：
//1
//34562
//3
//5624
//5
//246
//2
//64
//6
//4
//=
//135264




//if(){} 只判断一次


//while 语句执行后自动循环判断

function test(str){
    var arr1=str.split("");
    var arr2=[];
    while(arr1.length>0){
        arr2.push(arr1.splice(0,1));
        if(arr1.length>0){
            arr1.push(arr1.splice(0,1));
        }
    }

    console.log(arr2.toString());
};

test("123456");//135264


//(function(qq){
//    var arr = qq.split(''),re=[];
//    while(arr.length){
//        re = re.concat(arr.splice(0,1));
//        arr = arr.concat(arr.splice(0,1));
//    }
//    console.log(re.join(''));
//})('123456');

