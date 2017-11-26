// JavaScript Document
console.log(222);

$(function () {

//图片站详情页切换小图
  (function () {

    var oPageC = document.getElementById('pageCenter');

    if (oPageC) {

      var aLeft = getByClass(oPageC, 'a', 'left')[0];
      var aRight = getByClass(oPageC, 'a', 'right')[0]
      var oUl = oPageC.getElementsByTagName('ul')[0];
      var aLiW = 129;
      var len = oPageC.getElementsByTagName('li').length;
      var index = (parseInt(document.getElementById('pages').innerHTML) - 1);
      oUl.style.width = len * aLiW + 'px';
      oUl.style.left = -(index * aLiW) + 'px';

      if (len > 5) {
        aRight.onclick = function () {
          index++;

          if (index > len - 5) {
            index = index - 1;
          } else {
            oUl.style.left = oUl.offsetLeft - aLiW + 'px';
          }
          ;
        };
        aLeft.onclick = function () {
          index--;
          if (index < 0) {
            index = 0
          } else {
            oUl.style.left = oUl.offsetLeft + aLiW + 'px';
          }
        };
      }
    }
  })();
//图片站详情页切换小图


  (function () { //百科浮动楼层
    var oFix = document.getElementById('fix');

    if (oFix) {

//初始化数据
      var aqiData = {
        index: 0,
        srolltop: 0,
        arr: []
      };

//加载完成的数据
      function aqiLoad() {
        console.log('aqiLoad = ')
        var tagName = $('.common > .animal');
        var scrolltop = getScrollTop();
        var arr = [];
        for (var i = 0; i < tagName.length; i++) {
          arr.push(getPos(tagName[i]).top);
        }
        ;
        aqiData.arr = arr;
        aqiData.srolltop = scrolltop;
      }

//渲染dom
      function aqiDom() {
        for (var i = 0; i < $('#fix li').length; i++) {
          removeClass($('#fix li')[i], 'active');
        }
        addClass($('#fix li')[aqiData.index], 'active');
        window.scroll(0, aqiData.srolltop);
      };

      // 定位  dom
      function initPositionAqiDom() {
        var windowScroll = getScrollTop();
        var pos = getPos(document.getElementsByClassName('baike')[0]).top
        if(windowScroll >= pos) {
          document.getElementById('fix').style.top = 0 + 'px'
        }
      };

//滚动条的事件
      function aqiScroll() {
        var scrolltop = getScrollTop();
        var arr = aqiData.arr;
        aqiData.srolltop = scrolltop;
        for (var i = 0; i < arr.length; i++) {
          if (scrolltop > arr[arr.length - 1]) {
            aqiData.index = arr.length - 1;
            break;
          } else if (arr[i] < scrolltop && scrolltop < arr[i + 1]) {
            aqiData.index = i;
            break;
          }
        }
        //alert( getPos(oFix).top )
        if (scrolltop > arr[0]) {
          oFix.style.top = 0 + 'px'
        } else {
          oFix.style.top = (arr[0] - scrolltop) + 'px'
        }
        aqiDom();
      }


//li点击函数
      function aqiClick() {
        aqiData.index = this.index;
        aqiData.srolltop = aqiData.arr[this.index];
        aqiDom();
      }

//初始化
      function init() {
        //给Li绑定函数
        var oLi = oFix.getElementsByClassName('router');
        for (var i = 0; i < oLi.length; i++) {
          oLi[i].index = i;
          band(oLi[i], 'click', aqiClick)
        }
        console.log(22);
        //绑定滚动事件
        band(window, 'scroll', aqiScroll)

        //数据初始化
        aqiLoad()
        initPositionAqiDom()
        aqiDom();
      }
      init();
    }

  })();
//浮层结束 end

//轮播图
  (function () {

    var oBanner = document.getElementById('banner');

    if (oBanner) {
      var aqiIndex = 0; //数据
      var num = 0;
      var timer = null;
      var len = null;
      var w = $('.banImg')[0].offsetWidth;

//重置数据
      function aqiReast() {
        $('.banImg>div')[0].innerHTML += $('.banImg>div')[0].innerHTML;
        $('.banText>div')[0].innerHTML += $('.banText>div')[0].innerHTML;
        len = $('.banImg div a').length;
        $('.banImg>div')[0].style.width = $('.banText>div')[0].style.width = w * len + 'px';
        addClass($('.banNum li')[0], 'active');
      };

//渲染Dom
      function aqiRender() {
        $('.banImg>div').animate({

          left: -aqiIndex * w + 'px'
        });
        $('.banText>div').animate({
          left: -aqiIndex * w + 'px'
        });
        for (var i = 0; i < $('.banNum li').length; i++) {
          removeClass($('.banNum li')[i], 'active')
        }
        addClass($('.banNum li')[num], 'active')
      }

//自动切换
      function aqiTab() {
        clearInterval(timer);
        timer = setInterval(function () {
          if (aqiIndex >= len / 2) {
            aqiIndex = 1;
            $('.banImg>div')[0].style.left = '0px';
            $('.banText>div')[0].style.left = '0px';
          } else {
            aqiIndex++;
          }
          if (num >= len / 2 - 1) {
            num = 0;
          } else {
            num++;
          }
          aqiRender();
        }, 2000);
      };
//手动切换  over
      function aqiMan() {

        clearInterval(timer);
        aqiIndex = this.index;
        num = this.index;
        aqiRender();

      };
//手动切换  out
      function aqiQan() {
        clearInterval(timer);
        aqiTab();
      };

//初始化
      function init() {
        aqiReast();
        aqiTab();
        //Li绑定事件
        for (var i = 0; i < $('.banNum li').length; i++) {
          $('.banNum li')[i].index = i;
          band($('.banNum li')[i], 'mouseover', aqiMan);
          band($('.banNum li')[i], 'mouseout', aqiQan);
        }
      }

      init();

    }

  })();
//轮播图结束

//shop切换 轮播
  (function () {
    var oShopTab = $('.shopTab');
    var oShopTab1 = $('.shopTab1');
    var oBrandTab = $('.brandTab');
    if (oShopTab.length || oShopTab1.length || oBrandTab.length) {

      function allTab(obj) {
        var w = obj[0].getElementsByTagName('li')[0].offsetWidth;
        var childrenUl = obj[0].getElementsByTagName('ul')[0];
        childrenUl.innerHTML += childrenUl.innerHTML;
        var len = childrenUl.getElementsByTagName('li').length;

        var aqiIndex = 0;
        var timer = null;

        //数据重置
        function aqiReast() {
          childrenUl.style.width = w * len + 'px';
        };
        //渲染dom
        function aqiRender() {
          $(childrenUl).animate({
            left: -aqiIndex * w + 'px'
          });
        };
        //自动切换
        function aqiAuto() {
          clearInterval(timer);
          timer = setInterval(function () {

            if (aqiIndex >= len / 2) {
              aqiIndex = 1;
              childrenUl.style.left = '0px';
            } else {
              aqiIndex++;
            }
            aqiRender();
          }, 3000);
        };
        //清除定时器
        function aqiClear() {

          clearInterval(timer);
        }

        function aqiSet() {
          aqiAuto();
        }

        //左右按钮点击事件
        function aqiLeft() {
          if (aqiIndex >= len / 2) {
            aqiIndex = 1;
            childrenUl.style.left = '0px';
          } else {
            aqiIndex++;
          }
          aqiRender();
        }

        function aqiRight() {
          if (aqiIndex <= 0) {
            aqiIndex = len / 2 - 1;
            childrenUl.style.left = -len / 2 * w + 'px';
          } else {
            aqiIndex--;
          }
          aqiRender();
        }

        //初始化
        function init() {
          aqiReast();
          aqiAuto();
          //清除事件
          band(obj[0], 'mouseover', aqiClear);
          band(obj[0], 'mouseout', aqiSet);
          //左右按钮点击事件
          band(obj.children('a.left')[0], 'click', aqiLeft);
          band(obj.children('a.right')[0], 'click', aqiRight);
        };

        init();
      };
      allTab(oShopTab);
      allTab(oShopTab1);
      allTab(oBrandTab);

    }
  })();
//shop切换 轮播  end

//tab切换
  (function () {

    var oTab = $('.tab');
    if (oTab.length) {
      function allTab(obj) {

        var oLi = obj[0].getElementsByTagName('li');
        var oDiv = getByClass(obj[0], 'div', 'tabChildren')[0].children;
        var aqiIndex = 0;
//数据重置
        function aqiReast() {
          addClass(oLi[0], 'active');
          oDiv[0].style.display = 'block';
        };
//渲染dom
        function aqiRender() {
          for (var i = 0; i < oLi.length; i++) {
            oLi[i].index = i;
            oLi[i].onclick = function () {
              oDiv[aqiIndex].style.display = 'none';
              removeClass(oLi[aqiIndex], 'active');
              oDiv[this.index].style.display = 'block';
              addClass(this, 'active');
              aqiIndex = this.index;
            }
          }
        };

//初始化
        function init() {
          aqiReast();
          aqiRender();
        }

        init();

      }

      allTab(oTab);

    }

  })();
//tab切换  end

//图片站首页的图片切换
  (function () {
    var oOther = document.getElementById('other');
    var oOtherImg = document.getElementById('otherImg');
    var index = 0;
    if (oOther) {

      var aA = oOtherImg.getElementsByTagName('a');
      aA[0].style.display = 'block';

      var aDl = oOther.getElementsByTagName('dl');

      for (var i = 0; i < aDl.length; i++) {
        aDl[i].index = i;
        aDl[i].onmouseover = function () {
          aA[index].style.display = 'none';
          aA[this.index].style.display = 'block';
          index = this.index;
        };
      }
      ;


    }
  })();
//图片站首页的图片切换


//search start
  (function () {
    var oSearch = document.getElementById('search');
    var value = null;
    if (oSearch) {

      oSearch.word.onfocus = function () {

        if (this.value === '爱宠名字 健康常识' || this.value === '') {
          this.value = '';
        }
      };
      oSearch.word.onblur = function () {
        if (this.value === '') {
          this.value = '爱宠名字 健康常识';
        }
      };
      oSearch.onsubmit = function () {
        value = oSearch.word.value;
        if (value === '' || value === '爱宠名字 健康常识') {
          alert('请输入搜索内容')
          return false;
        }
        location.href = 'http://www.lelezone.com/search/' + value + '.html';
        return false;
      }

    }
    ;

  })();
//search end


});
//通过class选择元素start
function getByClass(id, tagName, className) {
  var iClass = id.getElementsByTagName(tagName);
  var arr = [];

  for (var i = 0; i < iClass.length; i++) {
    var ccc = iClass[i].className.split(' ');
    for (var j = 0; j < ccc.length; j++) {
      if (ccc[j] == className) {
        arr.push(iClass[i]);
        break;
      }
      ;
    }
    ;
  }
  ;

  return arr;
};
//通过class选择元素end


