<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model( 'event_m' );
	}

	public function index(){
		if( is_staff() ){
			$this->load->model( 'user_m' );
			$this->data[ 'events' ] = $this->user_m->get_events();
		}else{
			$this->data[ 'events' ] = $this->event_m->get( '*' );
		}
		$this->data[ 'meta' ][ 'title' ] = get_msg( 'event' );
		$this->data[ 'page' ] = 'all_event_v';
		$this->data[ 'current_menu' ] = 'event';
		$this->data[ 'common' ] = true;
		$this->data[ 'breadcrumb' ] = get_msg('breadcrumb_event_list');
		$this->load->view('dashboard_template_v', $this->data);
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

		if($this->form_validation->run()){

			$input_time = array(
				array(
					'start_time',
					'stop_time',
				),
				array(
					'traveltime_1_start',
					'traveltime_1_stop',
				),
				array(
					'traveltime_2_start',
					'traveltime_2_stop',
				),
				array(
					'construction_start',
					'construction_stop',
				),
				array(
					'dismantling_start',
					'dismantling_stop',
				)
			);
			
			$data = array(
				'total_worktime' => 0
			);

			$event_date = $this->input->post('date');
			foreach ($input_time as $pair ) {
				$temp = [];
				foreach($pair as $key){
					$v = $this->input->post($key);
					$data[$key] = $event_date . ' ' .$v;
					$temp[] = $v . ':00';
				}
				$data['total_worktime'] += get_time_diff($temp);
			} 
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

			$this->load->model( 'events_package_staff_m' );
			$this->load->model( 'events_staff_m' );

			$this->db->trans_start();
			if( $id ){
				$this->events_staff_m->delete( array( 'event_id' => $id ) );
				$this->events_package_staff_m->delete( array('event_id' => $id) );
				$this->event_m->save( $data, array('id'=>$id) );
				$is_update = true;
			}else{
				$id = $this->event_m->save( $data );
				$is_update = false;
			}

			$event_releated_staff = $this->input->post( 'add_staff' );

			foreach( $event_releated_staff as  $value){
				$insert_staff = array(
					'user_id' => $value,
					'event_id' => $id
				);
				$this->events_staff_m->save( $insert_staff );
			}

			if( $this->input->post( 'add_package_staff' ) ){
				$event_releated_package_staff = $this->input->post( 'add_package_staff' );
				$insert_package_staff = array(
					'user_id' => $this->input->post( 'add_package_staff' ),
					'event_id' => $id
				);
			}

			$this->events_package_staff_m->save( $insert_package_staff );

			if ($this->db->trans_complete()){
			    if( $is_update ){
			    	$this->data['success'][] = get_msg( 'event_update' );
			    }else{
			    	$this->session->set_flashdata( 'success', get_msg( 'event_added' ) );
			    	do_redirect('event');
			    }
			}else{
			   	$this->session->set_flashdata( 'error', get_msg( 'event_rollback_error' ) );
			   	do_redirect('event');
			}
		}
	}

	public function toggle_status(){

		$data = array(
			'status' => 500,
			'message' => get_msg( 'toggle_status_error' )
		);

		if( is_admin() ){
			$id = $this->input->post( 'event_id' );
			$query = $this->event_m->get(array('finished'), array('id' => $id), 1);
			if($query){
				$status = $query->finished;
				$data = array(
					'finished' => $status ? false : true,
				);
				$updated = $this->event_m->save( $data, array( 'id' => $id ) );
				if($updated){
					$data['status'] = 200;
					$data['message'] = get_msg('toggle_status_success');
				}
			}
		}

		echo json_encode($data);
	}

	public function view( $id ){
		$this->data['common'] = true;
		$this->data['meta'] = get_msg('meta_event_detail');
		$this->data['breadcrumb'] = get_msg('breadcrumb_event_preview');
		$this->data['page'] = 'event_detail_v';
		$this->data['current_menu'] = 'event';
		$query = $this->event_m->get( '*', array( 'id'=>$id ), 1 );
		if(!$query){
			$this->invalid_access();
		}
		$this->data['event'] = $query;
		$this->data['breadcrumb'][] = $query->name;
		$this->load->view( 'dashboard_template_v', $this->data );

		// $this->load->model( 'events_package_staff_m' );
		// $user = $this->events_package_staff_m->get( 'user_id', array('event_id' => $id) );
		// var_dump($user) ;

	}

	public function add(){
		if( !is_admin() ){
			$this->invalid_access();
		}

		$this->data[ 'meta' ][ 'title' ] = get_msg( 'add_event' );
		$this->data[ 'page' ] = 'add_event_v';
		$this->data[ 'current_menu' ] = 'event';
		$this->data[ 'date' ] = false;
		$this->data[ 'time' ] = false;
		$this->data[ 'breadcrumb' ] = array(get_msg( 'event' ),get_msg( 'add_event' ));
		$this->data[ 'event' ] = false;
		$this->data[ 'event_users' ] = [];
		$this->data[ 'staffs' ] = get_staffs_dropdown();	
		$this->save();
		$this->load->view( 'dashboard_template_v', $this->data );
	}

	public function edit($id=null){

		if( !is_admin() || !$id ){
			$this->invalid_access();
		}

		$event = $this->event_m->get('*', array('id'=>$id ), 1);
		if(!$event){
			$this->invalid_access();
		}

		if('post' == $this->input->method()){
			$this->save( $id );
			$event = $this->event_m->get('*', array('id'=>$id ), 1);
		}

		// $event_users = array_map(function($v){
		// 	return $v->user_id;
		// }, $users);		

		$event->date = get_date_from_datetime( $event->start_time, 'Y-m-d' );

		$arr = array(
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

		foreach ($arr as $value) {
			$event->$value = get_time_from_datetime( $event->$value );
		}

		$this->load->model( 'events_staff_m' );
		$users = $this->events_staff_m->get( 'user_id', array( 'event_id'=> $id ) );
		
		$event_users = array_map(function($v){
			return $v->user_id;
		}, $users);

		$this->load->model( 'events_package_staff_m' );
		$package_user = $this->events_package_staff_m->get( 'user_id', array( 'event_id'=> $id ) );

		$event_package_users = array_map(function($v){
			return $v->user_id;
		}, $package_user);

		$this->data[ 'meta' ] = get_msg( 'meta_event_edit' );
		$this->data[ 'page' ] = 'add_event_v';
		$this->data[ 'current_menu' ] = 'event';
		$this->data[ 'breadcrumb' ] = get_msg( 'breadcrumb_event_edit' );
		$this->data[ 'event' ] = $event;
		$this->data[ 'event_package_users' ] = $event_package_users[0];
		$this->data[ 'event_users' ] = $event_users;
		$this->data[ 'staffs' ] = get_staffs_dropdown();
		$this->load->view( 'dashboard_template_v', $this->data );
		
	} 
}