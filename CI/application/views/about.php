<?php
$this->load->view('header');
?>
<body id="index2" class="main-container">
<div class="row masonry-container  container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<ul class="nav nav-tabs">
				<?php
				$this->load->view('nav');
				?>

			</ul>

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


			<div class="container-fluid">
				<div class="row-fluid container-fluid ">

						<div class="tabbable" id="tabs-147073" style="margin: 200px auto; width: 600px;">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#panel-about" data-toggle="tab">关于我们</a>
								</li>
								<li>
									<a href="#panel-contact" data-toggle="tab">联系我们</a>
								</li>
								<li>
									<a href="#panel-pay" data-toggle="tab">Pay for me</a>
								</li>
							</ul>

							<div class="tab-content" style="height: 600px;">
								<div class="tab-pane active" id="panel-about">
									<p>
										关于我们.
									</p>
								</div>
								<div class="tab-pane" id="panel-contact">
									<p>
										联系我们.
									</p>
								</div>
								<div class="tab-pane" id="panel-pay">
									<p>
										Pay for me.
									</p>
								</div>
							</div>
						</div>

				</div>
			</div>
		</div>
	</div>
</div>



<?php
$this->load->view('footer');
?>
