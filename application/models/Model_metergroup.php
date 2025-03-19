<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_metergroup extends CI_Model{
	
	function tampil(){		
		return $this->db->get('metergroups');
	}
	
	// generic function
	function data_list($userlevel=false) {
		$sql  = "";
		$sql .= "select t1.*, coalesce('" . $userlevel . "', '') AS userlevel ";
		$sql .= "from metergroups t1 ";
		$query 	= $this->db->query($sql);
		return $query->result_array();
	}
	
	function metergroup_selected($username) {
		$sql  = "";
		$sql .= "select * ";
		$sql .= "from metergroups ";
		$sql .= "where metergroupid in ( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
		$sql .= ") ";

		$query 	= $this->db->query($sql);
		return $query->result();
	}
	
	function metergroup_notselected($username) {
		$sql  = "";
		$sql .= "select * ";
		$sql .= "from metergroups ";
		$sql .= "where metergroupid not in ( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
		$sql .= ") ";

		$query 	= $this->db->query($sql);
		return $query->result();
	}
		
	function formdata($metergroupid)
	{
		$this->db->select('*')
				 ->from('metergroups')
				 ->where('metergroupid', $metergroupid);
		return $this->db->get();
	}
	 
	function created_metergroup($data,$table){
		$this->db->insert($table,$data);
		// $this->db->insert();
	}
	
	function delete_metergroup($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
 
	function edit_metergroup($where,$table){		
		return $this->db->get_where($table,$where);
	}
	
	function id_metergroup($metergroupid)
	{
		$this->db->select('*')
				 ->from('metergroups')
				 ->where('metergroupid', $metergroupid);
		return $this->db->get();
	}
 
	function update_metergroup($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	
	public function get_id() {
  		$query = $this->db->query("SELECT MAX(metergroupid) as max_id FROM metergroups"); 
  		$row = $query->row_array();
  		$max_id = $row['max_id'];
  		$id_user = $max_id +1;
  		return $id_user;
 	}
	
	function cek_metergroupid($metergroupid){	
		
		$this->db->where('metergroupid', $metergroupid);
		return $this->db->get('metergroups');
	}
	
}