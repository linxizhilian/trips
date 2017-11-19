<?php
$this->load->view('header');
?>
<body id="index" class="main-container">
<div class="row masonry-container  container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<?php
			$this->load->view('nav');
			?>

<!--			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">-->
<!--				<ol class="carousel-indicators">-->
<!--					<ol data-target="#carousel-example-generic" data-slide-to="0" class="active"></ol>-->
<!--					<ol data-target="#carousel-example-generic" data-slide-to="1"></ol>-->
<!--					<ol data-target="#carousel-example-generic" data-slide-to="2"></ol>-->
<!--				</ol>-->
<!--				<div class="carousel-inner" role="listbox">-->
<!--					<div class="item active">-->
<!--						<img src="/plugins/assets/images/1.jpeg" alt="...">-->
<!--						<div class="carousel-caption">-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="item">-->
<!--						<img src="/plugins/assets/images/3.jpeg" alt="...">-->
<!--						<div class="carousel-caption">-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="item">-->
<!--						<img src="/plugins/assets/images/7.jpeg" alt="...">-->
<!--						<div class="carousel-caption">-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">-->
<!--					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>-->
<!--					<span class="sr-only">Previous</span>-->
<!--				</a>-->
<!--				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">-->
<!--					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>-->
<!--					<span class="sr-only">Next</span>-->
<!--				</a>-->
<!--			</div>-->

			<div class="header-list">
				<a href="/Help/index?a=copyright" class="<?php echo $a == 'copyright'? 'active' : '' ?>">版权声明<i class="arrow"></i></a>
				<a href="/Help/index?a=about" class="<?php echo $a == 'about' ?  'active' : '' ?>">团队介绍<i class="arrow"></i></a>
				<a href="/Help/index?a=contentus" class="<?php echo $a == 'contentus' ?  'active' : '' ?>">联系我们<i class="arrow"></i></a>
			</div>

			<div class="" style="height: ;">
				<?= $content?>
			</div>



		</div>
	</div>
</div>



<?php
$this->load->view('footer');
?>
