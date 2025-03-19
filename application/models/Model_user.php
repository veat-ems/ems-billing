<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model{
	
	function tampil_user(){		
		return $this->db->get('user');
	}
	
	// generic function
	function data_list($userlevel=false) {
		$sql  = "";
		$sql .= "select t1.*, coalesce('" . $userlevel . "', '') AS userlevel ";
		$sql .= "from \"user\" t1 ";
		$query 	= $this->db->query($sql);
		return $query->result_array();
	}
	
	function formdata($id_user)
	{
		$this->db->select('*')
				 ->from('user')
				 ->where('id_user', $id_user);
		return $this->db->get();
	}
	 
	function created_user($data,$table){
		$this->db->insert($table,$data);
	}
	
	function delete_user($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
 
	function edit_user($where,$table){		
		return $this->db->get_where($table,$where);
	}
	
	function id_user($id_user)
	{
		$this->db->select('*')
				 ->from('user')
				 ->where('id_user', $id_user);
		return $this->db->get();
	}
 
	function update_user($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	
	public function get_id() {
  		$query = $this->db->query("SELECT MAX(id_user) as max_id FROM \"user\""); 
  		$row = $query->row_array();
  		$max_id = $row['max_id'];
  		$id_user = $max_id +1;
  		return $id_user;
 	}
	
	function cek_username($username){	
		
		$this->db->where('username', $username);
		return $this->db->get('user');
	}
	
	function cek_password($username, $password){	
		
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		return $this->db->get('user');
	}
	
}