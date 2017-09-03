<?php

$this->load->view('header');
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="/Article/lists">一级文章列表</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> 一级文章列表</h2>

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
                                    echo"<td class=\"center\">{$data[$i]['instruction']}</td>";
                                    echo"<td class=\"center\">{$type[$data[$i]['categoryid']]}</td>";
                                    echo"<td class=\"center\">";
                                    echo"<a class=\"btn btn-info\" href=\"#\" onclick=\"see_pic(this)\" pic=\"{$data[$i]['picname']}\">";
                                    echo"<i class=\"glyphicon glyphicon-edit icon-white\"></i> 查看图片</a> ";
                                    echo" <a class=\"btn btn-danger\" href=\"#\">";
                                    echo"<i class=\"glyphicon glyphicon-trash icon-white\"></i> 删除</a>";
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
</script>
<?php
$this->load->view('footer');
?>

