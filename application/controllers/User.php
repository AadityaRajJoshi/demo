<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->helper('form');
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
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required' );
		$this->form_validation->set_rules('password', 'Password', 'required' );
		/* check validation*/
		if ( $this->form_validation->run() ){
			$username = $this->input->post( 'username' );
			$remember = $this->input->post( 'remember_me' );
			$password = md5( $this->input->post( 'password' ) );
			$select = strpos( $username, '@' ) ? 'email' : 'username' ;

			$condition = array(
				$select    => $username,
				'password' => $password
			);

			$this->load->model( 'user_m' );

			$db_user = $this->user_m->get( '*', $condition, 1 );

			if ( !$db_user ) {
				$this->session->set_flashdata( 'error', 'Username And Password Not Match' );
				
				redirect( get_route( 'login' ) );

			} else {
				$this->session->set_userdata(array(
					'id' => $db_user->id,	
					'name' => $username,
					'role' => get_role_by_id($db_user->role_id)
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
				redirect( 'dashboard' );
			}
		}

		$this->index();
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

	    if ($this->session->userdata('id'))
	        redirect(get_route('dashboard', 'refresh'));
	}
}