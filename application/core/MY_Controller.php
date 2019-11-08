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
}