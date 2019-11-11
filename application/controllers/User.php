<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
	public function __construct(){

		parent::__construct();
		$this->load->helper('form');
		$this->data['menu'] = get_menu();
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
				$this->session->set_flashdata( 'error', get_msg( 'up_mismatched' ) );
				
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

	public function edit( $id = null ){

		if( is_admin() ){	
			$this->load->model('user_m');
			 
			$this->data['meta'] = array(
				'title' => 'Admin',
				'description' => 'Staff Description',
				'keyword' => 'staff, admin, employee'
			);
			$this->data['staff'] = $this->user_m->get( '*', array( 
				'id'=>$id ), 1 );
			$this->data['page'] = 'edit_staff_v';
			$this->load->view('dashboard_template_v', $this->data);
		}
	}

	public function update(){

		if( is_admin() ){
			$this->load->model('user_m');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('name', 'Username', 'required' );
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email' );
			$this->form_validation->set_rules('number', 'phone number', 'required' );
			
			$id = $this->input->post('id');

			if( $this->form_validation->run() ){
				$name = $this->input->post( 'name' );
				$email = $this->input->post( 'email' );
				$phone_number = $this->input->post( 'number' );
				
				$pass = $this->input->post( 'password' );


				$data = array( 
				'username' => $name,
				'phone_number' => $phone_number,
				'email' => $email,
				
				);

				if( $pass != '' ){
					$data[ 'password' ] = md5( $pass );
				}

				if( $this->user_m->save( $data, array('id'=>$id) ) ) {
					$this->session->set_flashdata( 'success', get_msg( 'staff_edit' ) );
					redirect( get_route( 'staff' ) );
				}
			}
			$this->edit( $id );
		}
	}
}