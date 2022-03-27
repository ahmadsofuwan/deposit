<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{
	public function index()
	{
		load_class('Content', 'controller');
		$this->Content;
	}
}
