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

			case 'add_staff':
				$path = 'staff/add';
			break;
		}
		return $path;
	}

	function get_msg( $key ){
		return array(
			'up_mismatched' => 'Username And Password Not Match.',
		);
	}
}

if(! function_exists('get_role_by_id')){
	function get_role_by_id($id){
		$ci = get_instance();
		$roles = $ci->config->item('role');
		return array_search($id,$roles,true);
	}
}

if(! function_exists('get_role_id')){
	function get_role_id( $role ){
		$ci = get_instance();
		$roles = $ci->config->item('role');
		return $roles[$role];
	}
}