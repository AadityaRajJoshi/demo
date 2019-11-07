<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model( 'User_Model' );
	}

	public function check_login(){
	    if ( $this->session->userdata( 'logged_in_user' ) )
	        redirect( 'dashboard' );
	    else
	        return FALSE;
	}
}