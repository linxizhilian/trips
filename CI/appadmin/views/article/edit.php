<?php
$this->load->view('header');
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">修改模块文章</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> 修改模块文章</h2>

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
                        <form role="form" action="/Article/doedit" method="post" enctype="multipart/form-data" onsubmit="return sub();">
                            <div class="form-group">
                                <label for="type">*所属模块* : </label>
                                <span>
                                    <?php
                                        if(!empty($editinfo)){
                                            echo $type[$editinfo['typeid']];
                                        }
                                      ?>
                                  </span>
                            </div>
                            <div class="form-group">
                                <label for="content">*编辑模块内容*</label>
                                <script id="editor" type="text/plain" style="width:1024px;height:500px;"><?php if(!empty($editinfo['content'])){echo $editinfo['content'];}?></script>
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
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" class="form-control" id="pid" name="pid" value="<?php echo $editinfo['pid']; ?>">
                            <input type="hidden" class="form-control" id="ucontent" name="content" value="">
                            <button type="submit" class="btn btn-default">提交</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8" src="/plugins/uedit/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/plugins/uedit/ueditor.all.min.js"> </script>
<script type="text/javascript">
    var ue = UE.getEditor('editor');
    function sub(){
        var uedit = UE.getEditor('editor').hasContents();
        if(uedit){
            var content = UE.getEditor('editor').getContent();
            $('#ucontent').val(content);
            return true;
        }else{
            alert('内容不能为空');
            return false;
        }
    }
</script>
<?php
$this->load->view('footer');
?>
