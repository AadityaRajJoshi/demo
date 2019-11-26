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
		'order' => 'asc',
		'order_by' => 'id'
	);

	public function __construct(){
		parent::__construct(); 
		$start_date = $this->input->get( 'f' );
		$exception_methods = array('index', 'login', 'logout', 'forgot');
		$exception_controllers = array('user');
		$controller = $this->router->fetch_class();
		$method = $this->router->fetch_method();
		# Don't check for log in if controller is "user"
	    if(!is_logged_in() && !(in_array($controller, $exception_controllers) && in_array($method, $exception_methods))){
	        do_redirect( 'login' );
	    }

	    $this->data['profile_picture'] = get_profile_picture();

	    $order_by = $this->input->get('ob');
	    if($order_by){
	    	$order = strtolower($this->input->get('o'));
	    	if($order && ('asc' == $order || 'desc' == $order)){
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

	public function send_sms($data){

		return;
		// Your Account SID and Auth Token from twilio.com/console
		$account_sid = 'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
		$auth_token = 'your_auth_token';
		// In production, these should be environment variables. E.g.:
		// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

		// A Twilio number you own with SMS capabilities
		$twilio_number = "+15017122661";

		$client = new Client($account_sid, $auth_token);
		$client->messages->create(
		    // Where to send a text message (your cell phone?)
		    '+15558675310',
		    array(
		        'from' => $twilio_number,
		        'body' => 'I sent this message in under 10 minutes!'
		    )
		);
	}

	public function send_email($arg){
		$this->load->library('email');

		$this->email->from('yujesh@localhost.com', 'Luftlek');
		$this->email->to($arg['to']);
		$this->email->subject($arg['subject']);
		$this->email->message($arg['body']);
		// mail($arg['to'],$arg['subject'],$arg['body']);
		$t = $this->email->send();
		// file_put_contents(__DIR__.'/password.txt', print_r( $t, 1) );
					
	}

    public function random_password($length = 10) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}
}