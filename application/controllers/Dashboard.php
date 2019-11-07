<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{

	public function index(){
		$role = $this->session->userdata('role');
		$this->data['page'] = 'administrator' == $role ? 'admin_dashboard_v' : 'staff_dashboard_v';
		$this->load->view('dashboard_v', $this->data);
	}
}