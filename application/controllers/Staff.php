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

		if( is_admin() ){
			$this->data[ 'meta' ][ 'title' ] = get_msg( 'staff' );
			$this->data[ 'breadcrumb' ] = array(
				get_msg( 'staff' ),
				get_msg( 'all_staff' )
			);
			$this->data['staffs'] = $this->user_m->get( '*', array(
				'role_id' =>get_role_id("staff")
			));
			$this->data['page'] = 'list_staff_v';
			$this->data['current_menu'] = 'staff';

			$this->load->view( 'dashboard_template_v', $this->data );	
		}
	}

	public function add(){

		if(! is_admin())
			do_redirect('dashboard');
		
		$this->data[ 'meta' ][ 'title' ] = 'add staff';
		$this->data[ 'breadcrumb' ] = array(get_msg( 'staff' ),get_msg( 'add_staff' ));
		$this->data['page'] = 'add_staff_v';
		$this->data['current_menu'] = 'staff';
		$this->load->helper('email');

		$this->form_validation->set_rules('name', get_msg( 'username' ), 'required' );
		$this->form_validation->set_rules('email', get_msg( 'password' ), 'trim|required|valid_email' );
		$this->form_validation->set_rules('number', get_msg( 'number' ), 'required' );
		$this->form_validation->set_rules('password', get_msg( 'password' ), 'required' );
		if($this->form_validation->run()){
		
			$username = $this->input->post( 'name' );
			$email = $this->input->post( 'email' );
			$phone_number = $this->input->post( 'number' );
			$password = md5($this->input->post( 'password' ));
			
			$data = array(
				'username'=> $username,
				'email' => $email,
				'password' => $password,
				'Phone_number' => $phone_number,					
				'role_id' => get_role_id("staff")
			);
			if( $this->user_m->save( $data ) ){
				$this->session->set_flashdata( 'success', get_msg( 'staff_added' ) );
				do_redirect('staff');
			}else{
				$this->session->set_flashdata( 'error', get_msg( 'up_mismatched' ) );
				do_redirect('add_staff');
			}
		}

		$this->load->view( 'dashboard_template_v', $this->data );	
	}

	public function delete( $id = false ){
		if( $this->is_admin() ){

			$this->data['id'] = $id;
			$this->data['action'] = "staff/delete"; 
			$this->data['confirm'] = "Are You sure want to delete?";
			$this->data['page'] = 'delete_v';
			$this->load->view( 'dashboard_template_v', $this->data );

			if( $this->input->post('yes') ){
				$id = $this->input->post('id');
			
				if($this->user_m->delete(array('id'=>$id))){
					$this->session->set_flashdata( 'success', get_msg( 'staff_delete' ) );
				}
				do_redirect('staff');
			}
		}
	}	
}