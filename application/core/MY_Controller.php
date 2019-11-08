<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	protected $data = array(
		'meta' => array(
			'title' => 'Admin',
			'description' => 'Staff Description',
			'keyword' => 'staff, admin, employee'
		)
	);

	public function __construct(){
		parent::__construct();
	    if ( !$this->session->userdata('id') ){
	        redirect( '/' );
	    }

	    $this->data['menu'] = $this->get_menu();
	}

	public function get_menu(){
		$role = $this->session->userdata('role');
		if('administrator' == $role){
			return array(
				get_route( 'dashboard' ) => array(
					'title' => get_msg( 'dashboard' ),
					'icon'  => 'fas fa-home'
				),
				'event' => array(
					'title' => get_msg( 'event' ),
					'icon'	=> 'far fa-calendar-times',
					'menu'	=> array(
						get_route( 'add_event' ) => get_msg( 'add_event' ),
						get_route( 'event' ) 	 => get_msg( 'all_event' )
					),
				),
				'staff' => array(
					'title' => get_msg( 'staff' ),
					'icon'	=> 'fas fa-user-friends',
					'menu'	=> array(				
						get_route( 'add_staff' ) => get_msg( 'add_staff' ),
						get_route( 'staff' ) 	 => get_msg( 'all_staff' )
					)
				),
				get_route( 'setting' )	=> array(
					'title' => get_msg( 'setting' ),
					'icon'  => 'fas fa-cog'
				),
				get_route( 'logout' ) => array(
					'title' => get_msg( 'logout' ),
					'icon'  => 'fas fa-sign-out-alt'
				)
			);
		}elseif('staff' == $role){
			return array(
				get_route( 'dashboard' ) => array(
					'title' => get_msg( 'dashboard' ),
					'icon'  => 'fas fa-home'
				),
				'event' 	=> array(
					'title' => get_msg( 'my_event' ),
					'icon'	=> 'far fa-calendar-times'
				) ,
				get_route( 'setting' )	=> array(
					'title' => get_msg( 'setting' ),
					'icon'  => 'fas fa-cog'
				),
				get_route( 'logout' ) => array(
					'title' =>get_msg( 'logout' ),
					'icon'  => 'fas fa-sign-out-alt'
				)
			);
		}
	}

	public function is_admin(){
		return $this->session->userdata( 'role' ) == "administrator";
	}

	public function is_staff(){
		return $this->session->userdata( 'role' ) == "staff";
	}

	public function sendMail(){
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.mailtrap.io',
			'smtp_port' => 2525,
			'smtp_user' => 'db0698d87576a0',
			'smtp_pass' => '291562849ba032',
			'crlf' => "\r\n",
			'newline' => "\r\n"
		);

		$message = 'This is Test email';
		$this->load->library('email', $config);
		$this->email->clear();
		$this->email->set_newline("\r\n");
		$this->email->from('xxx@gmail.com'); // change it to yours
		$this->email->to('xxx@gmail.com');// change it to yours
		$this->email->subject('Resume from JobsBuddy for your Job posting');
		$this->email->message($message);
		// echo  "called";die;
		return $this->email->send();

	}
}