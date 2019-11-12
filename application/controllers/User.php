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
			}else{
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
				redirect(get_route('dashboard'));
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
	    redirect(get_route('login'), 'refresh');
	}

	public function check_login(){
	    if (is_logged_in()){
	        redirect(get_route('dashboard'), 'refresh');
	    }
	}

	public function profile(){
		$this->edit(get_session('id'), 'own');
	}

	public function edit( $id = null, $mode='other' ){

        if (! is_logged_in()){
            redirect(get_route('login'), 'refresh');
        }

        $invalid_access = function($instance){
        	$instance->session->set_flashdata( 'error', get_msg( 'access' ) );
            redirect(get_route('dashboard'));
        };

        $current_user_id = get_session( 'id' );
        if((is_staff() && $current_user_id != $id) ||  $id <= 0 ){
        	$invalid_access($this);
        }

        $this->load->model('user_m');
        $user = $this->user_m->get('*', array('id'=>$id ), 1);

        if(! $user){
        	$invalid_access($this);
        }
        
        $this->data['user'] = $user;

        if('own' == $mode){
        	# Editing my profile
    		$this->data['meta'] = array(
	            'title' => 'Edit Profile',
	            'description' => 'Edit Profile',
	            'keyword' => ''
	        );
        }else{
        	# Editing staff profile
    		$this->data['meta'] = array(
	            'title' => 'Edit Staff Profile',
	            'description' => 'Edit Profile',
	            'keyword' => ''
	        );
	        $mode = 'other';
        }

        $this->data['mode'] = $mode;
                          
        $this->data['common'] = true;
        $this->data['page'] = 'profile_v';
        $this->data['current_menu'] = 'dashboard';

        $this->data[ 'breadcrumb' ] = array(
            get_msg( 'staff' ),
            get_msg( 'update' )
        );

        $this->load->view('dashboard_template_v', $this->data);    
    }

	public function update(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Username', 'required' );
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email' );
		$this->form_validation->set_rules('number', 'phone number', 'required' );
		
		$id = $this->input->post('id');

		if( is_staff() ){
			$staff_id = get_session( 'id' );
			if( $staff_id != $id ){
				$this->session->set_flashdata( 'error', get_msg( 'access' ) );
				redirect(get_route( 'dashboard' ));
			}
		}

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
			$this->load->model('user_m');
			$query = $this->user_m->save( $data, array('id'=>$id) );

			if( is_admin() ){
				$this->session->set_flashdata( 'success', get_msg( 'staff_edit' ) );
				redirect(get_route( 'staff' ));
			}

			if( is_staff() ){
				$this->session->set_flashdata( 'success', get_msg( 'staff_edit' ) );
			}
		}

		$this->edit( $id );
	}
}