function band(obj, ev, fn) {
  return obj.addEventListener ? obj.addEventListener(ev, fn, false) : obj.attachEvent('on' + ev, fn);
}
function getStyle(obj, json) {
  for (var attr in json) {
    obj.style[atte] = json[attr];
  }
}
function getPos(obj) {
  var pos = {
    top: 0,
    left: 0
  };
  while (obj) {
    pos.top += obj.offsetTop;
    pos.left += obj.offsetLeft;
    obj = obj.offsetParent;
  }
  ;
  return pos;
};
function addClass(obj, className) {
  //分为俩种情况  一种就是如果它本身没有class的时候 和它本身有class的时候
  if (obj.className == '') {
    obj.className = className;
  } else {
    var arrClass = obj.className.split(' ');
    var numClass = arrClassName(arrClass, className);
    if (numClass == -1) {
      obj.className += ' ' + className;
    }
    ;
  }
  ;
};
function arrClassName(arr, cn) {
  for (var i = 0; i < arr.length; i++) {
    if (arr[i] == cn) {
      return 1;
    }
    ;
  }
  ;
  return -1;
};
//添加class end

//移除class start
function removeClass(obj, className) {
  var arr = [];
  var arrClass = obj.className.split(' ');
  for (var i = 0; i < arrClass.length; i++) {
    arr.push(arrClass[i]);
  }
  ;
  for (var j = 0; j < arr.length; j++) {
    if (arr[j] == className) {
      arr.splice(j, 1);
    }
    ;
  }
  ;

  obj.className = arr.join(' ');
};
//移除class end

function getScrollTop() {
  var scrollPos;
  if (window.pageYOffset) {
    scrollPos = window.pageYOffset;
  } else if (document.compatMode && document.compatMode != 'BackCompat') {
    scrollPos = document.documentElement.scrollTop;
  } else if (document.body) {
    scrollPos = document.body.scrollTop;
  }
  return scrollPos;
}
//滚动条距离





