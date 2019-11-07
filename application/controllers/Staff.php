<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
	} 

	public function index(){

		$this->load->model('user_m');
		$this->data['staffs'] = $this->user_m->get( '*', array(
			'role_id' => 2
		));

		$this->data['page'] = 'list_staff_v';
		$this->load->view('dashboard_template_v', $this->data);	
	}

	public function add(){
		$this->load->library('form_validation');

		$name = $this->input->post( 'name' );
		$email = $this->input->post( 'email' );
		$phone_number = $this->input->post( 'number' );
		$password = md5($this->input->post( 'password' ) );
		$displayname = $this->input->post('displayname');

		$this->form_validation->set_rules('name', 'Name', 'required' );
		$this->form_validation->set_rules('email', 'Email', 'required' );
		$this->form_validation->set_rules('number', 'Number', 'required' );
		$this->form_validation->set_rules('password', 'Password', 'required' );
		$this->form_validation->set_rules('displayname', 'Display Name', 'required' );

		if( $this->form_validation->run() ){
			$data = array( 
				'username' => $name,
				'password' => $password,
				'phone_number' => $phone_number,
				'email' => $email,
				'display_name' => $displayname,
				'role_id' => 2
			 );

			$query =$this->User_Model->save( $data );

			if( $query ){
				redirect('user');
			}else{
				echo "error";
			}

		}else{
			$this->load->view( 'pages/add-user' );
		}
	}

	public function edit( $id = null ){
		$this->load->model('user_m');
		$where = array(
			'id' => $id
		);
		$data = $this->user_m->get( '*', $where );
		$staffs = [
			'staffs' => $data
		];
		$this->load->view('pages/edit-user', $staffs);
	}

	public function update(){

		$name = $this->input->post( 'name' );
		$email = $this->input->post( 'email' );
		$phone_number = $this->input->post( 'number' );
		$displayname = $this->input->post('displayname');

		$id = $this->input->post('id');

		$data = array( 
			'username' => $name,
			'phone_number' => $phone_number,
			'email' => $email,
			'display_name' => $displayname,
		);

		$where = array(
			'id' => $id
		);

		$query = $this->User_Model->save( $data, $where );
		if ( $query ){
			redirect('user');
		}
	}
}