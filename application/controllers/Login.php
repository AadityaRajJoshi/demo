<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->helper('form');
	}

	public function index(){
		$this->check_login();
		$data = array(
			'meta' => array(
				'title' => 'Login',
				'description' => 'Login panel',
				'keyword' => 'staff, admin, employee'
			),
			'page' => 'login/login_v'
		);
		$this->load->view('login_template_v', $data);
	}

	public function login_attempt(){
		$this->check_login();
		$this->load->library('form_validation');

		$username = $this->input->post( 'username' );
		$password = md5( $this->input->post( 'password' ) );
		$remember = $this->input->post( 'remember' );

		$this->form_validation->set_rules('username', 'Username', 'required' );
		$this->form_validation->set_rules('password', 'Password', 'required' );

		$select = strpos( $username, '@' ) ? 'email' : 'username' ;
		if ( $this->form_validation->run() ){
			$condition = array(
				$select    => $username,
				'password' => $password
			);
			$this->load->model( 'user_m' );
			$db_user = $this->user_m->get( '*', $condition, 1 );
			if( !$db_user ){
				$this->session->set_flashdata( 'login_error', 'Username And Password Not Match' );
				redirect( '/' );
			}else{
				$this->session->set_userdata('logged_in_user', array(
					'id' => $db_user->id,	
					'name' => $username,
					'role' => $this->config->item('role')[$db_user->role_id]	
				));
				redirect( 'dashboard' );
			}
		}else{
			$this->session->set_flashdata( 'login_error', 'Fields Cannot be empty' );
			redirect( '/' );
		}
	}

	public function logout() {
	    $this->session->sess_destroy();
	    redirect( '/' );
	}

	public function check_login(){
	    if ($this->session->userdata('logged_in_user'))
	        redirect('dashboard', 'refresh');
	}
}