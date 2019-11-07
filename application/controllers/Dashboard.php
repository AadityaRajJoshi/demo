<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->model( 'User_Model' );
		$this->load->helper( 'form' );

		if( !$this->check_user_session_alive() ) {
 			redirect( 'login' );
		}
	}

	public function index(){
		$this->load->view( 'pages/dashboard' );
	}
}