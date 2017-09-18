<?php

$this->load->view('header');
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="/Article/lists">首页文章列表</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> 首页文章列表</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                    <!-- <div class="pull-left col-md-3">
                        <input type="text" class="form-control" placeholder="编号" name="searchid" id="searchid">
                    </div>
                    <div class="pull-left col-md-3">
                        <select class="form-control" name="searchtp" id="searchtp">
                            <option value="">--文章所属类别--</option>
                            <?php
                                // if(!empty($stype)){
                                //     for($i=0;$i<count($stype);$i++){
                                //         echo "<option value=\"{$stype[$i]['id']}\"";if(!empty($kp)){echo $kp['searchtp']==$stype[$i]['id']?'selected':'';} echo">{$stype[$i]['category']}</option>";
                                //     }
                                // }
                              ?>
                        </select>
                    </div>
                    <div class="pull-left col-sm-3">
                        <button type="button" class="btn btn-primary" onclick="gosearch()">查询</button>
                    </div>
                    <br><br><br> -->
                    <table class="table table-striped table-bordered responsive" id="table_data">
                        <thead>
                        <tr>
                            <th>编号</th>
                            <th>说明文字</th>
                            <th>文章所属类别</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($data)){
                            for($i=0;$i<count($data);$i++){
                                    echo "<tr>";
                                    echo"<td>{$data[$i]['id']}</td>";
                                    echo"<td class=\"center\">{$data[$i]['instruction']}<br><a class=\"btn btn-info btn-xs\" href=\"#\" onclick=\"edit_c(this)\" id=\"{$data[$i]['id']}\"><i class=\"glyphicon glyphicon-edit icon-white\"></i> 修改</a></td>";
                                    echo"<td class=\"center\">{$type[$data[$i]['categoryid']]}</td>";
                                    echo"<td class=\"center\">";
                                    echo"<a class=\"btn btn-info\" href=\"#\" onclick=\"see_pic(this)\" pic=\"{$data[$i]['picname']}\">";
                                    echo"<i class=\"glyphicon glyphicon-edit icon-white\"></i> 查看图片</a> ";
                                    echo"<a class=\"btn btn-info\" href=\"#\" onclick=\"edit_pic(this)\" pic=\"{$data[$i]['picname']}\" id=\"{$data[$i]['id']}\" data-toggle=\"modal\" data-target=\"#myModal_re\">";
                                    echo"<i class=\"glyphicon glyphicon-edit icon-white\"></i> 重传图片</a> ";
                                    echo" <a class=\"btn btn-danger\" href=\"#\" onclick=\"disp_confirm(this)\" value=\"id={$data[$i]['id']}\">";
                                    echo"<i class=\"glyphicon glyphicon-trash icon-white\"></i> 删除</a>";
                                    echo" <a class=\"btn btn-success\" href=\"/Article/addpart?pid={$data[$i]['id']}\">";
                                    echo"<i class=\"glyphicon glyphicon-zoom-in icon-white\"></i> 新增模块文章</a>";
                                    echo" <a class=\"btn btn-success\" href=\"/Article/lists_ed?id={$data[$i]['id']}\">";
                                    echo"<i class=\"glyphicon glyphicon-zoom-in icon-white\"></i> 查看模块</a>";
                                    echo"</td>";
                                    echo"</tr>";
                                }
                            }else{
                                echo"<tr>";
                                echo"<td colspan=4>还没有数据！</td>";
                                echo"</tr>";
                            }
                        ?>     
                        </tbody>
                    </table>
                    <!-- 弹出框 修改上传图片-->
                    <div class="modal fade" id="myModal_re" tabindex="-1" role="dialog" aria-labelledby="myModal_reLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content" style="font-size: 16px;">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">重传图片</h4>
                          </div>
                          <form role="form" action="/Article/edit_pic" method="post" enctype="multipart/form-data">
                              <div class="form-group modal-body">
                                <label for="InputFile">重传图片</label>
                                <input type="file" id="InputFile" name="userfile">
                                <p class="help-block">jpeg、png、gif、jpg</p>
                              </div>
                                <input type="hidden" id="re_id" name="re_id" value=""/>
                                <input type="hidden" id="re_pic" name="re_pic" value=""/>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">确定</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- model end -->
                    <?php 
                        //重传图片失败提示
                        if(!empty($msg)){
                            echo "<script>alert('{$msg}')</script>";
                        } 
                    ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/plugins/js/jquery.dataTables.js"></script>
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

    function disp_confirm(obj){
      var r=confirm("确定删除?")
      var val = $(obj).attr('value');
      if (r==true){
            window.location.href="/Article/del?"+val;
       }else{
       }
    }

    //修改文字内容
    function edit_c(obj){
        var id = $(obj).attr('id');
        var html = "<textarea  type='text' class='form-control' id='edit_instr' name='instruction' rows='3'></textarea>";
        var d = dialog({
            title:'修改说明文字:',
            content:html,
            quickClose: true,
            okValue:'修改',
            ok:function(){
                var instruction = $.trim($('#edit_instr').val());
                if(instruction.length>0){
                    window.location.href="/Article/edit_c?instruction="+instruction+"&id="+id;
                }else{
                    alert('内容不能为空');
                }
            },
        })
        d.show(obj);
    }

    //修改上传图片
    function edit_pic(obj){
        var pic = $(obj).attr('pic');
        var id = $(obj).attr('id');
        $('#re_id').val(id);
        $('#re_pic').val(pic);
    }

    //查询操作
    function gosearch(){
        var searchid = $("#searchid").val();
        var searchtp = $("#searchtp").val();
        window.location.href="/Article/lists?searchid="+searchid+"&searchtp="+searchtp;
    }

    // $(function() {
    //     setparam();
    // })

    function setparam() {
        $('#table_data').dataTable({
            "sDom": '<"top">rt<"bottom"lip>',
            "pagingType": "full_numbers",
            //"info": false,
            "searching": false,
            "bSort": false,
            "bAutoWidth": true,
            "oLanguage": {
                "sLengthMenu": "每页显示_MENU_ 条记录",
                "sZeroRecords": "没有找到记录",
                "sInfoEmpty": "无记录",
                "sInfoFiltered": "(从 _MAX_ 条记录过滤)",
                "sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
                "oPaginate": {
                    "sFirst": "首页",
                    "sPrevious": "上一页",
                    "sNext": "下一页",
                    "sLast": "末页"
                }
            }
        });
    }
</script>
<?php
$this->load->view('footer');
?>

