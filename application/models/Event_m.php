<?php
class Event_m extends MY_Model{
	protected $table = 'events';
	protected $table_2 = 'users';
	protected $table_3 = 'events_staff';

	public function get_users($event_id=false, $from=false,$to=false){

		$this->db->select('u.*, es.type');
		$this->db->from($this->table . ' e');
		$this->db->join($this->table_3 . ' es', 'es.event_id = e.id');
		$this->db->join($this->table_2 . ' u', 'u.id = es.user_id');
		$this->db->where('e.id', $event_id);
		
		if( $from ){
			$this->db->where('e.start_time >=', $from . ' 00:00:00');
		}

		if($to){
			$this->db->where('e.start_time <=', $to . ' 24:00:00');
		}
		$query = $this->db->get();
		if($query){
			return $query->result();
		}

		return false;
	}
}