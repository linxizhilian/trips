<?php

class My_Controller extends CI_Controller {

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
		$this->load->model('Part_model','part');
		$this->load->model('Article_second_model','article_part');
		$this->load->model('Category_model','category');
		$this->load->model('Other_model','other');
    }

    //	通过文章id查找文章属性
	public function get_article_by_aids($aids)
	{
		$data = array();
		if (empty($aids))
		{
			return [];
		}

		$str_aids = implode(',', $aids);

		$where['where'][] = "id in ($str_aids)";
		$res = $this->article->get_list($where);

		foreach ($res as $key => $value)
		{
			$value['img_url'] = $this->get_img_url($value['picname'],'img.beijingdrivertour.com');
			$value['article_url'] = '/Articles/index/'.$value['id'].'.html';
			$tmp[$value['id']] = $value;
		}
		return $tmp;
	}

	//	处理图片地址
	public function get_img_url($md5,$domain = 'img.pangzer.com', $height = 'h_240', $width = 'w_360', $ext = 'jpg', $thumberConf = 'f')
	{
		if (empty($md5))
		{
			$md5 = "bc7d4968358d4d62740289863486e612";
		}

		elseif (strlen($md5) == 32)
		{
			$dir1 = substr($md5, 0, 2);
			$dir2 = substr($md5, 2, 2);
			$url = "https://" . $domain . "/thumb/" . $thumberConf . "/" . $dir1 . "/" . $dir2 . "/" . $md5 . ",c_fill,";
		}
		else
		{

			// /uploads/201702/3b/18/3b18eb0d576ff5a2077cd85a8adb0aab.jpg
			$url = str_replace('http://' . $domain . '/', 'mao', $md5);
			$url = str_replace('uploads/', '', $url);
			$p = pathinfo($url);
			$dirname = isset($p['dirname']) ? $p['dirname'] : "";
			$url = $dirname . '/' . $p['filename'];
			$url = ltrim($url,'.');
			$url = 'https://' . $domain . '/thumb/' . $thumberConf  . $url . ',c_fill,';
		}
		return $url;
	}

	//	获取所有分类信息
	public function get_all_category()
	{
		$where1['where'][] = ' state = 1';
		$all_category = $this->category->get_list($where1);
		$arr_no = [1,7,11];
		foreach ($all_category as $key => $item)
		{
			$all_category[$key]['url'] = '/Category/index/'.$item['id'];
			if (in_array($item['id'],$arr_no))
			{
				unset($all_category[$key]);
			}
		}
		return $all_category;
	}

}
