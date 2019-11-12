<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
	}

	public function index(){
		$this->data[ 'meta' ][ 'title' ] = 'event';
		$this->data['page'] = 'all_event_v';
		$this->data['current_menu'] = 'event';
		$this->load->view('dashboard_template_v', $this->data);
	}

	public function add(){
		if( !is_admin() ){
			do_redirect( 'dashboard' );
		}
		$this->load->model( 'user_m' );
		$staffs = array();
		$db_staffs = $this->user_m->get( array( 'id', 'username' ) , array(
			'role_id' =>get_role_id("staff")
		));
		foreach ($db_staffs as $value) {
			$staffs[ $value->id ] = $value->username;
		}
		$this->data[ 'staffs' ] = $staffs;
		$this->data[ 'meta' ][ 'title' ] = 'add event';
		$this->data['page'] = 'add_event_v';
		$this->data['current_menu'] = 'event';
		$this->load->view('dashboard_template_v', $this->data);
	}
}