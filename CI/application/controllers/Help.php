<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Help extends My_Controller {

	public function index()
	{
		$other = $this->other->get_list();
		$contents = [];
		foreach ($other as $value)
		{
			$contents[$value['key']] = $value['value'];
		}

		$a = isset($_GET['a']) ? $_GET['a'] : 'about';
		$contents = $contents[$a];
		$data['a'] = $a;
		$data['content'] = $contents;
		$this->load->view('about',$data);
	}
}
