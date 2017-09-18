<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        //$this->load->model('base_model'); //autoload中已配置
        $this->load->model('user_model','user');
        $this->load->model('others_model','others');
    }
    
    public function pages(){
        $this->load->view('table');
    }

    public function test(){
        $res = $this->session->userdata('trips_userInfo');
        echo json_encode($res);
    }
    
    //首页
    public function index()
    {
        $this->load->view('index');
    }

    //登录视图
    public function index_login(){
        $this->load->view('login');
    }

    //登录操作
    public function dologin()
    {   
        $name = trim($this->input->get_post('username'));
        $pwd = md5(trim($this->input->get_post('password')));
        // 初始化返回数据
        $resp = array(
            'status' => false,
            'data' => array(),
            'info' => array(),
        );
        $where = array(array(
            'username' => $name,
            'password' => $pwd
        ));
        $userInfo = array();
        $res = $this->user->get_by($where);
        if(count($res)>0){
            $userInfo['userid'] = $res['id'];
            $userInfo['username'] = $res['username'];
            $this->session->set_userdata('trips_userInfo', $userInfo);
            $this->load->view('index');
        }else{
            $resp['info']['msg'] = '用户名或密码错误';
            $this->load->view('login',$resp);
        }
    }
        
    //退出操作
    public function logout(){
        $this->session->unset_userdata('trips_userInfo');
        $this->load->view('login');
    }
    
    //杂项列表
    public function lists()
    {
       $param['where'] = array(array(
            'state' => 1
        ));
       $res['data'] = $this->others->get_list($param);
       $this->load->view('home/lists',$res);
    }
    
    //新增杂项视图
    public function add()
    {
        $this->load->view('home/add');
    }
    
    //新增杂项执行
    public function doadd(){
        $key = trim($this->input->get_post('key'));
        $value = trim($this->input->get_post('content'));
        $note = trim($this->input->get_post('note'));
        if(empty($key) || empty($value)){
            $data['info']['msg'] = '杂项名称和内容都不能为空';
            $this->load->view('home/add',$data);
        }else{
            $insert_arr = array(
                'key' => $key,
                'value' => $value,
                'note' => $note
            );
            $sec_arr = array(
                'key' => $key,
                'value' => $value,
                'state' => 1
            );
            $params['where'][] = $sec_arr;
            $res_unq = $this->others->get_list($params);
            if(empty($res_unq)){
                $res = $this->others->insert($insert_arr);
                //$data['info']['msg'] = '添加成功';
                $this->lists();
            }else{
                $data['info']['msg'] = '此杂项名称或内容已添加,请勿重复添加';
                $this->load->view('home/add',$data);
            }
        }
    }
    
    //杂项编辑展示 
    public function edit()
    {
        $id = trim($this->input->get_post('id'));
        $where = array(array(
            'id' => $id
        ));
        $res = $this->others->get_by($where);
        $data['edit'] = $res;
        $this->load->view('home/edit',$data);
    }
    
    //杂项编辑执行
    public function doedit(){
        $id = trim($this->input->get_post('id'));
        $key = trim($this->input->get_post('key'));
        $value = trim($this->input->get_post('content'));
        $note = trim($this->input->get_post('note'));
        $info = array(
            'key' => $key,
            'value' => $value,
            'note' => $note
        );
        $this->others->update($id,$info);
        $this->lists();
    }
    
    //杂项删除
    public function del(){
        $id = trim($this->input->get_post('id'));
        $info = array(
            'state' => 2
        );
        $this->others->update($id,$info);
        $this->lists();
    }
}
