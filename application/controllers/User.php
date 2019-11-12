<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
	}

	public function index(){

		if(is_logged_in())
			do_redirect('dashboard');

		$cookie = json_decode( get_cookie( 'user_logged_in' ) );
		$user = false;
		if('' != $cookie && isset($cookie->user)){
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
				do_redirect('dashboard');
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
	    do_redirect('login');
	}

	public function profile(){
		$this->edit(get_session('id'), 'own');
	}

	public function invalid_access(){
		$this->session->set_flashdata( 'error', get_msg( 'access' ) );
	    do_redirect('dashboard');
	}

	public function edit($id=null, $mode='other'){ 

        if (! is_logged_in()){
            do_redirect('login');
        }

        if((is_staff() && get_session('id') != $id) ||  $id <= 0 ){
        	$this->invalid_access();
        }

        $this->load->model('user_m');
        $user = $this->user_m->get('*', array('id'=>$id ), 1);

        if(! $user){
        	$this->invalid_access();
        }
        
        $this->data['user'] = $user;

        if('own' == $mode){
        	# Editing my profile
    		$this->data['meta'] = array(
	            'title' => 'Edit Profile',
	            'description' => 'Edit Profile',
	            'keyword' => ''
	        );
	        $this->data['breadcrumb'] = array(get_msg('my_details'));
	        $this->data['body_class'] = 'edit-own-profile';
        	$this->data['current_menu'] = 'dashboard';
        }else{
        	# Editing staff profile
    		$this->data['meta'] = array(
	            'title' => 'Edit Staff Profile',
	            'description' => 'Edit Profile',
	            'keyword' => ''
	        );
	        $this->data[ 'breadcrumb' ] = array(get_msg('staff'), get_msg('update'));
	        $this->data['body_class'] = 'edit-staff-profile';
        	$this->data['current_menu'] = 'staff';
	        $mode = 'other';
        }

        $this->data['mode'] = $mode;
        $this->data['common'] = true;
        $this->data['page'] = 'profile_v';

        $this->data['current_menu'] = 'dashboard';

        if( $mode == 'own' ){

        $this->data[ 'breadcrumb' ] = array(
            get_msg( 'my_details' )
        );
    	}else{
    	$this->data[ 'breadcrumb' ] = array(
    	    get_msg( 'staff' ),
    	    get_msg( 'update' )
    	);
    	}

        $this->load->view('dashboard_template_v', $this->data);    
    }

	public function update(){

		if (! is_logged_in()){
		    do_redirect('login');
		}

		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Username', 'required' );
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email' );
		$this->form_validation->set_rules('number', 'phone number', 'required' );
		
		$mode = $this->input->post('mode');
		$id = $this->input->post('id');

		if($id<=0)
			$this->invalid_access();

		if( $this->form_validation->run() ){

			if( is_staff() && get_session( 'id' ) != $id )
				$this->invalid_access();

			$name = $this->input->post( 'name' );
			$email = $this->input->post( 'email' );
			$phone_number = $this->input->post( 'number' );
			$pass = $this->input->post( 'password' );

			$data = array( 
				'username' => $name,
				'phone_number' => $phone_number,
				'email' => $email,
			);

			if( $pass != '' )
				$data['password'] = md5($pass);

			$this->load->model('user_m');
			$updated = $this->user_m->save($data, array('id'=>$id));
			if($updated){
				$this->session->set_flashdata('success', get_msg('user_updated'));
			}else{
				$this->session->set_flashdata('error', get_msg( 'user_update_failed'));
			}
		}

		$this->edit( $id, $mode );
	}
}