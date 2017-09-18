<?php

$this->load->view('header');
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">模块文章列表</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> 模块文章列表</h2>

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
                            <th>内容</th>
                            <th>所属模块</th>
                            <th>所属文章编号</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($data)){
                            for($i=0;$i<count($data);$i++){
                                    echo "<tr>";
                                    echo"<td>{$data[$i]['id']}</td>";
                                    echo"<td class=\"center\">";
                                    echo"<a class=\"btn btn-info\" href=\"#\" onclick=\"see_content(this)\" content=\"{$data[$i]['id']}\">";
                                    echo"<i class=\"glyphicon glyphicon-edit icon-white\"></i> 查看内容</a></td>";
                                    echo"<td class=\"center\">{$type[$data[$i]['typeid']]}</td>";
                                    echo "<td>{$data[$i]['pid']}</td>";
                                    echo"<td class=\"center\">";
                                    echo"<a class=\"btn btn-info\" href=\"/Article/edit?id={$data[$i]['id']}\">";
                                    echo"<i class=\"glyphicon glyphicon-edit icon-white\"></i> 修改</a> ";
                                    echo" <a class=\"btn btn-danger\" href=\"#\" onclick=\"disp_confirm(this)\" value=\"id={$data[$i]['id']}&pid={$data[$i]['pid']}\">";
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
<script type="text/javascript" src="/plugins/js/jquery.dataTables.js"></script>
<script type="text/javascript">
    function disp_confirm(obj){
      var r=confirm("确定删除?")
      var val = $(obj).attr('value');
      if (r==true){
            window.location.href="/Article/del_ed?"+val;
       }else{
       }
    }

    function see_content(obj){
        var id = $(obj).attr('content');
        $.ajax({
            url:'/Article/see_content',
            type:'post',
            data:{id:id},
            success:function(msg){
                    var d = dialog({
                    title:'内容:',
                    content:msg,
                    quickClose: true
                })
                d.show(obj);
            }
        })
    }
</script>
<?php
$this->load->view('footer');
?>
