<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	protected $order = 'DESC';
	
	public function save( $data, $where = false ){
		
	    if( $where == false ){ 
	    	#Insert
	        $this->db->set( "updated_on", "now()", false );
	        $this->db->set( "created_on", "now()", false );

	        if( $this->db->insert( $this->table, $data ) ){
	        	return $this->db->insert_id();
	        }else{
	        	return false;
	        }

	    }else{ 
	    	#Update
	        $this->db->where( $where );
	        $this->db->set( "updated_on", "now()", false );
	        if( $this->db->update( $this->table, $data ) ){
	        	return $this->db->affected_rows();
	        }else{
	        	return false;
	        }
	    }
	}

	public function get( $column = '*', $where = false, $limit = false, $order = false ){
	
		$order = $order ? $order : $this->data['order_by'] . ' ' . $this->data['order'];

	    $this->db->select( $column, false );

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

	    if ($order){
	        $this->db->order_by( $order );
	    }else{
	        $this->db->order_by( 'id', $this->order );
	    }

	    $this->db->from( $this->table, false );
	    $query = $this->db->get();
	    if( $query ){
	    	return $limit == 1 ? $query->row() : $query->result();
	    }

	    return false;
	   
	}

	public function get_count( $where = false ){
		if( $where ){
			$this->db->where( $where );
		}
		return $this->db->from( $this->table )->count_all_results();
	}

	public function delete( $where ){
	    $this->db->where( $where );
	    if( $this->db->delete( $this->table ) ){
	    	return $this->db->affected_rows();
	    }else{
	    	return false;
	    }
	}
}