<?php
$this->load->view('header');
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="/Category/add_xqk">新增模块</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> 新增模块</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    <div class="box-content">
                        <form role="form" action="/Category/doadd_xqk" method="post">
                            <div class="form-group">
                                <label for="part">块名称</label>
                                <input type="text" class="form-control" id="part" name="part" placeholder="块名称">
                            </div>
                            <div class="form-group">
                                <label for="note">备注</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="备注">
                            </div>
                            <div class="">
                                <span style="color:red;">
                                    <?php
                                            if(!empty($info)){
                                                echo $info['msg'];
                                            }
                                    ?>
                                </span>
                            </div><br>
                            <button type="submit" class="btn btn-default">提交</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('footer');
?>
