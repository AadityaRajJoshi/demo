<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->model( 'User_Model' );
		$this->load->helper( 'form' );
	}

	public function index(){
		$logged_in_user = $this->session->userdata( 'logged_in_user' );
		if( $logged_in_user[ 'role_id' ] == 1 ){
			$this->load->view( 'pages/admin-dashboard' );
		}else{
			$this->load->view( 'pages/staff-dashboard' );
		}
	}
}