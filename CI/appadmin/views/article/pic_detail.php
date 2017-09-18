<?php
$this->load->view('header');
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">图片详情</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> 图片详情</h2>

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
                <div class="box-content">
                    <div>
                        <label>文章ID：</label>
                        <span><?php echo $data['id']; ?></span>
                    </div><br>
                    <table class="table table-striped table-bordered responsive" id="table_data">
                        <thead>
                            <tr>
                                <th>图片</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>picname</td>
                                <?php
                                    echo "<td>";
                                    echo"<a class=\"btn btn-info\" href=\"#\" onclick=\"see_pic(this)\" pic=\"{$data['picname']}\">";
                                    echo"<i class=\"glyphicon glyphicon-edit icon-white\"></i> 查看图片</a> ";
                                    echo" <a class=\"btn btn-info\" href=\"#\" onclick=\"repic_up(this)\" id=\"{$data['id']}\" which=\"picname\" pic= \"{$data['picname']}\" data-toggle=\"modal\" data-target=\"#re_myModal\">";
                                    echo"<i class=\"glyphicon glyphicon-edit icon-white\"></i> 重传图片</a> ";
                                    echo "</td>";
                                ?>
                            </tr>
                            <tr>
                                <td>picname2</td>
                                <?php
                                    if(empty($data['picname2'])){
                                        echo "<td>";
                                        echo"<a class=\"btn btn-info\" href=\"#\" onclick=\"pic_up(this)\" id=\"{$data['id']}\" which=\"picname2\" data-toggle=\"modal\" data-target=\"#myModal\">";
                                        echo"<i class=\"glyphicon glyphicon-edit icon-white\"></i> 上传图片</a> ";
                                        echo "</td>";
                                    }else{
                                        echo "<td>";
                                        echo"<a class=\"btn btn-info\" href=\"#\" onclick=\"see_pic(this)\" pic=\"{$data['picname2']}\">";
                                        echo"<i class=\"glyphicon glyphicon-edit icon-white\"></i> 查看图片</a> ";
                                        echo" <a class=\"btn btn-info\" href=\"#\" onclick=\"repic_up(this)\" id=\"{$data['id']}\" which=\"picname2\" pic= \"{$data['picname2']}\" data-toggle=\"modal\" data-target=\"#re_myModal\">";
                                        echo"<i class=\"glyphicon glyphicon-edit icon-white\"></i> 重传图片</a> ";
                                        echo "</td>";
                                    }
                                ?>
                            </tr>
                            <tr>
                                <td>picname3</td>
                                <?php
                                    if(empty($data['picname3'])){
                                        echo "<td>";
                                        echo"<a class=\"btn btn-info\" href=\"#\" onclick=\"pic_up(this)\" id=\"{$data['id']}\" which=\"picname3\" data-toggle=\"modal\" data-target=\"#myModal\">";
                                        echo"<i class=\"glyphicon glyphicon-edit icon-white\"></i> 上传图片</a> ";
                                        echo "</td>";
                                    }else{
                                        echo "<td>";
                                        echo"<a class=\"btn btn-info\" href=\"#\" onclick=\"see_pic(this)\" pic=\"{$data['picname3']}\">";
                                        echo"<i class=\"glyphicon glyphicon-edit icon-white\"></i> 查看图片</a> ";
                                        echo" <a class=\"btn btn-info\" href=\"#\" onclick=\"repic_up(this)\" id=\"{$data['id']}\" which=\"picname3\" pic= \"{$data['picname3']}\" data-toggle=\"modal\" data-target=\"#re_myModal\">";
                                        echo"<i class=\"glyphicon glyphicon-edit icon-white\"></i> 重传图片</a> ";
                                        echo "</td>";
                                    }
                                ?>
                            </tr>
                        </tbody>
                        <?php
                            if(!empty($msg)){
                                echo "<script>alert('{$msg}')</script>";
                            }
                        ?>
                    </table>
                    <!-- 弹出框 上传图片-->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content" style="font-size: 16px;">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">上传图片</h4>
                          </div>
                          <form role="form" action="/Article/pic_up" method="post" enctype="multipart/form-data">
                              <div class="form-group modal-body">
                                <label for="InputFile">上传图片</label>
                                <input type="file" id="InputFile" name="userfile">
                                <p class="help-block">jpeg、png、gif、jpg</p>
                              </div>
                                <input type="hidden" id="id" name="id" value=""/>
                                <input type="hidden" id="which" name="which" value=""/>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">确定</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- model end -->
                    <!-- 弹出框 重传图片-->
                    <div class="modal fade" id="re_myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content" style="font-size: 16px;">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">重传图片</h4>
                          </div>
                          <form role="form" action="/Article/repic_up" method="post" enctype="multipart/form-data">
                              <div class="form-group modal-body">
                                <label for="InputFile">重传图片</label>
                                <input type="file" id="InputFile" name="userfile">
                                <p class="help-block">jpeg、png、gif、jpg</p>
                              </div>
                                <input type="hidden" id="re_id" name="id" value=""/>
                                <input type="hidden" id="re_which" name="which" value=""/>
                                <input type="hidden" id="old_pic" name="pic" value=""/>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">确定</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- model end -->
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function see_pic(obj){
        var pic = $(obj).attr('pic');
        var p = dialog({
        title:'查看图片',
        content:'<img src="../uploads/'+pic+'">',
        quickClose: true
        })
        p.show(obj);
    }

    //上传图片id赋值
    function pic_up(obj){
        var id = $(obj).attr('id');
        var wh = $(obj).attr('which');
        $('#id').val(id);
        $('#which').val(wh);
    }

    //重传图片
    function repic_up(obj){
        var id = $(obj).attr('id');
        var wh = $(obj).attr('which');
        var pic = $(obj).attr('pic');
        $('#re_id').val(id);
        $('#re_which').val(wh);
        $('#old_pic').val(pic);
    }

</script>
<?php
$this->load->view('footer');
?>
