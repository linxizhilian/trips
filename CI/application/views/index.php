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

            <div class="row masonry-container">
                <div class="page-header text-center">
                    <h1>
                        今日推荐
                    </h1>
                </div>

                <div class="col-md-3 col-sm-3 item">
                    <div class="thumbnail">
                        <img src="/plugins/assets/images/7.jpeg" alt="">
                        <div class="caption">
                            <p>推荐一</p>
                        </div>
                    </div>
                </div><!--/.item  -->

                <div class="col-md-3 col-sm-3 item">
                    <div class="thumbnail">
                        <img src="/plugins/assets/images/7.jpeg" alt="">
                        <div class="caption">
                            <p>推荐二</p>
                        </div>
                    </div>
                </div><!--/.item  -->

                <div class="col-md-3 col-sm-3 item">
                    <div class="thumbnail">
                        <img src="/plugins/assets/images/7.jpeg" alt="">
                        <div class="caption">
                            <p>推荐三</p>
                        </div>
                    </div>
                </div><!--/.item  -->

                <div class="col-md-3 col-sm-3 item">
                    <div class="thumbnail">
                        <img src="/plugins/assets/images/7.jpeg" alt="">
                        <div class="caption">
                            <p>推荐四</p>
                        </div>
                    </div>
                </div><!--/.item  -->

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
                            <div class="col-md-6 col-sm-6 cat-6 thumbnail">
                                <img src="/plugins/assets/images/7.jpeg" alt="">
                                <div class="caption">
                                    <p>推荐二</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 cat-6 thumbnail">
                                <img src="/plugins/assets/images/7.jpeg" alt="">
                                <div class="caption">
                                    <p>推荐二</p>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="col-md-6 col-sm-6 cat-6 thumbnail">
                                <img src="/plugins/assets/images/7.jpeg" alt="">
                                <div class="caption">
                                    <p>推荐二</p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 cat-6 thumbnail">
                                <img src="/plugins/assets/images/7.jpeg" alt="">
                                <div class="caption">
                                    <p>推荐二</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div style="height:600px;background: pink;">
                            asdfasdf
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
                                <div class="col-md-8 col-sm-8 cat-5 thumbnail">
                                    <img alt="140x140" src="/plugins/assets/images/1.jpeg" />
                                    <div class="caption">
                                        <p>推荐二</p>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 cat-6 thumbnail">
                                    <img alt="140x140" src="/plugins/assets/images/2.jpeg" />
                                    <div class="caption">
                                        <p>推荐二</p>
                                    </div>
                                </div>
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
                                    <div class="col-md-4 col-sm-4 cat-6 thumbnail">
                                        <img alt="140x140" src="/plugins/assets/images/4.jpeg" />
                                        <div class="caption">
                                            <p>推荐二</p>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-8 cat-5 thumbnail">
                                        <img alt="140x140" src="/plugins/assets/images/3.jpeg" />
                                        <div class="caption">
                                            <p>推荐二</p>
                                        </div>
                                    </div>
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
                                <div class="col-md-8 col-sm-8 cat-5 thumbnail">
                                    <img alt="140x140" src="/plugins/assets/images/1.jpeg" />
                                    <div class="caption">
                                        <p>推荐二</p>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 cat-6 thumbnail">
                                    <img alt="140x140" src="/plugins/assets/images/2.jpeg" />
                                    <div class="caption">
                                        <p>推荐二</p>
                                    </div>
                                </div>
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
