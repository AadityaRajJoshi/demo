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
	    if ( !$this->session->userdata('id') ){
	        redirect( '/' );
	    }

	    $this->data['menu'] = $this->get_menu();
	}

	public function get_menu(){
		$role = $this->session->userdata('role');
		if('administrator' == $role){
			return array(
				'staff' => 'Staff',
				'event' => 'Event',
				'logout' => 'Logout',
			);
		}elseif('staff' == $role){
			return array(
				'logout' => 'Logout',

			);
		}
	}
}