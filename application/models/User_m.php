<?php
class User_m extends MY_Model{

	protected $table = 'users';
	protected $table_2 = 'events';
	protected $table_3 = 'events_staff';

	public function get_events($user_id=false){

		$user_id = !$user_id ? get_session('id') : $user_id;

		$this->db->select("e.*, es.type");
		$this->db->from($this->table . ' u');
		$this->db->join($this->table_3 . ' as es', "es.user_id = u.id");
		$this->db->join($this->table_2 . ' as e', "e.id = es.event_id");
		$this->db->where('u.id', $user_id);

		$query = $this->db->get();
		if($query){
			
			return $query->result();
		}

		return false;
	}

	public function get_by_ids($ids){

		$this->db->select( '*', false );
		$this->db->from( $this->table, false );
		$this->db->where_in('id', $ids);
		$query = $this->db->get();
	    if( $query ){
	    	return $query->result();
	    }

	    return false;
	}

}