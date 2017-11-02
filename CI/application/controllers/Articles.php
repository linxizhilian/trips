<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends My_Controller {

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

	public function index()
	{
        $product_id = $this->uri->segment(3, 0);

        $product_id = trim($product_id,'.html');
        //	查找文章信息
		$article = $this->article->get($product_id);
		$pics = json_decode($article['arr_pic']);
		foreach ($pics as $key => $pic)
		{
			$pics[$key] = $this->get_img_url($pic);
		}

        $where['where'][] = "state = 1 and pid = ".$product_id;
        $where['order_by'][] = "id asc";
        $all_content = $this->article_part->get_list($where);
        $wherepart['where'][] = "state = 1";
        $all_part = $this->part->get_list($wherepart);
        $part = [];
        foreach ($all_part as $value)
        {
            $part[$value['id']] = $value;
        }
		$title_tag = [];
        foreach ($all_content as $key => $value)
		{
			if ($value['typeid'] == 6)
			{
				//	标题下小tag
				$title_tag = $value;
				unset($all_content[$key]);
			}
		}
        $data['pics'] = $pics;
        $data['title_tag'] = $title_tag;
        $data['part'] = $part;
        $data['all_content'] = $all_content;
		$this->load->view('article',$data);
	}
}
