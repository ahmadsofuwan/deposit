<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Content extends MY_Controller
{

	public function index()
	{
		$dataCompany = $this->getDataRow('profile_company', '*');
		$head = $this->getDataRow('head', 'html', array('status' => '1'));
		$banner = $this->getDataRow('banner', '*', array('status' => '1'));
		$reward = $this->getDataRow('reward', '*');

		$data['html']['reward'] = $reward;
		$data['html']['banner'] = $banner;
		$data['html']['head'] = $head;
		$data['html']['dataCompany'] = $dataCompany;
		$data['html']['title'] = 'Laskar138';
		$data['url'] = 'public/body';
		$this->templatePublic($data);
	}
	public function ajax()
	{
		switch ($_POST['action']) {
			case 'checkAccount':
				$join = array(
					array('level', 'level.pkey=customer.levelkey'),
				);
				$select = '
					customer.*,
					level.name levelname,
					level.img levelimg,
				';


				$data = $this->getDataRow('customer', $select, array('customer.name' => $_POST['name']), '', $join);
				$data[0]['point'] = number_format($data[0]['point']);
				echo json_encode($data);
				break;
		}
	}
}
