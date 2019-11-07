<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	protected $data = array(
		'meta' => array(
			'title' => 'Admin',
			'description' => 'Staff Description',
			'keyword' => 'staff, admin, employee'
		)
	);

	public function __construct(){
		parent::__construct();
		$this->check_login();
	}

	public function check_login(){
	    if ( $this->session->userdata( 'logged_in_user' ) )
	        redirect( 'dashboard' );
	    else
	        return FALSE;
	}
}