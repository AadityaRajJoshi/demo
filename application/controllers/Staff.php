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

			$this->data[ 'breadcrumb' ] = get_msg( 'breadcrumb_all_staff' );	
			
			$this->data['staffs'] = $this->user_m->get( '*', array(
				'role_id' =>get_role_id("staff")
			));
			$this->data['page'] = 'list_staff_v';
			$this->data['current_menu'] = 'staff';
			$this->load->view( 'dashboard_template_v', $this->data );	
		}
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