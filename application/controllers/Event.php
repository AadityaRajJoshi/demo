<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
	}

	public function index(){
		$this->data[ 'meta' ][ 'title' ] =  get_msg( 'event' );
		$this->data['page'] = 'all_event_v';
		$this->data[ 'breadcrumb' ] = array( get_msg( 'event' ),get_msg( 'all_event' ) );
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
		$this->data[ 'meta' ][ 'title' ] = get_msg( 'add_event' );
		$this->data[ 'breadcrumb' ] = array(get_msg( 'event' ),get_msg( 'add_event' ));
		$this->data['page'] = 'add_event_v';
		$this->data['current_menu'] = 'event';
		$this->load->view('dashboard_template_v', $this->data);
	}

	public function save(){
		$this->form_validation->set_rules('event-name', 'Event Name', 'required' );
		$this->form_validation->set_rules('ordernumber', 'Ordernumber', 'required' );
		$this->form_validation->set_rules('date', 'Date', 'required' );
		$this->form_validation->set_rules('event-start', 'Event Start', 'required' );
		$this->form_validation->set_rules('event-stop', 'Event Stop', 'required' );
		$this->form_validation->set_rules('traveltime-one-start', 'Event Stop', 'required' );
		echo "<pre>";
		var_export( $_POST );
	}
}