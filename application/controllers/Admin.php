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

		$dataList = $this->getDataRow($tableName, $tableName . '.*,level.name as levelname', '', '', $join, 'name ASC');
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
			if (empty($_POST['name']))
				array_push($arrMsgErr, "Nama wajib Di isi");

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

	public function depositTransactionList()
	{
		$tableName = 'deposit_transaction';

		$join = array(
			array('deposit', 'deposit.pkey=' . $tableName . '.depositkey'),
			array('customer', 'customer.pkey=' . $tableName . '.customerkey'),
		);
		$select = '
			' . $tableName . '.*,
			deposit.name as depositname,
			customer.name as customername,
		';

		$dataList = $this->getDataRow($tableName, $select, '', '', $join);
		$data['html']['title'] = 'List Deposit';
		$data['html']['dataList'] = $dataList;
		$data['html']['tableName'] = $tableName;
		$data['html']['form'] = get_class($this) . '/depositTransaction';
		$data['url'] = 'admin/depositTransactionList';
		$this->template($data);
	}

	public function depositTransaction($id = '')
	{
		$tableName = 'deposit_transaction';
		$tableDetail = '';
		$baseUrl = get_class($this) . '/' . __FUNCTION__;
		$detailRef = '';
		$formData = array(
			'pkey' => 'pkey',
			'customerkey' => 'customerKey',
			'createon' => 'createon',
			'depositkey' => 'depositKey',
			'calculate' => 'calculate',
			'totalpoint' => 'point',
			'note' => 'note',
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
						//update customer
						$customerPoint = $this->getDataRow($tableName, 'SUM(totalpoint) as totalpoint', array('customerkey' => $_POST['customerKey']))[0]['totalpoint'];
						$customerTempPoint = $this->getDataRow('customer', 'temppoint', array('pkey' => $_POST['customerKey']))[0]['temppoint'];
						$customerRank = $this->getDataRow('level', 'pkey', '`rankpoint` <=250', '1', '', '`level`.`rankpoint` DESC')[0]['pkey'];
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








	public function userList()
	{
		if ($this->session->userdata('role') != '1')
			redirect(base_url());
		$join = array(
			array('role', 'role.pkey=account.role', 'left'),
		);
		$dataList = $this->getDataRow('account', 'account.*, role.name as rolename', '', '', $join, 'name ASC');
		$data['html']['title'] = 'List Account';
		$data['html']['dataList'] = $dataList;
		$data['html']['form'] = get_class($this) . '/user';
		$data['url'] = 'admin/userList';
		$this->template($data);
	}

	public function user($id = '')
	{
		$tableName = 'account';
		$tableDetail = 'account_detail';
		$baseUrl = get_class($this) . '/' . __FUNCTION__;
		$detailRef = '';
		$formData = array(
			'pkey' => 'pkey',
			'name' => 'name',
			'username' => 'username',
			'password' => array('password', 'md5'),
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
				$this->delete($_POST['tbl'], 'pkey=' . $_POST['pkey']);
				break;
			case 'getDeposit':
				$data = $this->getDataRow('deposit', '*', array('pkey' => $_POST['pkey']));
				echo json_encode($data);
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
}
