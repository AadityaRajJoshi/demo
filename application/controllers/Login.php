<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){

		parent::__construct();
		$this->load->model( 'User_Model' );
		$this->load->helper('form');
	}

	public function index()
	{
		$this->check_login();
		$this->load->view('pages/login');
	}

	public function login_attempt(){
		$this->check_login();
		$this->load->library('form_validation');

		$username = $this->input->post( 'username' );
		$Password = md5( $this->input->post( 'password' ) );
		$remember = $this->input->post( 'remember' );

		$this->form_validation->set_rules('username', 'Username', 'required' );
		$this->form_validation->set_rules('password', 'Password', 'required' );

		$select = strpos( $username, '@' ) ? 'email' : 'username' ;
		if ( $this->form_validation->run() ){
			$condition = array(
				$select    => $username,
				'password' => $Password
			);
			$query = $this->User_Model->get( '*', $condition );
			if( !$query ){
				$this->session->set_flashdata( 'login_error', 'Username And Password Not Match' );
				redirect( 'login' );
			}else{
				$logged_user = $this->User_Model->get( array( 'role_id','id') , $condition );
				$session = array(
					'id' => $logged_user[ 0 ]->id,	
					'username' => $username,
					'role_id'  => $logged_user[ 0 ]->role_id		
				);
				$this->session->set_userdata('logged_in_user', $session );
				redirect( 'dashboard' );
			}
		}else{
			$this->session->set_flashdata( 'login_error', 'Fields Cannot be empty' );
			redirect( 'login' );
		}
	}

	public function logout() {
	    $this->session->sess_destroy();
	    redirect( 'login' );
	}
}