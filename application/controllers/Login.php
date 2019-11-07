<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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

		echo $this->check_user_session_alive();

	}

	public function index()
	{
		$this->load->view('pages/login');
	}

	public function user_login(){
		// $this->load->model( 'User_Model' );
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
				/**
				* showm flash messge for unsuccessful login
				*/
				$this->session->set_flashdata( 'login_error', 'Username And Password Not Match' );
				$this->load->view('pages/login');
				// redirect( 'login' );
			}else{
				$this->session->set_userdata('logged_in_user', $condition );
				redirect( 'dashboard' );
			}
		}else{
			$this->session->set_flashdata( 'login_error', 'Fields Cannot be empty' );
			$this->load->view('pages/login');
		}
	}

	public function check_login(){
	    if ($this->session->userdata( 'logged_in_user' ) == TRUE)
	        redirect('dashboard/manage_content', 'refresh');
	    else
	        return FALSE;
	}

	public function check_user_session_alive(){
		$user_status = $this->session->userdata( 'logged_in_user' );
		$query = false;
		if( $user_status ){
			$query = $this->User_Model->get( '*', $user_status );
		}
		return $query;
	}
}