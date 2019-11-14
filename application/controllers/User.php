<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller{

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
		$this->data['meta'] = get_msg('meta_login');
		$this->data['page'] = 'login_v';
		$this->data['cookie'] = $user;
		
		$this->load->view('login_template_v', $this->data);
	}

	public function login(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', get_msg('username'), 'required' );
		$this->form_validation->set_rules('password', get_msg('password'), 'required' );
		# check validation
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
				$this->data['error'][] = get_msg( 'up_mismatched' );
			}else{
				$this->session->set_userdata(array(
					'id' => $db_user->id,	
					'name' => $username,
					'role' => get_role_by_id($db_user->role_id)
				));

				if( $this->input->post( 'remember_me' ) && 'on' == $this->input->post( 'remember_me' ) ) {

					set_cookie( 
						'user_logged_in', 
						json_encode([
							'user' => $username,
							'pass' => $this->input->post( 'password' ),
						]),
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
			'meta' => get_msg('meta_forgot'),
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

        if((is_staff() && get_session('id') != $id) ||  $id <= 0 ){
        	$this->invalid_access();
        }

        $this->load->model('user_m');
        $user = $this->user_m->get('*', array('id'=>$id ), 1);

        if(! $user){
        	$this->invalid_access();
        }
        
        $id = $this->input->post('id');
        if($id){
        	if($id<=0)
        		$this->invalid_access();

        	if( is_staff() && get_session( 'id' ) != $id )
        		$this->invalid_access();

        	$update = $this->save($id);
        	if($update)
        		$user = $this->user_m->get('*', array('id'=>$id ), 1);
        }

        $this->data['user'] = $user;

        if('own' == $mode){
        	# Editing own profile
    		$this->data['meta'] = get_msg('meta_edit_staff');
    		$config = $this->config->item('profile_picture');
    		foreach(explode('|',$config['allowed_types']) as $ext){
    			$path = $config['upload_path'].$user->id. '.' . $ext;
	    		if(file_exists($path)){
	    			$this->data['profile_picture'] = $path;
	    		}
    		}
	        $this->data['breadcrumb'] = get_msg('breadcrumb_user_edit_own');
	        $this->data['body_class'] = 'edit-own-profile';
        	$this->data['current_menu'] = 'dashboard';
        }else{
        	# Editing staff profile

    		$this->data['meta'] = get_msg('meta_edit_profile');
	        $this->data[ 'breadcrumb' ] = get_msg('breadcrumb_user_edit_other');
	        $this->data['body_class'] = 'edit-staff-profile';
        	$this->data['current_menu'] = 'staff';
	        $mode = 'other';
        }

        $this->data['mode'] = $mode;
        $this->data['common'] = true;
        $this->data['page'] = 'profile_v';
        $this->data['current_menu'] = 'dashboard';

        $this->load->view('dashboard_template_v', $this->data);    
    }

    public function add(){
    	
    	if(! is_admin())
    		do_redirect('dashboard');

    	$this->data = array(
    		'meta' => get_msg('meta_add_staff'),
    		'page' => 'add_staff_v',
    		'breadcrumb' => get_msg('breadcrumb_add_staff'),
    		'current_menu' => 'staff'
    	);

    	$this->save();

    	$this->load->view( 'dashboard_template_v', $this->data );
    }

	public function save($id=false){

		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Username', 'required' );
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email' );
		$this->form_validation->set_rules('number', 'phone number', 'required' );
		if(! $id)
			$this->form_validation->set_rules('password', 'Password', 'required' );
		
		if($this->form_validation->run()){
			$username = $this->input->post('name');
			$email = $this->input->post('email');
			$phone_number = $this->input->post('number');
			$password = $this->input->post('password');
			
			$data = array(
				'username'=> $username,
				'email' => $email,
				'Phone_number' => $phone_number,
			);

			if( $password != '' ){
				$data['password'] = md5($password);
			}

			$where = $id ? array('id'=>$id) : false;
			if( $where ){
				# do update 
				if($_FILES['userfile']['size'] > 0){
					$config = $this->config->item('profile_picture');
					$config['file_name'] = $id;
					$this->load->library('upload', $config);
					if($this->upload->do_upload('userfile')){
						$upload_data = $this->upload->data();
						foreach(explode('|',$config['allowed_types']) as $ext ){
							$file_name = $id . '.' . $ext;
							$path = $config['upload_path'] . $file_name;
							if($upload_data['file_name'] != $file_name && file_exists($path)){
								unlink($path);
							}
						}
					}else{
						$this->data['error'][] = $this->upload->display_errors();
					}
				}
			}else{
				# do insert
				$data['role_id'] = get_role_id("staff");
			}
			
			$this->load->model( 'user_m' );
			$operation = $this->user_m->save( $data, $where );

			if( $id ){
				# Need to update staff
				if($operation){
					$this->data['success'][] = get_msg('user_updated');
					return true;
				}else{
					$this->session->set_flashdata('error', get_msg( 'user_update_failed'));
					return false;
				}
			}else{
				# Need to create staff
				if($operation){
					$this->session->set_flashdata( 'success', get_msg( 'staff_added' ) );
					do_redirect('staff');
				}else{
					$this->session->set_flashdata( 'error', get_msg( 'up_mismatched' ) );
					return false;
				}
			}
		}else{
			return false;
		}
	}
}