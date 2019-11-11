<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
	}

	public function index(){
		$this->data[ 'meta' ][ 'title' ] = 'setting';
		$this->data['page'] = 'setting_v';
		$this->load->view('dashboard_template_v', $this->data);
	}
}