<?php
$this->load->view('header');
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="/Home/edit">编辑杂项</a>
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
                        <form role="form" action="/Home/doedit" method="post" onsubmit="return subtest();">
                            <div class="form-group">
                                <label for="key">杂项名称</label>
                                <input type="text" class="form-control" id="key" name="key" placeholder="key" value="<?php if(!empty($edit)){echo $edit['key'];} ?>">
                            </div>
                            <div class="form-group">
                                <label for="value">内容</label>
                                <input type="text" class="form-control" id="value" name="value" placeholder="内容" value="<?php if(!empty($edit)){echo $edit['value'];} ?>">
                            </div>
                            <div class="form-group">
                                <label for="note">备注</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="备注" value="<?php if(!empty($edit)){echo $edit['note'];} ?>">
                            </div>
                            <div class="">
                                <span style="color:red;" id="shown" hidden>杂项名称和内容都不能为空</span>
                            </div><br>
                            <input type="hidden" class="form-control" name="id"  value="<?php if(!empty($edit)){echo $edit['id'];} ?>">
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
<script type="text/javascript">
    function subtest(){
        var key = $.trim($('#key').val());
        var value = $.trim($('#value').val());
        if((key.length >0)&&(value.length >0)){
            return true;
        }else{
            $('#shown').show();
            return false;
        }
    }
</script>
