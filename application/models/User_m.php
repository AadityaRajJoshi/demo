<?php
class User_m extends MY_Model{

	protected $table = 'users';
	protected $table_2 = 'events';
	protected $table_3 = 'events_staff';

	public function get_events($user_id=false, $where=false){

		$user_id = !$user_id ? get_session('id') : $user_id;
		$order = 'e.' . $this->data['order_by'] . ' ' . $this->data['order'];

		$this->db->select("e.*, es.type");
		$this->db->from($this->table . ' u');
		$this->db->join($this->table_3 . ' as es', "es.user_id = u.id");
		$this->db->join($this->table_2 . ' as e', "e.id = es.event_id");
		$this->db->where('u.id', $user_id);
		if ( $where != false ){
		    $this->db->where( $where );
		}
	
		$this->db->order_by($order);

		$query = $this->db->get();

		if($query){
			return $query->result();
		}

		return false;
	}

	public function get( $column = 'u.*', $where = false, $limit = false, $order = false ){
		
		$order = $order ? $order : $this->data['order_by'] . ' ' . $this->data['order'];

	    $this->db->select( $column, false );
	    $this->db->from( $this->table . ' u', false );
	    $this->db->join($this->table_3 . ' es', 'es.user_id = u.id', 'left');
	    $this->db->join($this->table_2 . ' e', 'es.event_id = e.id', 'left');

	    if ( $where != false ){
	        $this->db->where( $where );
	    }

	    if( $limit != false ){
	    	if( is_array( $limit ) ){
	        	$this->db->limit( $limit[0], $limit[1] );
	    	}else{
	        	$this->db->limit( $limit );
	    	}
	    }

	    if($limit != 1){
		    if ($order){
		        $this->db->order_by($order);
		    }else{
		        $this->db->order_by('u.id', $this->order);
		    }
	    }

	    $this->db->group_by('u.id');

	    $query = $this->db->get();
	    if( $query ){
	    	return $limit == 1 ? $query->row() : $query->result();
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