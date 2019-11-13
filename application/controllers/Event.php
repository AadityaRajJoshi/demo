<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
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
		$this->data[ 'staffs' ] = get_staffs_dropdown();
		$this->data[ 'meta' ][ 'title' ] = get_msg( 'add_event' );
		$this->data[ 'breadcrumb' ] = array(get_msg( 'event' ),get_msg( 'add_event' ));
		$this->data['page'] = 'add_event_v';
		$this->data['current_menu'] = 'event';

		$this->form_validation->set_rules('event-name', 'Event Name', 'required' );
		$this->form_validation->set_rules('ordernumber', 'Ordernumber', 'required' );
		$this->form_validation->set_rules('date', 'Date', 'required' );
		$this->form_validation->set_rules('event-start', 'Event Start', 'required' );
		$this->form_validation->set_rules('event-stop', 'Event Stop', 'required' );
		$this->form_validation->set_rules('traveltime-one-start', 'First Traveltime Start', 'required' );
		$this->form_validation->set_rules('traveltime-one-stop', 'First Traveltime Stop', 'required' );
		$this->form_validation->set_rules('traveltime-two-start', 'Second Traveltime Start', 'required' );
		$this->form_validation->set_rules('traveltime-two-stop', 'Second Traveltime Stop', 'required' );
		$this->form_validation->set_rules('construction-start', 'Construction Start Time', 'required' );
		$this->form_validation->set_rules('construction-stop', 'Construction Stop Time', 'required' );
		$this->form_validation->set_rules('dismantling-start', 'Dismantle Start Time', 'required' );
		$this->form_validation->set_rules('dismantling-stop', 'Dismantle Stop Time', 'required' );
		$this->form_validation->set_rules('add-staff', 'Add Staff', 'required' );

		if($this->form_validation->run()){			
			echo "<pre>";
			var_export( $_POST );
		}
		$this->load->view( 'dashboard_template_v', $this->data );
	}
}