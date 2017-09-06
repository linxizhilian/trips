<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends My_Controller {

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

    }

	public function home()
	{
        $all_category = $this->category->get_list();

        foreach ($all_category as $key => $value)
        {
			$where = [];
			$tmmm = [];
			$where['fields'] = 'id';
            $where['where'][] = "categoryid = ". $value['id'];
            $where['order_by'] = 'id';
			$where['limit'] = array(10);
            $ss = $this->article->get_list($where);
            foreach ($ss as $v)
			{
				$tmmm[] = $v['id'];
			}
            $all_category[$key]['aids'] = $tmmm;
        }
        $tmp = [];
        foreach ($all_category as $item)
		{
			if (!empty($item['aids']))
			{
				$tmp = array_merge($item['aids'],$tmp);
			}
		}
        //	首屏轮播数据
		$lunbo = [53,78,44];
		$data['lunbo'] = $lunbo;
		//	今日推荐
		$tuijian = [55,33,22,66];
		$data['tuijian'] = $tuijian;
        //	通过id 查找文章数据
		$tmp = array_merge($lunbo,$tmp,$tuijian);
		$article = $this->get_article_by_aids($tmp);

		$data['article'] = $article;
		$data['all_category'] = $all_category;
//        get_list_by_pid
		$this->load->view('index',$data);
	}
}
