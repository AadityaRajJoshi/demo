<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
	}

	public function index(){
		$this->data[ 'meta' ][ 'title' ] = 'dashboard';
		$this->data[ 'breadcrumb' ] = get_msg( 'dashboard' ) ;
		if( is_admin() ){
			$this->data['page'] = 'admin_dashboard_v';
		}elseif( is_staff() ){
			$this->data['page'] = 'staff_dashboard_v';
		}
		$this->data['current_menu'] = 'dashboard';
		$this->load->view('dashboard_template_v', $this->data);
	}
}