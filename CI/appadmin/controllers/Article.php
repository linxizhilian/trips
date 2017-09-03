<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('category_model','category');
        $this->load->model('articlefirst_model','artfirst');
        $this->load->model('articlesecond_model','artsecond');
    }
    
    //一级列表
    public function lists()
    {
        $res['data'] = $this->artfirst->get_list();
        $type = $this->category->get_list();
        $_type = array();
        for($i=0;$i<count($type);$i++){
            $_type[$type[$i]['id']] = $type[$i]['category'];
        }
        $res['type'] = $_type;
        $this->load->view('article/lists',$res);
    }

    //一级新增视图
    public function add()
    {
        $res['data'] = $this->category->get_list();
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
                $data['info']['msg'] = '添加成功';
                $data['data'] = $this->category->get_list();
                $this->load->view('article/add',$data);
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
        $config['max_size'] = 2048;
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

    //编辑
    public function edit()
    {
        $this->load->view('article/edit');
    }
    
    //二级列表
    public function lists_ed()
    {
        $this->load->view('article/lists_ed');
    }
    
    //二级新增
    public function add_ed()
    {
        $this->load->view('article/add_ed');
    }
}
