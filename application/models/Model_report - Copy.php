<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_reportcopy extends CI_Model{
	
	function getdata($table){		
		return $this->db->get($table);
	}
	
	function getdata_orderby($table,$orderby){			
    	$this->db->from($table);
		$this->db->order_by($orderby,"desc");
		$query = $this->db->get(); 
		return $query;
	}
	
}