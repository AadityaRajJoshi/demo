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
		$this->data = array(
			'meta' => array(
				'title' => get_msg( 'add_event' ),
				'description' => '',
				'keyword' => ''
			),
			'page' => 'add_event_v',
			'breadcrumb' => array(get_msg( 'event' ),get_msg( 'add_event' )),
			'current_menu' =>'event',
			'staffs' => get_staffs_dropdown() 
		);
		$this->data[ 'staffs' ] = get_staffs_dropdown();
		$this->save();
	
		$this->load->view( 'dashboard_template_v', $this->data );
	}

	public function save( $id = false ){
		$this->form_validation->set_rules('name', 'Event Name', 'required' );
		$this->form_validation->set_rules('order_number', 'Ordernumber', 'required' );
		$this->form_validation->set_rules('date', 'Date', 'required' );
		$this->form_validation->set_rules('start_time', 'Event Start', 'required' );
		$this->form_validation->set_rules('stop_time', 'Event Stop', 'required' );
		$this->form_validation->set_rules('traveltime_1_start', 'First Traveltime Start', 'required' );
		$this->form_validation->set_rules('traveltime_1_stop', 'First Traveltime Stop', 'required' );
		$this->form_validation->set_rules('traveltime_2_start', 'Second Traveltime Start', 'required' );
		$this->form_validation->set_rules('traveltime_2_stop', 'Second Traveltime Stop', 'required' );
		$this->form_validation->set_rules('construction_start', 'Construction Start Time', 'required' );
		$this->form_validation->set_rules('construction_stop', 'Construction Stop Time', 'required' );
		$this->form_validation->set_rules('dismantling_start', 'Dismantle Start Time', 'required' );
		$this->form_validation->set_rules('dismantling_stop', 'Dismantle Stop Time', 'required' );
		$this->form_validation->set_rules('add_staff[]', 'Add Staff', 'required' );

		$ci = $this;
		$formated_date = function() use($ci){
			$date = array(
				'start_time',
				'stop_time',
				'traveltime_1_start',
				'traveltime_1_stop',
				'traveltime_2_start',
				'traveltime_2_stop',
				'construction_start',
				'construction_stop',
				'dismantling_start',
				'dismantling_stop',
			);
			$data=array();
			foreach ($date as $key ) {
				$data[$key] = $ci->input->post('date'). ' ' .$ci->input->post($key);
			}
			return $data;
		};

		if($this->form_validation->run()){		
			$data = $formated_date();		
			$optional_value = array(
				'name',
				'order_number',
				'packing_time',
				'address',
				'contact_person',
				'telephone_contact_person',
				'distance_to_event',
				'type_of_car',
				'link_gmap',
				'other_information',
				'add_products',
				'electricity'
			);

			foreach ( $optional_value as $key => $value) {
				if( $this->input->post( $value )){
					$data[ $value ] = $this->input->post( $value );
				}
			}

			$a = $this->input->post( 'add_staff' );
			$b = $this->input->post( 'add_package_staff' );
			echo "<pre>";
			var_export( $a );
			// var_export( $b );
			die;

			$this->load->model( 'event_m' );
			$this->event_m->save( $data );
		}
	}
}