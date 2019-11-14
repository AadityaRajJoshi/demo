<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	public function index(){
		$this->load->model( 'event_m' );
		$this->data[ 'meta' ][ 'title' ] = get_msg( 'event' );
		$this->data[ 'page' ] = 'all_event_v';
		$this->data[ 'events' ] = $this->event_m->get( '*' );
		$this->data[ 'current_menu' ] = 'event';
		$this->data[ 'breadcrumb' ] = array( get_msg( 'event' ),get_msg( 'all_event' ) );
		$this->load->view('dashboard_template_v', $this->data);
	}

	public function add(){
		if( !is_admin() ){
			do_redirect( 'dashboard' );
		}
		$this->load->model( 'event_m' );
		$this->data[ 'meta' ][ 'title' ] = get_msg( 'add_event' );
		$this->data[ 'page' ] = 'add_event_v';
		$this->data[ 'current_menu' ] = 'event';
		$this->data[ 'breadcrumb' ] = array(get_msg( 'event' ),get_msg( 'add_event' ));
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
			$data[ 'total_worktime' ] = $this->input->post('date') . ' ' . get_total_working_time( $formated_date() );
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
			if( !$id ){
				$data[ 'finished' ] = false;
			}

			foreach ( $optional_value as $key => $value) {
				if( $this->input->post( $value )){
					$data[ $value ] = $this->input->post( $value );
				}
			}
			$this->load->model( 'event_m' );
			$this->load->model( 'package_staff_m' );
			$this->load->model( 'staff_m' );
			$where_event = $id ? array('id'=>$id) : false;
			$where_staff = $id ? array('event_id'=>$id) : false;

			$this->db->trans_start();
			$event_id = $this->event_m->save( $data, $where_event );

			$event_releated_staff = $this->input->post( 'add_staff' );
			foreach ( $event_releated_staff as  $value) {
				$insert_staff = array(
					'user_id' => $value,
					'event_id' => $event_id
				);
				$this->staff_m->save( $insert_staff, $where_staff );
			}

			if( $this->input->post( 'add_package_staff' ) ){
				$event_releated_package_staff = $this->input->post( 'add_package_staff' );
				$insert_package_staff = array(
					'user_id' => $this->input->post( 'add_package_staff' ),
					'event_id' => $event_id
				);
			}

			$this->package_staff_m->save( $insert_package_staff, $where_staff );

			if ($this->db->trans_status() === FALSE){
			    $this->db->trans_rollback();
			   	$this->session->set_flashdata( 'error', get_msg( 'event_rollback_error' ) );
			}else{
			    $this->db->trans_commit();
			    if( $id ){
			    	$this->session->set_flashdata( 'success', get_msg( 'event_update' ) );
			    	do_redirect('event');
			    }else{
			    	$this->session->set_flashdata( 'success', get_msg( 'event_added' ) );
			    	do_redirect('event');
			    }
			}

		}
	}

	public function status(){
		$id = $this->input->post( 'event_id' );
		$this->load->model( 'event_m' );
		$event_status = $this->event_m->get( array( 'finished' ), array( 'id' => $id ),1 );
		$status = $event_status->finished;
		$data = array(
			'finished' => $status ? false : true,
		);
		$this->event_m->save( $data, array( 'id' => $id ) );
	}
}