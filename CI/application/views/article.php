<?php
$this->load->view('header');
?>
<!---->
<!--<link href="http://s.lelezone.com/baike/css/base.css?v=1213" rel="stylesheet" type="text/css"/>-->
<!--<link href="http://s.lelezone.com/baike/css/content.css?v=20170102" rel="stylesheet" type="text/css"/>-->

<body id="index2" class="main-container">
<div class="row masonry-container  container-fluid">
    <div class="row-fluid">
        <div class="span12">
                <?php
                $this->load->view('nav');
                ?>

            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <ol data-target="#carousel-example-generic" data-slide-to="0" class="active"></ol>
                    <ol data-target="#carousel-example-generic" data-slide-to="1"></ol>
                    <ol data-target="#carousel-example-generic" data-slide-to="2"></ol>
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
                <ol>
                    <a href="#">主页</a> <span class="divider">/</span>
                </ol>
                <ol>
                    <a href="#">类目</a> <span class="divider">/</span>
                </ol>
                <ol class="active">
                    主题
                </ol>
            </ul>


            <!--content start-->
            <div>
                <pre>
                Tour code: CL-D-01A                                                                                                     Available: Daily

                Duration: One Full Day                                                                                                  Starts/ends: On your request

                Attractions: Tian’anmen Square, Forbidden City & Great Wall at Mutianyu
                </pre>
            </div>


            <div class="baike clear">
                <div class="common col-md-9 col-sm-9" style="color: #0B90C4;float: right;">

                    <?php foreach ($all_content as $key => $value):?>

                        <div class="animal">
                            <h2><?php echo $part[$value['typeid']]['part'] ;?></h2>

                            <div style="height:600px;">
                                <?=$value['content']?>
                            </div>

                        </div>

                    <?php endforeach; ?>
                </div>


                <!--fix   start-->
                <div class="article-nav-bar fix col-md-2 col-sm-2" style="color: #1f8c22;" id="fix" >
                    <ul>
                        <?php foreach ($all_content as $key => $value):?>

                        <li class="bg<?=$key?>" style="height: 50px;background-color: #0bcb9a;margin-bottom: 2px;"><?php echo $part[$value['typeid']]['part'] ;?></li>
                        <?php endforeach; ?>

                    </ul>
                </div>
                <!--fix   end-->
            </div>

            <!--content end-->
        </div>
    </div>
</div>
<?php
$this->load->view('footer');
?>


