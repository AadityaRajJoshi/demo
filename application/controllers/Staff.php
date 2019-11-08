<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('user_m');
	} 

	public function index(){

		if( $this->is_admin() ){

			$this->data['staffs'] = $this->user_m->get( '*', array(
				'role_id' =>get_role_id("staff")
			));

			$this->data['page'] = 'list_staff_v';
			$this->load->view( 'dashboard_template_v', $this->data );	

			$this->is_admin();
		}
	}

	public function add(){
		if( $this->is_admin() ){

			$this->data['page'] = 'add_staff_v';
			$this->load->helper('email');

			$this->form_validation->set_rules('name', 'Username', 'required' );
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email' );
			$this->form_validation->set_rules('number', 'phone number', 'required' );
			$this->form_validation->set_rules('password', 'Password', 'required' );
			$this->form_validation->set_rules('displayname', 'Display Name', 'required' );

			if( $this->form_validation->run() ){
				$username = $this->input->post( 'name' );
				$email = $this->input->post( 'email' );
				$phone_number = $this->input->post( 'number' );
				$password = md5($this->input->post( 'password' ));
				$displayname = $this->input->post( 'displayname' );

				$data = array(
					'username'=> $username,
					'email' => $email,
					'password' => $password,
					'Phone_number' => $phone_number,
					'Display_name' => $displayname,
					'role_id' => get_role_id("staff")
				);
				if( $this->user_m->save( $data ) ){
					$this->session->set_flashdata( 'success', get_msg( 'staff_added' ) );
					redirect( get_route( 'staff' ) );
				}else{
					$this->session->set_flashdata( 'error', get_msg( 'up_mismatched' ) );
					redirect( get_route('staff/add'));
				}
			}

			$this->load->view( 'dashboard_template_v', $this->data );	
		}
	}

	public function edit( $id = null ){
		if( $this->is_admin() ){	

			$this->data['staff'] = $this->user_m->get( '*', array( 
				'id'=>$id ) );
			$this->data['page'] = 'edit_staff_v';
			$this->load->view('dashboard_template_v', $this->data);	
		}
	}

	public function update(){
		if( $this->is_admin() ){

			$name = $this->input->post( 'name' );
			$email = $this->input->post( 'email' );
			$phone_number = $this->input->post( 'number' );
			$displayname = $this->input->post( 'displayname' );

			$id = $this->input->post('id');

			$data = array( 
				'username' => $name,
				'phone_number' => $phone_number,
				'email' => $email,
				'display_name' => $displayname,
			);
		
			if( $this->user_m->save( $data, array(
				'id'=>$id
			) )){
				$this->session->set_flashdata( 'success', get_msg( 'staff_edit' ) );
				redirect( get_route( 'staff' ) );
			}else{
				$this->session->set_flashdata( 'error', get_msg( 'staff_edit_e' ) );
			}
		}
	}

	public function delete( $id = null ){
		if( $this->is_admin() ){
			$this->data['page'] = 'delete_v';
			$this->load->view( 'dashboard_template_v', $this->data );

			
			// if($this->user_m->delete( array('id'=>$id) )){
			// 	$this->session->set_flashdata( 'success', get_msg( 'staff_delete' ) );
			// 	redirect( get_route( 'staff' ) );
		}
	}
	
}