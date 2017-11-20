
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

            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="/plugins/assets/images/1.jpeg" alt="...">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <div class="item">
                        <img src="/plugins/assets/images/3.jpeg" alt="...">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <div class="item">
                        <img src="/plugins/assets/images/7.jpeg" alt="...">
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

            <!-- 文章类表 -->
            <div class="col-md-12 col-sm-12" style="padding: 0;">
                <ul class="thumbnails" style="padding: 0;">
                    <li class="col-md-4 col-sm-4" style="margin-bottom: 15px;">
                        <div class="thumbnail">
                            <img alt="300x200" src="/plugins/assets/images/2.jpeg" />
                            <div class="caption">
                                <p>
                                    冯诺尔曼结构
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="col-md-4 col-sm-4" style="margin-bottom: 15px;">
                        <div class="thumbnail">
                            <img alt="300x200" src="/plugins/assets/images/2.jpeg" />
                            <div class="caption">
                                <p>
                                    哈佛结构
                                </p>


                            </div>
                        </div>
                    </li>
                    <li class="col-md-4 col-sm-4" style="margin-bottom: 15px;">
                        <div class="thumbnail">
                            <img alt="300x200" src="/plugins/assets/images/2.jpeg" />
                            <div class="caption">
                                <p>
                                    改进型哈佛结构
                                </p>


                            </div>
                        </div>
                    </li>
                    <li class="col-md-4 col-sm-4" style="margin-bottom: 15px;">
                        <div class="thumbnail">
                            <img alt="300x200" src="/plugins/assets/images/2.jpeg" />
                            <div class="caption">
                                <p>
                                    改进型哈佛结构
                                </p>


                            </div>
                        </div>
                    </li>
                    <li class="col-md-4 col-sm-4" style="margin-bottom: 15px;">
                        <div class="thumbnail">
                            <img alt="300x200" src="/plugins/assets/images/2.jpeg" />
                            <div class="caption">
                                <p>
                                    改进型哈佛结构
                                </p>


                            </div>
                        </div>
                    </li>
                    <li class="col-md-4 col-sm-4" style="margin-bottom: 15px;">
                        <div class="thumbnail">
                            <img alt="300x200" src="/plugins/assets/images/2.jpeg" />
                            <div class="caption">
                                <p>
                                    改进型哈佛结构
                                </p>


                            </div>
                        </div>
                    </li>
                    <li class="col-md-4 col-sm-4" style="margin-bottom: 15px;">
                        <div class="thumbnail">
                            <img alt="300x200" src="/plugins/assets/images/2.jpeg" />
                            <div class="caption">
                                <p>
                                    改进型哈佛结构
                                </p>


                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- 分页 -->
            <nav aria-label="text-center Page navigation">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous">
                            <span aria-hidden="true">上一页</span>
                        </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">下一页</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
</div>


<?php
$this->load->view('footer');
?>
