<?php
$this->load->view('header');
?>
<body id="index2" class="main-container">
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

					<?php foreach ($lunbo as $key => $aid):?>
                    <div class="item <?php if ($key == 0) echo "active";?>">
                        <a target="_blank" href="<?php echo $article[$aid]['article_url']?>">
                        <img  class="lazy_src" img_src="<?php echo $article[$aid]['img_url']?>" alt="<?php echo $article[$aid]['instruction']?>">
                        <div class="carousel-caption">
							<?php echo $key?>
                        </div>
                        </a>
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

            <div class="row masonry-container">
                <div class="page-header text-center">
                    <h1>
                        今日推荐
                    </h1>
                </div>
				<?php foreach ($tuijian as $aid):?>
                <div class="col-md-3 col-sm-3 item">
                    <div class="thumbnail">
                        <a target="_blank" href="<?php echo $article[$aid]['article_url']?>">
                        <img class="lazy_src" img_src="<?php echo $article[$aid]['img_url']?>" alt="<?php echo $article[$aid]['instruction']?>">
                        <div class="caption">
                            <p><?php echo $article[$aid]['instruction']?></p>
                        </div>
                        </a>
                    </div>
                </div><!--/.item  -->
				<?php endforeach; ?>
            </div>

            <div class="row masonry-container  container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="page-header">
                            <h1>
                                Day Tour
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="col-md-8 col-sm-8">
                        <div class="row-fluid">
							<?php foreach ($all_category[2]['aids'] as $key => $aid):?>
								<?php
									if ($key >3)
									{
										continue;
									}
								?>
                            <div class="col-md-6 col-sm-6  thumbnail">
                                <a target="_blank" href="<?php echo $article[$aid]['article_url']?>">
                                <img class="lazy_src" img_src="<?php echo $article[$aid]['img_url']?>" alt="<?php echo $article[$aid]['instruction']?>">
                                <div class="caption">
                                    <p><?php echo $article[$aid]['instruction']?></p>
                                </div>
                                </a>
                            </div>
							<?php endforeach; ?>
							<?php
								if ($key == 1)
							{

							?>
						</div>
						<div class="row-fluid">
							<?php
							}
							?>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div style="height:600px;background: pink;">
                            今日推荐阿萨德法师打发斯蒂芬中XCV自行车va撒地方对每一个人都说还好我的心我的情只要我对你好这样的温柔你要不要
							扮演什么角色我都会
							其实你爱我伤心任何的表情我都能给
                        </div>
                    </div>
                </div>
            </div>


            <div class="row masonry-container container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="page-header">
                            <h1>
                                Day Over
                            </h1>
                        </div>
                        <div class="container-fluid">
                            <div class="row-fluid">
                                <?php foreach ($all_category[3]['aids'] as $key => $aid):?>
                                    <?php
                                    if ($key >1)
                                    {
                                        continue;
                                    }
                                    ?>

                                <div class="col-md-<?php echo ($key == 1) ? 'col-md-4 col-sm-4 ': 'col-md-8 col-sm-8 ' ?> thumbnail">
                                    <a target="_blank" href="<?php echo $article[$aid]['article_url']?>">
                                    <img class="lazy_src" img_src="<?php echo $article[$aid]['img_url']?>" alt="<?php echo $article[$aid]['instruction']?>" />
                                    <div class="caption">
                                        <p><?php echo $article[$aid]['instruction']?></p>
                                    </div>
                                    </a>
                                </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row masonry-container container-fluid">
                <div class="row-fluid">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h1>
                                Hiking
                            </h1>
                        </div>
                        <div class="row-fluid">
                            <div class="col-md-12">
                                <div class="row-fluid">
                                    <?php foreach ($all_category[4]['aids'] as $key => $aid):?>
                                        <?php
                                        if ($key >1)
                                        {
                                            continue;
                                        }
                                        ?>

                                        <div class="col-md-<?php echo ($key != 1) ? 'col-md-4 col-sm-4 ': 'col-md-8 col-sm-8 ' ?> thumbnail">
                                            <a target="_blank" href="<?php echo $article[$aid]['article_url']?>">
                                            <img class="lazy_src" img_src="<?php echo $article[$aid]['img_url']?>" alt="<?php echo $article[$aid]['instruction']?>" />
                                            <div class="caption">
                                                <p><?php echo $article[$aid]['instruction']?></p>
                                            </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row masonry-container container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="page-header">
                            <h1>
                                Driver
                            </h1>
                        </div>
                        <div class="container-fluid">
                            <div class="row-fluid">
                                <?php foreach ($all_category[5]['aids'] as $key => $aid):?>
                                    <?php
                                    if ($key >1)
                                    {
                                        continue;
                                    }
                                    ?>

                                    <div class="col-md-<?php echo ($key != 1) ? 'col-md-4 col-sm-4 ': 'col-md-8 col-sm-8 ' ?> thumbnail">
                                        <a target="_blank" href="<?php echo $article[$aid]['article_url']?>">
                                        <img class="lazy_src" img_src="<?php echo $article[$aid]['img_url']?>" alt="<?php echo $article[$aid]['instruction']?>" />
                                        <div class="caption">
                                            <p><?php echo $article[$aid]['instruction']?></p>
                                        </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!--			杂项 下面添加-->
			<div class="row masonry-container container-fluid">

				<div>
					<?php echo $index_bootm['value'];?>
				</div>

			</div>
        </div>
    </div>
</div>

	<?php
$this->load->view('footer');
?>
