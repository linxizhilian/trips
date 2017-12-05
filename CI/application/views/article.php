<?php
$this->load->view('header');
?>
<!---->
<!--<link href="http://s.lelezone.com/baike/css/base.css?v=1213" rel="stylesheet" type="text/css"/>-->
<!--<link href="http://s.lelezone.com/baike/css/content.css?v=20170102" rel="stylesheet" type="text/css"/>-->

<body id="index" class="main-container article-container">
<div class="row masonry-container">
	<div class="row-fluid">
		<div class="span12">
			<?php
			$this->load->view('nav');
			?>
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
					<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					<li data-target="#carousel-example-generic" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner" role="listbox">
					<?php foreach ($pics as $key => $value): ?>
						<div class="item <?php if ($key == 0) echo "active";?>">
							<img class="lazy_src" img_src="<?php echo $value ?>" alt="...">
							<div class="carousel-caption">
							</div>
						</div>
					<?php endforeach; ?>

				</div>
				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>

			<!-- 面包屑 -->
			<ul class="breadcrumb">
				<li><a href="/Index/home">主页</a> <span class="divider"></span></li>
				<li><a href="/Category/index">类目</a> <span class="divider"></span></li>
				<li class="active">主题</li>
			</ul>


			<!--content start-->
			<div>
				<pre>
					>>>>>>>>>>>>>>>>> 我是谁，我在哪儿
					<?php echo empty($title_tag['content']) ? '' : $title_tag['content']; ?>
				</pre>
			</div>

			<div style="text-align: center">
				<div class="baike clear">
					<div class="common">

						<div class="animal">
							<h2>路线-样例</h2>
							<p >路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
								路线路线路线路线路线路线路线路线路线路线路线路线路线
							</p>

						</div>
						<div class="animal">
							<h2>费用-样例</h2>
							<p >费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用
								费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用
								费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用
								费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用费用
							</p>
						</div>

						<div class="animal">
							<h2>车系-样例</h2>
							<p >车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系
								车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系
								车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系
								车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系
								车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系
								车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系车系
							</p>
						</div>


						<?php if (!empty($all_content)): ?>
							<?php foreach ($all_content as $key => $value): ?>
								<div class="animal">
									<h2><?php echo empty($part[$value['typeid']]['part']) ? '' : $part[$value['typeid']]['part']; ?></h2>
									<p >
										<?= $value['content'] ?>
									</p>

								</div>

							<?php endforeach; ?>
						<?php endif; ?>
					</div>


					<!--fix   start-->
					<div class="article-nav-bar" id="fix">
						<ul>
							<li class="router">路线-样例</li>
							<li class="router">费用-样例</li>
							<li class="router">车系-样例</li>
							<?php if (!empty($all_content)): ?>
								<?php foreach ($all_content as $key => $value): ?>
									<?php
									?>
									<li class="router bg<?= $key ?>"><?php echo empty($part[$value['typeid']]['part']) ? '' : $part[$value['typeid']]['part']; ?></li>
								<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</div>
					<!--fix   end-->
				</div>
			</div>


			<!--content end-->
		</div>
	</div>
</div>
<?php
$this->load->view('footer');
?>


