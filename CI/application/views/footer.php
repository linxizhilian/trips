<style>
	.footer	{margin: auto;}
	.footer { width:100%; height:120px; background:#2c3a46; }
	.footer .l img { margin-top:30px; }
	.footer .r { margin-left:75px; }
	.footer .r .link { height:32px; line-height:32px; margin-top:28px; }
	.footer .r .link a { font-size:14px; color:#fff; margin-right:43px; }
	.footer .r .p { line-height:32px; font-size:14px; color:#999; }
</style>
<div class="footer">
	<div class="wrap clearfix">
		<div class="l fl">
			<img src="/plugins/img/f_bg.png">
		</div>
		<div class="r fl">
			<div class="link">
				<a href="">联系我们</a>
				<a href="">关于我们</a>
			</div>
			<div class="p">
				Copyright © food666.com. All Rights Reserved.     京ICP证099999号
			</div>
		</div>
	</div>
</div>
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
