<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->data['page'] = 'staff/staff_dashboard_v';
		$this->load->view('dashboard_v', $this->data);
	}
}
