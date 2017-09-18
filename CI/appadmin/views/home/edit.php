<?php
$this->load->view('header');
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">编辑杂项</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> 编辑杂项</h2>

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
                        <form role="form" action="/Home/doedit" method="post" enctype="multipart/form-data" onsubmit="return subtest();">
                            <div class="form-group">
                                <label for="key">杂项名称</label>
                                <input type="text" class="form-control" id="key" name="key" placeholder="key" value="<?php if(!empty($edit)){echo $edit['key'];} ?>">
                            </div>
                            <div class="form-group">
                                <label for="value">内容</label>
                                <script id="editor" type="text/plain" style="width:1024px;height:500px;"><?php if(!empty($edit)){echo $edit['value'];}?></script>
                            </div>
                            <div class="form-group">
                                <label for="note">备注</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="备注" value="<?php if(!empty($edit)){echo $edit['note'];} ?>">
                            </div>
                            <div class="">
                                <span style="color:red;" id="shown" hidden>杂项名称和内容都不能为空</span>
                            </div><br>
                            <input type="hidden" class="form-control" name="id"  value="<?php if(!empty($edit)){echo $edit['id'];} ?>">
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
    function subtest(){
        var uedit = UE.getEditor('editor').hasContents();
        var content = UE.getEditor('editor').getContent();
        var key = $.trim($('#key').val());
        if((key.length >0) && uedit){
            $('#ucontent').val(content);
            return true;
        }else{
            $('#shown').show();
            return false;
        }
    }
</script>
<?php
$this->load->view('footer');
?>

