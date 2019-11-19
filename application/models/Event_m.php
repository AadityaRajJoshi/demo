<?php
class Event_m extends MY_Model{
	protected $table = 'events';
	protected $table_2 = 'users';
	protected $table_3 = 'events_staff';
	protected $table_4 = 'events_package_staff';

	public function get_users($event_id=37){
		if( $event_id ){
			$query = $this->db->query("SELECT * FROM ( SELECT u.id id,es.event_id ,'event_staff' type FROM luftlek_users u INNER JOIN luftlek_events_staff as es on es.user_id = u.id where es.event_id = 37
			UNION ALL
			select u.id id,eps.event_id, 'package_staff' type FROM luftlek_users u INNER JOIN luftlek_events_package_staff as eps on eps.user_id = u.id where eps.event_id = 37 ) as t1");
			var_export( $query->result() );

			$query1 = 'SELECT * FROM ( SELECT u.id id, es.event_id,"event_staff" type FROM '.$this->table_2.' u INNER JOIN '.$this->table_3.' as es on es.user_id = u.id where es.event_id = ? UNION ALL SELECT u.id id, eps.event_id,"pakage_staff" type FROM '.$this->table_2.' INNER JOIN '.$this->table_4.' as eps on eps.user_id = u.id WHERE eps.event_id = ? ) as t1)';
			echo $query1;
		}else{
			do_redirect('event');	
		}

	}
}