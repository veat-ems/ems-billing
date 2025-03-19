<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_dashboard extends CI_Model{
	
	function tampil($metergroupid=false){	
		$this->db->from("data_meter");	
		return $this->db->get();
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
	
	function dt_counter($table, $id_counter)
	{
		$this->db->select("*")
				 ->from($table)
				 ->where("id_counter", $id_counter);
		return $this->db->get();
	}
	
	function dt_counter_formatted($table, $id_counter)
	{
		$this->db->select("date_time, TRUNC((kwh1/1000), 1) as kwh1, TRUNC((kwh2/1000), 1) as kwh2, TRUNC((kwh_exp/1000), 1) as kwh_exp")
				 ->from($table)
				 ->where("id_counter", $id_counter);
		return $this->db->get();
	}
	
	function dt_counter_group_formatted($table, $metergroupid)
	{
		$this->db->select("date_time, TRUNC((active_energy/1000), 1) as active_energy, TRUNC((maximum_demand/1000), 1) as maximum_demand, TRUNC((average_demand/1000), 1) as average_demand, TRUNC((apparent_power/1000), 1) as apparent_power, TRUNC((reactive_power/1000), 1) as reactive_power")
				 ->from($table)
				 ->where("metergroupid", $metergroupid);
		return $this->db->get();
	}
			
	
	function count_com()
	{
		$this->db->from("com");
		return $this->db->count_all_results();
	}
	
	function count_modbus()
	{
		$this->db->from("modbus");
		return $this->db->count_all_results();
	}
	

	function get_data_metergroup_paging_list($limit, $start, $username=false){
		
		$sql = "select * from  metergroups "; 
		$sql .= "where metergroupid in ";
		$sql .= "( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
		$sql .= ") ";
		$sql .= "limit " . $limit . " offset " . $start . " ";
		
		$query 	= $this->db->query($sql);
		return $query;
		
	}
		
	function get_data_meter_paging_list($limit, $start, $username=false){
		//$query = $this->db->get("data_meter", $limit, $start);
		//return $query;
	
		
		$sql = "select * from  data_meter "; 
		$sql .= "where metergroupid in ";
		$sql .= "( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
		$sql .= ") ";
		$sql .= "limit " . $limit . " offset " . $start . " "; 
		//$sql .= "limit 1 offset 0 "; 
		
		$query 	= $this->db->query($sql);
		return $query;
		
	}
	
	function count_rows($table, $username=false){
		//$query = $this->db->get("data_meter", $limit, $start);
		//return $query;
	
		$sql = "select * from " . $table . " "; 
		$sql .= "where metergroupid in ";
		$sql .= "( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
		$sql .= ") ";
		
		$query 	= $this->db->query($sql);
		return $query->num_rows();

	}	
	
		
}