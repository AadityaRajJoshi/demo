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
			'menu'			=> 'Menu'
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