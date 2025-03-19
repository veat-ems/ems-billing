<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_meterdata extends CI_Model{
	
	function tampil(){		
		return $this->db->get('data_meter');
	}
	
	function getdata_all($table){		
		return $this->db->get($table);
	}
	
	function getlistfree_id($table) {
		$sql  = "select	pgcl.id ";
		$sql .= "from " . $table . " pgcl ";
		$sql .= "where pgcl.id not in ( select id from data_meter ) ";
		$sql .= "and length(pgcl.id) < 10 ";
		$sql .= "and length(pgcl.id) > 0";
		$query 	= $this->db->query($sql);
		return $query->result();
	}

	function getdatax($table, $username=false){
		$sql = "select * from  " . $table . " "; 
		$sql .= "where metergroupid in ";
		$sql .= "( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
		$sql .= ") ";
		$query 	= $this->db->query($sql);
		return $query;
		
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
	
	function get_id() {
  		$query = $this->db->query("SELECT MAX(id_meter) as max_id FROM data_meter"); 
  		$row = $query->row_array();
  		$max_id = $row['max_id'];
  		$id_meter = $max_id +1;
  		return $id_meter;
 	}
	
	// generic function
	function data_list($username=false, $userlevel=false) {
		$sql  = "";
		$sql .= "select t1.*, coalesce('" . $userlevel . "', '') AS userlevel, coalesce(t2.metergroupname, '') as metergroupname_formatted ";
		$sql .= "from data_meter t1 left join metergroups t2 on t1.metergroupid = t2.metergroupid ";
		$sql .= "where t1.metergroupid in ";
		$sql .= "( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
		$sql .= ") ";

		$query 	= $this->db->query($sql);
		// var_dump($sql);
		// die;
		return $query->result_array();
	}
		 
	function input_user($data,$table){
		$this->db->insert($table,$data);
	}
	
	function cek_id($id){	
		
		$this->db->where('id', $id);
		return $this->db->get('data_meter');
	}
	
	function cek_cm($com,$modbus){			
		$this->db->where('com', $com);
		$this->db->where('modbus', $modbus);
		return $this->db->get('data_meter');
	}
	
	function created_meterdata($data,$table){
		$this->db->insert($table,$data);
	}
	
	function get_insertpicture($id_meter, $data,  $table){
		$this->db->where('id_meter', $id_meter);
		$this->db->update($table,$data);
	}
	
	function formdata($id_meter)
	{
		$this->db->select('*')
				 ->from('data_meter')
				 ->where('id_meter', $id_meter);
		return $this->db->get();
	}	
 
	function hapus_user($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
	
	
 
	function edit_user($where,$table){		
		return $this->db->get_where($table,$where);
	}
 
	function update_user($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	
	function delete($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}	
}