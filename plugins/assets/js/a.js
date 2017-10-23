(function(){ //百科浮动楼层
var oFix = document.getElementById('fix');

if( oFix ){

//初始化数据
var aqiData = {
	index : 0,
	srolltop : 0,
	arr : []
};

//加载完成的数据
function aqiLoad(){
	var tagName = $('.common > .animal');
	var scrolltop = getScrollTop();
	var arr = [];
	for( var i=0; i<tagName.length; i++ ){
		arr.push( getPos(tagName[i]).top );
	};
	aqiData.arr = arr;
	aqiData.srolltop = scrolltop;
}

//渲染dom
function aqiDom(){
	for(var i=0; i<$('#fix li').length; i++){
		removeClass($('#fix li')[i] , 'active' );
	}
	addClass( $('#fix li')[aqiData.index] , 'active' );
	window.scroll(0,aqiData.srolltop);
};

//滚动条的事件
function aqiScroll(){
	var scrolltop = getScrollTop();
	var arr = aqiData.arr;
	aqiData.srolltop = scrolltop;
	for( var i=0; i<arr.length; i++ ){
		if( scrolltop > arr[ arr.length-1 ] ){
			aqiData.index = arr.length-1;
			break;
		}else if( arr[i] < scrolltop && scrolltop < arr[i+1] ){
			aqiData.index = i;
			break;
		}
	}
	//alert( getPos(oFix).top )
	if( scrolltop > arr[0] ){
		oFix.style.top = 0 + 'px'
	}else{
		oFix.style.top = (arr[0] - scrolltop) + 'px'
	}
	aqiDom();
}


//li点击函数
function aqiClick(){

	aqiData.index = this.index;
	aqiData.srolltop = aqiData.arr[this.index];
	aqiDom();
}

//初始化
function init(){

	//给Li绑定函数
	var oLi = oFix.getElementsByTagName('li');
	for( var i=0; i<oLi.length; i++ ){
		oLi[i].index = i;
		band( oLi[i] , 'click' , aqiClick )
	}
	//绑定滚动事件
	band( window , 'scroll' , aqiScroll );

	//数据初始化
	aqiLoad()
	aqiDom();
}
init();

}

})();
//浮层结束 end