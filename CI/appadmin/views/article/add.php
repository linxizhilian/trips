<?php
$this->load->view('header');
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="/Article/add">新增首页文章</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> 新增首页文章</h2>

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
                        <form role="form" action="/Article/doadd" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="instruction">*文章所属类别*</label>
                                <select class="form-control" name="categoryid" id="categoryid">
                                  <option>--请选择--</option>
                                  <?php
                                    if(!empty($data)){
                                        for($i=0;$i<count($data);$i++){
                                            echo "<option value=\"{$data[$i]['id']}\">{$data[$i]['category']}</option>";
                                        }
                                    }
                                  ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="instruction">*说明文字*</label>
                                <input type="text" class="form-control" id="instruction" name="instruction" placeholder="说明文字">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">*File input*</label>
                                <input type="file" id="userfile" name="userfile">
                            </div>
                            <div class="">
                                <span style="color:red;">
                                    <?php
                                            if(!empty($info)){
                                                echo $info['msg'];
                                            }
                                    ?>
                                </span>
                            </div>
                            <br>
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
