<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_kwhperjam extends CI_Model{
	
	function getdata_($table){		
		return $this->db->get($table);
	}
	
	function getdata($table, $username=false){
		$sql = "select * from " . $table . " "; 
		$sql .= "where metergroupid in ";
		$sql .= "( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
		$sql .= ") ";
		$query 	= $this->db->query($sql);
		return $query;
		
	}
	
	function getdata_orderby($table,$orderby){			
    	$this->db->from($table);
		$this->db->order_by($orderby,"desc");
		$query = $this->db->get(); 
		return $query;
	}
	
	function getdatasort_orderby($table,$where,$orderby){			
    	$this->db->from($table);
		$this->db->where($where);		
		$this->db->order_by($orderby,"asc");
		$query = $this->db->get(); 
		return $query;
	}
	
	
	
	function id_jam($id, $hari, $jam)
	{
		$this->db->select("*")
				 ->from("counter_jam")
				 ->where("id", $id)
				 ->where("tanggal", $hari)
				 ->where("jam", $jam);
		return $this->db->get();
	}
	
	
	function cekjam($hari, $jam)
	{
		$this->db->select("*")
				 ->from("counter_jam")
				 ->where("tanggal", $hari)
				 ->where("jam", $jam);
		return $this->db->get()->num_rows();
	}
	
	
	function data_jam($id, $tanggal, $jam)
	{
		$this->db->select("*")
				 ->from("counter_jam")
				 ->where("id", $id)
				 ->where("tanggal", $tanggal)
				 ->where("jam", $jam);
		return $this->db->get();
	}
	
}