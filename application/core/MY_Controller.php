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
				'dashboard' => 'Dashboard',
				'event' => array(
					'event/add' => 'Add Event',
					'event' 	=> 'All Event',
				),
				'staff' => array(
					'staff/add' => 'Add Staff' 
					'staff' 	=> 'Staff' 
				),
				'logout' => 'Logout',
			);
		}elseif('staff' == $role){
			return array(
				'dashboard' => 'Dashboard',
				'event' 	=> 'My Events' ,
				'setting'	=> 'Setting'
				'logout' 	=> 'Logout',
			);
		}
	}
}