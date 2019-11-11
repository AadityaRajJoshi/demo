<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
	}

	public function index(){

		$user = $this->session->userdata('role');
		if( 'administrator' == $user ){
			$this->data['page'] = 'admin_dashboard_v';
		}elseif( 'staff' == $user ){
			$this->data['page'] = 'staff_dashboard_v';
		}

		$this->load->view('dashboard_template_v', $this->data);
	}
}