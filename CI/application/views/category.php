<?php
$this->load->view('header');
?>
<body id="index" class="main-container main-category">
<div class="row masonry-container  container-fluid">
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
					<div class="item active">
						<img animal src="/plugins/assets/images/1.jpeg" alt="...">
						<div class="carousel-caption">
						</div>
					</div>
					<div class="item">
						<img animal src="/plugins/assets/images/3.jpeg" alt="...">
						<div class="carousel-caption">
						</div>
					</div>
					<div class="item">
						<img animal src="/plugins/assets/images/7.jpeg" alt="...">
						<div class="carousel-caption">
						</div>
					</div>
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
			</ul>

			<!-- 分类列表 -->
			<div class="media-container">
                <?php if (isset($empty)) echo "本分类暂无文章,以下是全部文章";?>

				<?php foreach ($article as $key => $aid):?>
                <a target="_blank" href="<?php echo $aid['article_url']?>">
                    <div class="tour-item clear">
                        <div class="tour-item-hd col-sm-12 col-md-5 col-lg-5">
                            <img animal class="lazy_src" img_src="<?php echo $aid['img_url']?>" alt="<?php echo $aid['instruction']?>">
                        </div>
                        <div class="tour-item-bd col-sm-12 col-md-7 col-lg-7">
                            <h3><?php echo $aid['instruction']?></h3>
                            <ul class="list-style-dot">
                                <li>Tour code: CL-D-04B</li>
                                <li>Available: Daily</li>
                                <li>Duration: Beijing Four Full Days</li>
                                <li>Starts/ends: On your request</li>
                                <li>Attractions: The Great Wall at Mutianyu, Tian’anmen Square, the Forbidden City, Temple of Heaven, Olympic Stadiums, Summer Palace; Lama Temple, Jingshan Park, Beihai Park, Confucius Temple, Beijing Zoo (Panda House), National Museum, Acrobatic show or Kongfu show</li>
                            </ul>
                        </div>
                    </div>
                </a>
				<?php endforeach; ?>
			</div>

		</div>
	</div>
</div>

<?php
$this->load->view('footer');
?>

<script>
	$(document).ready(function () {
		console.log(' -- 分组初始化 -- ')


	});
</script>


