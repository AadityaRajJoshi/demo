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
		$db_user = $this->user_m->get( array( 'id', 'username' ) , array(
			'role_id' =>get_role_id("staff")
		), 1);
		var_export( $db_user );
		$this->data[ 'meta' ][ 'title' ] = 'add event';
		$this->data['page'] = 'add_event_v';
		$this->data['current_menu'] = 'event';
		$this->data[ 'staffs' ] = 
		$this->load->view('dashboard_template_v', $this->data);
	}
}