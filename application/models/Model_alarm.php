<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_alarm extends CI_Model{
	

	function get_today($table){		
		// return $this->db->get($table);

		$sql  = "select * from ". $table." ta ";
		$sql .= "inner join data_meter tm on ta.id = tm.id ";
		$sql .= "where date(ta.date_time) = date(LOCALTIMESTAMP) ";
		$sql .= "ORDER BY ta.id_alarm DESC ";
		// $sql .= "LIMIT 100 ";   // limit alarr 
			//echo $sql;
		return 	$query 	= $this->db->query($sql);
			// return $query->result_array();
	}

	function get_all($table){		
		// return $this->db->get($table);

		$sql  = "select * from ". $table." ta ";
		$sql .= "inner join data_meter tm on ta.id = tm.id ";
		$sql .= "where date(ta.date_time) < date(LOCALTIMESTAMP) ";
		$sql .= "ORDER BY ta.id_alarm DESC ";
		$sql .= "LIMIT 10000 ";   // limit alarr 
			//echo $sql;
		return 	$query 	= $this->db->query($sql);
			// return $query->result_array();
	}

	function getdata($table){		
		// return $this->db->get($table);

		$sql  = "select * from ". $table." ta ";
		$sql .= "inner join data_meter tm on ta.id = tm.id ";
		$sql .= "ORDER BY ta.id_alarm DESC ";
		$sql .= "LIMIT 100 ";   // limit alarr 
			//echo $sql;
		return 	$query 	= $this->db->query($sql);
			// return $query->result_array();
	}
	
	function getdata_all($table){		
		// return $this->db->get($table);

		$sql  = "select * from ". $table." ta ";
		$sql .= "inner join data_meter tm on ta.id = tm.id ";
		$sql .= "ORDER BY ta.id_alarm DESC ";
		$sql .= "LIMIT 1000 ";   // limit alarr 
			//echo $sql;
		return 	$query 	= $this->db->query($sql);
			// return $query->result_array();
	}

	// generic function
	function data_list($var_date_from=false, $var_date_thru=false, $var_shownumber=false, $var_active=1, $var_username=false) {
		$sql  = "select ta.id_alarm, ta.id, tm.id as id_meter, tm.id_name, tm.id_serial, ta.date_time, ta.alarmlog, ta.created ";
		$sql .= "from ( ";
		$sql .= "alarm ta left join alarmsettings ts on ta.id_alarm = ts.id_alarm and ts.onoff = 0 ";
		if ($var_username) {
			$sql .= "and ts.username = '" . $var_username . "' ";
		}
		$sql .= ") ";
		$sql .= "left join data_meter tm on ta.id = tm.id ";
		$sql .= "where 1 = 1 ";
		$sql .= "and ts.id_alarm is null ";
		//$sql .= "and (date(ta.date_time) BETWEEN "' . $var_date_from . '" and "' . $var_date_thru . '") ";
		
		$sql .= "and tm.metergroupid in ";
		$sql .= "( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $var_username . "' ";
		$sql .= ") ";
		
		if ($var_active != "ALL") {
			$sql .= "and ta.active = " . $var_active . " ";
		}
		$sql .= "order by ta.date_time desc ";
		if ($var_shownumber != "ALL") {
			//$sql .= "limit 0 offset " . $var_shownumber . " ";
		}
		
		//echo $sql;
		$query 	= $this->db->query($sql);
		return $query->result_array();
	}
	
	function tampil($var_date_from=false, $var_date_thru=false, $var_shownumber=false, $var_active=1, $var_username=false){
		$sql  = "select ta.id_alarm, ta.id, tm.id as id_meter, tm.id_name, tm.id_serial, ta.date_time, ta.alarmlog, ta.created ";
		$sql .= "from ( ";
		$sql .= "pg_alarm ta left join alarmsettings ts on ta.id_alarm = ts.id_alarm and ts.onoff = 0 ";
		if ($var_username) {
			$sql .= "and ts.username = '" . $var_username . "' ";
		}
		$sql .= ") ";
		$sql .= "left join data_meter tm on ta.id = tm.id ";
		$sql .= "where 1 = 1 ";
		$sql .= "and ts.id_alarm is null ";
		//$sql .= "and (date(ta.date_time) BETWEEN "' . $var_date_from . '" and "' . $var_date_thru . '") ";
		
		$sql .= "and tm.metergroupid in ";
		$sql .= "( ";
		$sql .= "select metergroupid from usermetergroups where username = '" . $var_username . "' ";
		$sql .= ") ";
		
		if ($var_active != "ALL") {
			$sql .= "and ta.active = " . $var_active . " ";
		}
		$sql .= "order by ta.date_time desc ";
		if ($var_shownumber != "ALL") {
			$sql .= "limit 10 offset " . $var_shownumber . " ";
		}
		$query 	= $this->db->query($sql);

		return $query;
	}
}