<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
	}

	public function index(){
		$this->data[ 'meta' ][ 'title' ] = 'event';
		$this->data['page'] = 'all_event_v';
		$this->data['current_menu'] = 'event';
		$this->load->view('dashboard_template_v', $this->data);
	}

	public function add(){
		$this->data[ 'meta' ][ 'title' ] = 'add event';
		$this->data['page'] = 'add_event_v';
		$this->data['current_menu'] = 'event';
		$this->load->view('dashboard_template_v', $this->data);
	}
}