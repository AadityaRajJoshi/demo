<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->helper('form');
		// $this->load->helper('cookie');
		// $this->check_login();
	}


	public function index(){
		
		$this->check_login();
		$cookie = json_decode( get_cookie( 'user_logged_in' ) );
		$user = false;
		if( '' != $cookie && isset( $cookie->user ) ){
			$user = array(
				'name' => $cookie->user,
				'pass' => $cookie->pass
			);
		}
		$data = array(
			'meta' => array(
				'title' => 'Login',
				'description' => 'Login panel',
				'keyword' => 'staff, admin, employee'
			),
			'page' => 'login_v',
			'cookie' => $user
		);
		$this->load->view('login_template_v', $data);

	}

	public function login(){

		if( $this->input->post('login') ) {

			$this->load->library('form_validation');

			$username = $this->input->post( 'username' );
			$remember = $this->input->post( 'remember_me' );
			$password = md5( $this->input->post( 'password' ) );

			$this->form_validation->set_rules('username', 'Username', 'required' );
			$this->form_validation->set_rules('password', 'Password', 'required' );


			$select = strpos( $username, '@' ) ? 'email' : 'username' ;
			/* check validation*/
			if ( $this->form_validation->run() ){

				$condition = array(
					$select    => $username,
					'password' => $password
				);

				$this->load->model( 'user_m' );

				$db_user = $this->user_m->get( '*', $condition, 1 );

				if ( !$db_user ) {
					$this->session->set_flashdata( 'login_error', 'Username And Password Not Match' );
					
					redirect( 'login' );

				} else {

					$this->session->set_userdata('logged_in_user', array(
						'id' => $db_user->id,	
						'name' => $username,
						'role' => $this->config->item('role')[$db_user->role_id]	
					));

					if( $this->input->post( 'remember_me' ) && 'on' == $this->input->post( 'remember_me' ) ) {

						set_cookie( 
							'user_logged_in', 
							json_encode( [
								'user' => $username,
								'pass' => $this->input->post( 'password' ),
							] ),
							30*60*60 
						);

					}
					redirect( 'staff' );
				}

			}
		}
		$this->session->set_flashdata( 'login_error', 'Fields Cannot be empty' );
		redirect( '/');
		
	}

	public function forgot(){

		$data = array(
			'meta' => array(
				'title' => 'Forgot Password?',
				'description' => '',
				'keyword' => ''
			),
			'page' => 'forgot_v'
		);
		$this->load->view( 'login_template_v', $data );
	}

	public function logout() {
	    $this->session->sess_destroy();
	    redirect( '/' );
	}

	public function check_login(){
	    if ($this->session->userdata('logged_in_user'))
	        redirect('staff', 'refresh');
	}
}