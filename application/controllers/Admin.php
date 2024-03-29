<?php

use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->login) {
			redirect(base_url('Auth'));
		}
	}
	public function index()
	{
		$data['html']['title'] = 'Dasboard';
		$this->template($data);
	}

	public function customerList()
	{
		$tableName = 'customer';
		$join = array(
			array('level', 'level.pkey=' . $tableName . '.levelkey', 'left'),
		);

		$dataList = $this->getDataRow($tableName, $tableName . '.*,level.name as levelname,level.img as levelimg', '', '', $join, 'name ASC');
		$data['html']['title'] = 'List Customer';
		$data['html']['dataList'] = $dataList;
		$data['html']['tableName'] = $tableName;
		$data['html']['form'] = get_class($this) . '/customer';
		$data['url'] = 'admin/customerList';
		$this->template($data);
	}
	public function customer($id = '')
	{
		$tableName = 'customer';
		$tableDetail = '';
		$baseUrl = get_class($this) . '/' . __FUNCTION__;
		$detailRef = '';
		$formData = array(
			'pkey' => 'pkey',
			'name' => 'name',
		);
		$formDetail = array();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST['action'])) redirect(base_url($baseUrl . 'List'));
			//validate form
			$arrMsgErr = array();
			if (empty($_POST['name'])) {
				array_push($arrMsgErr, "Nama wajib Di isi");
			} else {
				$chekName = $this->getDataRow($tableName, 'name', array('name' => $_POST['name']));
				if (!empty(count($chekName)))
					array_push($arrMsgErr, "Nama sudah di gunakan silahkan Masukan Nama lain");
			}

			$this->session->set_flashdata('arrMsgErr', $arrMsgErr);
			//validate form
			if (empty(count($arrMsgErr)))
				switch ($_POST['action']) {
					case 'add':
						$defaultRank = $this->getDataRow('level', 'pkey', '', '', '', 'level.rankpoint ASC')[0]['pkey'];
						$_POST['levelKey'] = $defaultRank;
						$formData['levelkey'] = 'levelKey';
						$formData['createon'] = 'sesionid';
						$formData['createtimestamp'] = 'time';
						$refkey = $this->insert($tableName, $this->dataForm($formData));
						$this->insertDetail($tableDetail, $formDetail, $refkey);
						redirect(base_url($baseUrl . 'List')); //wajib terakhir
						break;
					case 'update':
						$formData['modifby'] = 'sesionid';
						$formData['modiftimestamp'] = 'time';
						$this->update($tableName, $this->dataForm($formData), array('pkey' => $_POST['pkey']));
						$this->updateDetail($tableDetail, $formDetail, $detailRef, $id);
						redirect(base_url($baseUrl . 'List'));
						break;
				}
		}

		if (!empty($id)) {
			$dataRow = $this->getDataRow($tableName, '*', array('pkey' => $id), 1)[0];
			$this->dataFormEdit($formData, $dataRow);
		}

		$data['html']['baseUrl'] = $baseUrl;
		$data['html']['title'] = 'Input Data ' . __FUNCTION__;
		$data['html']['err'] = $this->genrateErr();
		$data['url'] = 'admin/' . __FUNCTION__ . 'Form';
		$this->template($data);
	}

	public function depositList()
	{
		$tableName = 'deposit';
		$dataList = $this->getDataRow($tableName, '* ,', '', '', '', 'name ASC');
		$data['html']['title'] = 'List Deposit';
		$data['html']['dataList'] = $dataList;
		$data['html']['tableName'] = $tableName;
		$data['html']['form'] = get_class($this) . '/deposit';
		$data['url'] = 'admin/depositList';
		$this->template($data);
	}

	public function deposit($id = '')
	{
		$tableName = 'deposit';
		$tableDetail = '';
		$baseUrl = get_class($this) . '/' . __FUNCTION__;
		$detailRef = '';
		$formData = array(
			'pkey' => 'pkey',
			'name' => 'name',
			'createon' => 'createon',
			'point' => array('point', 'number'),
		);
		$formDetail = array();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST['action'])) redirect(base_url($baseUrl . 'List'));
			//validate form
			$arrMsgErr = array();
			if (empty($_POST['name']))
				array_push($arrMsgErr, "Nama wajib Di isi");
			if (empty($_POST['point']))
				array_push($arrMsgErr, "Point Deposit wajib Di isi");


			$this->session->set_flashdata('arrMsgErr', $arrMsgErr);
			//validate form
			if (empty(count($arrMsgErr)))
				switch ($_POST['action']) {
					case 'add':
						$refkey = $this->insert($tableName, $this->dataForm($formData));
						$this->insertDetail($tableDetail, $formDetail, $refkey);
						redirect(base_url($baseUrl . 'List')); //wajib terakhir
						break;
					case 'update':
						$this->update($tableName, $this->dataForm($formData), array('pkey' => $_POST['pkey']));
						$this->updateDetail($tableDetail, $formDetail, $detailRef, $id);
						redirect(base_url($baseUrl . 'List'));
						break;
				}
		}

		if (!empty($id)) {
			$dataRow = $this->getDataRow($tableName, '*', array('pkey' => $id), 1)[0];
			$this->dataFormEdit($formData, $dataRow);
		}

		$data['html']['baseUrl'] = $baseUrl;
		$data['html']['title'] = 'Input Data ' . __FUNCTION__;
		$data['html']['err'] = $this->genrateErr();
		$data['url'] = 'admin/' . __FUNCTION__ . 'Form';
		$this->template($data);
	}
	public function depositTransactionList($start = '')
	{
		$tableName = 'deposit_transaction';
		$perpage = 10;
		$limit = $perpage;
		$like = '';
		$join = array(
			array('deposit', 'deposit.pkey=' . $tableName . '.depositkey', 'left'),
			array('customer', 'customer.pkey=' . $tableName . '.customerkey', 'left'),
			array('account', 'account.pkey=' . $tableName . '.createon', 'left'),
			array('role', 'role.pkey=account.role', 'left'),
		);
		$select = '
			' . $tableName . '.*,
			deposit.name as depositname,
			customer.name as customername,
			account.name as createname,
			account.role as createrole,
			role.name as rolename,
			';
		if ($start) {
			$limit = [$start + $perpage, $start];
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$like = array(
				'calculate' => $_POST['search'],
				'totalpoint' => $_POST['search'],
				'time' => strtotime($_POST['search']),
				'deposit.name' => $_POST['search'],
				'customer.name' => $_POST['search'],
				'account.name' => $_POST['search'],
				'role.name' => $_POST['search'],
				'account.role' => $_POST['search'],
			);
		}

		$dataList = $this->getDataRow($tableName, $select, $like, $limit, $join, $tableName . '.time DESC');


		//pagenation
		$this->load->library('pagination');

		$config['base_url'] = base_url(get_class($this) . '/' . __FUNCTION__);
		$config['total_rows'] = count($this->getDataRow($tableName, 'pkey'));
		$config['per_page'] = $perpage;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['cur_tag_open'] = '<li class="paginate_button page-item active"><a class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="paginate_button page-item">';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="paginate_button page-item next">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="paginate_button page-item next">';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="paginate_button page-item">';
		$config['first_tag_close'] = '</li>';
		$config['attributes'] = array('class' => 'page-link');
		$this->pagination->initialize($config);
		$pagenation = $this->pagination->create_links();





		$data['html']['pagenation'] = $pagenation;
		$data['html']['title'] = 'List Deposit';
		$data['html']['dataList'] = $dataList;
		$data['html']['tableName'] = $tableName;
		$data['html']['form'] = get_class($this) . '/depositTransaction';
		$data['url'] = 'admin/depositTransactionList';
		$this->template($data);
	}

	public function depositTransaction($id = '')
	{
		$file_name = 'config.json';
		$file_path = FCPATH . $file_name; // FCPATH merupakan konstanta CI3 untuk path ke root directory

		if (!file_exists($file_path)) {
			$limit = array(
				'limit' => 350,
			);
			$json_data = json_encode($limit);
			file_put_contents($file_path, $json_data);
		}
		$limit = json_decode(file_get_contents($file_path))->limit; //limit dari file config


		$tableName = 'deposit_transaction';
		$tableDetail = '';
		$baseUrl = get_class($this) . '/' . __FUNCTION__;
		$detailRef = '';
		$formData = array(
			'pkey' => 'pkey',
			'customerkey' => 'customerKey',
			'createon' => 'sesionid',
			'depositkey' => 'depositKey',
			'calculate' => 'calculate',
			'totalpoint' => 'point',
			'time' => 'time',
			'note' => 'note',
		);
		$formDetail = array();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST['action'])) redirect(base_url($baseUrl . 'List'));
			//validate form
			$arrMsgErr = array();
			$point = $this->getDataRow('deposit', '*', array('pkey' => $_POST['depositKey']))[0]['point'];
			$_POST['point'] = (int) $point * str_replace(",", "", $_POST['calculate']);
			$now = strtotime("now");
			$midnight = strtotime(date('Y-m-d', $now) . ' midnight');
			$where = 'customerkey = ' . $_POST['customerKey'] . ' AND `time` BETWEEN ' . $midnight . ' AND ' . $now . '';
			$data = $this->getDataRow($tableName, 'SUM(totalpoint) AS total', $where);
			if ($data[0]['total'] + $_POST['point'] > $limit && $this->role <> 1) {
				$maxPoint = $limit - $data[0]['total'];
				array_push($arrMsgErr, "Point harian tidak boleh melebihi " . $limit . " Point harian sekarang " . number_format($data[0]['total']) . ", Maximal Deposit Point :" . $maxPoint);
			}
			$this->session->set_flashdata('arrMsgErr', $arrMsgErr);
			//validate form
			if (empty(count($arrMsgErr)))
				switch ($_POST['action']) {
					case 'add':
						$_POST['time'];
						$refkey = $this->insert($tableName, $this->dataForm($formData));
						$this->insertDetail($tableDetail, $formDetail, $refkey);

						//update customer
						$customerPoint = $this->getDataRow($tableName, 'SUM(totalpoint) as totalpoint', array('customerkey' => $_POST['customerKey']))[0]['totalpoint'];
						$customerTempPoint = $this->getDataRow('customer', 'temppoint', array('pkey' => $_POST['customerKey']))[0]['temppoint'];
						$customerRank = $this->getDataRow('level', 'pkey', array('rankpoint <=' => (int)$customerPoint + $_POST['point']), '1', '', '`level`.`rankpoint` DESC')[0]['pkey'];
						$dataUpdateCustomer = array(
							'point' => $customerPoint,
							'temppoint' => $customerTempPoint + $_POST['point'],
							'levelkey' => $customerRank,
						);
						$this->update('customer', $dataUpdateCustomer, array('pkey' => $_POST['customerKey']));
						//update customer

						redirect(base_url($baseUrl . 'List')); //wajib terakhir
						break;
					case 'update':
						$_POST['time'];
						$oldData = $this->getDataRow($tableName, '*', array('pkey' => $_POST['pkey']));
						$this->update($tableName, $this->dataForm($formData), array('pkey' => $_POST['pkey']));
						$this->updateDetail($tableDetail, $formDetail, $detailRef, $id);

						//update customer
						$customerPoint = $this->getDataRow($tableName, 'SUM(totalpoint) as totalpoint', array('customerkey' => $_POST['customerKey']))[0]['totalpoint'];
						$customerTempPoint = $this->getDataRow('customer', 'temppoint', array('pkey' => $_POST['customerKey']))[0]['temppoint'];
						$customerTempPoint = (int)$customerTempPoint - (int)$oldData[0]['totalpoint'];
						$customerRank = $this->getDataRow('level', 'pkey', array('rankpoint <=' => (int)$customerPoint + $_POST['point']), '1', '', '`level`.`rankpoint` DESC')[0]['pkey'];
						$dataUpdateCustomer = array(
							'point' => $customerPoint,
							'temppoint' => $customerTempPoint + $_POST['point'],
							'levelkey' => $customerRank,
						);
						$this->update('customer', $dataUpdateCustomer, array('pkey' => $_POST['customerKey']));
						//update customer


						redirect(base_url($baseUrl . 'List'));
						break;
				}
		}

		if (!empty($id)) {
			$dataRow = $this->getDataRow($tableName, '*', array('pkey' => $id), 1)[0];
			$this->dataFormEdit($formData, $dataRow);
		}







		$selValDeposit = $this->getDataRow('deposit', '*', '', '', '', 'name ASC');
		$selValCustomer = $this->getDataRow('customer', '*', '', '', '', 'name ASC');
		$data['html']['selValCustomer'] = $selValCustomer;
		$data['html']['selValDeposit'] = $selValDeposit;
		$data['html']['baseUrl'] = $baseUrl;
		$data['html']['title'] = 'Input Data Transaksi Deposit';
		$data['html']['err'] = $this->genrateErr();
		$data['url'] = 'admin/' . __FUNCTION__ . 'Form';
		$this->template($data);
	}

	public function levelList()
	{
		$tableName = 'level';

		$join = array();
		$select = '
			' . $tableName . '.*,
		';

		$dataList = $this->getDataRow($tableName, $select, '', '', $join);
		$data['html']['title'] = 'List Level';
		$data['html']['dataList'] = $dataList;
		$data['html']['tableName'] = $tableName;
		$data['html']['form'] = get_class($this) . '/level';
		$data['url'] = 'admin/levelList';
		$this->template($data);
	}

	public function level($id = '')
	{
		$tableName = 'level';
		$tableDetail = '';
		$baseUrl = get_class($this) . '/' . __FUNCTION__;
		$detailRef = '';
		$formData = array(
			'pkey' => 'pkey',
			'name' => 'name',
			'rankpoint' => array('rankPoint', 'number'),
		);
		$formDetail = array();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST['action'])) redirect(base_url($baseUrl . 'List'));
			//validate form
			$arrMsgErr = array();
			$point = $this->getDataRow('deposit', '*', array('pkey' => $_POST['depositKey']))[0]['point'];
			$_POST['point'] = $point * str_replace(",", "", $_POST['calculate']);

			$this->session->set_flashdata('arrMsgErr', $arrMsgErr);
			//validate form
			if (empty(count($arrMsgErr)))
				switch ($_POST['action']) {
					case 'add':
						$refkey = $this->insert($tableName, $this->dataForm($formData));
						$this->insertDetail($tableDetail, $formDetail, $refkey);
						$upload = array(
							'postname' => 'logo',
							'tablename' => $tableName,
							'colomname' => 'img',
							'pkey' => $refkey,
						);
						$this->uploadImg($upload);
						redirect(base_url($baseUrl . 'List')); //wajib terakhir
						break;
					case 'update':
						$this->update($tableName, $this->dataForm($formData), array('pkey' => $_POST['pkey']));
						$this->updateDetail($tableDetail, $formDetail, $detailRef, $id);
						$upload = array(
							'postname' => 'logo',
							'tablename' => $tableName,
							'colomname' => 'img',
							'pkey' => $_POST['pkey'],
							'replace' => true
						);
						$this->uploadImg($upload);
						redirect(base_url($baseUrl . 'List'));
						break;
				}
		}

		if (!empty($id)) {
			$dataRow = $this->getDataRow($tableName, '*', array('pkey' => $id), 1)[0];
			$this->dataFormEdit($formData, $dataRow);
		}

		$data['html']['baseUrl'] = $baseUrl;
		$data['html']['title'] = 'Input Data Transaksi Deposit';
		$data['html']['err'] = $this->genrateErr();
		$data['url'] = 'admin/' . __FUNCTION__ . 'Form';
		$this->template($data);
	}

	public function headList()
	{
		$tableName = 'head';

		$join = array(
			array('account', 'account.pkey=' . $tableName . '.createon', 'left'),
			array('role', 'role.pkey=account.role', 'left'),
		);
		$select = '
			' . $tableName . '.*,
			account.name as createname,
			account.role as createrole,
			role.name as rolename,
		';

		$dataList = $this->getDataRow($tableName, $select, '', '', $join);
		$data['html']['title'] = 'List Head Seo';
		$data['html']['dataList'] = $dataList;
		$data['html']['tableName'] = $tableName;
		$data['html']['form'] = get_class($this) . '/head';
		$data['url'] = 'admin/headList';
		$this->template($data);
	}

	public function head($id = '')
	{
		$tableName = 'head';
		$tableDetail = '';
		$baseUrl = get_class($this) . '/' . __FUNCTION__;
		$detailRef = '';
		$formData = array(
			'pkey' => 'pkey',
			'name' => 'name',
			'html' => 'html',
			'createon' => 'sesionid',
			'time' => 'time',
		);
		$formDetail = array();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST['action'])) redirect(base_url($baseUrl . 'List'));
			//validate form
			$arrMsgErr = array();
			if (empty($_POST['name']))
				array_push($arrMsgErr, 'nama Wajib Di isi');

			$this->session->set_flashdata('arrMsgErr', $arrMsgErr);
			//validate form
			if (empty(count($arrMsgErr)))
				switch ($_POST['action']) {
					case 'add':
						$refkey = $this->insert($tableName, $this->dataForm($formData));
						$this->insertDetail($tableDetail, $formDetail, $refkey);
						redirect(base_url($baseUrl . 'List')); //wajib terakhir
						break;
					case 'update':
						$this->update($tableName, $this->dataForm($formData), array('pkey' => $_POST['pkey']));
						$this->updateDetail($tableDetail, $formDetail, $detailRef, $id);
						redirect(base_url($baseUrl . 'List'));
						break;
				}
		}

		if (!empty($id)) {
			$dataRow = $this->getDataRow($tableName, '*', array('pkey' => $id), 1)[0];
			$this->dataFormEdit($formData, $dataRow);
		}

		$data['html']['baseUrl'] = $baseUrl;
		$data['html']['title'] = 'Input Data Transaksi Deposit';
		$data['html']['err'] = $this->genrateErr();
		$data['url'] = 'admin/' . __FUNCTION__ . 'Form';
		$this->template($data);
	}
	public function bannerList()
	{
		$tableName = 'banner';
		$join = array(
			array('account', 'account.pkey=' . $tableName . '.createon', 'left'),
			array('role', 'role.pkey=account.role', 'left'),
		);
		$select = '
			' . $tableName . '.*,
			account.name as createname,
			account.role as createrole,
			role.name as rolename,
		';


		$dataList = $this->getDataRow($tableName, $select, '', '', $join);
		$data['html']['title'] = 'List Banner';
		$data['html']['dataList'] = $dataList;
		$data['html']['tableName'] = $tableName;
		$data['html']['form'] = get_class($this) . '/banner';
		$data['url'] = 'admin/bannerList';
		$this->template($data);
	}

	public function banner($id = '')
	{
		$tableName = 'banner';
		$tableDetail = '';
		$baseUrl = get_class($this) . '/' . __FUNCTION__;
		$detailRef = '';
		$formData = array(
			'pkey' => 'pkey',
			'name' => 'name',
			'createon' => 'sesionid',
			'time' => 'time',
		);
		$formDetail = array();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST['action'])) redirect(base_url($baseUrl . 'List'));
			//validate form
			$arrMsgErr = array();
			if (empty($_POST['name']))
				array_push($arrMsgErr, 'Nama Wajib Di isi');
			if ($_POST['action'] == 'add')
				if (empty($_FILES['banner']['name']))
					array_push($arrMsgErr, "Gambar wajib Di isi");

			$this->session->set_flashdata('arrMsgErr', $arrMsgErr);
			//validate form
			if (empty(count($arrMsgErr)))
				switch ($_POST['action']) {
					case 'add':
						$refkey = $this->insert($tableName, $this->dataForm($formData));
						$this->insertDetail($tableDetail, $formDetail, $refkey);
						$upload = array(
							'postname' => 'banner',
							'tablename' => $tableName,
							'colomname' => 'img',
							'pkey' => $refkey,
						);
						$this->uploadImg($upload);
						redirect(base_url($baseUrl . 'List')); //wajib terakhir
						break;
					case 'update':
						$this->update($tableName, $this->dataForm($formData), array('pkey' => $_POST['pkey']));
						$this->updateDetail($tableDetail, $formDetail, $detailRef, $id);
						$upload = array(
							'postname' => 'banner',
							'tablename' => $tableName,
							'colomname' => 'img',
							'pkey' => $_POST['pkey'],
							'replace' => true,
						);
						$this->uploadImg($upload);
						redirect(base_url($baseUrl . 'List'));
						break;
				}
		}

		if (!empty($id)) {
			$dataRow = $this->getDataRow($tableName, '*', array('pkey' => $id), 1)[0];
			$this->dataFormEdit($formData, $dataRow);
		}

		$data['html']['baseUrl'] = $baseUrl;
		$data['html']['title'] = 'Input Data ' . __FUNCTION__;
		$data['html']['err'] = $this->genrateErr();
		$data['url'] = 'admin/' . __FUNCTION__ . 'Form';
		$this->template($data);
	}

	public function rewardList()
	{
		$tableName = 'reward';
		$join = array(
			array('account', 'account.pkey=' . $tableName . '.createon', 'left'),
			array('role', 'role.pkey=account.role', 'left'),
		);
		$select = '
			' . $tableName . '.*,
			account.name as createname,
			account.role as createrole,
			role.name as rolename,
		';


		$dataList = $this->getDataRow($tableName, $select, '', '', $join);
		$data['html']['title'] = 'List Reward';
		$data['html']['dataList'] = $dataList;
		$data['html']['tableName'] = $tableName;
		$data['html']['form'] = get_class($this) . '/reward';
		$data['url'] = 'admin/rewardList';
		$this->template($data);
	}

	public function reward($id = '')
	{
		$tableName = 'reward';
		$tableDetail = '';
		$baseUrl = get_class($this) . '/' . __FUNCTION__;
		$detailRef = '';
		$formData = array(
			'pkey' => 'pkey',
			'title' => 'title',
			'name' => 'name',
			'point' => array('point', 'number'),
			'createon' => 'sesionid',
			'time' => 'time',
		);
		$formDetail = array();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST['action'])) redirect(base_url($baseUrl . 'List'));
			//validate form
			$arrMsgErr = array();
			if (empty($_POST['name']))
				array_push($arrMsgErr, 'Nama Wajib Di isi');
			if (empty($_POST['title']))
				array_push($arrMsgErr, 'Title Wajib Di isi');
			if (empty($_POST['point']))
				array_push($arrMsgErr, 'Point Wajib Di isi');
			if ($_POST['action'] == 'add')
				if (empty($_FILES['img']['name']))
					array_push($arrMsgErr, "Gambar wajib Di isi");

			$this->session->set_flashdata('arrMsgErr', $arrMsgErr);
			//validate form
			if (empty(count($arrMsgErr)))
				switch ($_POST['action']) {
					case 'add':
						$refkey = $this->insert($tableName, $this->dataForm($formData));
						$this->insertDetail($tableDetail, $formDetail, $refkey);
						$upload = array(
							'postname' => 'img',
							'tablename' => $tableName,
							'colomname' => 'img',
							'pkey' => $refkey,
						);
						$this->uploadImg($upload);
						redirect(base_url($baseUrl . 'List')); //wajib terakhir
						break;
					case 'update':
						$this->update($tableName, $this->dataForm($formData), array('pkey' => $_POST['pkey']));
						$this->updateDetail($tableDetail, $formDetail, $detailRef, $id);
						$upload = array(
							'postname' => 'img',
							'tablename' => $tableName,
							'colomname' => 'img',
							'pkey' => $_POST['pkey'],
							'replace' => true
						);
						$this->uploadImg($upload);
						redirect(base_url($baseUrl . 'List'));
						break;
				}
		}

		if (!empty($id)) {
			$dataRow = $this->getDataRow($tableName, '*', array('pkey' => $id), 1)[0];
			$this->dataFormEdit($formData, $dataRow);
		}

		$data['html']['baseUrl'] = $baseUrl;
		$data['html']['title'] = 'Input Data ' . __FUNCTION__;
		$data['html']['err'] = $this->genrateErr();
		$data['url'] = 'admin/' . __FUNCTION__ . 'Form';
		$this->template($data);
	}
	public function linkList()
	{
		$tableName = 'link';
		$join = array(
			array('account', 'account.pkey=' . $tableName . '.createon', 'left'),
			array('role', 'role.pkey=account.role', 'left'),
		);
		$select = '
			' . $tableName . '.*,
			account.name as createname,
			account.role as createrole,
			role.name as rolename,
		';


		$dataList = $this->getDataRow($tableName, $select, '', '', $join);
		$data['html']['title'] = 'List Link';
		$data['html']['dataList'] = $dataList;
		$data['html']['tableName'] = $tableName;
		$data['html']['form'] = get_class($this) . '/link';
		$data['url'] = 'admin/linkList';
		$this->template($data);
	}

	public function link($id = '')
	{
		$tableName = 'link';
		$tableDetail = '';
		$baseUrl = get_class($this) . '/' . __FUNCTION__;
		$detailRef = '';
		$formData = array(
			'pkey' => 'pkey',
			'name' => 'name',
			'wa' => 'wa',
			'in' => 'in',
			'register' => 'register',
			'claim' => 'claim',
			'createon' => 'sesionid',
			'time' => 'time',
		);
		$formDetail = array();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST['action'])) redirect(base_url($baseUrl . 'List'));
			//validate form
			$arrMsgErr = array();
			if (empty($_POST['name']))
				array_push($arrMsgErr, 'Nama Wajib Di isi');
			if (empty($_POST['wa']))
				array_push($arrMsgErr, 'WhatsApp Wajib Di isi');
			if (empty($_POST['in']))
				array_push($arrMsgErr, 'Link masuk Wajib Di isi');
			if (empty($_POST['register']))
				array_push($arrMsgErr, 'Link Daftar Wajib Di isi');
			if (empty($_POST['claim']))
				array_push($arrMsgErr, 'Link Klaim Wajib Di isi');


			$this->session->set_flashdata('arrMsgErr', $arrMsgErr);
			//validate form
			if (empty(count($arrMsgErr)))
				switch ($_POST['action']) {
					case 'add':
						$refkey = $this->insert($tableName, $this->dataForm($formData));
						$this->insertDetail($tableDetail, $formDetail, $refkey);
						redirect(base_url($baseUrl . 'List')); //wajib terakhir
						break;
					case 'update':
						$this->update($tableName, $this->dataForm($formData), array('pkey' => $_POST['pkey']));
						$this->updateDetail($tableDetail, $formDetail, $detailRef, $id);
						redirect(base_url($baseUrl . 'List'));
						break;
				}
		}

		if (!empty($id)) {
			$dataRow = $this->getDataRow($tableName, '*', array('pkey' => $id), 1)[0];
			$this->dataFormEdit($formData, $dataRow);
		}

		$data['html']['baseUrl'] = $baseUrl;
		$data['html']['title'] = 'Input Data ' . __FUNCTION__;
		$data['html']['err'] = $this->genrateErr();
		$data['url'] = 'admin/' . __FUNCTION__ . 'Form';
		$this->template($data);
	}

	public function contentList()
	{
		$tableName = 'content';
		$join = array(
			array('account', 'account.pkey=' . $tableName . '.createon', 'left'),
			array('role', 'role.pkey=account.role', 'left'),
		);
		$select = '
			' . $tableName . '.*,
			account.name as createname,
			account.role as createrole,
			role.name as rolename,
		';

		$dataList = $this->getDataRow($tableName, $select, '', '', $join);
		$data['html']['title'] = 'List content';
		$data['html']['dataList'] = $dataList;
		$data['html']['tableName'] = $tableName;
		$data['html']['form'] = get_class($this) . '/content';
		$data['url'] = 'admin/contentList';
		$this->template($data);
	}

	public function content($id = '')
	{
		$tableName = 'content';
		$tableDetail = '';
		$baseUrl = get_class($this) . '/' . __FUNCTION__;
		$detailRef = '';
		$formData = array(
			'pkey' => 'pkey',
			'name' => 'name',
			'createon' => 'sesionid',
			'time' => 'time',
			'content' => 'content',
		);
		$formDetail = array();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST['action'])) redirect(base_url($baseUrl . 'List'));
			//validate form
			$arrMsgErr = array();
			if (empty($_POST['name']))
				array_push($arrMsgErr, 'Nama Wajib Di isi');
			if (empty($_POST['content']))
				array_push($arrMsgErr, 'Content Wajib Di isi');


			$this->session->set_flashdata('arrMsgErr', $arrMsgErr);
			//validate form
			if (empty(count($arrMsgErr)))
				switch ($_POST['action']) {
					case 'add':
						$refkey = $this->insert($tableName, $this->dataForm($formData));
						$this->insertDetail($tableDetail, $formDetail, $refkey);
						redirect(base_url($baseUrl . 'List')); //wajib terakhir
						break;
					case 'update':
						$this->update($tableName, $this->dataForm($formData), array('pkey' => $_POST['pkey']));
						$this->updateDetail($tableDetail, $formDetail, $detailRef, $id);
						redirect(base_url($baseUrl . 'List'));
						break;
				}
		}

		if (!empty($id)) {
			$dataRow = $this->getDataRow($tableName, '*', array('pkey' => $id), 1)[0];
			$this->dataFormEdit($formData, $dataRow);
		}

		$data['html']['baseUrl'] = $baseUrl;
		$data['html']['title'] = 'Input Data ' . __FUNCTION__;
		$data['html']['err'] = $this->genrateErr();
		$data['url'] = 'admin/' . __FUNCTION__ . 'Form';
		$this->template($data);
	}

	public function claimList()
	{
		$tableName = 'claim';
		$join = array(
			array('account', 'account.pkey=' . $tableName . '.createon', 'left'),
			array('role', 'role.pkey=account.role', 'left'),
			array('customer', 'customer.pkey=' . $tableName . '.customerkey', 'left'),
			array('reward', 'reward.pkey=' . $tableName . '.rewardkey', 'left'),
		);
		$select = '
			' . $tableName . '.*,
			account.name as createname,
			account.role as createrole,
			role.name as rolename,
			customer.name as customername,
			reward.title as titlereward,
			reward.point as pointreward,
			reward.img as rewardimg,
		';

		$dataList = $this->getDataRow($tableName, $select, '', '', $join);
		$data['html']['title'] = 'List Calaim';
		$data['html']['dataList'] = $dataList;
		$data['html']['tableName'] = $tableName;
		$data['html']['role'] = $this->role;
		$data['html']['form'] = get_class($this) . '/claim';
		$data['url'] = 'admin/claimList';
		$this->template($data);
	}

	public function claim($id = '')
	{
		$tableName = 'claim';
		$tableDetail = '';
		$baseUrl = get_class($this) . '/' . __FUNCTION__;
		$detailRef = '';
		$formData = array(
			'pkey' => 'pkey',
			'createon' => 'sesionid',
			'time' => 'time',
			'customerkey' => 'customerKey',
			'rewardkey' => 'rewardKey',
			'rewardpoint' => 'rewardPoint',
			'note' => 'note',
		);
		$formDetail = array();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST['action'])) redirect(base_url($baseUrl . 'List'));
			//validate form
			$arrMsgErr = array();
			if (empty($_POST['customerKey']))
				array_push($arrMsgErr, "Nama Pelanggan wajib Di isi");
			if (empty($_POST['rewardKey']))
				array_push($arrMsgErr, "Reward wajib Di isi");
			// cek point mencukupi atau tidak
			$nowPoint = $this->getDataRow('customer', 'temppoint', array('pkey' => $_POST['customerKey']))[0]['temppoint'];
			$rewardPoint = $this->getDataRow('reward', 'point', array('pkey' => $_POST['rewardKey']))[0]['point'];

			if ((int)$nowPoint < (int)$rewardPoint)
				array_push($arrMsgErr, "Point tidak mencukupi saat in Point = " . number_format($nowPoint));

			$this->session->set_flashdata('arrMsgErr', $arrMsgErr);
			//validate form
			if (empty(count($arrMsgErr)))
				switch ($_POST['action']) {
					case 'add':
						$_POST['rewardPoint'] = $this->getDataRow('reward', 'point', array('pkey' => $_POST['rewardKey']))[0]['point'];
						$nowPoint = $this->getDataRow('customer', 'temppoint', array('pkey' => $_POST['customerKey']))[0]['temppoint'];
						$updatePoint = (int)$nowPoint - (int)$_POST['rewardPoint'];
						$this->update('customer', array('temppoint' => $updatePoint), array('pkey' => $_POST['customerKey']));

						$refkey = $this->insert($tableName, $this->dataForm($formData));
						$this->insertDetail($tableDetail, $formDetail, $refkey);
						redirect(base_url($baseUrl . 'List')); //wajib terakhir
						break;
					case 'update':
						// mengembalikan Point
						$rewardPoint = $this->getDataRow($tableName, 'rewardpoint', array('pkey' => $_POST['pkey']))[0]['rewardpoint'];
						$nowPoint = $this->getDataRow('customer', 'temppoint', array('pkey' => $_POST['customerKey']))[0]['temppoint'];
						$updatePoint = (int)$nowPoint + $rewardPoint;
						$this->update('customer', array('temppoint' => $updatePoint), array('pkey' => $_POST['customerKey']));

						//memasukan ulang Point
						$_POST['rewardPoint'] = $this->getDataRow('reward', 'point', array('pkey' => $_POST['rewardKey']))[0]['point'];
						$nowPoint = $this->getDataRow('customer', 'temppoint', array('pkey' => $_POST['customerKey']))[0]['temppoint'];
						$updatePoint = (int)$nowPoint - (int)$_POST['rewardPoint'];
						$this->update('customer', array('temppoint' => $updatePoint), array('pkey' => $_POST['customerKey']));


						$_POST['rewardPoint'] = $this->getDataRow('reward', 'point', array('pkey' => $_POST['rewardKey']))[0]['point'];
						$this->update($tableName, $this->dataForm($formData), array('pkey' => $_POST['pkey']));
						$this->updateDetail($tableDetail, $formDetail, $detailRef, $id);
						redirect(base_url($baseUrl . 'List'));
						break;
				}
		}

		if (!empty($id)) {
			$dataRow = $this->getDataRow($tableName, '*', array('pkey' => $id), 1)[0];
			$this->dataFormEdit($formData, $dataRow);
		}
		$selValCustomer = $this->getDataRow('customer', '*', '', '', '', 'customer.name');
		$selValReward = $this->getDataRow('reward', '*', '', '', '', 'reward.title');
		$data['html']['selValReward'] = $selValReward;
		$data['html']['selValCustomer'] = $selValCustomer;
		$data['html']['baseUrl'] = $baseUrl;
		$data['html']['title'] = 'Input Data ' . __FUNCTION__;
		$data['html']['err'] = $this->genrateErr();
		$data['url'] = 'admin/' . __FUNCTION__ . 'Form';
		$this->template($data);
	}
	public function getTarnsaction()
	{
		// echo json_encode($_POST);

		// die; //datatable config
		$allData = array();
		$colomOrder = array(
			'customer.name',
			'deposit.name',
			'deposit_transaction.calculate',
			'deposit_transaction.totalpoint',
			'deposit_transaction.time',
			'account.name',
		);

		$tableName = 'deposit_transaction';
		$select = '
			' . $tableName . '.*,
			deposit.name as depositname,
			customer.name as customername,
			account.name as createname,
			account.role as createrole,
			role.name as rolename,
			';
		$limit = [$this->input->post('length'), $this->input->post('start')];
		$joint = array(
			array('deposit', 'deposit.pkey=' . $tableName . '.depositkey', 'left'),
			array('customer', 'customer.pkey=' . $tableName . '.customerkey', 'left'),
			array('account', 'account.pkey=' . $tableName . '.createon', 'left'),
			array('role', 'role.pkey=account.role', 'left'),
		);
		$like = array();



		$order = '';
		if ($this->input->post('draw') == 1) {
			$order = 'pkey desc';
		} else {
			$order = $colomOrder[$this->input->post('order')[0]['column']] . ' ' . $this->input->post('order')[0]['dir'];
		}
		if (!empty($this->input->post('search')['value'])) {
			$param = $this->input->post('search')['value'];
			$like = array(
				array('deposit_transaction.time', strtotime($param)),
				array('deposit_transaction.totalpoint', $param),
				array('deposit_transaction.calculate', $param),
				array('deposit.name', $param),
				array('customer.name', $param),
				array('account.name', $param),
				array('account.role', $param),
				array('role.name', $param),
			);
			// $like = array(
			// 	'deposit_transaction.time' => strtotime($param),
			// 	'deposit_transaction.totalpoint' => $param,
			// 	'deposit_transaction.calculate' => $param,
			// 	'deposit.name' => $param,
			// 	'customer.name' => $param,
			// 	'account.name' => $param,
			// 	'account.role' => $param,
			// 	'role.namea' => $param,
			// );
		}




		$transaction = $this->getDataRow($tableName, $select, '', $limit, $joint, $order, '', $like);
		$countData = $this->getDataRow($tableName, $tableName . '.pkey', '', '', $joint, $order, '', $like);
		$countDataTotal = $this->getDataRow($tableName, $tableName . '.pkey');
		foreach ($transaction as $key => $value) {
			$arr = array(
				$value['customername'],
				$value['depositname'],
				number_format($value['calculate']),
				number_format($value['totalpoint']),
				date("d / m / Y  H:i", $value['time']),
				$value['createname'] . '|' . $value['rolename'],
				'<a href="' . base_url('Admin/depositTransaction/') . $value['pkey'] . '" class="btn btn-primary">Edit</a>' .
					'<button class="btn btn-danger ml-3" name="delete" data="' . $tableName . '" value="' . $value['pkey'] . '">Delete</button>',

			);
			array_push($allData, $arr);
		}




		$data =  array(
			'draw' => $this->input->post('draw'),
			'recordsTotal' => count($countDataTotal),
			'recordsFiltered' => count($countData),
			'data' => $allData,
		);
		echo json_encode($data);
	}






	public function userList()
	{
		$file_name = 'config.json';
		$file_path = FCPATH . $file_name; // FCPATH merupakan konstanta CI3 untuk path ke root directory

		if (!file_exists($file_path)) {
			$limit = array(
				'limit' => 350,
			);
			$json_data = json_encode($limit);
			file_put_contents($file_path, $json_data);
		}
		$limit = json_decode(file_get_contents($file_path))->limit;


		if ($this->session->userdata('role') != '1')
			redirect(base_url());
		$tableName = 'account';
		$join = array(
			array('role', 'role.pkey=account.role', 'left'),
		);
		$dataList = $this->getDataRow($tableName, 'account.*, role.name as rolename', '', '', $join, 'name ASC');
		$data['html']['title'] = 'List Account';
		$data['html']['limit'] = $limit;
		$data['html']['dataList'] = $dataList;
		$data['html']['tableName'] = $tableName;
		$data['html']['form'] = get_class($this) . '/user';
		$data['url'] = 'admin/userList';
		$this->template($data);
	}

	public function user($id = '')
	{
		$tableName = 'account';
		$tableDetail = '';
		$baseUrl = get_class($this) . '/' . __FUNCTION__;
		$detailRef = '';
		$formData = array(
			'pkey' => 'pkey',
			'name' => 'name',
			'username' => 'username',
			'role' => 'role',
		);
		$formDetail = array();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST['action'])) redirect(base_url($baseUrl . 'List'));
			//validate form
			$arrMsgErr = array();
			if (empty($_POST['name']))
				array_push($arrMsgErr, "Password wajib Di isi");

			if (empty($_POST['password']) && $_POST['action'] == 'add')
				array_push($arrMsgErr, "Password wajib Di isi");
			if ($_POST['role'] == '1')
				unset($_POST['detailKey']);



			$this->session->set_flashdata('arrMsgErr', $arrMsgErr);
			//validate form
			if (empty(count($arrMsgErr)))
				switch ($_POST['action']) {
					case 'add':
						$formData['password'] = array('password', 'md5');
						$refkey = $this->insert($tableName, $this->dataForm($formData));
						$this->insertDetail($tableDetail, $formDetail, $refkey);
						redirect(base_url($baseUrl . 'List')); //wajib terakhir
						break;
					case 'update':
						if (!empty($_POST['password']))
							$formData['password'] = array('password', 'md5');
						$this->update($tableName, $this->dataForm($formData), array('pkey' => $_POST['pkey']));
						$this->updateDetail($tableDetail, $formDetail, $detailRef, $id);
						redirect(base_url($baseUrl . 'List'));
						break;
				}
		}

		if (!empty($id)) {
			$dataRow = $this->getDataRow($tableName, '*', array('pkey' => $id), 1)[0];
			$this->dataFormEdit($formData, $dataRow);
			$_POST['password'] = '';
		}
		$selVal = $this->getDataRow('role', '*', '', '', '', 'name ASC');
		$selValClass = $this->getDataRow('class', '*', '', '', '', 'name ASC');

		$data['html']['selValClass'] = $selValClass;
		$data['html']['baseUrl'] = $baseUrl;
		$data['html']['selVal'] = $selVal;
		$data['html']['title'] = 'Input Data ' . __FUNCTION__;
		$data['html']['err'] = $this->genrateErr();
		$data['url'] = 'admin/' . __FUNCTION__ . 'Form';
		$this->template($data);
	}

	public function ajax()
	{
		if (empty($_POST['action'])) {
			echo 'no action';
			die;
		}
		switch ($_POST['action']) {
			case 'delete':
				switch ($_POST['tbl']) {
					case 'deposit_transaction':
						$oldData = $this->getDataRow($_POST['tbl'], '*', array('pkey' => $_POST['pkey']));
						$this->delete($_POST['tbl'], 'pkey=' . $_POST['pkey']);

						//update customer
						$customerPoint = $this->getDataRow($_POST['tbl'], 'SUM(totalpoint) as totalpoint', array('customerkey' => $oldData[0]['customerkey']))[0]['totalpoint'];
						$customerTempPoint = $this->getDataRow('customer', 'temppoint', array('pkey' => $oldData[0]['customerkey']))[0]['temppoint'];
						$customerTempPoint = (int)$customerTempPoint - (int)$oldData[0]['totalpoint'];

						$customerRank = $this->getDataRow('level', 'pkey', '', '', '', 'level.rankpoint ASC')[0]['pkey'];
						if (!empty($customerPoint))
							$customerRank = $this->getDataRow('level', 'pkey', array('rankpoint <=' => $customerPoint), '1', '', '`level`.`rankpoint` DESC')[0]['pkey'];

						$dataUpdateCustomer = array(
							'point' => $customerPoint,
							'temppoint' => $customerTempPoint,
							'levelkey' => $customerRank,
						);
						$this->update('customer', $dataUpdateCustomer, array('pkey' => $oldData[0]['customerkey']));
						//update customer
						break;
					case 'level':
						$oldData = $this->getDataRow($_POST['tbl'], '*', array('pkey' => $_POST['pkey']));
						$this->load->helper("file");
						unlink('./uploads/' . $oldData[0]['img']);
						$this->delete($_POST['tbl'], 'pkey=' . $_POST['pkey']);
						break;
					default:
						switch ($_POST['tbl']) {
							case 'claim':
								$data = $this->getDataRow($_POST['tbl'], '*', array('pkey' => $_POST['pkey']))[0];
								$nowPoint = $this->getDataRow('customer', 'temppoint', array('pkey' => $data['customerkey']))[0]['temppoint'];
								$updatePoint = (int)$nowPoint + (int)$data['rewardpoint'];
								$this->update('customer', array('temppoint' => $updatePoint), array('pkey' => $data['customerkey']));

								$this->delete($_POST['tbl'], 'pkey=' . $_POST['pkey']);
								break;

							default:
								$this->delete($_POST['tbl'], 'pkey=' . $_POST['pkey']);
								break;
						}


						break;
				}
				break;
			case 'getDeposit':
				$data = $this->getDataRow('deposit', '*', array('pkey' => $_POST['pkey']));
				echo json_encode($data);
				break;
			case 'statusHead':
				$this->update('head', array('status' => '0'), array('status' => '1'));
				$this->update('head', array('status' => '1'), array('pkey' => $_POST['pkey']));
				break;
			case 'statuslink':
				$this->update('link', array('status' => '0'), array('status' => '1'));
				$this->update('link', array('status' => '1'), array('pkey' => $_POST['pkey']));
				break;
			case 'statusBanner':
				$oldststus = $this->getDataRow('banner', 'status', array('pkey' => $_POST['pkey']));
				$status = '1';
				if ($oldststus[0]['status'] == '1')
					$status = '0';
				$this->update('banner', array('status' => $status), array('pkey' => $_POST['pkey']));
				break;
			case 'statusContent':
				$oldststus = $this->getDataRow('content', 'status', array('pkey' => $_POST['pkey']));
				$status = '1';
				if ($oldststus[0]['status'] == '1')
					$status = '0';
				$this->update('content', array('status' => $status), array('pkey' => $_POST['pkey']));
				break;
			default:
				echo 'action is not in the list';
				break;
		}
	}

	public function export($action, $param)
	{
		switch ($action) {
			case 'student':
				$exportData = array();
				$dataSelect = '
				students.*,
				class.name as classname,
				students_detail.memorikey
				';
				$dataJoin = array(
					array('class', 'class.pkey=' . $param, 'left'),
					array('students_detail', 'students_detail.studentkey=students.pkey', 'left'),
					array('student_memori_detail', 'students_detail.studentkey=students.pkey', 'left'),
				);
				$data = $this->getDataRow('students', $dataSelect, array('classkey' => $param), '', $dataJoin, 'students.name ASC');

				foreach ($data as $dataKey => $dataValue) {
					$subExportData = array(
						'studentname' => $dataValue['name'],
						'classname' => $dataValue['classname'],
					);
					print_r($dataValue);
					echo '<br>';
					echo '<br>';
				}

				break;
			case 'label':
				# code...
				break;
			default:
				# code...
				break;
		}
	}
	public function configs()
	{
		$limit = $this->input->post('limit'); // ambil nilai limit dari $_POST
		$data = array(
			'limit' => $limit,
		);
		$json_data = json_encode($data);

		$file_name = 'config.json';
		$file_path = FCPATH . $file_name;

		$result = file_put_contents($file_path, $json_data);
		if ($result === false) {
			return json_encode(['status' => false, 'message' => 'Failed to write data to file.']);
		}

		return json_encode(['status' => true]);
	}
}
