<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('category_model','category');
        $this->load->model('part_model','part');
        $this->load->model('articlefirst_model','artfirst');
        $this->load->model('articlesecond_model','artsecond');
    }
    
    //一级列表
    public function lists()
    {
        $id = trim($this->input->get_post('searchid'));
        $categoryid = trim($this->input->get_post('searchtp'));
        $param = array();
        $where = array(array(
            'state !=' => 2
        ));
        
        $param['where'] = $where;
        $res['data'] = $this->artfirst->get_list($param);
        $type = $this->category->get_list();
        $_type = array();
        for($i=0;$i<count($type);$i++){
            $_type[$type[$i]['id']] = $type[$i]['category'];
        }
        $res['type'] = $_type;
        $res['stype'] = $type;
        $this->load->view('article/lists',$res);
    }

    //一级新增视图
    public function add()
    {
        $param['where'] = array(array(
            'state' => 1
        ));
        $res['data'] = $this->category->get_list($param);
        $this->load->view('article/add',$res);
    }
    
    //一级新增执行
    public function doadd(){
        $categoryid = trim($this->input->get_post('categoryid'));
        $instruction = trim($this->input->get_post('instruction'));
        if(empty($categoryid) || empty($instruction)){
            $data['info']['msg'] = '所有项必填！！！';
            $data['data'] = $this->category->get_list();
            $this->load->view('article/add',$data);
        }else{
            $upload_res = $this->file_upload();
            if($upload_res['status']){
                $insert_arr = array(
                    'instruction' => $instruction,
                    'picname' => $upload_res['file_name'],
                    'categoryid' => $categoryid
                );
                $res = $this->artfirst->insert($insert_arr);
                //category表写入aids字段
                $arr_category1 = array(array(
                    'id' => $categoryid
                ));
                $res1 = $this->category->get_by($arr_category1);
                if(empty($res1['aids'])){
                    $arr_in = array(
                        'aids' => $res
                    );
                    $this->category->update($categoryid,$arr_in);
                }else{
                    $arr_in = array(
                        'aids' => $res1['aids'].','.$res
                    );
                    $this->category->update($categoryid,$arr_in);
                }
                $this->lists();
            }else{
                $data['info']['msg'] = $upload_res['info'];
                $data['data'] = $this->category->get_list();
                $this->load->view('article/add',$data);
            }
        }
    }
    
    //文件上传函数
    protected function file_upload() {
        $config = array();
        $config['upload_path'] = './uploads';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 10240;
        $config['file_name'] = date("YmdHis").rand(1000,9999);
        $this->load->library('upload',$config);
        // 初始化返回信息
        $resp = array(
            'status' => FALSE,
            'file_name' => '',
            'info' => '',
        );
        if (!$this->upload->do_upload('userfile')) {
            $resp['info'] = $this->upload->display_errors();
        } else {
            $resp['status'] = TRUE;
            $resp['file_name'] = $this->upload->data('file_name');
        }
        return $resp;
    }

    //编辑视图(修改模块文章)
    public function edit()
    {
        $id = trim($this->input->get_post('id'));
        $where = array(array(
            'id' => $id
        ));
        $data = $this->artsecond->get_by($where);
        $res['editinfo'] = $data;
        
        $type = $this->part->get_list();
        $_type = array();
        for($i=0;$i<count($type);$i++){
            $_type[$type[$i]['id']] = $type[$i]['part'];
        }
        $res['type'] = $_type;
        $res['id'] = $id;
        $this->load->view('article/edit',$res);
    }
    
    //编辑执行(修改模块文章)
    public function doedit(){
        $id = trim($this->input->get_post('id'));
        $pid = trim($this->input->get_post('pid'));
        $content = trim($this->input->get_post('content'));
        $update_arr = array(
            'id' => $id,
            'content' => $content
        );
        $this->artsecond->update($id,$update_arr);
        //跳到对应文章的模块文章列表(就为一个pid现查吧...)
        $param['where'] = array(array(
            'state' => 1,
            'pid' => $pid
        ));
        $res['data'] = $this->artsecond->get_list($param);
        $type = $this->part->get_list();
        $_type = array();
        for($i=0;$i<count($type);$i++){
            $_type[$type[$i]['id']] = $type[$i]['part'];
        }
        $res['type'] = $_type;
        $this->load->view('article/lists_ed',$res);
    }


    //二级列表(查看某一篇文章下的模块)
    public function lists_ed()
    {   
        $id = trim($this->input->get_post('id'));
        $param['where'] = array(array(
            'state' => 1,
            'pid' => $id
        ));
        $res['data'] = $this->artsecond->get_list($param);
        $type = $this->part->get_list();
        $_type = array();
        for($i=0;$i<count($type);$i++){
            $_type[$type[$i]['id']] = $type[$i]['part'];
        }
        $res['type'] = $_type;
        $this->load->view('article/lists_ed',$res);
    }
    
    //二级列表页查看content
    public function see_content(){
        $id = trim($this->input->get_post('id'));
        $res = $this->artsecond->get($id);
        $ucontent = $res['content'];
        echo $ucontent;
    }


    //二级新增视图(新增模块文章)
    public function addpart()
    {
        $pid = trim($this->input->get_post('pid'));
        $param['where'] = array(array(
            'state' => 1
        ));
        $data['pid'] = $pid;
        $data['data'] = $this->part->get_list($param);
        $this->load->view('article/add_ed',$data);
    }
    
    //二级新增执行
    public function doaddpart(){
        $pid = trim($this->input->get_post('pid'));
        $content = trim($this->input->get_post('content'));
        $typeid = trim($this->input->get_post('typeid'));
        $insert_arr = array(
            'content' => $content,
            'typeid' => $typeid,
            'pid' => $pid
        );
        $sec_arr = array(
            'pid' => $pid,
            'typeid' => $typeid,
            'state' => 1
        );
        $params['where'][] = $sec_arr;
        $res_unq = $this->artsecond->get_list($params);
        if(empty($res_unq)){
            $this->artsecond->insert($insert_arr);
            $this->lists();
        }else{
            $data['info']['msg'] = '所选文章下该模块的内容已添加过';
            $param['where'] = array(array(
                'state' => 1
            ));
            $data['pid'] = $pid;
            $data['data'] = $this->part->get_list($param);
            $this->load->view('article/add_ed',$data);
        }
    }
    
    //一级文章删除(修改state)
    public function del(){
        $id = trim($this->input->get_post('id'));
        $info = array(
            'state' => 2
        );
        $this->artfirst->update($id,$info);
        $this->lists();
    }
    
    //二级文章删除(修改state)
    public function del_ed(){
        $id = trim($this->input->get_post('id'));
        $pid = trim($this->input->get_post('pid'));
        $info = array(
            'state' => 2
        );
        $this->artsecond->update($id,$info);
        //跳转对应文章下模块文章,现查...
        $param['where'] = array(array(
            'state' => 1,
            'pid' => $pid
        ));
        $res['data'] = $this->artsecond->get_list($param);
        $type = $this->part->get_list();
        $_type = array();
        for($i=0;$i<count($type);$i++){
            $_type[$type[$i]['id']] = $type[$i]['part'];
        }
        $res['type'] = $_type;
        $this->load->view('article/lists_ed',$res);
    }
    
    //修改一级文章文字部分
    public function edit_c(){
        $id = trim($this->input->get_post('id'));
        $instruction = trim($this->input->get_post('instruction'));
        $info = array(
            'instruction' => $instruction
        );
        $this->artfirst->update($id,$info);
        $this->lists();
    }
    
    //一级文章重传图片
    public function edit_pic(){
        $id = trim($this->input->get_post('re_id'));
        $pic = trim($this->input->get_post('re_pic'));
        $upload_res = $this->file_upload();
        if($upload_res['status']){
            @unlink("./uploads/".$pic);
            $update_arr = array(
                'picname' => $upload_res['file_name'],
            );
            $res = $this->artfirst->update($id,$update_arr);
            $this->lists();
        }else{
            $res['msg'] = $upload_res['info'];
            $param['where'] = array(array(
                'state' => 1
            ));
            $res['data'] = $this->artfirst->get_list($param);
            $type = $this->category->get_list();
            $_type = array();
            for($i=0;$i<count($type);$i++){
                $_type[$type[$i]['id']] = $type[$i]['category'];
            }
            $res['type'] = $_type;
            $this->load->view('article/lists',$res);
        }
    }
    
    //图片详情(视图)
    public function pic_detail(){
        $id = trim($this->input->get_post('id'));
        $where = array(array(
            'id' => $id
        ));
        $data = $this->artfirst->get_by($where);
        $res['data'] = $data;
        $this->load->view('article/pic_detail',$res);
    }
    
    //图片详情页上传图片
    public function pic_up(){
        $id = trim($this->input->get_post('id'));
        $which = trim($this->input->get_post('which'));
        $upload_res = $this->file_upload();
        if($upload_res['status']){
            $update_arr = array(
                $which => $upload_res['file_name'],
            );
            $res = $this->artfirst->update($id,$update_arr);
            //处理数组字段
            $where = array(array(
                'id' => $id
            ));
            $data = $this->artfirst->get_by($where);
            if(!empty($data['picname'])&&!empty($data['picname2'])&&!empty($data['picname3'])){
                if($data['state']==3){
                    $arr_pic1 = array($data['picname'],$data['picname2'],$data['picname3']);
                    $arr_pic = json_encode($arr_pic1);
                    $up_data = array(
                      'arr_pic' => $arr_pic,
                      'state' => 1
                    );
                    $this->artfirst->update($id,$up_data);
                    $ndata = $this->artfirst->get_by($where);
                    $nres['data'] = $ndata;
                    $this->load->view('article/pic_detail',$nres);
                }else{
                    $arr_pic1 = array($data['picname'],$data['picname2'],$data['picname3']);
                    $arr_pic = json_encode($arr_pic1);
                    $up_data = array(
                      'arr_pic' => $arr_pic
                    );
                    $this->artfirst->update($id,$up_data);
                    $ndata = $this->artfirst->get_by($where);
                    $nres['data'] = $ndata;
                    $this->load->view('article/pic_detail',$nres);
                }
            }else{
                $mres['data'] = $data;
                $this->load->view('article/pic_detail',$mres);
            }
        }else{
            $nres['msg'] = $upload_res['info'];
            $where = array(array(
                'id' => $id
            ));
            $nres['data'] = $this->artfirst->get_by($where);
            $this->load->view('article/pic_detail',$nres);
        }
    }
    
    //图片详情页 重传图片
    public function repic_up(){
        $id = trim($this->input->get_post('id'));
        $which = trim($this->input->get_post('which'));
        $pic = trim($this->input->get_post('pic'));
        $upload_res = $this->file_upload();
        if($upload_res['status']){
            @unlink("./uploads/".$pic);
            $update_arr = array(
                $which => $upload_res['file_name'],
            );
            $res = $this->artfirst->update($id,$update_arr);
            //处理数组字段
            $where = array(array(
                'id' => $id
            ));
            $data = $this->artfirst->get_by($where);
            if(!empty($data['picname'])&&!empty($data['picname2'])&&!empty($data['picname3'])){
                if($data['state']==3){
                    $arr_pic1 = array($data['picname'],$data['picname2'],$data['picname3']);
                    $arr_pic = json_encode($arr_pic1);
                    $up_data = array(
                      'arr_pic' => $arr_pic,
                      'state' => 1
                    );
                    $this->artfirst->update($id,$up_data);
                    $ndata = $this->artfirst->get_by($where);
                    $nres['data'] = $ndata;
                    $this->load->view('article/pic_detail',$nres);
                }else{
                    $arr_pic1 = array($data['picname'],$data['picname2'],$data['picname3']);
                    $arr_pic = json_encode($arr_pic1);
                    $up_data = array(
                      'arr_pic' => $arr_pic
                    );
                    $this->artfirst->update($id,$up_data);
                    $ndata = $this->artfirst->get_by($where);
                    $nres['data'] = $ndata;
                    $this->load->view('article/pic_detail',$nres);
                }
            }else{
                $mres['data'] = $data;
                $this->load->view('article/pic_detail',$mres);
            }
        }else{
            $nres['msg'] = $upload_res['info'];
            $where = array(array(
                'id' => $id
            ));
            $nres['data'] = $this->artfirst->get_by($where);
            $this->load->view('article/pic_detail',$nres);
        }
    }
}
