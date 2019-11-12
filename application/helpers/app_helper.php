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

			case 'profile':
				$path = 'profile';
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
			'access'        => 'Cannot access',
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

if(! function_exists('is_logged_in')){
	function is_logged_in(){
		return get_session('id');
	}
}

if( !function_exists( 'get_menu' ) ){	
	function get_menu(){
		
		if(is_admin()){

			return array(
				'dashboard' => array(
					'route' => 'dashboard',
					'title' => get_msg( 'dashboard' ),
					'icon' => 'fas fa-home'
				),
				'event' => array(
					'title' => get_msg( 'event' ),
					'icon' => 'far fa-calandar-times',
					'menu' => array(
						'add_event' => array(
							'route' => get_route( 'add_event' ),
							'title' => get_msg( 'add_event' ),
						),
						'list_event' => array(
							'route' => get_route( 'event' ),
							'title' => get_msg( 'all_event' )
						)
					)
				),
				'staff' => array(
					'title' => get_msg( 'staff' ),
					'icon'	=> 'fas fa-user-friends',
					'menu'	=> array(				
						'add_staff' => array(
							'route' => get_route( 'add_staff' ),
							'title' => get_msg( 'add_staff' )
						),
						'all_staff' => array(
							'route' => get_route( 'staff' ),
							'title' => get_msg( 'all_staff' )
						)
					)
				),
				'setting'=> array(
					'title' => get_msg( 'setting' ),
					'icon' => 'fas fa-cog'
				),
				'logout' => array(
					'route' => get_route( 'logout' ),
					'title' => get_msg( 'logout' ),
					'icon' => 'fas fa-sign-out-alt'
				),
			);
		}

		 if( is_staff() ) {
		 	return array(
		 		'dashboard' => array(
		 			'route' => 'dashboard',
		 			'title' => get_msg( 'dashboard' ),
		 			'icon' => 'fas fa-home'
		 		),
		 		'event' => array(
		 			'title' => get_msg( 'my_event' ),
		 			'icon' => 'far fa-calandar-times'
		 		),
		 		'my_details' => array(
		 			'route' => get_route( 'unauthorized' ),
		 			'title' => get_msg('my_details'),
		 			'icon' => 'fas fa-cog'
		 		),
		 		'logout' => array(
					'route' => get_route( 'logout' ),
					'title' => get_msg( 'logout' ),
					'icon' => 'fas fa-sign-out-alt'
				),
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

if(! function_exists('menu')){
	function menu($current_route){
		print_menu(get_menu(), $current_route);
	}
}

if(! function_exists('print_menu')){
	function print_menu( $menu, $current_menu, $wrapper=true){
	    $wrapper_class = 'sidebar-menu';
	    $header = 'Menu';

	    if( $wrapper )
	        echo sprintf('<ul class="%s"><li class="sidebar-header">%s</li>', $wrapper_class, $header);

	    foreach( $menu as $id => $m ){
	        $route = isset($m['route']) ? $m['route'] : '#';
	        $item_class = $current_menu == $id ? 'active menu-item' : 'menu-item';
	        
	        echo sprintf('<li class="%s"><a href="%s">',$item_class, $route);

	        if(isset($m['icon']))
	            echo sprintf('<i class="%s"></i>',$m['icon']);

	        echo $m['title'];

	        if( isset($m['menu']) )
	            echo '<i class="fa fa-angle-right pull-right"></i>';

	        echo '</a>';

	        if(isset($m['menu'])){
	            echo '<ul class="sidebar-submenu">';
	            print_menu($m['menu'], $current_menu, false);
	            echo '</ul>';
	        }else{
	            echo '</li>';
	        }
	    }

	    if( $wrapper ){
	        echo '</ul>'; 
	    }
	}
}