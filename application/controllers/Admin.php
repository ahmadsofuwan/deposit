<?php

use phpDocumentor\Reflection\Types\This;

defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends MY_Controller
{

	public function index()
	{
		$data['html']['title'] = 'Dasboard';
		$this->template($data);
	}

	public function customerList()
	{
		$tableName = 'customer';
		$dataList = $this->getDataRow($tableName, '* ,', '', '', '', 'name ASC');
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
			'createon' => 'createon',
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
