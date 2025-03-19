<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_variablegraphical extends CI_Model{
	
	function getdata_($table){		
		return $this->db->get($table);
	}
		
	// function getdata($table, $username=false){
	// 	$sql = "select * from  " . $table . " "; 
	// 	$sql .= "where metergroupid in ";
	// 	$sql .= "( ";
	// 	$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
	// 	$sql .= ") ";
	// 	$query 	= $this->db->query($sql);
	// 	return $query;
	// }

	function getdata($table, $username=false){
		$sql = "select * from  " . $table . " dm inner join metergroups mg on dm.metergroupid = mg.metergroupid "; 
		$sql .= "where dm.metergroupid in ";
		$sql .= "( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
		$sql .= ") order by id, dm.metergroupid";
		$query 	= $this->db->query($sql);
		return $query;
		// select * from  data_meter dm inner join metergroups mg on dm.metergroupid = mg.metergroupid where dm.metergroupid in (select metergroupid from usermetergroups where username = 'admin')
	}

	function tampil(){		
		return $this->db->get("data_meter");
	}
	
	function filter_dashboard($where,$value,$table)
	{
		$this->db->select("*")
				 ->from($table)
				 ->where($where, $value);
		return $this->db->get();
	}
	
	
	public function getcounter_id($table,$id) {
  		$this->db->select("MAX(id_counter) as max_id")
				 ->from($table)
				 ->where("id",$id);
		$query = $this->db->get();
		$row = $query->row_array();
  		$max_id = $row["max_id"];
  		return $max_id;
 	}


	 function dt_counter_1($table, $coloum, $id_counter)
	 {

		 $sql = "select * ";
		 $sql .= "from " . $table . " ";
		 $sql .= "WHERE ". $coloum ." = '". $id_counter ."' ORDER BY date_time DESC LIMIT 1";
		 // var_dump($sql);
		 // die;
		 $query 	= $this->db->query($sql);
 
		 return $query;
	 }


	
	function dt_counter($id_counter)
	{
		$this->db->select("*")
				 ->from("counter")
				 ->where("id_counter", $id_counter);
		return $this->db->get();
	}
	
	function dt_counter2($id)
	{
		$this->db->select("*")
				 ->from("counter_live")
				 ->where("id", $id);
		return $this->db->get();
	}	
	
	function dt_meter($id)
	{
		$this->db->select("*")
				 ->from("data_meter")
				 ->where("id", $id);
		return $this->db->get();
	}
	
	
	function count_data_($table)
	{
		$this->db->from($table);
		return $this->db->count_all_results();
	}
	
	function count_data($table, $username=false)
	{
		$sql = "select * from " . $table . " "; 
		$sql .= "where metergroupid in ";
		$sql .= "( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
		$sql .= ") ";
		
		$query 	= $this->db->query($sql);
		return $query->num_rows();
	}
	
}