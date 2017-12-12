<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends My_Controller {

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
	public function index()
	{
		$category_id = $this->uri->segment(3, 0);
		$where1['fields'] = 'id';
		if (empty($category_id))
		{
			$where1['where'][] = ' state = 1';
		}else{
			$where1['where'][] = ' state = 1 and categoryid = '.$category_id;
		}

		$article_id = $this->article->get_list($where1);
		if (empty($article_id))
		{
			$data['empty'] = true;
			$where2['where'][] = ' state = 1';
			$article_id = $this->article->get_list($where2);
		}
		foreach ($article_id as $item)
		{
			$article_ids[] = $item['id'];
		}
		$article = $this->get_article_by_aids($article_ids);

		$data['article'] = $article;
		$data['all_category_nav'] = $this->get_all_category();
		$this->load->view('category',$data);
	}
}
