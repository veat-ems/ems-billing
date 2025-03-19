<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_tabelperjam extends CI_Model{
	
	
	function tampil(){		
		return $this->db->get("data_meter");
	}
	function getdata_all($table){		
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
	
	// generic function
	function data_list($username=false) {
		$sql  = "";
		$sql .= "select t1.id_meter, t1.id_name, t2.date_time, t2.id, t2.type ";
		$sql .= ", TRUNC(coalesce(t2.v1, 0), 2) as v1, TRUNC(coalesce(t2.v2, 0), 2) as v2, TRUNC(coalesce(t2.v3, 0), 2) as v3 ";
		$sql .= ", TRUNC(coalesce(t2.v12, 0), 2) as v12, TRUNC(coalesce(t2.v23, 0), 2) as v23, TRUNC(coalesce(t2.v31, 0), 2) as v31 ";
		$sql .= ", TRUNC(coalesce(t2.i1, 0), 2) as i1, TRUNC(coalesce(t2.i2, 0), 2) as i2, TRUNC(coalesce(t2.i3, 0), 2) as i3, TRUNC(coalesce(t2.inet, 0), 2) as inet ";
		$sql .= ", TRUNC(coalesce(t2.watt1, 0), 2) as watt1, TRUNC(coalesce(t2.watt2, 0), 2) as watt2, TRUNC(coalesce(t2.watt3, 0), 2) as watt3, TRUNC(coalesce(t2.watt, 0), 2) as watt ";
		$sql .= ", TRUNC(coalesce(t2.va1, 0), 2) as va1, TRUNC(coalesce(t2.va2, 0), 2) as va2, TRUNC(coalesce(t2.va3, 0), 2) as va3, TRUNC(coalesce(t2.va, 0), 2) as va ";
		$sql .= ", TRUNC(coalesce(t2.freq, 0), 2) as freq, TRUNC(coalesce(t2.pf1, 0), 2) as pf1, TRUNC(coalesce(t2.pf2, 0), 2) as pf2, TRUNC(coalesce(t2.pf3, 0), 2) as pf3 ";
		$sql .= ", TRUNC(coalesce(t2.kwh_imp, 0)/1000 , 2) as kwh_imp, TRUNC(coalesce(t2.kwh_exp, 0)/1000 , 2) as kwh_exp ";
		$sql .= ", TRUNC(coalesce(t2.kvarh_imp, 0)/1000 , 2) as kvarh_imp, TRUNC(coalesce(t2.kvarh_exp, 0)/1000 , 2) as kvarh_exp, TRUNC(coalesce(t2.kvah, 0)/1000 , 2) as kvah ";
		$sql .= ", TRUNC(coalesce(t2.thd_v1, 0), 2) as thd_v1, TRUNC(coalesce(t2.thd_v2, 0), 2) as thd_v2, TRUNC(coalesce(t2.thd_v3, 0), 2) as thd_v3 ";
		$sql .= ", TRUNC(coalesce(t2.thd_i1, 0), 2) as thd_i1, TRUNC(coalesce(t2.thd_i2, 0), 2) as thd_i2, TRUNC(coalesce(t2.thd_i3, 0), 2) as thd_i3 ";
		$sql .= "from data_meter t1 left join counter2 t2 on t1.id = t2.id ";
		$sql .= "where t1.metergroupid in ";
		$sql .= "( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $username . "' ";
		$sql .= ") ";

		$query 	= $this->db->query($sql);
		return $query->result_array();
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