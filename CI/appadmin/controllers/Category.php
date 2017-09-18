<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('category_model','category');
        $this->load->model('part_model','part');
    }
    
    //列表
    public function lists()
    {
       $param['where'] = array(array(
            'state' => 1
        ));
       $res['data'] = $this->category->get_list($param);
       //$sql = $this->category->_db->last_query();
       $this->load->view('category/lists',$res);
    }
    
    //详情页块数列表
    public function lists_xqk(){
        $param['where'] = array(array(
            'state' => 1
        ));
        $res['data'] = $this->part->get_list($param);
       $this->load->view('category/lists_xqk',$res);
    }

    //新增视图
    public function add()
    {
        $this->load->view('category/add');
    }
    
    //新增块数视图
    public function add_xqk(){
        $this->load->view('category/add_xqk');
    }


    //新增执行
    public function doadd(){
        $category = trim($this->input->get_post('category'));
        $note = trim($this->input->get_post('note'));
        if(empty($category)){
            $data['info']['msg'] = '分类名称不能为空';
            $this->load->view('category/add',$data);
        }else{
            $insert_arr = array(
                'category' => $category,
                'note' => $note,
                'add_time' => date('Y-m-d H:i:s',time())
            );
            $sec_arr = array(
                'category' => $category,
                'state' => 1
            );
            $params['where'][] = $sec_arr;
            $res_unq = $this->category->get_list($params);
            if(empty($res_unq)){
                $res = $this->category->insert($insert_arr);
                //$data['info']['msg'] = '添加成功';
                $this->lists();
            }else{
                $data['info']['msg'] = '此分类名称已添加,请勿重复使用';
                $this->load->view('category/add',$data);
            }
        }
    }
    
    //新增块数执行
    public function doadd_xqk(){
        $part = trim($this->input->get_post('part'));
        $note = trim($this->input->get_post('note'));
        if(empty($part)){
            $data['info']['msg'] = '块名称不能为空';
            $this->load->view('category/add_xqk',$data);
        }else{
            $insert_arr = array(
                'part' => $part,
                'note' => $note,
                'add_time' => date('Y-m-d H:i:s',time())
            );
            $sec_arr = array(
                'part' => $part,
                'state' => 1
            );
            $params['where'][] = $sec_arr;
            $res_unq = $this->part->get_list($params);
            if(empty($res_unq)){
                $res = $this->part->insert($insert_arr);
                //$data['info']['msg'] = '添加成功';
                $this->lists_xqk();
            }else{
                $data['info']['msg'] = '此块名称已添加,勿重复使用';
                $this->load->view('category/add_xqk',$data);
            }
        }
    }

    //编辑展示 
    public function edit()
    {
        $id = trim($this->input->get_post('id'));
        $where = array(array(
            'id' => $id
        ));
        $res = $this->category->get_by($where);
        $data['edit'] = $res;
        $this->load->view('category/edit',$data);
    }
    
    //块编辑展示
    public function edit_xqk(){
        $id = trim($this->input->get_post('id'));
        $where = array(array(
            'id' => $id
        ));
        $res = $this->part->get_by($where);
        $data['edit'] = $res;
        $this->load->view('category/edit_xqk',$data);
    }
    
    //编辑执行
    public function doedit(){
        $id = trim($this->input->get_post('id'));
        $category = trim($this->input->get_post('category'));
        $note = trim($this->input->get_post('note'));
        $aids = trim($this->input->get_post('aids'));
        $info = array(
            'category' => $category,
            'note' => $note,
            'aids' => $aids
        );
        $this->category->update($id,$info);
        $this->lists();
    }
    
    //块编辑执行
    public function doedit_xqk(){
        $id = trim($this->input->get_post('id'));
        $part = trim($this->input->get_post('part'));
        $note = trim($this->input->get_post('note'));
        $info = array(
            'part' => $part,
            'note' => $note
        );
        $this->part->update($id,$info);
        $this->lists_xqk();
    }
    
    //类别管理删除(修改state)
    public function del(){
        $id = trim($this->input->get_post('id'));
        $info = array(
            'state' => 2
        );
        $this->category->update($id,$info);
        $this->lists();
    }
    
    //模块管理删除(part表,修改state)
    public function xq_del(){
        $id = trim($this->input->get_post('id'));
        $info = array(
            'state' => 2
        );
        $this->part->update($id,$info);
        $this->lists_xqk();
    }
}
