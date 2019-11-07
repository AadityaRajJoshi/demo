<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model( 'User_Model' );
	}

	public function check_user_session_alive(){
		$user_status = $this->session->userdata( 'logged_in_user' );
		$query = false;
		if( $user_status ){
			$query = $this->User_Model->get( '*', $user_status );
		}
		return $query;
	}
}