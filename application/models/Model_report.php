<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_report extends CI_Model{
	
	function getdata($table){		
		return $this->db->get($table);
	}
	
	function getdata_orderby($table,$orderby,$dari,$sampai){			
    	//$query = $this->db->query("SELECT * FROM counter where DATE(date_time)=$sampai");
		
		$this->db->from($table);
		// $this->db->where('sell_date BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
		$this->db->where('DATE(date_time)>=',$dari);
		$this->db->where('DATE(date_time)<=',$sampai);
		$this->db->order_by($orderby,"asc");
		$query = $this->db->get(); 
		return $query;
	}
	
	function getdatasort_orderby($table,$id,$orderby,$dari,$sampai){			
    	$this->db->from($table);
		$this->db->where('id',$id);
		$this->db->where('DATE(date_time)>=',$dari);
		$this->db->where('DATE(date_time)<=',$sampai);
		$this->db->order_by($orderby,"asc");
		$query = $this->db->get(); 
		return $query;
	}
	
}