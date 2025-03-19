<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_variabletable extends CI_Model{
	
	function tampil(){		
		return $this->db->get('data_meter');
	}
	
	function getdata($table){		
		return $this->db->get($table);
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
	
	public function getcounter_id($table,$id) {
  		$this->db->select("MAX(id_counter) as max_id")
				 ->from($table)
				 ->where("id",$id);
		$query = $this->db->get();
		$row = $query->row_array();
  		$max_id = $row["max_id"];
  		return $max_id;
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
				 ->from("counter2")
				 ->where("id", $id);
		return $this->db->get();
	}	
	
	
	function count_data($table)
	{
		$this->db->from($table);
		return $this->db->count_all_results();
	}
	
}