<?php 
if(!defined ('BASEPATH')) exit('No direct script access allowed');

if(! function_exists('get_route')){
	function get_route($slug){
		$path = false;
		switch( $slug ){
			case 'login':
				$path = '/';
			break;

			case 'dashboard':
				$path = 'dashboard';
			break;

			case 'staff':
				$path = 'staff';
			break;
			case 'event':
				$path = 'event';
			break;

			case 'setting':
				$path = 'setting';
			break;

			case 'logout':
				$path = 'user/logout';
			break;

			case 'add_staff':
				$path = 'staff/add';
			break;

			case 'add_event':
				$path = 'event/add';
			break;

			case 'unauthorized':
				$path = 'user/edit/'.get_session('id');
			break;	
		}
		return $path;
	}
}

if(! function_exists('get_msg')){
	function get_msg( $key ){
		$msg = array(
			'up_mismatched' => 'Username And Password Not Match.',
			'staff_added'	=> 'Staff added Successfully',
			'staff_add_e'	=> 'Error! Staff Not Added',
			'staff_edit'	=> 'Staff Upadted Successfully',
			'staff_edit_e'	=> 'Error! Staff Not Upadted',
			'staff_delete'	=> 'Staff Deleted Successfully',
			'staff_delete_e'=> 'Error! Staff Not Deleted',
			'dashboard'		=> 'Dashboard',
			'event'			=> 'Event',
			'add_event'		=> 'Add Event',
			'all_event'		=> 'All Event',
			'staff'			=> 'Staff',
			'add_staff'		=> 'Add Staff',
			'all_staff'		=> 'All Staff',
			'setting'		=> 'Setting',
			'my_event'		=> 'My Event',
			'logout'		=> 'Log Out',
			'menu'			=> 'Menu',

			'access'         => 'Cannot access',

			'update'		=> 'Update',
			'my_details'	=> 'My Details'

		);

		return $msg[ $key ];
	}
}

if(! function_exists('get_role_by_id')){
	function get_role_by_id( int $id){
		$ci = get_instance();
		$roles = $ci->config->item('role');
		$a =  array_search($id,$roles,true);
		return $a;
	}
}

if(! function_exists('get_role_id')){
	function get_role_id( $role ){
		$ci = get_instance();
		$roles = $ci->config->item('role');
		return $roles[$role];
	}
}

if( !function_exists( 'is_admin' ) ){	
	function is_admin(){
	 	$ci = get_instance();
		return $ci->session->userdata( 'role' ) == "administrator";
	}
}


if( !function_exists( 'is_staff' ) ){	
	function is_staff(){
		$ci = get_instance();
		return $ci->session->userdata( 'role' ) == "staff";
	}

}

if( !function_exists( 'get_session' ) ){
	function get_session( $param = false ){
		$ci = get_instance();
		return $ci->session->userdata($param);
	}
}

if( !function_exists( 'get_active_class' ) ){
	function get_active_class( $key = false ){
		$ci = get_instance();
		$class = false;
		if( $key == $ci->uri->segment(1) ){
			$class = 'class="active" ';
		}
		return $class;
	}
}

if( !function_exists( 'get_menu' ) ){	
	function get_menu(){
		$ci = get_instance();
		$role = $ci->session->userdata('role');
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
					'title' => get_msg( 'my_details' ),
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

if( !function_exists( 'breadcrumb_tail' ) ){
	function breadcrumb_tail( $arr ){
		$tail = false;
		$icon = '<i class="fas fa-angle-right"></i>';
		if( is_array( $arr ) ){
			foreach ( $arr as $key => $value ) {
				$tail .= $value . $icon;
			}
			echo $tail;
		}else{
			echo $arr;
		}
	}
}