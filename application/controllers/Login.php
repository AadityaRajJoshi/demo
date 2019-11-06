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

	public function index()
	{
		$this->load->helper('form');
		$this->load->view('pages/login');
		$this->load->model( 'User_Model' );
	}

	public function user_login(){
		$this->load->model( 'User_Model' );
		$this->load->library('form_validation');


		$username = $this->input->post( 'username' );
		$Password = $this->input->post( 'password' );
		$remember = $this->input->post( 'remember' );

		$this->form_validation->set_rules('username', 'Username', 'required' );
		$this->form_validation->set_rules('password', 'Password', 'required' );

		if ( $this->form_validation->run() ){
			$condition = array(
				'username' => $username,
				'password' => $Password
			);
			$query = $this->User_Model->get( '*', $condition );
			var_export( $query );die;
		}else{
			echo "error";
		}
	}
}