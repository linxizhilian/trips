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
        $tmpp = [];
        foreach ($all_category as $key => $value)
        {
            $tmpp[$value['id']] = $value;
        }
        $all_category = $tmpp;
        $tmp = [];
        foreach ($all_category as $item)
		{
			if (!empty($item['aids']))
			{
				$tmp = array_merge(explode(',',$item['aids']),$tmp);
			}
		}
        //	首屏轮播数据
		$lunbo = explode(',',$all_category[11]['aids']);
		$data['lunbo'] = $lunbo;
		//	今日推荐
		$tuijian = explode(',',$all_category[1]['aids']);
		$data['tuijian'] = $tuijian;
        //	通过id 查找文章数据
		if (!empty($tuijian))
		{
			$tmp1 = array_merge($lunbo,$tmp,$tuijian);
		}else{
			$tmp1 = array_merge($lunbo,$tmp);
		}
		foreach ($tmp1 as $key => $item)
		{
			if (empty($item))
			{
				unset($tmp1[$key]);
			}
		}
		$article = $this->get_article_by_aids($tmp1);

		//	底部数据
		$where['where'] = "id = 6";
		$other = $this->other->get_list();
		$index_bootm = '';
		foreach ($other as $item)
		{
			if ($item['id'] == 8)
			{
				$index_bootm = $item;
			}
		}

		$data['index_bootm'] = $index_bootm;
		$data['article'] = $article;
		$data['all_category'] = $all_category;
//        get_list_by_pid
		$this->load->view('index',$data);
	}
}
