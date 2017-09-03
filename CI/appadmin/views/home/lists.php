<?php
$this->load->view('header');
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="/Home/lists">杂项列表</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> 杂项列表</h2>

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
                    <table class="table table-striped table-bordered responsive">
                        <thead>
                        <tr>
                            <th>编号</th>
                            <th>杂项名称</th>
                            <th>内容</th>
                            <th>备注</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($data)){
                            for($i=0;$i<count($data);$i++){
                                    echo "<tr>";
                                    echo"<td>{$data[$i]['id']}</td>";
                                    echo"<td class=\"center\">{$data[$i]['key']}</td>";
                                    echo"<td class=\"center\">{$data[$i]['value']}</td>";
                                    echo"<td class=\"center\">{$data[$i]['note']}</td>";
                                    echo"<td class=\"center\">";
                                    echo"<a class=\"btn btn-info\" href=\"/Home/edit?id={$data[$i]['id']}\">";
                                    echo"<i class=\"glyphicon glyphicon-edit icon-white\"></i> 修改</a> ";
                                    echo" <a class=\"btn btn-danger\" onclick=\"disp_confirm(this)\" value=\"id={$data[$i]['id']}\">";
                                    echo"<i class=\"glyphicon glyphicon-trash icon-white\"></i> 删除</a>";
                                    echo"</td>";
                                    echo"</tr>";
                                }
                            }else{
                                echo"<tr>";
                                echo"<td colspan=5>还没有数据！</td>";
                                echo"</tr>";
                            }
                        ?>     
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('footer');
?>
<script type="text/javascript">
    function disp_confirm(obj){
      var r=confirm("确定删除?")
      var val = $(obj).attr('value');
      if (r==true){
            window.location.href="/Home/del?"+val;
       }else{
       }
    }
</script>
