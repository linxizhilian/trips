

<!--link-js-->
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="http://s.lelezone.com/baike/js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="/plugins/assets/js/js.js?v=1213" type="text/javascript"></script>

<script >

	//根据图片样式的宽高动态加载图片地址
	function checkShow() {//检查元素是否在可视范围内
		var winH = $(window).height(),//获取窗口高度
			scrollH = $(window).scrollTop();//获取窗口滚动高度

		$('.lazy_src').each(function () {//遍历每一个元素
			var cur = $(this),
				top = cur.offset().top;//获取元素距离窗口顶部偏移高度

			if (cur.attr('src')) {
				return;
			}//判断是否已加载
			showImg(cur);
			if (top < scrollH + winH + 100) {
				showImg(cur);
			}
		});
	}
	function showImg(el) {
		var width = 'w_' + el.width();
		var height = 'h_' + el.height();
		var url = el.attr('img_src') + height + ',' + width + '.jpg';
		el.attr('src', url);

	}
	// 改变图片的url
	$(function () {
		checkShow();
		$(window).on('scroll', function () {//监听滚动事件
			checkShow();
		});
	});
</script>
</body>
</html>
