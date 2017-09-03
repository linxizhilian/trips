<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	/**
	 * Home Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    public function __construct(){
        parent::__construct();
        $this->load->model('Article_model','article');
        $this->load->model('Category_model','category');
    }

	public function home()
	{
        $all_category = $this->category->get_list();

        echo "<pre>";
        foreach ($all_category as $key => $value)
        {
            $where['where'] = "";
            $where['where'][] = "categoryid = ". $value['id'];
            $where['order_by'] = 'id';
            $all_category[$key]['aids'] = $this->article->get_list($where);

        }

        var_dump($all_category);
//        get_list_by_pid
        $all_article = $this->article->get_list($params);
        var_dump($all_article);
		$this->load->view('index');
	}
}
