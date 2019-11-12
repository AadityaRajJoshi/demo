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
	    if ( !is_logged_in() ){
	        do_redirect( 'login' );
	    }

	    $this->data['menu'] = get_menu();
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