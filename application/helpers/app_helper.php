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
		}
		return $path;
	}

	function get_msg( $key ){
		return array(
			'up_mismatched' => 'Username And Password Not Match.',
		);
	}
}