<?php
class User_m extends MY_Model{

	protected $table = 'users';
	protected $table_2 = 'events';
	protected $table_3 = 'events_staff';

	public function get_events($id=false){
		$id = !$id ? get_session('id') : $id;

		$this->db->select('*');
		$this->db->from($this->table . ' as u');
		$this->db->join($this->table_3 . ' as es', 'u.id = es.user_id');
		$this->db->join($this->table_2 . ' as e', 'e.id = es.event_id');
		$this->db->where('u.id',$id);

		if('id' == $this->data['order_by']){
			$order_by = 'e.id';
		}else{
			$order_by = $this->data['order_by'];
		}
		$this->db->order_by( $order_by . ' ' . $this->data['order'] );

		$query = $this->db->get();

		if( $query ){
			return $query->result();
		}
		return false;
	}

}