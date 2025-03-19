<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_login extends CI_Model{
	
	function cek($username, $password){	
		$pengacak 	= "AJBBBLAJSCLWLWJJJJKLLL";
		$passwordku = md5($pengacak . md5($password) . $pengacak );
		$this->db->where("username", $username);
		$this->db->where("password", $passwordku);
		return $this->db->get("user");
	}
	
	
	
	function ckv(){
		
		$mc = mcNCdy();
		$ls = dKTyJmsw($mc);
		$query = $this->db->query("SELECT * FROM tb_sip where id='1' and mc='$mc' and nama='$ls' "); 
		$row   = $query->row_array();
		if($query->num_rows() == 1)
		{
		 	$ckk = "Verified";
		}
		else{
		 	$ckk = "Non";
		}
		return $ckk;
	}
	
	
	function cks(){
		
		$query = $this->db->query("SELECT * FROM tb_sip where id='1' "); 
		$row   = $query->row_array();
		if($query->num_rows() == 1)
		{
		 	$cks = $query->num_rows();
		}
		else{
		 	$cks = 0;
		}
		return $cks;
	}	
	
	function ckb(){
		
		$query = $this->db->query("SELECT * FROM tb_sip where id='1' "); 
		$row   = $query->row_array();
		if($query->num_rows() == 1)
		{
		 	$ckb = $row['kd'];
		}
		else{
		 	$ckb = 0;
		}
		return $ckb;
	}
	
	
	function created($data,$table){
		$this->db->insert($table,$data);
	}
 
	function update($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	
	
}