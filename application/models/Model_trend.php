<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_trend extends CI_Model{
	
	// ---- v.6 -------------
	
	function get_trend_daily_max_6($tablename='counter_transit', $id, $date_from, $date_thru) {
		$sql  = "SELECT id, date(date_time) as date_time, "; 
		$sql .= "max(v1) as v1, max(v2) as v2, max(v3) as v3, max(v12) as v12, max(v23) as v23, max(v31) as v31, "; 
		$sql .= "max(i1) as i1, max(i2) as i2, max(i3) as i3, max(inet) as inet, "; 
		$sql .= "max(watt1) as watt1, max(watt2) as watt2, max(watt3) as watt3, max(watt) as watt, "; 
		$sql .= "max(va1) as va1, max(va2) as va2, max(va3) as va3, max(va) as va, "; 
		$sql .= "max(freq) as freq, max(pf1) as pf1, max(pf2) as pf2, max(pf3) as pf3, "; 
		$sql .= "max(kwh_exp) as kwh_exp, max(kwh_imp) as kwh_imp, max(kvarh_exp) as kvarh_exp, max(kvarh_imp) as kvarh_imp, "; 
		$sql .= "max(kvah) as kvah, "; 
		$sql .= "max(thd_v1) as thd_v1, max(thd_v2) as thd_v2, max(thd_v3) as thd_v3, "; 
		$sql .= "max(thd_i1) as thd_i1, max(thd_i2) as thd_i2, max(thd_i3) as thd_i3, "; 
		$sql .= "max(kwh1) as kwh1, max(kwh2) as kwh2, max(kwh) as kwh "; 
		$sql .= "FROM " . $tablename . " "; 
		$sql .= "where id = '" . $id . "' and date_time BETWEEN '" . $date_from . "' and '" . $date_thru . "'  "; 
		$sql .= "group by id, date(date_time) ";
		
		//echo $sql;
		
		$query 	= $this->db->query($sql);
		$result = $query->result();
		
		return $result;
		
	}
	
	
	function get_trend_hourly_6($tablename="counter_jam", $id, $date_from, $date_thru) {
		$sql  = "select concat(DATE(date_time), ' ', extract(hour from date_time), '-00-00') as date_time, id " ;
		$sql .= ", sum(v1) as v1, sum(v2) as v2, sum(v3) as v3, sum(v12) as v12, sum(v23) as v23, sum(v31) as v31 ";
		$sql .= ", sum(i1) as i1, sum(i2) as i2, sum(i3) as i3, sum(inet) as inet ";
		$sql .= ", sum(watt1) as watt1, sum(watt2) as watt2, sum(watt3) as watt3, sum(watt) as watt ";
		$sql .= ", sum(va1) as va1, sum(va2) as va2, sum(va3) as va3, sum(va) as va ";
		$sql .= ", sum(freq) as freq, sum(pf1) as pf1, sum(pf2) as pf2, sum(pf3) as pf3 ";
		$sql .= ", sum(kwh_exp) as kwh_exp, sum(kwh_imp) as kwh_imp ";
		$sql .= ", sum(kvarh_exp) as kvarh_exp, sum(kvarh_imp) as kvarh_imp, sum(kvah) as kvah ";
		$sql .= ", sum(thd_v1) as thd_v1, sum(thd_v2) as thd_v2, sum(thd_v3) as thd_v3 ";
		$sql .= ", sum(thd_i1) as thd_i1, sum(thd_i2) as thd_i2, sum(thd_i3) as thd_i3 ";
		$sql .= ", sum(kwh1) as kwh1, sum(kwh2) as kwh2, sum(kwh) as kwh ";
		$sql .= "from " . $tablename . " a ";
		$sql .= "where a.date_time BETWEEN '" . $date_from . "' and '" . $date_thru . "' ";
		$sql .= "and a.id = '" . $id . "' ";
		$sql .= "group by a.id, DATE(a.date_time), extract(hour from a.date_time) ";
		
		//echo $sql;
		$query 	= $this->db->query($sql);
		$result = $query->result();
		
		return $result;
		
	}
	
	
	// -------------------------------
	
	function get_trend_monthly($tablename='counter_jam', $id, $date_from, $date_thru) {
		$sql  = "select * from " . $tablename . " a ";
		$sql .= "where  ";
		$sql .= "a.date_time in "; 
		$sql .= "( ";
		$sql .= "SELECT min(b.date_time) ";
		$sql .= "FROM " . $tablename . " b ";
		$sql .= "where a.id = b.id ";
		$sql .= "and date(a.date_time) BETWEEN '" . $date_from . "' and '" . $date_thru . "' ";
		$sql .= "group by b.id, date(b.date_time), day(b.date_time) ";
		$sql .= ") ";
		$sql .= "and id = '" . $id . "' ";
		
		$query 	= $this->db->query($sql);
		$result = $query->result();
		
		return $result;
		
	}
	
	
	function get_trend_monthly_max($tablename='counter_jam', $id, $date_from, $date_thru) {
		$sql  = "SELECT id_counter, date_time, id, panel, tanggal, jam, type, com, modbus, `status`, "; 
		$sql .= "max(v1) as v1, max(v2) as v2, max(v3) as v3, max(v12) as v12, max(v23) as v23, max(v31) as v31, "; 
		$sql .= "max(i1) as i1, max(i2) as i2, max(i3) as i3, max(inet) as inet, "; 
		$sql .= "max(watt1) as watt1, max(watt2) as watt2, max(watt3) as watt3, max(watt) as watt, "; 
		$sql .= "max(va1) as va1, max(va2) as va2, max(va3) as va3, max(va) as va, "; 
		$sql .= "max(freq) as freq, max(pf1) as pf1, max(pf2) as pf2, max(pf3) as pf3, "; 
		$sql .= "max(kwh_exp) as kwh_exp, max(kwh_imp) as kwh_imp, max(kvarh_exp) as kvarh_exp, max(kvarh_imp) as kvarh_imp, "; 
		$sql .= "max(kvah) as kvah, "; 
		$sql .= "max(thd_v1) as thd_v1, max(thd_v2) as thd_v2, max(thd_v3) as thd_v3, "; 
		$sql .= "max(thd_i1) as thd_i1, max(thd_i2) as thd_i2, max(thd_i3) as thd_i3, "; 
		$sql .= "max(kwh1) as kwh1, max(kwh2) as kwh2, max(kwh) as kwh "; 
		$sql .= "FROM " . $tablename . " "; 
		$sql .= "where id = '" . $id . "' and date(date_time) BETWEEN '" . $date_from . "' and '" . $date_thru . "'  "; 
		$sql .= "group by id, date(date_time), day(date_time) ";
		
		$query 	= $this->db->query($sql);
		$result = $query->result();
		
		return $result;
		
	}
	
	function get_trend_daily($tablename='counter_jam', $id, $date_from, $date_thru) {
		$sql  = "select * from " . $tablename . " a ";
		$sql .= "where  ";
		$sql .= "a.date_time in "; 
		$sql .= "( ";
		$sql .= "SELECT min(b.date_time) ";
		$sql .= "FROM " . $tablename . " b ";
		$sql .= "where a.id = b.id ";
		$sql .= "and date(a.date_time) BETWEEN '" . $date_from . "' and '" . $date_thru . "' ";
		$sql .= "group by b.id, date(b.date_time), hour(b.date_time) ";
		$sql .= ") ";
		$sql .= "and id = '" . $id . "' ";
		//echo $sql;
		$query 	= $this->db->query($sql);
		$result = $query->result();
		
		return $result;
		
	}
	
	function searchmin($tablename, $fieldname, $conditions=NULL) {
		$this->db->select_min($fieldname);
		
		if($conditions != NULL)
			$this->db->where($conditions);
			
		$result = $this->db->get($tablename);
		$row = $result->row();
		
		return $row->$fieldname;
	}
	
	function getdata_all($table){		
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



	function getdata_orderby($table,$orderby){			
    	$this->db->from($table);
		$this->db->order_by($orderby,"desc");
		$query = $this->db->get(); 
		return $query;
	}
	
	function getdatasort_orderby($table,$where,$orderby,$dari,$sampai){			
    	$this->db->from($table);
		$this->db->where($where);
		$this->db->where("DATE(date_time)>=",$dari);
		$this->db->where("DATE(date_time)<=",$sampai);		
		$this->db->order_by($orderby,"asc");
		$query = $this->db->get(); 
		return $query;
	}
	
	function update_parameter($username=false, $module=false, $parameters=false) {
		$condition_delete["username"] 	= $username;
		$condition_delete["module"] 	= $module;
		$this->mcrud->delete($condition_delete, "fieldparameters");
		
		$sql  = "INSERT INTO fieldparameters (username, module, fieldname, setvalue) VALUES ";
		$sql .= $parameters;

		$this->db->query($sql); 
	}
	
	function get_parameter_value($username=false, $module=false, $fieldname) {
		$condition["username"] 	= $username;
		$condition["module"] 	= $module;
		$condition["fieldname"] = $fieldname;
		
		$row = $this->mcrud->search($condition, "fieldparameters");
		
		if ($row) {
			$paramvalue = $row->setvalue;
		} else {
			$paramvalue = 0;
		}
		
		
		
		return $paramvalue; 
	}
	
	function iif($if_statement, $if_true, $if_false){
		if ($if_statement == true){
			$return = $if_true;
		} else {
			$return = $if_false;
		}
		return $return;
	}
	
}