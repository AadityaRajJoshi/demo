<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model( 'event_m' );
	}

	public function index(){

		$start_date = $this->input->get( 'f' );
		$end_date = $this->input->get('t');

		if( is_staff() ){
			$this->load->model( 'user_m' );
			$this->data[ 'events' ] = $this->user_m->get_events('', $start_date, $end_date);
		}else{
			$this->data[ 'events' ] = $this->event_m->get( '*', $start_date, $end_date );
		}
		$this->data[ 'meta' ] = get_msg( 'meta_event' );
		$this->data[ 'page' ] = 'event_list_v';
		$this->data[ 'current_menu' ] = 'event';
		$this->data[ 'common' ] = true;

		$this->data[ 'breadcrumb' ] = get_msg('breadcrumb_all_event');

		$this->load->view('dashboard_template_v', $this->data);
	}

	public function get_formatted_inputs($api=true){

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
				if(!empty($v)){
					$temp[] = $v . ':00';
				}
				$data[$key] = $event_date . ' ' .$v;
			}
			if(count($temp) == 2)
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
			'city',
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

		$data[ 'finished' ] = false;

		if($api){
			echo json_encode(array(
				'status' => 200,
				'data' => $this->get_formatted_time( $data )
			));

			return;
		}
		return $data;
	}

	public function save( $is_update = false ){

		$this->form_validation->set_rules('name', get_msg('label_event_name'), 'required' );
		$this->form_validation->set_rules('order_number', get_msg('label_event_order'), 'required' );
		$this->form_validation->set_rules('date', get_msg('label_event_date'), 'required' );
		$this->form_validation->set_rules('city', get_msg('label_event_city'), 'required' );
		$this->form_validation->set_rules('start_time', get_msg('label_event_starttime'), 'required' );
		$this->form_validation->set_rules('stop_time', get_msg('label_event_stoptime'), 'required' );
		$this->form_validation->set_rules('traveltime_1_start', get_msg('label_event_traveltime_1_start'), 'required' );
		$this->form_validation->set_rules('traveltime_1_stop', get_msg('label_event_traveltime_1_stop'), 'required' );
		$this->form_validation->set_rules('traveltime_2_start', get_msg('label_event_traveltime_2_start'), 'required' );
		$this->form_validation->set_rules('traveltime_2_stop', get_msg('label_event_traveltime_2_stop'), 'required' );
		$this->form_validation->set_rules('construction_start', get_msg('label_event_construction_start'), 'required' );
		$this->form_validation->set_rules('construction_stop', get_msg('label_event_construction_stop'), 'required' );
		$this->form_validation->set_rules('dismantling_start', get_msg('label_event_dismantling_start'), 'required' );
		$this->form_validation->set_rules('dismantling_stop', get_msg('label_event_dismantling_stop'), 'required' );
		$this->form_validation->set_rules('add_staff[]', 'Add Staff', 'required' );

		if($this->form_validation->run()){

			$data = $this->get_formatted_inputs(false);

			$this->load->model( 'events_staff_m' );
			$this->load->model( 'user_m' );

			$this->db->trans_start();

			if( $is_update ){
				$event_id = $is_update;
				$this->events_staff_m->delete( array( 'event_id' => $event_id ) );
				$this->event_m->save( $data, array('id'=>$event_id) );
			}else{
				$event_id = $this->event_m->save( $data );
			}

			$event_staff = $this->input->post( 'add_staff' );
			$event_package_staff = $this->input->post( 'add_package_staff' );

			# add staff to table
			foreach ($event_staff as $s) {
				$add_staff = array(
					'user_id' => $s,
					'event_id' => $event_id,
					'type' =>  $event_package_staff && $s == $event_package_staff ? 3 : 1
				);
				$this->events_staff_m->save( $add_staff );
			}

			if($is_update){
				$t = $this->input->post('old_staff');
			}else{
				# Send sms to newly added staffs
				$staffs = $this->user_m->get_by_ids($event_staff);
				foreach($staffs as $staff){
					$msg = str_replace('{event}', $data['name'], get_msg('sms_added_to_event'));
					$this->send_sms(array(
						'number' => $staff->phone_number,
						'message' => $msg,
					));
				}
			}

			# add package staff to table
			if( $event_package_staff && !in_array( $event_package_staff , $event_staff) ){
				$add_event_staff = array(
					'user_id' => $event_package_staff,
					'event_id' => $event_id,
					'type' =>  2
				);
				$this->events_staff_m->save( $add_event_staff );
			}

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

	public function get_formatted_time($event){

		if(is_array($event)){
			$event = (object) $event;
		}

		$event->date = get_date_from_datetime($event->start_time, 'Y-m-d');
		$event->total_worktime = seconds_to_time($event->total_worktime);
		$event->traveltime_1 = get_start_end_time($event->traveltime_1_start, $event->traveltime_1_stop);
		$event->construction_time = get_start_end_time($event->construction_start, $event->construction_stop);
		$event->event_time = get_start_end_time($event->start_time,$event->stop_time);
		$event->dismantling_time = get_start_end_time($event->dismantling_start, $event->dismantling_stop);
		$event->traveltime_2 = get_start_end_time($event->traveltime_2_start, $event->traveltime_2_stop);

		return $event;
	}

	public function view( $id ){

		$this->data['common'] = true;
		$this->data['meta'] = get_msg('meta_event_detail');
		$this->data['breadcrumb'] = get_msg('breadcrumb_event_preview');
		$this->data['page'] = 'event_detail_v';
		$this->data['current_menu'] = 'event';

		if(is_staff()){		
			$session_user = $this->session->userdata('id');
			$users = $this->event_m->get_users($id);
			$available_user = array_map(function($v){
				return $v->id;
			}, $users);
			if( !in_array($session_user, $available_user) ){
				$this->invalid_access();
			}
		}
			
		$query = $this->event_m->get( '*', array( 'id'=>$id ), 1 );
		if(!$query){
			$this->invalid_access();
		}

		$this->data['event'] = $this->get_formatted_time($query);

		$staff = $this->event_m->get_users( $id );
		$event_staff = '';
		$event_package_staff = '';
		
		foreach ($staff as $value) {
			if( $value->type == 1 ){
				$event_staff .= ucfirst($value->username).', ';
			}elseif( $value->type == 2 ){
				$event_package_staff =  ucfirst($value->username);
			}else{
				$event_staff .= ucfirst($value->username).', ';
				$event_package_staff =  ucfirst($value->username);
			}
		}

		$this->data[ 'event_package_staff' ] = $event_package_staff;
		$this->data[ 'event_staff' ] = rtrim( $event_staff, ', ' );
		$this->data['breadcrumb'][] = $query->name;
		$this->load->view( 'dashboard_template_v', $this->data );
	}

	public function add(){
		if( !is_admin() ){
			$this->invalid_access();
		}

		$this->data[ 'meta' ] = get_msg( 'meta_add_event' );
		$this->data[ 'page' ] = 'event_add_v';
		$this->data[ 'current_menu' ] = 'event';
		$this->data[ 'date' ] = false;
		$this->data[ 'time' ] = false;
		$this->data[ 'breadcrumb' ] = get_msg('breadcrumb_add_event');
		$this->data[ 'event' ] = false;
		$this->data[ 'event_users' ] = [];
		$this->data[ 'staffs' ] = get_staffs_dropdown();	
		$this->save();
		$this->data[ 'mode' ] = 'add';
		$this->data[ 'event_package_staff' ] = '';
		$this->data[ 'event_staff' ] = '';
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

		$event = $this->get_formatted_time($event);

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
		$users = $this->events_staff_m->get( array( 'user_id', 'type' ), array( 'event_id'=> $id ) );

		$event_staff = array();
		$event_package_staff = false;
		foreach ($users as $u) {
			if( $u->type == 3){
				$event_staff[] = $u->user_id;
				$event_package_staff = $u->user_id;
			}elseif( $u->type == 2 ){
				$event_package_staff = $u->user_id;
			}else{
				$event_staff[] = $u->user_id;	
			}
		}

		$this->data[ 'meta' ] = get_msg( 'meta_event_edit' );
		$this->data[ 'page' ] = 'event_add_v';
		$this->data[ 'current_menu' ] = 'events';
		$this->data[ 'breadcrumb' ] = get_msg( 'breadcrumb_event_edit' );
		$this->data[ 'event' ] = $event;
		$this->data[ 'mode' ] = 'edit';
		$this->data[ 'event_package_users' ] = $event_package_staff;
		$this->data[ 'event_users' ] = $event_staff;
		$this->data[ 'staffs' ] = get_staffs_dropdown();
		$this->data[ 'event_staff' ] = '';
		$this->load->view( 'dashboard_template_v', $this->data );		
	}

	public function sendMail(){

		$config = array(
			'protocol' => 'sendmail',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_port' => 465,
			'smtp_user' => 'cloudprazol@gmail.com',
			'smtp_pass' => 'cloud_prajwol',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
		);

		$message = 'This is Test email';
		$this->load->library('email', $config);
		$this->email->clear();
		$this->email->set_newline("\r\n");
		$this->email->from('cloudprazol@gmail.com'); // change it to yours
		$this->email->to('cloudaaditya@gmail.com');// change it to yours
		$this->email->subject('Resume from JobsBuddy for your Job posting');
		$this->email->message($message);
		// echo  "called";die;
		if( $this->email->send() ){
			echo "mail sent";
		}else{
			echo "error";
			var_export( $this->email->print_debugger() );
		}
	}
}