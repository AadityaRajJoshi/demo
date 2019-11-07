<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$user = $this->session->userdata('logged_in_user');
		$this->data['page'] = 'administrator' == $user['role'] ? 'admin_dashboard_v' : 'staff_dashboard_v';
		$this->load->view('dashboard_template_v', $this->data);
	}
}