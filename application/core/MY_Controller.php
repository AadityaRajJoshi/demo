<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	public $data = array(
		'meta' => array(
			'title' => '',
			'keyword' => '',
			'description' => ''
		),
		'error' => array(),
		'success' => array(),
		'order' => 'desc',
		'order_by' => 'id'
	);

	public function __construct(){
		parent::__construct(); 
		$exception_methods = array('index', 'login', 'logout', 'forgot');
		$exception_controllers = array('user');
		$controller = $this->router->fetch_class();
		$method = $this->router->fetch_method();
		# Don't check for log in if controller is "user"
	    if(!is_logged_in() && !(in_array($controller, $exception_controllers) && in_array($method, $exception_methods))){
	        do_redirect( 'login' );
	    }

	    $this->data['profile_picture'] = get_profile_picture();

	    $order_by = $this->uri->segment(3, 0);
	    if($order_by){
	    	$order = strtolower($this->uri->segment(4, 0));
	    	if('asc' == $order || 'desc' == $order){
	    		$this->data['order_by'] = $order_by;
	    		$this->data['order'] = $order;
	    	}
	    }

	    $this->data['menu'] = get_menu();
	}

	public function invalid_access(){
		$this->session->set_flashdata( 'error', get_msg( 'access' ) );
	    do_redirect('dashboard');
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