<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller{
	

	public function index(){
		// echo 'staff list';
		// $this->load->view( 'pages/list-staff' );
		$this->load->model( 'User_Model' );
		$query = $this->User_Model->get( '*' );
		// var_dump($query);
		$this->load->view('list-staff', $query);
	}

	public function add_user(){
		$this->load->helper('form');
		$this->load->view('pages/user');
	}

	public function add(){

		$this->load->library('form_validation');
		$this->load->model( 'User_Model' );


		$name = $this->input->post( 'name' );
		$email = $this->input->post( 'email' );
		$phone_number = $this->input->post( 'number' );
		$password = md5($this->input->post( 'password' ) );
		$displayname = $this->input->post('displayname');

		$this->form_validation->set_rules('name', 'Name', 'required' );
		$this->form_validation->set_rules('email', 'Email', 'required' );
		$this->form_validation->set_rules('number', 'Number', 'required' );
		$this->form_validation->set_rules('password', 'Password', 'required' );
		$this->form_validation->set_rules('displayname', 'Display Name', 'required' );

		if( $this->form_validation->run() ){

			$data = array( 
				'username' => $name,
				'password' => $password,
				'email' => $email,
				'display_name' => $displayname,
				'role_id' => 2
			 );

			$query =$this->User_Model->save( $data );

			if( $query ){
				redirect('User');
			}else{
				echo "error";
			}

		}else{
			$this->load->view( 'pages/user' );
		}
	}
}