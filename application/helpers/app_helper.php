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
				$path = 'user/add';
			break;

			case 'all_event':
				$path = 'event';
			break;

			case 'add_event':
				$path = 'event/add';
			break;

			case 'profile':
				$path = 'profile';
			break;	
		}
		return $path;
	}
}

if(! function_exists('get_msg')){
	function get_msg( $key ){
		$msg = array(
			'up_mismatched' => 'Username And Password Not Match.',
			'staff'	        => 'Staff',
			'add_staff'	    => 'Add Staff',
			'staff_added'	=> 'Staff added Successfully',
			'staff_add_e'	=> 'Error! Staff Not Added',
			'staff_delete'	=> 'Staff Deleted Successfully',
			'staff_delete_e'=> 'Error! Staff Not Deleted',
			'user_updated'	=> 'Staff Upadted Successfully',
			'user_update_failed' => 'Error! Staff Not Upadted',
			'dashboard'		=> 'Dashboard',
			'event'			=> 'Event',
			'add_event'		=> 'Add Event',
			'all_event'		=> 'All Event',
			'all_staff'     => 'All Staff',
			'staff'         => 'Staff',
			'my_details'    => 'My Details', 			
			'setting'		=> 'Setting',
			'my_event'		=> 'My Event',
			'login'         => 'Login',
			'logout'		=> 'Log Out',
			'menu'			=> 'Menu',
			'access'        => 'Cannot access',
			'name'          => 'Name',
			'event_added'   => 'Event Added Successfully',
			'event_update'  => 'Event Updated Successfully',
			'date'			=> 'Date',
			'city'			=> 'City',
			'eventime'		=> 'Eventtime',
			'finished'		=> 'Finished',
			'ordernumber'	=> 'Ordernumber',
			'total_workingtime' => 'Total Workingtime',
			'event_rollback_error' => 'Error! Cannot Insert Event',
			'name_placeholder' => 'Enter Name',
			'email'         => 'Email',
			'email_placeholder' => 'Enter Email',
			'number'        => 'Number',
			'number_placeholder' => 'Enter Phone Number',
			'password'     => 'PASSWORD',
			'password_placeholder' => 'Enter Password',
			'save_details'  => 'UPDATE DETAILS',
			'update_staff'  => 'UPDATE STAFF',
			'username'     => 'User Name',
			'username_placeholder' => 'Enter Username Or Email',
			'remember'     => 'Remember me',
			'forget_pass'  => 'Forget Password',
			'id' => 'ID',
			'work_time'    => 'Total WorkingTime',
			'edit_title_m'  => 'Edit Profile',
			'edit_staff_title_m' => 'Edit Staff Profile',
			
			'breadcrumb_user_edit_own' => array('MY DETAILS'),
			'breadcrumb_user_edit_other' => array('Staff', 'Update'),
			'breadcrumb_all_staff' => array('Staff', 'All Staff'),
			'breadcrumb_add_staff' => array('Staff','Add Staff'),

			'meta_login' => array(
				'title' => 'Login',
				'description' => 'Login panel',
				'keyword' => 'staff, admin, employee'
			),
			'meta_forgot' => array(
				'title' => 'Forgot Password',
				'description' => '',
				'keyword' => ''
			),
			'meta_add_staff' => array(
    			'title' => 'Add Staff',
    			'description' => '',
    			'keyword' => ''
    		),
			'meta_edit_staff' => array(
	            'title' => 'Edit Profile',
	            'description' => 'Edit Profile',
	            'keyword' => ''
	        ),
	        'meta_edit_profile' => array(
	            'title' => 'Edit Staff Profile',
	            'description' => 'Edit Profile',
	            'keyword' => ''
	        ),
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
					'icon' => 'far fa-calendar-times',
					'menu' => array(
						'add_event' => array(
							'route' => get_route( 'add_event' ),
							'title' => get_msg( 'add_event' ),
						),
						'list_event' => array(
							'route' => get_route( 'all_event' ),
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
						'list_staff' => array(
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
		}elseif( is_staff() ) {
		 	return array(
		 		'dashboard' => array(
		 			'route' => 'dashboard',
		 			'title' => get_msg( 'dashboard' ),
		 			'icon' => 'fas fa-home'
		 		),
		 		'event' => array(
		 			'title' => get_msg( 'my_event' ),
		 			'icon' => 'far fa-calendar-times'
		 		),
		 		'my_details' => array(
		 			'route' => get_route( 'profile' ),
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

if(! function_exists('do_redirect')){
	function do_redirect($route,$mode='refresh'){
		redirect(get_route($route), $mode);
	}
}

if(! function_exists('get_staffs_dropdown')){	
	function get_staffs_dropdown(  ){
		$ci = get_instance();
		$ci->load->model( 'user_m' );
		$staffs = array();
		$db_staffs = $ci->user_m->get( array( 'id', 'username' ) , array(
			'role_id' =>get_role_id("staff")
		));
		foreach ($db_staffs as $value) {
			$staffs[ $value->id ] = $value->username;
		}

		return $staffs;
	}
}


if(! function_exists('get_time_from_datetime')){	
	function get_time_from_datetime( $datetime ){
		$time=strtotime($datetime);
		return date("H:i", $time);
	}
}

if(! function_exists('get_date_from_datetime')){	
	function get_date_from_datetime( $datetime ){
		$time=strtotime($datetime);
		return date("d M Y", $time);
	}
}

if(! function_exists('get_total_working_time')){	
	function get_total_working_time( $args ){
		$event_start = strtotime( $args['start_time'] );
		$event_end = strtotime( $args['stop_time'] );
		$tt_1_start = strtotime( $args['traveltime_1_start'] );
		$tt_1_stop = strtotime( $args['traveltime_1_stop'] );
		$tt_2_start = strtotime( $args['traveltime_2_start'] );
		$tt_2_stop = strtotime( $args['traveltime_2_stop'] );
		$construct_start = strtotime( $args['construction_start'] );
		$construct_stop = strtotime( $args['construction_stop'] );
		$dismantl_start = strtotime( $args['dismantling_start'] );
		$dismantl_stop = strtotime( $args['dismantling_stop'] );

		$event_diff = abs( $event_end - $event_start );
		$tt_1_diff = abs( $tt_1_stop - $tt_1_start) ;  
		$tt_2_diff = abs( $tt_2_stop - $tt_2_start) ;
		$construct_diff = abs( $construct_stop - $construct_start) ;
		$dismantl_diff = abs( $dismantl_stop - $dismantl_start) ;

		return gmdate('H:i:s',$event_diff + $tt_1_diff + $tt_2_diff + $construct_diff + $dismantl_diff);
	}
}

if(! function_exists('print_success_msg')){
	function print_success_msg($msg){
		if(!$msg || count($msg) <= 0)
			return;

		echo '<span class="form-success">';
		foreach($msg as $m){echo $m;}
		echo '</span>';
	}
}

if(! function_exists('print_error_msg')){
	function print_error_msg($msg){
		if(!$msg || count($msg) <= 0)
			return;
		
		echo '<span class="form-err">';
		foreach($msg as $m){echo $m;}
		echo '</span>';
	}
}