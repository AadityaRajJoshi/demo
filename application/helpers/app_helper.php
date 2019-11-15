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

			case 'user_edit':
				$path = 'user/edit';
			break;

			case 'all_event':
				$path = 'event';
			break;

			case 'add_event':
				$path = 'event/add';
			break;

			case 'event_edit':
				$path = 'event/edit';
			break;

			case 'profile':
				$path = 'profile';
			break;

			case 'forgot':
				$path = 'forgot';
			break;	

			case 'event_toggle_status':
				$path = 'event/toggle_status';
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
			'event_added'   => 'Event Added Successfully',
			'event_update'  => 'Event Updated Successfully',
			'date'			=> 'Date',
			'city'			=> 'City',
			'eventime'		=> 'Eventtime',
			'finished'		=> 'Finished',
			'ordernumber'	=> 'Ordernumber',
			'total_workingtime' => 'Total Workingtime',
			'event_rollback_error' => 'Error! Cannot Insert Event',

			'label_name'         => 'Name',
			'label_email'        => 'Email',
			'label_password'     => 'Password',
			'label_phone_number' => 'Number',
			'label_username'     => 'User Name',

			'placeholder_name' => 'Enter Name',
			'placeholder_email' => 'Enter Email',
			'placeholder_phone_number' => 'Enter Phone Number',
			'placeholder_password' => 'Enter Password',
			'placeholder_username' => 'Enter Username Or Email',

			'save_details'  => 'UPDATE DETAILS',
			'update_staff'  => 'UPDATE STAFF',
			'remember'     => 'Remember me',
			'forget_pass'  => 'Forget Password',
			'id' => 'ID',
			'work_time'    => 'Total WorkingTime',
			'edit_title_m'  => 'Edit Profile',
			'toggle_status_error' => 'You are not authorized',
			'edit_staff_title_m' => 'Edit Staff Profile',			
			'breadcrumb_user_edit_own' => array('MY DETAILS'),
			'breadcrumb_user_edit_other' => array('Staff', 'Update'),
			'breadcrumb_all_staff' => array('Staff', 'All Staff'),
			'breadcrumb_add_staff' => array('Staff','Add Staff'),
			'no_event_assigned' => 'Not assigned on any event',
			'breadcrumb_event_edit' => array('Event', 'Edit Event'),
 
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
	        'meta_event_detail' => array(
	        	'title' => 'Event Details',
	        	'description' => 'Event Details',
	        	'keyword' => 'event'
	        ),
	        'meta_event_edit' => array(
	        	'title' => 'Event Edit',
	        	'description'=> 'Event Edit',
	        	'keyword' => 'event'
	        ),

	        'event_name_label' => 'Event Name',
	        'event_order_label' => 'Order Number',
	        'event_date_label' => 'Date',
	        'event_starttime_label' => 'Event StartTime',
	        'event_StopTime_label' => 'Event StopTime',
	        'event_traveltime_1_start_label' => 'TravelTime 1 Start',
	        'event_traveltime_1_stop_label' => 'TravelTime 1 Stop',
	        'event_traveltime_2_start_label' => 'TravelTime 2 Start',
	        'event_traveltime_2_stop_label' => 'TravelTime 2 Stop',
	        'event_construction_start_label' => 'Construction Start',
	        'event_construction_stop_label' => 'Construction Stop',
	        'event_dismantling_start_label' => 'Dismantling Start',
	        'event_dismantling_stop_label' => 'Dismantling Stop',
	        'event_addstaff_label' => 'Add Staff',
	        'event_add_packingstaff_label' => 'Add Package Staff',
	        'event_packing_time_label' => 'Packing Time',
	        'event_address_label' => 'Address',
	        'event_Contact_person_label' => 'Contact Person',
	        'event_tele_person' => 'Telephone Contact Person',
	        'event_distance_label' => 'Distance To Event',
	        'event_car_wagon_label' => 'Type Of Car And Wagon',
	        'event_link_map_label' => 'Link To Google Map',
	        'event_other_info_label' => 'Other Information',
	        'event_add_product_label' => 'Add Products',
	        'event_electricty_label' => 'Electricity',
	        'event_preview_btn' =>'Preview Event',
	        'event_publish_btn' => 'Publish Event',

	        'e_name_placeholder' => 'Enter Event Name',
	        'e_order_placeholder' => 'Enetr Order Number',
	        'e_date_placeholder' => 'Enter Date',
	        'e_packing_time_placeholder' => 'Enter Packing Time',
	        'e_address_placeholder' => 'Enter Address',
	        'e_Contact_person_placeholder' => 'Your Contact Person',
	        'e_distance_placeholder' => 'Distance To Event',
	        'e_car_wagon_placeholder' => 'Enter Type Of Car And Wagon',
	        'e_link_map_placeholder' => 'Enter Link To Google Map',
	        'e_other_info_placeholder' => 'Enter Other Information',
	        'e_add_product_placeholder' => 'Add Other Products'

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
		// return seconds_to_time( $datetime );
		$time=strtotime($datetime);
		return date("H:i", $time);
	}
}

if(! function_exists('get_date_from_datetime')){	
	function get_date_from_datetime( $datetime, $format ){
		$time=strtotime($datetime);
		return date( $format , $time);
	}
}

if( !function_exists( 'time_to_sec' ) ){	
	function time_to_sec($time) {
	    $sec = 0;
	    foreach (array_reverse(explode(':', $time)) as $k => $v) $sec += pow(60, $k) * $v;
	    return $sec;
	}
}

if( !function_exists('get_time_diff') ){
	function get_time_diff($t){
		return abs(time_to_sec($t[0]) - time_to_sec($t[1]));
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

if(! function_exists('get_value')){
	function get_value($object, $key, $default=false){

		if(is_object($object)){
			return $object->$key;
		}else{
			$post = set_value($key);
			if($post){
				return $post;
			}else{
				return $default;
			}
		}
	}
}


if(! function_exists('get_staff_worktime')){
	function get_staff_worktime( $user_id ){
		$ci = get_instance();
		$ci->load->model( 'user_m' );
		$ci->load->helper('date');
		$times = $ci->user_m->get_events( $user_id );
		if($times){
			$t = 0;
			foreach($times as $key => $time){
				$t = $t + $time->total_worktime ;
			}
			return seconds_to_time( $t );
		}else{
			return get_msg( 'no_event_assigned' );
		}	
	}
}
function seconds_to_time($seconds_time){
    // if ($seconds_time < 24 * 60 * 60) {
    //     return gmdate('H:i:s', $seconds_time);
    // } else {
        $hours = floor($seconds_time / 3600);
        $minutes = floor(($seconds_time - $hours * 3600) / 60);
        $seconds = floor($seconds_time - ($hours * 3600) - ($minutes * 60));
        $date = '';
        if( $hours != 0 ){
        	$date .= $hours.'hr';
        }
        if( $minutes != 0  ){
        	$date .= $minutes.'min';
        }
        if( $seconds != 0  ){
        	$date .= $seconds.'sec';
        }
        return $date;
    // }
}

if( !function_exists('get_profile_picture') ){
	function get_profile_picture(){
		$ci = get_instance();
		$image = $ci->config->item('profile_picture');
		foreach(explode('|',$image['allowed_types']) as $ext){
			$path = $image['upload_path'].get_session('id'). '.' . $ext;
    		if(file_exists($path)){
    			return $path;
    		}
		}
	}
}

if( !function_exists( 'get_first_letter' ) ){
	function get_first_letter(){
		$username = get_session('name');
		return strtoupper($username[0]);
	}
}